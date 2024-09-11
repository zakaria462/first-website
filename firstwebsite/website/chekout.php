<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Checkout</h1>
    <h2>Products in Cart:</h2>
    <ul id="cartProducts">
        <!-- Products in the cart will be dynamically added here -->
    </ul>
    <h2>Enter Your Information:</h2>
    <form id="checkoutForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br>
        <button type="submit">Place Order</button>
    </form>

    <script>
        // Function to display products in the cart
        function displayCartProducts() {
            const cartProducts = JSON.parse(localStorage.getItem('products2'));
            const cartProductsList = document.getElementById('cartProducts');
            cartProductsList.innerHTML = '';
            if (cartProducts) {
                for (const product of Object.values(cartProducts)) {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${product.nom} - Quantity: ${product.quantity} - Price: ${product.prix * product.quantity} Dh`;
                    cartProductsList.appendChild(listItem);
                }
            } else {
                cartProductsList.innerHTML = '<li>No products in cart</li>';
            }
        }

        window.onload = function() {
            displayCartProducts();
        };

        // Handle form submission
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const customerInfo = {
                name: formData.get('name'),
                email: formData.get('email'),
                address: formData.get('address'),
                products: JSON.parse(localStorage.getItem('products2'))
            };
            // Here you can handle sending customerInfo to the server for processing
            console.log(customerInfo);
            // Example: sendCustomerInfo(customerInfo);
            alert('Order placed successfully!'); // Temporary alert, replace it with appropriate action
            localStorage.removeItem('products2'); // Clear cart after successful order placement
            displayCartProducts(); // Update cart display
        });
    </script>
</body>
</html>
