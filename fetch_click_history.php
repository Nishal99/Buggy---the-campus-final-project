<?php
session_start();
require_once 'includes/dbh.inc.php';

// Assuming you have stored user ID in the session
$userId = $_SESSION['potId'];

$sql = "SELECT user_clicks.clickedAt, bugs_suggestions.question, bugs_suggestions.keyword, bugs_suggestions.category 
        FROM user_clicks 
        JOIN bugs_suggestions ON user_clicks.questionId = bugs_suggestions.slotId 
        WHERE user_clicks.userId = ? 
        ORDER BY user_clicks.clickedAt DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$clickHistory = [];
while ($row = $result->fetch_assoc()) {
    $clickHistory[] = $row;
}



$stmt->close();
$conn->close();

echo json_encode($clickHistory);
?>
