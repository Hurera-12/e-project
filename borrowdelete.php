<?php
include "database.php";

// Check if user_id is set in the GET request


// Check if user_id is set in the GET request
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); // Sanitize input

    // Prepare SQL DELETE statement
    $stmt = $conn->prepare("DELETE FROM borrow_records WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect to the main page after deletion
        header("Location: borrow.php"); // change 'borrow.php' to your main file name if different
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request. No user ID specified.";
}

$conn->close();
?>