const cartItems = [];
const cartContainer = document.getElementById("cart-items");
const emptyCart = document.getElementById("cart-empty");
const checkoutSection = document.getElementById("checkout-section");

function addToCart(product) {
    cartItems.push(product);
    renderCart();
}

function renderCart() {
    cartContainer.innerHTML = '';

    if (cartItems.length === 0) {
        emptyCart.style.display = 'block';
        cartContainer.style.display = 'none';
        checkoutSection.style.display = 'none';
        return;
    }

    emptyCart.style.display = 'none';
    cartContainer.style.display = 'flex';
    checkoutSection.style.display = 'block';

    cartItems.forEach(item => {
    const itemDiv = document.createElement("div");
    itemDiv.classList.add("cart-item", item.element);

    itemDiv.innerHTML = `
        <div class="item-info">
            <div class="item-title">${item.name}</div>
            <div class="item-price">₱${item.price}</div>
        </div>
        <div>
            <button class="btn" onclick="removeFromCart('${item.name}')">Remove</button>
        </div>
    `;

        cartContainer.appendChild(itemDiv);
    });
}

function removeFromCart(name) {
    const index = cartItems.findIndex(i => i.name === name);
    if (index > -1) {
        cartItems.splice(index, 1);
        renderCart();
    }
}

    // Example items (simulate clicking 'add to cart' from product.php)
window.addEventListener('DOMContentLoaded', () => {
    // Comment these in when integrating:
    // addToCart({ name: 'Agni Gloves', price: 1200, element: 'fire' });
    // addToCart({ name: 'Northern Water Flask', price: 890, element: 'water' });
});