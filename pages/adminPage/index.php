<?php
require_once '../../bootstrap.php';
require_once HANDLERS_PATH . 'admin/getAllProduct.handler.php';

$pageTitle = 'Admin Dashboard';
$pageName = 'admin';
$navbarType = 'admin';
$headerType = 'none';

$products = getAllProducts();
ob_start();
?>

<h2 class="admin-title">Admin Dashboard – Avatar Gear</h2>

<!-- Filter Dropdown -->
<div class="admin-filter-wrapper">
    <select id="elementFilter" class="element-filter">
        <option value="all">All Nations</option>
        <option value="fire">🔥 Fire Nation</option>
        <option value="water">💧 Water Tribe</option>
        <option value="earth">🌿 Earth Kingdom</option>
        <option value="air">🌬 Air Nomads</option>
    </select>
</div>

<!-- Add Product Form -->
<section class="admin-card">
    <div class="admin-card-header">Add New Product</div>
    <div class="admin-card-body">
        <form id="productForm" class="admin-form" method="POST" action="/handlers/admin/addProduct.handler.php">
            <input type="text" placeholder="Product Name" name="name" required>
            <input type="number" placeholder="Price (₱)" name="price" required>
            <input type="number" placeholder="Stock Quantity" name="stock_quantity" required min="0">
            <input type="url" placeholder="Image URL" name="image_url">
            <textarea name="description" placeholder="Product Description" rows="2"></textarea>
            <button type="submit" class="admin-btn">Add Product</button>
        </form>
    </div>
</section>

<!-- Product List Output -->
<section id="productList" class="product-list-section">
    <?php foreach ($products as $item): ?>
        <div class="product-card show">
            <?php if (!empty($item['image_url'])): ?>
                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                    style="width: 100%; max-height: 220px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
            <?php endif; ?>

            <form method="POST" action="/handlers/admin/updateProduct.handler.php" class="admin-form">
                <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>
                <input type="number" name="price" value="<?= $item['price'] ?>" required>
                <textarea name="description"
                    placeholder="Description"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>

                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <button type="submit" class="add-to-cart-btn">Save</button>
                    <a href="/handlers/admin/deleteProduct.handler.php?item_id=<?= $item['item_id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this item?')" class="add-to-cart-btn"
                        style="background-color: #a82a2a; text-align: center;">
                        Delete
                    </a>
                </div>
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php
$content = ob_get_clean();
require_once LAYOUT_PATH . '/admin.layout.php';
?>