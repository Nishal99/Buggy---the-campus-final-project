<?php

header('Content-Type: text/html'); // Change content type to HTML

// Read the input data
$input = file_get_contents('php://input');

// Save the input data to a temporary file
$temp_file = tempnam(sys_get_temp_dir(), 'click_history_');
file_put_contents($temp_file, $input);

// Execute the Python script with the temporary file as an argument
$output = shell_exec("python analyze-gap.py $temp_file 2>&1");

// Remove the temporary file
unlink($temp_file);

// Define the mapping of keywords to URLs
$links = [
    "CSS Animations" => "https://youtube.com/playlist?list=PL4cUxeGkcC9iGYgmEd2dm3zAKzyCGDtM5&si=UWqLVhgzu4czJDPB",
    "CSS Flexbox" => "https://youtube.com/playlist?list=PL4cUxeGkcC9i3FXJSUfmsNOx8E7u6UuhG&si=jy5rKlUS81mKmZw5",
    "CSS Preprocessors" => "https://youtu.be/IiujOinbGzw?si=PUTBKY6_AZdX4qvc",
    "CSS Selectors" => "https://youtu.be/Z07d9Vu7GKM?si=0yOEnb6292rTY-Ab",
    "HTML Basics" => "https://youtu.be/qz0aGYrrlhU?si=kVsxzPOxrju6ZbeU",
    "CSS Properties" => "https://youtu.be/oAkPcpzjDBI?si=xng81CQRYq-yfYB9",
    "CSS Borders" => "https://youtu.be/pkNdQ7TmxIw?si=ALrzhgnlQOCvq-Wh",
    "CSS Positioning" => "https://youtube.com/playlist?list=PL4cUxeGkcC9hudKGi5o5UiWuTAGbxiLTh&si=4CG6p0vJqHQgo_4V",
    "CSS Interactivity" => "https://youtube.com/playlist?list=PL5e68lK9hEzcZLltZrc3NDlKWS3XygchY&si=y9-kHEmypVg8uDZc",
    "CSS Basics" => "https://youtube.com/playlist?list=PLr6-GrHUlVf8JIgLcu3sHigvQjTw_aC9C&si=_GNk7S0U_62OoHu-",
    "CSS Transformations" => "https://youtu.be/qdeIy9_fbxE?si=GD9OCzN7wVzRTM_S",
    "CSS Grid" => "https://youtube.com/playlist?list=PL4cUxeGkcC9itC4TxYMzFCfveyutyPOCY&si=gGFn3OUN4O6Xc5rM",
    "Responsive Design" => "https://youtube.com/playlist?list=PLSJxovi1IyDH-pPIe0OF0z_mW-WVdhmhx&si=-pUCVFTsQp5zBC8X",
    "CSS Effects" => "https://youtube.com/playlist?list=PL5e68lK9hEzcduOKAjayn5HsxZUCypc2U&si=fn4dIGLBhwUeNCK7",
    "CSS Text Effects" => "https://youtube.com/playlist?list=PL5e68lK9hEzdGazIG1ONnb7TJ74Q69rH7&si=lj0m5f8a008ja0V4",
    "CSS Performance" => "https://youtu.be/-CATiyw2-Ns?si=0UzRAUTJVZGluzpu",
    "CSS Box Model" => "https://youtu.be/nSst4-WbEZk?si=R-DScwlha5PhoUSs",
    "CSS Layout" => "https://youtube.com/playlist?list=PLdE8ESr9Th_uU8IAMv4MQDAsD0z7Aj4hr&si=6he20Sujbt11Kz3u",
    "CSS 3D Transforms" => "https://youtube.com/playlist?list=PL5e68lK9hEze9y8yDozv1GHSGDM0ER9is&si=_lfPOHeGZ107wTGN",
    "CSS Text" => "https://youtube.com/playlist?list=PL5e68lK9hEzdGazIG1ONnb7TJ74Q69rH7&si=lj0m5f8a008ja0V4"

];


// Decode HTML entities and wrap each output line in the HTML div
$lines = explode("\n", $output);
$preprocessed_output = [];
$seen_categories = [];  // Array to keep track of categories that have already been added

foreach ($lines as $line) {
    $decoded_line = html_entity_decode(trim($line));
    if ($decoded_line !== "" && !preg_match('/^\[nltk_data\]/', $decoded_line) && !in_array($decoded_line, $seen_categories)) {
        // Add to the output and mark this category as seen
        if (array_key_exists($decoded_line, $links)) {
            $url = $links[$decoded_line];
            $preprocessed_output[] = '<a class="a-cat" target="_blank" href="' . htmlspecialchars($url) . '"><div class="analyze-gap">' . htmlspecialchars($decoded_line) . '</div></a>';
        } else {
            $preprocessed_output[] = '<div class="analyze-gap">' . htmlspecialchars($decoded_line) . '</div>';
        }
        $seen_categories[] = $decoded_line;
    }
}

// Add the heading if there are any categories
if (!empty($preprocessed_output)) {
    array_unshift($preprocessed_output, '<div class="heading_kg" id="heading_kg">You must gain your knowledge in below areas</div>');
}

if (empty($preprocessed_output)) {
    echo "Error running the Python script or no output generated";
} else {
    // Output the HTML
    echo implode("\n", $preprocessed_output);
}
?>
