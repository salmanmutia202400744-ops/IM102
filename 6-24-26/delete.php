<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->query("DELETE FROM products WHERE id = $id");
    header('Location: index.php');
    exit;
}

// Get product details
$result = $conn->query("
    SELECT name, description, price, stock
    FROM products
    WHERE id = $id
");

$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="delete.css">
<head>
    <title>Delete Product</title>
</head>
<body>
<div class="container">

    <div class="delete-icon">
        ⚠
    </div>

    <h1>Delete Product</h1>

    <p class="subtitle">
        Please confirm before permanently removing this item.
    </p>

    <div class="product-card">

        <p class="name">
            <?= htmlspecialchars($product['name']) ?>
        </p>

        <p class="details">
            <?= htmlspecialchars($product['description']) ?>
        </p>

        <p class="details">
            Price: ₱<?= number_format($product['price'], 2) ?>
        </p>

        <p class="details">
            Stock: <?= $product['stock'] ?>
        </p>

    </div>

    <div class="warning">
        This action cannot be undone.
    </div>

    <div class="button-group">

        <form method="POST" style="flex:1;">
            <button type="submit" class="btn-delete">
                Delete Product
            </button>
        </form>

        <a href="index.php" class="btn-cancel">
            Cancel
        </a>

    </div>

</div>
</body>
</html>