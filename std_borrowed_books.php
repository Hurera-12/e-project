<?php
include "database.php"; // Connect to library_db

// Fetch records if student ID is entered
$books = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id_search'])) {
    $student_id = intval($_POST['user_id_search']);

    $result = $conn->query("SELECT * FROM borrow_records WHERE user_id = $student_id");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    } else {
        echo "<p class='text-warning'>No books found for this Student ID.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrowed Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="std_borrowed_books.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Borrowed Books List</h2>

    <!-- Search Form -->
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="number" name="user_id_search" class="form-control" placeholder="Enter Student ID" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <?php if (!empty($books)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Borrow Date</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><?= htmlspecialchars($book['book_title']) ?></td>
                        <td><?= htmlspecialchars($book['issue_date']) ?></td>
                        <td>
                            <a href="std_update_record.php?id=<?= $book['id'] ?>" class="btn btn-success btn-sm">Update</a>
                        </td>
                        <td>
                            <a href="std_delete_record.php?id=<?= $book['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
