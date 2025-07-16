<?php
require_once '../../bootstrap.php';
require_once dirname(__DIR__, 2) . '/utils/envSetter.util.php';

$pageTitle = 'Products';

$conn = pg_connect(sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $pgConfig['host'],
    $pgConfig['port'],
    $pgConfig['db'],
    $pgConfig['user'],
    $pgConfig['pass']
));

$result = pg_query($conn, "SELECT * FROM items WHERE isdeleted = false ORDER BY item_id ASC");

$productsByNation = [
    'fire' => ['title' => 'Fire Nation', 'items' => []],
    'water' => ['title' => 'Water Tribe', 'items' => []],
    'earth' => ['title' => 'Earth Kingdom', 'items' => []],
    'air' => ['title' => 'Air Nomads', 'items' => []],
];

while ($row = pg_fetch_assoc($result)) {
    $image = $row['image_url'] ?? '';
    if (str_contains($image, 'fire'))
        $nation = 'fire';
    elseif (str_contains($image, 'water'))
        $nation = 'water';
    elseif (str_contains($image, 'earth'))
        $nation = 'earth';
    elseif (str_contains($image, 'air'))
        $nation = 'air';
    else
        $nation = 'other';

    if (!isset($productsByNation[$nation])) {
        $productsByNation[$nation] = ['title' => 'Other Items', 'items' => []];
    }

    $productsByNation[$nation]['items'][] = $row;
}
pg_close($conn);

ob_start();
?>

<!-- Nation Filter Buttons -->
<div class="category-labels">
    <img src="/assets/img/fire.png" alt="Fire Nation" class="faction-icon" onclick="filterProducts('fire')">
    <img src="/assets/img/water.png" alt="Water Tribe" class="faction-icon" onclick="filterProducts('water')">
    <img src="/assets/img/air.png" alt="Air Nomads" class="faction-icon" onclick="filterProducts('air')">
    <img src="/assets/img/earth.png" alt="Earth Kingdom" class="faction-icon" onclick="filterProducts('earth')">
    <img src="/assets/img/allButton.png" alt="All Products" class="faction-icon" onclick="filterProducts('all')">
</div>

<!-- Product Sections -->
<?php foreach ($productsByNation as $nation => $data): ?>
    <?php if (count($data['items']) > 0): ?>
        <div class="product-section <?= $nation ?>">
            <h2><?= htmlspecialchars($data['title']) ?></h2>
            <div class="product-grid">
                <?php foreach ($data['items'] as $item): ?>
                    <div class="product-card" data-element="<?= $nation ?>">
                        <img src="<?= htmlspecialchars($item['image_url'] ?? '/assets/img/fallback.png') ?>"
                            alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="product-title"><?= htmlspecialchars($item['name']) ?></div>
                        <div class="product-desc"><?= htmlspecialchars($item['description'] ?? '') ?></div>
                        <div class="product-price">₱<?= number_format($item['price'], 2) ?></div>
                        <button class="add-to-cart-btn" data-id="<?= $item['item_id'] ?>"
                            data-title="<?= htmlspecialchars($item['name']) ?>" data-price="<?= number_format($item['price'], 2) ?>"
                            data-image="<?= htmlspecialchars($item['image_url']) ?>" data-nation="<?= $nation ?>">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Attach Product JS -->
<script src="/assets/js/products.js" defer></script>

<?php
$content = ob_get_clean();
require_once LAYOUT_PATH . '/product.layout.php';
?>