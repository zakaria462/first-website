<?php
session_start();


$total_earnings = isset($_SESSION['total_earnings']) ? $_SESSION['total_earnings'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'rtz.php';

    $full_name = $_POST['full_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $delivery_address = $_POST['delivery_address'];
    $totalCommande = $_POST['totalCommande']; 
    $products = isset($_POST['products']) ? json_decode($_POST['products'], true) : array(); 

    foreach ($products as $product) {
        $productId = $product['id'];
        $quantity = $product['quantity'];
        
        $sqlQuantity = "SELECT quantité FROM pc WHERE id = '$productId'";
        $result = $con->query($sqlQuantity);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $availableQuantity = $row['quantité'];
            
            if ($quantity <= $availableQuantity) {
                
                $availableQuantity -= $quantity;
               
                $sqlUpdateQuantity = "UPDATE pc SET quantité = '$availableQuantity' WHERE id = '$productId'";
                $con->query($sqlUpdateQuantity);
            } else {
               
                echo '<script>alert("Error: Insufficient quantity for product ' . $productId . '");</script>';
                exit();
            }
        } else {
          
            echo '<script>alert("Error: Unable to retrieve quantity for product ' . $productId . '");</script>';
            exit();
        }
    }

 
    $total_earnings += $totalCommande;


    $_SESSION['total_earnings'] = $total_earnings;

    $sql = "INSERT INTO commande (full_name, email_address, phone_number, delivery_address, date_commande, etat_commande, total_commande)
            VALUES ('$full_name', '$email_address', '$phone_number', '$delivery_address', NOW(), 'nouvelle', '$totalCommande')";

    if ($con && $con->query($sql) === TRUE) {
      header("Location: confirmation.html");
        exit(); 
    } else {
        echo '<script>alert("Error processing your order. Please try again later.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="panier.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <style>
   

    .orders {
      background-color: white;
      padding: 20px;
      max-width: 800px;
      margin: 20px auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    .commande h2 {
      border-bottom: 2px solid #333;
      padding-bottom: 10px;
      margin-bottom: 20px;
      font-size: 24px;
      color: #333;
    }
    .commande ul {
      list-style: none;
      padding: 0;
    }
    .commande ul li {
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }
    #total-price {
      font-size: 18px;
      font-weight: bold;
      margin: 20px 0;
    }
    #customer-form {
      display: flex;
      flex-direction: column;
    }
    #customer-form label {
      font-weight: bold;
      margin-top: 10px;
    }
    #customer-form input, #customer-form textarea {
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    #customer-form button {
      background-color: ##007bff;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      margin-top: 20px;
      cursor: pointer;
      font-size: 16px;
    }
    #customer-form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="stiky">
    <div>
      <a href="index.html"><img src="pictures/logo.png" class="logo"></a>
    </div>
    <div class="top-nav">
      <nav class="navbar">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="index.html" class="active1">Products</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a href="login.php">Account</a></li>
        </ul>
      </nav>  
      <div class="top-icons">
        <i class="fa fa-search" onclick="showbar()"></i>
        <i class="fa fa-user" onclick="toggleProfile()" ></i>
        <div class="icon-cart">
          <i class="fa fa-cart-plus" id="shopping"></i>
          <span class="quantity">0</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="orders">
  <div class="commande">
    <h2>Your Products</h2>
    <ul id="cart-summary"></ul>
  </div>
  <p id="total-price">Total: <b>0 Dh</b></p>
  <h2>Please fill out the information</h2>
  <form id="customer-form" method="POST">
    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" required><br>

    <label for="email_address">Email Address:</label>
    <input type="email" id="email_address" name="email_address" required autocomplete="email"><br>

    <label for="phone_number">Phone Number:</label>
    <input type="tel" id="phone_number" name="phone_number" required><br>

    <label for="delivery_address">Delivery Address:</label>
    <textarea id="delivery_address" name="delivery_address" required></textarea><br>

    <input type="hidden" id="totalCommande" name="totalCommande" value="">
    <input type="hidden" id="products" name="products" value=''>
    
    <button type="submit">Place Order</button>
  </form>
</div> 

<script>
  let listCards;

  function loadCartData() {
    const storedCartData = JSON.parse(getCookie('cartData'));
    if (storedCartData) {
      listCards = storedCartData;
    } else {
      listCards = {};
    }
  }

  function populateCartSummary() {
    const cartSummary = document.getElementById('cart-summary');
    cartSummary.innerHTML = '';

    let totalCommande = 0;

    if (Object.keys(listCards).length !== 0) {
      for (let key in listCards) {
        const product = listCards[key];
        const listItem = document.createElement('li');
        listItem.textContent = `${product.nom} x ${product.quantity} - ${product.prix * product.quantity} Dh`;
        cartSummary.appendChild(listItem);

        totalCommande += product.prix * product.quantity; 
      }
    } else {
      const emptyCartMessage = document.createElement('p');
      emptyCartMessage.textContent = 'Your shopping cart is empty.';
      cartSummary.appendChild(emptyCartMessage);
    }

    const totalPriceElement = document.getElementById('total-price');
    totalPriceElement.innerHTML = `Total: <b>${totalCommande} Dh</b>`;

    const totalCommandeInput = document.getElementById('totalCommande');
    totalCommandeInput.value = totalCommande;

    const productsInput = document.getElementById('products');
    productsInput.value = JSON.stringify(listCards);
  }

  window.addEventListener('load', () => {
    loadCartData();
    populateCartSummary();
  });

  function getCookie(name) {
    let nameEQ = name + '=';
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      let cookie = cookies[i];
      while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
      if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
    }
    return null;
  }
</script>
</body>
</html>

