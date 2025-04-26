<?php
// Include database connection
include "database.php";

// Check if the 'user_id' parameter is provided via GET request
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch the current borrow record for the given user_id
    $sql = "SELECT * FROM borrow_records WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Get the record from the result set
    } else {
        echo "<p>No record found for user ID $user_id</p>";
        exit();
    }
} else {
    echo "<p>User ID is required.</p>";
    exit();
}

// Handle form submission to update the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve new values from the form
    $return_date = $_POST['return_date'];
    $status = $_POST['status'];
    $fine = $_POST['fine'];

    // Update the record in the database
    $update_sql = "UPDATE borrow_records 
                   SET return_date = '$return_date', status = '$status', fine = '$fine'
                   WHERE user_id = '$user_id'";

    if ($conn->query($update_sql) === TRUE) {
        // echo "<p>Record updated successfully!</p>";
        // Redirect back to the main page or the records list page
        header("location: borrow.php") ;
 } 
}
    

$conn->close();
?>
    

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

<link rel="stylesheet" href="borrowupdate.css">
  <title>Update Borrow Record</title>
</head>
<body>
  <div class="container mt-4">
    <h1 class="mb-4">Update Borrow Record</h1>
    <form method="POST">
    <div class="mb-3">
    <label for="user_id" class="form-label">User_Id</label>
    <br>
    
    <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $row['user_id'] ?>" required>
    <br>
    <div class="mb-3">
    <label for="user_id" class="form-label">User_Name</label>
    <br>
    
    <input type="text" class="form-control" id="user_name"name="user_name" value="<?= $row['user_name'] ?>" required >
    <br>
    <div class="mb-3">
    <label for="user_id" class="form-label">book_Title</label>
    <br>
    
    <input type="text" class="form-control" id="book_title" name="book_title" value="<?= $row['book_title'] ?>" required >
    <br>
      <div class="mb-3">
        <label for="return_date" class="form-label">Issue Date</label>
        <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?= $row['issue_date'] ?>" required>
      </div>
      <br>
      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" class="form-control" id="due_date" name="due_date" value="<?= $row['due_date'] ?>" required>
      </div>
    <br>
      <div class="mb-3">
        <label for="return_date" class="form-label">Return Date</label>
        <input type="date" class="form-control" id="return_date" name="return_date" value="<?= $row['return_date'] ?>" required>
      </div>
      <br> 

      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
          <option value="Returned" <?= $row['status'] == 'Returned' ? 'selected' : '' ?>>Returned</option>
          
          <option value="Over Due" <?= $row['status'] == 'Over Due' ? 'selected' : '' ?>>Over Due</option>
          <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>

        </select>
      </div>
      <div class="mb-3">
        <label for="fine" class="form-label">Fine ($)</label>
        <input type="number" class="form-control" id="fine" name="fine" value="<?= $row['fine'] ?>" step="0.01" required>
      </div>
      <button type="submit" class="btn btn-primary">Update Record</button>
    </form>
  </div>
</body>
</html>
