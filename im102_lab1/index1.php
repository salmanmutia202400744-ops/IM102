<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $course = $_POST['course'];
    $year = $_POST['year'];

    $sql = "INSERT INTO students (name, course, year)
            VALUES ('$name', '$course', '$year')";

    if ($conn->query($sql)) {
        echo "<p>Student added successfully!</p>";
    }
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>

    <h2>Student List</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['course']; ?></td>
            <td><?= $row['year']; ?></td>
        </tr>
        <?php endwhile; ?>

    </table>

    <h2>Add Student</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="year" placeholder="Year" required>
        <button type="submit">Add Student</button>
    </form>

</body>
</html>