<?php include "database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <link rel="stylesheet" href="borrow.css" />
  <title>Library Borrow Record</title>
</head>
<body>
  <div class="container mt-4">
    <h1 class="mb-4">LIBRARY BORROW RECORDS</h1>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>USER ID</th>
          <th>USER NAME</th>
          <th>BOOK TITLE</th>
          <th>ISSUE DATE</th>
          <th>DUE DATE</th>
          <th>RETURN DATE</th>
          <th>STATUS</th>
          <th>FINE</th>
          <th>UPDATE</th>
          <th>DELETE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM borrow_records";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $statusClass = strtolower($row["status"]);
                echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>" . htmlspecialchars($row['user_name']) . "</td>
                        <td>" . htmlspecialchars($row['book_title']) . "</td>
                        <td>{$row['issue_date']}</td>
                        <td>{$row['due_date']}</td>
                        <td>" . ($row['return_date'] ? $row['return_date'] : '-') . "</td>
                        <td class='status-{$statusClass}'>" . htmlspecialchars($row['status']) . "</td>
                        <td>{$row['fine']}</td>
                        <td><a class='btn btn-success' href='borrowupdate.php?user_id=" . $row['user_id'] . "'>Update</a></td>
                        <td><a class='btn btn-danger' href='borrowdelete.php?user_id=" . $row['user_id'] . "'>delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9' class='text-center'>No borrow records found.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
