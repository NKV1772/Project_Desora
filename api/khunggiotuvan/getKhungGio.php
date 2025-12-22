<?php
header("Content-Type: application/json");
require_once "../config/db.php";

$ngay = $_GET['ngay'] ?? null;

if (!$ngay) {
  echo json_encode(["error" => "Thiếu tham số ngày"]);
  exit;
}

$sql = "
    SELECT maKGTV, 
           TIME(thoiGianBatDau) AS batDau,
           TIME(thoiGianKetThuc) AS ketThuc
    FROM KHUNGGIOTUVAN
    WHERE conTrong = 1
      AND DATE(thoiGianBatDau) = :ngay
    ORDER BY thoiGianBatDau
";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":ngay", $ngay);
$stmt->execute();

$khungGio = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($khungGio);
