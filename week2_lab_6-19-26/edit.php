<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);

$result = $conn->query("
    SELECT *
    FROM products
    WHERE id = $id
");

$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

$categories = $conn->query("
    SELECT id, name
    FROM categories
    ORDER BY name
");

$suppliers = $conn->query("
    SELECT id, name
    FROM suppliers
    ORDER BY name
");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);

    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];

    $category_id = (int)$_POST['category_id'];
    $supplier_id = (int)$_POST['supplier_id'];

    if (
        empty($name) ||
        empty($description)
    ) {

        $message = '<p style="color:red;">Name and Description are required.</p>';

    } else {

        $sql = "
        UPDATE products
        SET
            name = '$name',
            description = '$description',
            price = $price,
            stock = $stock,
            category_id = $category_id,
            supplier_id = $supplier_id
        WHERE id = $id
        ";

        if ($conn->query($sql)) {

            header('Location: index.php');
            exit;

        } else {

            $message = '<p style="color:red;">Error: ' . $conn->error . '</p>';

        }
    }
}
?>

<div class="form-container">

    <h2>Edit Product</h2>

    <?= $message ?>

    <form method="POST">

        <div class="form-group">
            <label>Product Name</label>
            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($product['name']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea
                name="description"
                required
            ><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input
                type="number"
                step="0.01"
                name="price"
                value="<?= $product['price'] ?>"
                required
            >
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input
                type="number"
                name="stock"
                value="<?= $product['stock'] ?>"
                required
            >
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>

                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option
                        value="<?= $cat['id'] ?>"
                        <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id" required>
                <option value="">-- Select Supplier --</option>

                <?php while ($sup = $suppliers->fetch_assoc()): ?>
                    <option
                        value="<?= $sup['id'] ?>"
                        <?= ($sup['id'] == $product['supplier_id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($sup['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" class="btn">
                Save Product
            </button>

            <a href="index.php" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>

</div>

<link rel="stylesheet" href="add_edit.css">
</div>