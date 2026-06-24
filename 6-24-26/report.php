
<?php
require_once 'config.php';

$stats_sql = "
SELECT
    COUNT(*) AS total_products,
    SUM(stock) AS total_stock,
    SUM(price * stock) AS total_value,
    SUM(CASE WHEN stock < 20 THEN 1 ELSE 0 END) AS low_stock
FROM products
";

$stats = $conn->query($stats_sql)->fetch_assoc();

$category_stats = $conn->query("
SELECT
    c.name AS category_name,
    COUNT(p.id) AS product_count,
    COALESCE(SUM(p.stock),0) AS total_stock,
    COALESCE(SUM(p.price * p.stock),0) AS total_value,
    COALESCE(AVG(p.price),0) AS average_price
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name
ORDER BY total_value DESC;
");

$supplier_stats = $conn->query("
SELECT
    s.name AS supplier_name,
    COUNT(p.id) AS product_count,
    COALESCE(SUM(p.stock),0) AS total_stock
FROM suppliers s
LEFT JOIN products p ON s.id = p.supplier_id
GROUP BY s.id, s.name
ORDER BY s.name
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Report</title>
</head>
<link rel="stylesheet" href="report.css">
<link rel="stylesheet" href="sidebar.css">
<body>
<div class="wrapper">
<?php include 'navbar.php'; ?>

    <main class="main-content">

        <div class="page-header">

            <div class="page-title">
                <h1>Inventory Report</h1>
                <p>Overview of inventory performance and statistics</p>
            </div>


        </div>

        <div class="cards">

            <div class="card">
                <h3><?= $stats['total_products'] ?></h3>
                <p>Total Products</p>
            </div>

            <div class="card">
                <h3><?= $stats['total_stock'] ?></h3>
                <p>Total Stock</p>
            </div>

            <div class="card">
                <h3>₱<?= number_format($stats['total_value'],2) ?></h3>
                <p>Total Inventory Value</p>
            </div>

            <div class="card">
                <h3><?= $stats['low_stock'] ?></h3>
                <p>Low Stock Items</p>
            </div>

        </div>

        <div class="report-section">

            <h2>Category Breakdown</h2>

            <div class="table-wrapper">
                <table>

                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Products</th>
                            <th>Stock</th>
                            <th>Total Value</th>
                            <th>Average Price</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($row = $category_stats->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['category_name']) ?></td>
                            <td><?= $row['product_count'] ?></td>
                            <td><?= $row['total_stock'] ?></td>
                            <td>₱<?= number_format($row['total_value'],2) ?></td>
                            <td>₱<?= number_format($row['average_price'],2) ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>

                </table>
            </div>

        </div>

        <div class="report-section">

            <h2>Supplier Breakdown</h2>

            <div class="table-wrapper">
                <table>

                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Products</th>
                            <th>Total Stock</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($row = $supplier_stats->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['supplier_name']) ?></td>
                            <td><?= $row['product_count'] ?></td>
                            <td><?= $row['total_stock'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>

                </table>
            </div>

        </div>

    </main>

</div>
</body>
</html>
