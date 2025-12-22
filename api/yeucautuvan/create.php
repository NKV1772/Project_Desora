<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
  echo json_encode(["error" => "Dữ liệu không hợp lệ"]);
  exit;
}

$conn->beginTransaction();

try {
  /* =============================
     1. TẠO / LẤY KHÁCH HÀNG
  ============================== */
  $sql = "SELECT maKH FROM khachhang WHERE email = :email LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute(["email" => $data["email"]]);
  $kh = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($kh) {
    $maKH = $kh["maKH"];
  } else {
    $sql = "
            INSERT INTO khachhang (hoTen, email, sdt, tenShop)
            VALUES (:hoTen, :email, :sdt, :tenShop)
        ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      "hoTen" => $data["hoTen"],
      "email" => $data["email"],
      "sdt" => $data["sdt"],
      "tenShop" => $data["tenShop"]
    ]);
    $maKH = $conn->lastInsertId();
  }

  /* =============================
     2. TẠO YÊU CẦU TƯ VẤN
  ============================== */
  $sql = "
        INSERT INTO yeucautuvan (maKH, maKGTV, nganSach, moTa)
        VALUES (:maKH, :maKGTV, :nganSach, :moTa)
    ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([
    "maKH" => $maKH,
    "maKGTV" => $data["maKGTV"],
    "nganSach" => $data["nganSach"],
    "moTa" => $data["moTa"]
  ]);

  $maYCTV = $conn->lastInsertId();

  /* =============================
     3. CHI TIẾT NHU CẦU
  ============================== */
  if (!empty($data["nhuCau"])) {
    $sql = "
            INSERT INTO chitietyeucau (maYC, maNC)
            VALUES (:maYC, :maNC)
        ";
    $stmt = $conn->prepare($sql);

    foreach ($data["nhuCau"] as $maNC) {
      $stmt->execute([
        "maYC" => $maYCTV,
        "maNC" => $maNC
      ]);
    }
  }

  /* =============================
     4. CẬP NHẬT KHUNG GIỜ
  ============================== */
  $sql = "UPDATE khunggiotuvan SET conTrong = 0 WHERE maKGTV = :maKGTV";
  $stmt = $conn->prepare($sql);
  $stmt->execute(["maKGTV" => $data["maKGTV"]]);

  /* =============================
     5. GỬI EMAIL XÁC NHẬN
  ============================== */
  $to = $data["email"];
  $subject = "Xác nhận yêu cầu tư vấn - Desora";
  $message = "
        Xin chào {$data["hoTen"]},\n\n
        Yêu cầu tư vấn của bạn đã được ghi nhận.\n
        Desora sẽ liên hệ trong thời gian sớm nhất.\n\n
        Cảm ơn bạn!
    ";
  $headers = "From: no-reply@desora.vn";

  mail($to, $subject, $message, $headers);

  /* =============================
     HOÀN TẤT
  ============================== */
  $conn->commit();

  echo json_encode([
    "success" => true,
    "maYCTV" => $maYCTV
  ]);

} catch (Exception $e) {
  $conn->rollBack();
  echo json_encode([
    "error" => $e->getMessage()
  ]);
}
