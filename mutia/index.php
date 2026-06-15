<?php
require_once 'config.php';

$sql = "SELECT p.id,
               p.name,
               p.description,
               p.price,
               p.stock,
               c.category_name,
               s.supplier_name
        FROM products p
        JOIN categories c
            ON p.category_id = c.category_id
        JOIN suppliers s
            ON p.supplier_id = s.supplier_id
        ORDER BY p.id ASC";

$result = $conn->query($sql);

if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Product Inventory</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr class='tittle'>
            <th>Product Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Supplier</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['category_name']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>₱<?= number_format($row['price'], 2) ?></td>
            <td><?= $row['stock'] ?></td>
            <td><?= htmlspecialchars($row['supplier_name']) ?></td>
        </tr>
        <?php endwhile; ?>

    </table>

    <p class="count">
        Total Products: <?= $result->num_rows ?>
    </p>
</div>

</body>
</html>