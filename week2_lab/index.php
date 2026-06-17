<?php
require_once 'config.php';
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "
SELECT p.*, c.name AS category_name, s.name AS supplier_name
FROM products p
JOIN categories c ON p.category_id = c.id
JOIN suppliers s ON p.supplier_id = s.id
WHERE 1=1
";

if(!empty($search)){
    $search = $conn->real_escape_string($search);

    $sql .= "
    AND (
        p.name LIKE '%$search%'
        OR p.description LIKE '%$search%'
    )
    ";
}

if(!empty($category)){
    $category = $conn->real_escape_string($category);

    $sql .= "
    AND c.name = '$category'
    ";
}

$result = $conn->query($sql);
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
    <div class="top-actions">
    <a href="add.php" class="add-btn">+ Add Product</a>
</div>
    <h2>Product Inventory</h2>
    <?php
$categories = $conn->query("
    SELECT DISTINCT name
    FROM categories
    ORDER BY name
");

$stats_sql = "
SELECT
    COUNT(*) AS total_products,
    SUM(stock) AS total_stock,
    SUM(price * stock) AS total_value,
    SUM(CASE WHEN stock < 20 THEN 1 ELSE 0 END) AS low_stock
FROM products p
JOIN categories c ON p.category_id = c.id
WHERE 1=1
";

if(!empty($search)){
    $stats_sql .= "
    AND (
        p.name LIKE '%$search%'
        OR p.description LIKE '%$search%'
    )
    ";
}

if(!empty($category)){
    $stats_sql .= "
    AND c.name = '$category'
    ";
}

$stats = $conn->query($stats_sql)->fetch_assoc();
?>

<form method="GET">
    <input
        type="text"
        name="search"
        placeholder="Search products..."
        value="<?= htmlspecialchars($search) ?>"
    >

    <select name="category">
        <option value="">All Categories</option>

        <?php while($c = $categories->fetch_assoc()): ?>
            <option
                value="<?= $c['name'] ?>"
                <?= ($category == $c['name']) ? 'selected' : '' ?>
            >
                <?= $c['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Filter</button>
</form>
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
        <p>Inventory Value</p>
    </div>

    <div class="card">
        <h3><?= $stats['low_stock'] ?></h3>
        <p>Low Stock Items</p>
    </div>
</div>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr class='title'>
            <th>Product Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Supplier</th>
            <th>Action</th>
        </tr>

        <?php if($result->num_rows > 0): ?>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr class="<?= ($row['stock'] < 20) ? 'low-stock' : '' ?>">
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['category_name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>₱<?= number_format($row['price'], 2) ?></td>
        <td><?= $row['stock'] ?></td>
        <td><?= htmlspecialchars($row['supplier_name']) ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
        </td>
    </tr>
    <?php endwhile; ?>

<?php else: ?>

    <tr>
        <td colspan="6">No products found.</td>
    </tr>

<?php endif; ?>

    </table>

    <p class="count">
        Total Products: <?= $result->num_rows ?>
    </p>
</div>

</body>
</html>