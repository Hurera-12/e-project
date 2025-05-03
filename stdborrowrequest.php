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

  <link rel="stylesheet" href="stdborrowrequest.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Student Borrow Request</h2>
    <form action="submit_borrow_request.php" method="POST">
  <div>
    <label>Student ID:</label>
    <input type="number" name="user_id" required>
  </div>
  <br>
  <div>
    <label>Student Name:</label>
    <input type="text" name="user_name" required>
  </div>
  <br>
  <div>
    <label>Book Title:</label>
    <input type="text" name="book_title" required>
  </div>
  <br>
  <button type="submit">Submit Request</button>
</form>

  </div>
</body>
</html>

