<?php
session_start();

// Include the database connection file
require_once 'includes/dbh.inc.php';

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the slotId and user ID from POST request and session
$slotId = isset($_POST['slotId']) ? $_POST['slotId'] : null;
$userId = isset($_SESSION['potId']) ? $_SESSION['potId'] : null;

if (empty($slotId) || empty($userId)) {
    die("Missing slotId or userId: slotId=" . $slotId . ", userId=" . $userId);
}

// Insert the click data into user_clicks table
$sql = "INSERT INTO user_clicks (userId, questionId) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $slotId);

if ($stmt->execute()) {
    echo "Click stored successfully.";
} else {
    echo "Error storing click: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
