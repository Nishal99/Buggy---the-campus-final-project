<?php
// Read the input file path from command line argument
if ($argc != 2) {
    echo "Usage: php fetch-categories.php <input_file>\n";
    exit(1);
}
$input_file = $argv[1];

// Read the click history data from the input file
$click_history_json = file_get_contents($input_file);

// Establish a database connection (assuming you have already included the necessary code to connect to your database)
require_once 'includes/dbh.inc.php';

// Execute the Python script to get knowledge gaps
$pythonScriptPath = "test.py"; // Adjust this path accordingly
$pythonOutput = shell_exec("python $pythonScriptPath $input_file");
$knowledgeGaps = json_decode($pythonOutput, true);

// Placeholder knowledge gaps
// $knowledgeGaps = [
//     "fixed footer css", // Placeholder knowledge gap
//     "responsive design" // Placeholder knowledge gap
// ];

// Fetch categories related to each knowledge gap
foreach ($knowledgeGaps as $knowledgeGap) {
    // Search for keywords related to the knowledge gap in bugs_suggestions table
    // Assuming 'keyword' is the column in your bugs_suggestions table containing keywords
    $sql = "SELECT category FROM bugs_suggestions WHERE keyword LIKE '%$knowledgeGap%'";
    $result = $conn->query($sql);

    // Fetch categories related to the knowledge gap
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
    }

    // Print categories related to the knowledge gap
    echo "Categories related to '$knowledgeGap': " . implode(', ', $categories) . "\n";
}

// Close the database connection if necessary
$conn->close();
?>
