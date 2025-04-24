<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="borrow.css">
    <title>library borrow record</title>

</head>
<body>
    <div class="container">
        <h1>LIBRARY BORROW RECORDS</h1>
</div>
</body>
</html>

<?php include"database.php";



$sql = "SELECT * FROM borrow_records ORDER BY issue_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Book Title</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Fine ($)</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $statusClass = strtolower($row["status"]);
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>" . htmlspecialchars($row['user_name']) . "</td>
                <td>" . htmlspecialchars($row['book_title']) . "</td>
                <td>{$row['issue_date']}</td>
                <td>{$row['due_date']}</td>
                <td>" . ($row['return_date'] ? $row['return_date'] : '-') . "</td>
                <td class='status-{$statusClass}'>" . htmlspecialchars($row['status']) . "</td>
                <td>{$row['fine']}</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No borrow records found.</p>";
}

$conn->close();
?>
 
 