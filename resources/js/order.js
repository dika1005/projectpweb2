document.addEventListener("DOMContentLoaded", function () {
    const price = parseInt(document.getElementById("product_price").value);
    const stock = parseInt(document.getElementById("product_stock").value);
    let quantity = 1;

    const quantityInput = document.getElementById("quantity");
    const quantityDisplay = document.getElementById("quantityDisplay");
    const totalDisplay = document.getElementById("total_price_display");
    const btnIncrease = document.getElementById("increaseQty");
    const btnDecrease = document.getElementById("decreaseQty");

    function updateUI() {
        quantityDisplay.textContent = quantity;
        quantityInput.value = quantity;
        totalDisplay.value = "Rp " + (price * quantity).toLocaleString("id-ID");
        btnIncrease.disabled = quantity >= stock;
        btnDecrease.disabled = quantity <= 1;
    }

    btnIncrease.addEventListener("click", function () {
        if (quantity < stock) {
            quantity++;
            updateUI();
        }
    });

    btnDecrease.addEventListener("click", function () {
        if (quantity > 1) {
            quantity--;
            updateUI();
        }
    });

    updateUI();
});
