<?php
require_once '../../bootstrap.php';

$pageTitle = 'Cart';
$pageName = 'cart';
$navbarType = 'default';
$headerType = 'none';

ob_start();
?>

<div class="cart-container">
    <h1>Your Elemental Cart</h1>

    <div id="cart-empty" class="empty-cart">
        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart Icon" />
        <p>Your cart is still empty... summon a product!</p>
    </div>

    <div id="cart-items" class="cart-items" style="display: none;"></div>

    <div class="checkout" id="checkout-section" style="display: none;">
        <button class="btn">Proceed to Checkout</button>
    </div>
</div>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';