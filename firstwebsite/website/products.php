<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="profil.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .header {
      display: flex;
      justify-content: space-between;
    }

    .header .navbar li a {
      font-size: 19px;
    }

    .center-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-direction: column;
      padding: 30px;
    }

    #suppr {
      padding: 17px;
      border-radius: 5px;
      background-color: #324960;
      line-height: 0;
      color: white;
      width: 120px;
      margin: 10px;
    }
    #suppr:hover {
      background-color: #5aacef;
    }
    input {
      border: none;
      outline: none;
      padding: 0;
    }

    #int {
      font-size: 20px;
    }

    .product-management {
      display: none;
    }

    .filter-buttons-container {
      display: flex;
      justify-content: center;
    }

    .filter-buttons {
      border-radius: 5px;
      padding: 10px;
    }

    .filter-buttons button {
      margin-right: 5px;
      background-color: #f5f5f5;
      padding: 10px;
      border-radius: 10px;
      width: 100px;
    }

    .filter-buttons button:hover {
      border: 2px solid white;
      box-shadow: none;
      background-color: #324960;
      color: white;
    }
  </style>
</head>

<body onload="toggleCategory('pc')">
  <div class="header">
    <div>
      <a href="index.html"><img src="pictures/logo.png" class="logo"></a>
    </div>
    <div class="top-nav">
      <nav class="navbar">
        <ul>
          <li><a href="dachbord.php" >dashboard</a></li>
          <li><a href="products.php" class="active1">Products</a></li>
          <li><a href="orders.php">Orders</a></li>
          <li><a href="customers.php" >Customers</a></li>
        </ul>
      </nav>
    </div>
    <form class="formm" action="logout.php" method="post">
      <button class="button-64" role="button"><span class="text">logout</span></button>
    </form>
  </div>
  <div style="margin-top : 120px;" class="filter-buttons-container">
    <div class="filter-buttons">
      <button onclick="toggleCategory('pc')">PC</button>
      <button onclick="toggleCategory('camera')">Camera</button>
      <button onclick="toggleCategory('iphone')">iPhone</button>
      <button onclick="toggleCategory('accessoires')">Accessoires</button>
    </div>
  </div>

  <!-- PC Management -->
  <div class="product-management pc">
    <form action="update_quantity.php" method="post">
      <input type="hidden" name="category" value="pc">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php include("rtz.php");
          $query = "SELECT * FROM pc";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td>
                <img src="<?= $row['image'] ?>" alt="Product Image" style="max-width: 100px;">
              </td>
              <td>
                <input id="int" type="text" name="product_name_<?= $row['id'] ?>" value="<?= $row['nom'] ?>">
              </td>
              <td>
                <input id="int" type="text" name="product_description_<?= $row['id'] ?>" value="<?= $row['description'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="product_price_<?= $row['id'] ?>" value="<?= $row['prix'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="new_quantity_<?= $row['id'] ?>" value="<?= $row['quantité'] ?>">
              </td>
              <td class='center-content'>
                <input id="int" type="hidden" name="id" value="<?= $row['id'] ?>">
                <button id='suppr' formaction="delete_product.php" type="submit" name="delete_action" value="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <button id="miseajour" type="submit">update</button>
    </form>
    <div class="management">
      <form action="add_product.php" method="post" id="addFormPC" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="pc">
        <button type="submit">Add</button>
      </form>
      <button id="miseajour" onclick="toggleForm('addFormPC')">Add product</button>
    </div>
  </div>

  <!-- Camera Management -->
  <div class="product-management camera" style="display: none;">
    <form action="update_quantity.php" method="post">
      <input type="hidden" name="category" value="camera">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php include("rtz.php");
          $query = "SELECT * FROM camera";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td>
                <img src="<?= $row['image'] ?>" alt="Product Image" style="max-width: 100px;">
              </td>
              <td>
                <input id="int" type="text" name="product_name_<?= $row['id'] ?>" value="<?= $row['nom'] ?>">
              </td>
              <td>
                <input id="int" type="text" name="product_description_<?= $row['id'] ?>" value="<?= $row['description'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="product_price_<?= $row['id'] ?>" value="<?= $row['prix'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="new_quantity_<?= $row['id'] ?>" value="<?= $row['quantité'] ?>">
              </td>
              <td class='center-content'>
                <input id="int" type="hidden" name="id" value="<?= $row['id'] ?>">
                <button id='suppr' formaction="delete_product.php" type="submit" name="delete_action" value="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <button id="miseajour" type="submit">update</button>
    </form>
    <div class="management">
      <form action="add_product.php" method="post" id="addFormCamera" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="camera">
        <button type="submit">Add</button>
      </form>
      <button id="miseajour" onclick="toggleForm('addFormCamera')">Add product</button>
    </div>
  </div>

  <!-- iPhone Management -->
  <div class="product-management iphone" style="display: none;">
    <form action="update_quantity.php" method="post">
      <input type="hidden" name="category" value="iphone">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php include("rtz.php");
          $query = "SELECT * FROM iphone";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td>
                <img src="<?= $row['image'] ?>" alt="Product Image" style="max-width: 100px;">
              </td>
              <td>
                <input id="int" type="text" name="product_name_<?= $row['id'] ?>" value="<?= $row['nom'] ?>">
              </td>
              <td>
                <input id="int" type="text" name="product_description_<?= $row['id'] ?>" value="<?= $row['description'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="product_price_<?= $row['id'] ?>" value="<?= $row['prix'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="new_quantity_<?= $row['id'] ?>" value="<?= $row['quantité'] ?>">
              </td>
              <td class='center-content'>
                <input id="int" type="hidden" name="id" value="<?= $row['id'] ?>">
                <button id='suppr' formaction="delete_product.php" type="submit" name="delete_action" value="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <button id="miseajour" type="submit">update</button>
    </form>
    <div class="management">
      <form action="add_product.php" method="post" id="addFormiPhone" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="iphone">
        <button type="submit">Add</button>
      </form>
      <button id="miseajour" onclick="toggleForm('addFormiPhone')">Add product</button>
    </div>
  </div>

  <!-- Accessoires Management -->
  <div class="product-management accessoires" style="display: none;">
    <form action="update_quantity.php" method="post">
      <input type="hidden" name="category" value="accessoires">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php include("rtz.php");
          $query = "SELECT * FROM accessoires";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td>
                <img src="<?= $row['image'] ?>" alt="Product Image" style="max-width: 100px;">
              </td>
              <td>
                <input id="int" type="text" name="product_name_<?= $row['id'] ?>" value="<?= $row['nom'] ?>">
              </td>
              <td>
                <input id="int" type="text" name="product_description_<?= $row['id'] ?>" value="<?= $row['description'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="product_price_<?= $row['id'] ?>" value="<?= $row['prix'] ?>">
              </td>
              <td>
                <input id="int" type="number" name="new_quantity_<?= $row['id'] ?>" value="<?= $row['quantité'] ?>">
              </td>
              <td class='center-content'>
                <input id="int" type="hidden" name="id" value="<?= $row['id'] ?>">
                <button id='suppr' formaction="delete_product.php" type="submit" name="delete_action" value="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <button id="miseajour" type="submit">update</button>
    </form>
    <div class="management">
      <form action="add_product.php" method="post" id="addFormAccessoires" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="accessoires">
        <button type="submit">Add</button>
      </form>
      <button id="miseajour" onclick="toggleForm('addFormAccessoires')">Add product</button>
    </div>
  </div>

  <script>
    function toggleCategory(category) {
      // Hide all product management sections
      const productManagementDivs = document.querySelectorAll('.product-management');
      productManagementDivs.forEach(div => div.style.display = 'none');

      // Show the selected product management section
      const selectedDiv = document.querySelector(`.product-management.${category}`);
      selectedDiv.style.display = 'block';
    }

    function toggleForm(formId) {
      const form = document.getElementById(formId);
      form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>

</html>
