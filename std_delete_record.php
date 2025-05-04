<?php
include "database.php";

if (isset($_GET['id'])) {
    $delete_id = intval($_GET['id']);

    $delete_query = "DELETE FROM borrow_records WHERE id = $delete_id";
    if ($conn->query($delete_query)) {
        header("Location: std_borrowed_books.php");
        exit;
    } else {
        echo "Delete failed: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
