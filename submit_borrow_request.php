<?php
$servername="localhost";
$username="root";
$password="";
$db="library_db";

$conn=new mysqli($servername,$username,$password,$db);



$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$book_title = $_POST['book_title'];
$issue_date = date("Y-m-d"); // Today
$due_date = date("Y-m-d", strtotime("+14 days")); // Due in 2 weeks

// Insert into admin's borrow_records as pending or into a separate borrow_requests table
$sql = "INSERT INTO borrow_records (user_id, user_name, book_title, issue_date, due_date, status, fine)
        VALUES (?, ?, ?, ?, ?, 'pending', 0)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $user_id, $user_name, $book_title, $issue_date, $due_date);

if ($stmt->execute()) {
    echo "Borrow request submitted. Waiting for approval.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
