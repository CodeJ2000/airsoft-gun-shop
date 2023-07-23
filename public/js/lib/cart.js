// resources/js/cart.js

document.addEventListener("DOMContentLoaded", function () {
    const quantityInputs = document.querySelectorAll(".cart-quantity");
    const quantityMinusButtons = document.querySelectorAll(
        ".cart-quantity-minus"
    );
    const quantityPlusButtons = document.querySelectorAll(
        ".cart-quantity-plus"
    );
    const removeButtons = document.querySelectorAll(".cart-remove");

    // Handle quantity changes
    quantityInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            const key = input.dataset.key;
            const quantity = parseInt(input.value);

            updateCartQuantity(key, quantity);
        });
    });

    // Handle minus button clicks
    quantityMinusButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const key = button.dataset.key;
            const input = document.querySelector(
                `.cart-quantity[data-key="${key}"]`
            );
            const quantity = parseInt(input.value);

            if (quantity > 1) {
                input.value = quantity - 1;
                updateCartQuantity(key, quantity - 1);
            }
        });
    });

    // Handle plus button clicks
    quantityPlusButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const key = button.dataset.key;
            const input = document.querySelector(
                `.cart-quantity[data-key="${key}"]`
            );
            const quantity = parseInt(input.value);

            input.value = quantity + 1;
            updateCartQuantity(key, quantity + 1);
        });
    });

    // Handle item removal
    removeButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const key = button.dataset.key;

            removeCartItem(key);
        });
    });

    // Function to update cart quantity in the session
    function updateCartQuantity(key, quantity) {
        axios
            .patch(`/cart/${key}`, { quantity: quantity })
            .then(function () {
                // Reload the page or update the relevant UI elements
                location.reload();
            })
            .catch(function (error) {
                console.error(error);
            });
    }

    // Function to remove cart item from the session
    function removeCartItem(key) {
        axios
            .delete(`/cart/${key}`)
            .then(function () {
                // Reload the page or update the relevant UI elements
                location.reload();
            })
            .catch(function (error) {
                console.error(error);
            });
    }
});
