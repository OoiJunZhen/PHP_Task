<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once("dbconnect.php");

     // Get user input and collected data
    $userInput = $_POST["userNumber"];
    $collectedData = json_decode($_POST["collectedData"]);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO num_table (user_input, collected_digits) VALUES (?, ?)");

    // Check if preparation succeeded
    if ($stmt) {
        // Bind parameters and set collected digits as a comma-separated string
        $stmt->bind_param("ss", $userInput, $collectedDigits);
        $collectedDigits = implode(",", $collectedData);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Data stored successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }

    // Close connection
    $conn->close();

}
?>