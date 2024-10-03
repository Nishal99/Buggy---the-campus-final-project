<?php
session_start();

// Include the database connection file
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "buggy_login";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}

// Get user input from GET request (change to POST if necessary)
$searchQuery = $_GET['q'];

// Split the search query into individual words
$searchWords = explode(" ", $searchQuery);

// Construct the WHERE clause to match any keyword that partially matches any word in the search query
$whereClause = "";
foreach ($searchWords as $word) {
    $whereClause .= " OR keyword LIKE '%" . mysqli_real_escape_string($conn, $word) . "%'";
}
$whereClause = substr($whereClause, 4); // Remove the leading " OR "

// Query to search for similar keywords in MySQL database
$sql = "SELECT slotId, keyword, question, answer FROM bugs_suggestions WHERE " . $whereClause;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output suggestions
    while($row = $result->fetch_assoc()) {
        echo "<div class='ques_div-container' data-slotid='". $row['slotId'] ."' onclick='showAnswer(this)' style='cursor:pointer;'>". $row['question'] . "</div>";
        if (array_key_exists('answer', $row)) {
            echo "<div class='answer' style='display:none;'>" . $row['answer'] . "</div>";
        }
    }
} else {
    echo "No suggestions found.";
}

$conn->close();




/*

// Include the database connection file
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "buggy_login";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}

// Get user input from GET request (change to POST if necessary)
$searchQuery = $_GET['q'];

// Split the search query into individual words
$searchWords = explode(" ", $searchQuery);

// Construct the WHERE clause to match any keyword that partially matches any word in the search query
$whereClause = "";
foreach ($searchWords as $word) {
    $whereClause .= " OR keyword LIKE '%" . mysqli_real_escape_string($conn, $word) . "%'";
}
$whereClause = substr($whereClause, 4); // Remove the leading " OR "

// Query to search for similar keywords in MySQL database
$sql = "SELECT slotId, question, answer FROM bugs_suggestions WHERE " . $whereClause;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output suggestions
    while($row = $result->fetch_assoc()) {
        echo "<div class='ques_div-container' onclick='showAnswer(this)' style='cursor:pointer;'>". $row['question'] . "</div>";
        if (array_key_exists('answer', $row)) {
            echo "<div class='answer' style='display:none;'>" . $row['answer'] . "</div>";
        }
    }
} else {
    echo "No suggestions found.";
}


$conn->close();
*/
?>