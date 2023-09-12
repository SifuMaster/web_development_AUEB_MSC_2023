document.addEventListener("DOMContentLoaded", function () {
    const quantityElements = document.querySelectorAll(".quantity");

    quantityElements.forEach((quantityElement) => {
        const inputField = quantityElement.querySelector("input");
        const plusButton = quantityElement.querySelector(".btn-plus");
        const minusButton = quantityElement.querySelector(".btn-minus");

        plusButton.addEventListener("click", function () {
            let currentQuantity = parseInt(inputField.value);
            currentQuantity++;
            inputField.value = currentQuantity;
        });

        minusButton.addEventListener("click", function () {
            let currentQuantity = parseInt(inputField.value);
            if (currentQuantity > 1) {
                currentQuantity--;
                inputField.value = currentQuantity;
            }
        });
    });

    // Add to Cart Button Click Listener
    const addToCartBtns = document.querySelectorAll(".btn-add-to-cart");

    addToCartBtns.forEach((addToCartBtn) => {
        addToCartBtn.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            const quantityInput = this.parentElement.querySelector("input");
            const quantity = quantityInput.value;
            console.log(quantity);

            fetch("save_to_session.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        productId: productId,
                        quantity: quantity,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const cartTotalElement = document.getElementById("cartTotal");

                    if (data.totalSum !== undefined) {
                        console.log("Total Sum: " + data.totalSum);
                        cartTotalElement.textContent = "Καλάθι(" + data.totalSum + ")";
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
});
