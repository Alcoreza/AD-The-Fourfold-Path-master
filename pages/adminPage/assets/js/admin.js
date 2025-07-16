document.addEventListener("DOMContentLoaded", () => {
  const productList = document.getElementById("productList");
  const form = document.getElementById("productForm");
  const filter = document.getElementById("elementFilter");

  // 🔁 Filter products by element
  filter.addEventListener("change", () => {
    const selected = filter.value;
    document.querySelectorAll(".product-card").forEach((card) => {
      const element = card.getAttribute("data-element");
      if (selected === "all" || selected === element) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });

  // 📝 Populate form with product data for editing
  productList.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-btn")) {
      const card = e.target.closest(".product-card");
      form.elements.name.value =
        card.querySelector(".product-title").textContent;
      form.elements.price.value = card
        .querySelector(".product-price")
        .textContent.replace(/[₱,]/g, "");
      form.elements.image.value = card.querySelector("img").getAttribute("src");
      form.elements.element.value = card.getAttribute("data-element");
      form.elements.description.value =
        card.querySelector(".product-desc")?.dataset?.desc || "";

      // Optional: store the product ID in a hidden input if needed
      if (!form.querySelector("input[name='item_id']")) {
        const hidden = document.createElement("input");
        hidden.type = "hidden";
        hidden.name = "item_id";
        hidden.value = e.target.dataset.id;
        form.appendChild(hidden);
      } else {
        form.querySelector("input[name='item_id']").value = e.target.dataset.id;
      }

      window.scrollTo({ top: 0, behavior: "smooth" });
    }

    // 🗑 Handle product delete (you still need backend PHP)
    if (e.target.classList.contains("delete-btn")) {
      const id = e.target.dataset.id;
      if (confirm("Are you sure you want to delete this product?")) {
        // ⛔ Static-only version (no AJAX):
        window.location.href = `/handlers/admin/deleteProduct.handler.php?id=${id}`;
      }
    }
  });

  // 🆕 Add or Edit product form submission (non-AJAX)
  form.addEventListener("submit", (e) => {
    // Don't prevent default — let it behave normally
    const itemIdInput = form.querySelector("input[name='item_id']");
    if (itemIdInput && itemIdInput.value) {
      // Edit mode → update existing product
      form.action = "/handlers/admin/updateProduct.handler.php";
    } else {
      // Add mode → new product
      form.action = "/handlers/admin/addProduct.handler.php";
    }
  });
});
