 <?php
 require_once 'config.php';
  $sql = "SELECT * FROM students ORDER BY id ASC";
 $result = $conn->query($sql);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 <title>Student List</title>
 <style>
 body {
 font-family: 'Segoe UI', Arial, sans-serif;
 margin: 20px;
 background: #f5f5f5;
 }
 .container {
max-width: 900px;
 margin: 0 auto;
 background: white;
 padding: 25px;
 border-radius: 8px;
 box-shadow: 0 2px 10px rgba(0,0,0,0.1);
 }
 h1 { color: #333; margin-top: 0; }
 table {
 width: 100%;
 border-collapse: collapse;
 margin-top: 15px;
 }
 th {
 background: #333;
 color: white;
 padding: 12px;
 text-align: left;
 font-size: 0.9em;
 text-transform: uppercase;
 }
 td {
 padding: 10px 12px;
 border-bottom: 1px solid #eee;
 }
 tr:hover { background: #f9f9f9; }
 tr:nth-child(even) { background: #fafafa; }
 tr:nth-child(even):hover { background: #f0f0f0; }
 .count {
 margin-top: 15px;
 color: #666;
 font-size: 0.9em;
 }
 </style>
 </head>
 <body>
 <div class="container">
    
  <p>
 <a href="add.php" style="
 display: inline-block;
 padding: 10px 20px;
 background: #4CAF50;
 color: white;
 text-decoration: none;
 border-radius: 4px;
 ">+ Add Student</a>
 </p>

 <h1>Student List</h1>
 <table>
 <tr>
 <th>ID</th>
 <th>Name</th>
 <th>Course</th>
 <th>Year</th>
 <th>Date Added</th>
 <th>Email</th>
 <th>Phone</th>
 <th>Address</th>
 <th>Actions</th>
</tr>
 <?php while ($row = $result->fetch_assoc()): ?>
 <tr>
 <td><?= $row['id'] ?></td>
 <td><?= htmlspecialchars($row['name']) ?></td>
 <td><?= htmlspecialchars($row['course']) ?></td>
 <td class="year"><?= $row['year'] ?></td>
 <td><?= $row['date_added'] ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['phone']) ?></td>
<td><?= htmlspecialchars($row['address']) ?></td>
<td class="actions">
    <div class="edit">
        <a href="edit.php?id=<?= $row['id'] ?>" 
       style="color: #ffffff; text-decoration: none; margin-right: 10px;">Edit</a>
    </div>
    <div class= "delete">
        <a href="delete.php?id=<?= $row['id'] ?>" 
        style="color: #fdfdfd; text-decoration: none;"
        onclick="return confirm('Delete <?= htmlspecialchars(addslashes($row['name'])) ?>?')">Delete</a>
    </div>
    
</td>

 </tr>
 <?php endwhile; ?>
 </table>
 <p class="count">Total: <?= $result->num_rows ?> student(s)</p>
 </div>
 
 </body>
 </html>
  <link rel="stylesheet" href="style.css">