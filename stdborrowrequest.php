<?php 
$servername="localhost";
$username="root";
$password="";
$db="borrowrequest";

$conn=new mysqli($servername,$username,$password,$db);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request a Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2>Student Borrow Request</h2>
    <form action="submit_borrow_request.php" method="POST">
      <div class="mb-3">
        <label for="user_id" class="form-label">Student ID</label>
        <input type="number" class="form-control" id="user_id" name="user_id" required>
      </div>
      <div class="mb-3">
        <label for="user_name" class="form-label">Student Name</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
      </div>
      <div class="mb-3">
        <label for="book_title" class="form-label">Book Title</label>
        <input type="text" class="form-control" id="book_title" name="book_title" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
  </div>
</body>
</html>
