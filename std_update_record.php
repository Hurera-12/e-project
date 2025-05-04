<?php
include "database.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM borrow_records WHERE id = $id");

    if ($result && $result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $update_id = intval($_POST['update_id']);
    $updated_title = $conn->real_escape_string($_POST['book_title']);

    $update_query = "UPDATE borrow_records SET book_title = '$updated_title' WHERE id = $update_id";
    if ($conn->query($update_query)) {
        header("Location: std_borrowed_books.php");
        exit;
    } else {
        echo "Update failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: burlywood;">
<div class="container mt-5">
    <h2>Update Borrowed Book</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Book Title</label>
            <input type="text" name="book_title" class="form-control" value="<?= htmlspecialchars($book['book_title']) ?>" required>
        </div>
        <input type="hidden" name="update_id" value="<?= $book['id'] ?>">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="borrowed_books.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
