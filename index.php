<?php
require_once BOOTSTRAP_PATH;

$pageName = 'home';
$pageTitle = 'Welcome';
$navbarType = 'default';
$headerType = 'default';

ob_start();
?>

<main class="fade-in-section">
    <section class="intro-section">
        <div class="ribbon-container">
            <h2 class="ribbon-text">Welcome, Bender</h2>
        </div>
        <p>
            Here at The Fourfold Path, we believe the spirit of each element lives within all of us. Our elemental
            gear is inspired by the traditions of the Four Nations - Fire, Water, Air, and Earth.<br>
            Crafted to help you connect with your inner strength.
        </p>
        <p>
            Whether you seek to train your body, relax your soul, or wear your nation’s pride,<br>
            our collection is the beginning of your journey.
        </p>
        <p>
            Choose wisely. Train with purpose. Master your path.
        </p>
        <a href="/pages/productPage/index.php" class="explore-btn">Explore Products</a>
    </section>
</main>

<section class="element-cards">
    <h2>Choose Your Faction</h2>
    <div class="card-grid">
        <a href="/pages/productPage/index.php?nation=fire" class="card fire fade-in-section">
            <h3>Fire Nation</h3>
            <p class="description">Power, precision, and relentless drive. Harness the heat within.</p>
        </a>
        <a href="/pages/productPage/index.php?nation=water" class="card water fade-in-section">
            <h3>Water Tribe</h3>
            <p class="description">Healing, balance, and flow. Master the art of adaptation.</p>
        </a>

        <a href="/pages/productPage/index.php?nation=air" class="card air fade-in-section">
            <h3>Air Nomads</h3>
            <p class="description">Freedom, peace, and motion. Glide lightly through the world.</p>
        </a>

        <a href="/pages/productPage/index.php?nation=earth" class="card earth fade-in-section">
            <h3>Earth Kingdom</h3>
            <p class="description">Stability, resilience, and power. Stand your ground with strength.</p>
        </a>
    </div>
</section>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';
?>