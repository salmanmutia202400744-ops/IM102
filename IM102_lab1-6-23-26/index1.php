<?php
require_once 'auth.php';
requireLogin();

include 'config.php';
$sql = "
SELECT
    p.id,
    p.name,
    p.description,
    p.price,
    p.stock,
    c.name AS category,
    s.name AS supplier
FROM products p
JOIN categories c ON p.category_id = c.id
JOIN suppliers s ON p.supplier_id = s.id
ORDER BY p.id ASC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="container">

    <h1>Inventory Management</h1>

    <div class="header">

        <a href="add_product.php" class="btn btn-add">
            + Add Product
        </a>

        <?php if (isAdmin()): ?>
            <a href="report.php" class="btn btn-report">
                📊 Report
            </a>
        <?php endif; ?>

        <a href="logout.php" class="btn btn-logout"
        onclick="return confirm('Are you sure you want to logout?');">
            Logout
        </a>

    </div>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Description</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </thead>

        <tbody>

        <?php while($row = $result->fetch_assoc()): ?>

            <tr>

                <td><?= $row['id'] ?></td>

                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['description']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['category']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['supplier']) ?>
                </td>

                <td>
                    ₱<?= number_format($row['price'],2) ?>
                </td>

                <td>

                    <?php
                    if($row['stock'] < 10){
                        echo "<span class='low-stock'>{$row['stock']}</span>";
                    }else{
                        echo $row['stock'];
                    }
                    ?>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

    <p class="count">
        Total Products:
        <span class="badge">
            <?= $result->num_rows ?>
        </span>
    </p>

</div>

</body>
</html>