<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../config/db.php";

$sql = "
    SELECT DISTINCT DATE(thoiGianBatDau) AS ngay
    FROM KHUNGGIOTUVAN
    WHERE conTrong = 1
    ORDER BY ngay ASC
";

$stmt = $conn->prepare($sql);
$stmt->execute();

$ngay = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($ngay);