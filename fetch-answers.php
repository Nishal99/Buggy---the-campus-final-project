<?php
// Include the database connection file and other necessary configurations
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "buggy_login";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}
// Get the selected question from the request
$selectedQuestion = $_GET['question'];

// Query the database to fetch the answer for the selected question
// You need to adjust this query according to your database schema
$sql = "SELECT answer FROM bugs_suggestions WHERE question = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedQuestion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output the answer
    $row = $result->fetch_assoc();
    echo "<p>" . $row['answer'] . "</p>";
} else {
    echo "Answer not found.";
}
?>
