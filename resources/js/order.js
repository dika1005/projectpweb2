document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".order-form").forEach(function (form) {
        let price = parseInt(form.dataset.price);
        let stock = parseInt(form.dataset.stock);
        let quantity = 1;

        const quantityInput = form.querySelector(".quantity");
        const quantityDisplay = form.querySelector(".quantityDisplay");
        const totalDisplay = form.querySelector(".total_price_display");
        const btnIncrease = form.querySelector(".increaseQty");
        const btnDecrease = form.querySelector(".decreaseQty");

        function updateUI() {
            quantityDisplay.textContent = quantity;
            quantityInput.value = quantity;
            totalDisplay.value =
                "Rp " + (price * quantity).toLocaleString("id-ID");
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
});
