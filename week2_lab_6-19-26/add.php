<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $supplier_id = $_POST['supplier_id'];

    $stmt = $conn->prepare("
        INSERT INTO products (name, description, price, stock, category_id, supplier_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssdiis", $name, $description, $price, $stock, $category_id, $supplier_id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

?>
<div class="form-container">
    <div class="container">
    <ul>
    <li><a href="index.php">Products</a></li>
  <li><a href="report.php">Report</a></li>
  <li><a class='active' href="add.php">Add Product</a></li>
</ul>

    <h2>Add Product</h2>

    <form method="POST">

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" required></textarea>
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" required>
        </div>

<?php
$categories = $conn->query("SELECT id, name FROM categories ORDER BY name");
?>
<select class="form-group" name="category_id" required>
<option value="">-- Select Category --</option>
<?php while ($cat = $categories->fetch_assoc()): ?>
<option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
<?php endwhile; ?>
</select>

<?php
$suppliers = $conn->query("SELECT id, name FROM suppliers ORDER BY name");
?>
<select class="form-group" name="supplier_id" required>
<option value="">-- Select Category --</option>
<?php while ($cat = $suppliers->fetch_assoc()): ?>
<option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
<?php endwhile; ?>
</select>

        <div class="button-group">
            <button type="submit" class="btn">
                Save Product
            </button>

            <a href="index.php" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>
<link rel="stylesheet" href="add_edit.css">
</div>