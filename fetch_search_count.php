<?php
session_start();
require_once 'includes/dbh.inc.php';

$userId = $_SESSION['potId'];

$totalSearchesSql = "SELECT COUNT(*) as total_search_count FROM user_clicks WHERE userId = ?";
$weekSearchesSql = "SELECT COUNT(*) as week_search_count FROM user_clicks WHERE userId = ? AND clickedAt >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";

$stmt = $conn->prepare($totalSearchesSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$totalResult = $stmt->get_result();
$totalSearchCount = $totalResult->fetch_assoc()['total_search_count'];

$stmt->close();

$stmt = $conn->prepare($weekSearchesSql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$weekResult = $stmt->get_result();
$weekSearchCount = $weekResult->fetch_assoc()['week_search_count'];

$stmt->close();
$conn->close();

echo json_encode([
    'total_search_count' => $totalSearchCount,
    'week_search_count' => $weekSearchCount,
]);
?>
