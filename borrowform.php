<?php
include "database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="borrowform.css">
</head>
<body>
    <div class"container">
        <h1>ENTRY OF BORROWED BOOKS</h1>
    </div>
</body>
</html>
<form method="POST" class="borrow-form">
    <label>User ID: <input type="number" name="user_id" required></label>
    <label>User Name: <input type="text" name="user_name" required></label>
    <label>Book Title: <input type="text" name="book_title" required></label>
    <label>Issue Date: <input type="date" name="issue_date" required></label>
    <label>Due Date: <input type="date" name="due_date" required></label>
    <label>Return Date: <input type="date" name="return_date"></label> <!-- NEW -->
    <label>Status:
        <select name="status">
            <option value="pending">Pending</option>
            <option value="returned">Returned</option>
            <option value="overdue">Overdue</option>
        </select>
    </label>
    <label>Fine ($): <input type="number" name="fine" step="0.01" value="0.00"></label>
    <button type="submit">Add Record</button>
</form>

               <?php
               if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_id = $_POST['user_id'];
                $user_name = $_POST['user_name'];
                $book_title = $_POST['book_title'];
                $issue_date = $_POST['issue_date'];
                $due_date = $_POST['due_date'];
                $return_date = !empty($_POST['return_date']) ? $_POST['return_date'] : null;
                $status = $_POST['status'];
                $fine = $_POST['fine'];
            
                $sql = "INSERT INTO borrow_records (user_id, user_name, book_title, issue_date, due_date, return_date, status, fine)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
                $stmt = $conn->prepare($sql);

            if($sql) {
                header("location: borrow.php");
            }
            
                // if (!$stmt) {
                //     die("SQL prepare failed: " . $conn->error);
                // }
            
                $stmt->bind_param("issssssd", $user_id, $user_name, $book_title, $issue_date, $due_date, $return_date, $status, $fine);
                $stmt->execute();
                $stmt->close();
            }
?>            
