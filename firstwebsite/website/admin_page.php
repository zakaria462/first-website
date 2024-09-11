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
                    <li><a href="index.html" class="active1">Home</a></li>
                    <li><a href="#product">Products</a></li>
                    <li><a href="#About">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="login.php">Account</a></li>
                </ul>
            </nav>  
            <div class="top-icons">
                <i class="fa fa-search" onclick="showbar()"></i>
                <i class="fa fa-user" onclick="toggleProfile()"></i>
                <div class="icon-cart">
                    <i class="fa fa-cart-plus"></i>
                    <span>0</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bnj">
    <h1>Hello Admin</h1>
    <form class="formm" action="logout.php" method="post">
    <button class="button-64" role="button"><span class="text">logout</span></button>
    </form>
</div>

<div class="product-management">
   
<h2 style="margin-top: 120px;">Liste des produits - PC</h2>
    <form action="update_quantity.php" method="post">
    <input type="hidden" name="category" value="pc">
        <table>
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité disponible</th>
                    <th>Nouvelle quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("rtz.php");

                $query = "SELECT * FROM pc";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td>" . $row['quantité'] . "</td>";
                    echo "<td><input type='number' name='new_quantity[]' value='" . $row['quantité'] . "'></td>";
                    echo "<input type='hidden' name='product_id[]' value='" . $row['id'] . "'>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button id="miseajour" type="submit">update</button>
    </form>

    <div class="management">
    <form action="add_product.php" method="post" id="addForm" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        
        <input type="hidden" name="category" value="pc">
        <button type="submit">Add</button>
    </form>
    <button id="miseajour" onclick="toggleForm('addForm')">Add product</button>
</div>
<div class="management">
    <form action="delete_product.php" method="post" id="deleteForm" style="display: none;">
    <select style="padding: 8px; margin: 5px;" name="product_id" required>
            <option  value="" disabled selected>Sélectionner un produit</option>
            <?php
            $result = mysqli_query($con, "SELECT id, nom FROM pc");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
            }
            ?>
        </select>
        
        <input type="hidden" name="category" value="pc">
        <button type="submit">Delete</button>
    </form>
    <button id="miseajour" onclick="toggleForm('deleteForm')">Delete product</button>
</div>

<div class="product-management">
    
    <h2>Liste des produits - camera</h2>
    <form action="update_quantity.php" method="post">
    <input type="hidden" name="category" value="camera">
        <table>
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité disponible</th>
                    <th>Nouvelle quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("rtz.php");

                $query = "SELECT * FROM camera";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td>" . $row['quantité'] . "</td>";
                    echo "<td><input type='number' name='new_quantity[]' value='" . $row['quantité'] . "'></td>";
                    echo "<input type='hidden' name='product_id[]' value='" . $row['id'] . "'>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button id="miseajour" type="submit">update</button>
    </form>

    <div class="management">
    <form action="add_product.php" method="post" id="addForm1" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="camera">
        <button type="submit">Add</button>
    </form>
    <button id="miseajour" onclick="toggleForm('addForm1')">Add product</button>
</div>
<div class="management">
    <form action="delete_product.php" method="post" id="deleteForm1" style="display: none;">
    <select style="padding: 8px; margin: 5px;" name="product_id" required>
            <option value="" disabled selected>Sélectionner un produit</option>
            <?php
            $result = mysqli_query($con, "SELECT id, nom FROM pc");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
            }
            ?>
        </select>
        <input type="hidden" name="category" value="camera">
        <button type="submit">Delete</button>
    </form>
    <button id="miseajour" onclick="toggleForm('deleteForm1')">Delete product</button>
</div>
<div class="product-management">
    <h2>Liste des produits - iphone</h2>
    <form action="update_quantity.php" method="post">
    <input type="hidden" name="category" value="iphone">
        <table>
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité disponible</th>
                    <th>Nouvelle quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("rtz.php");

                $query = "SELECT * FROM iphone";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td>" . $row['quantité'] . "</td>";
                    echo "<td><input type='number' name='new_quantity[]' value='" . $row['quantité'] . "'></td>";
                    echo "<input type='hidden' name='product_id[]' value='" . $row['id'] . "'>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button id="miseajour" type="submit">update</button>
    </form>

    <div class="management">
    <form action="add_product.php" method="post" id="addForm2" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number" id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url" id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="iphone">
        <button type="submit">Add</button>
    </form>
    <button id="miseajour" onclick="toggleForm('addForm2')">Add product</button>
</div>
<div class="management">
    <form action="delete_product.php" method="post" id="deleteForm2" style="display: none;">
    <select style="padding: 8px; margin: 5px;" name="product_id" required>
            <option value="" disabled selected>Sélectionner un produit</option>
            <?php
            $result = mysqli_query($con, "SELECT id, nom FROM pc");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
            }
            ?>
        </select>
        <input type="hidden" name="category" value="iphone">
        <button type="submit">Delete</button>
    </form>
    <button id="miseajour" onclick="toggleForm('deleteForm2')">Delete productt</button>
</div>

<div class="product-management">
    <h2>Liste des produits - accessoires</h2>
    <form action="update_quantity.php" method="post">
    <input type="hidden" name="category" value="accessoires">
        <table>
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Quantité disponible</th>
                    <th>Nouvelle quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("rtz.php");

                $query = "SELECT * FROM accessoires";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td>" . $row['quantité'] . "</td>";
                    echo "<td><input type='number' name='new_quantity[]' value='" . $row['quantité'] . "'></td>";
                    echo "<input type='hidden' name='product_id[]' value='" . $row['id'] . "'>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button id="miseajour" type="submit">Update</button>
    </form>

    <div class="management">
    <form action="add_product.php" method="post" id="addForm3" style="display: none;">
        <input type="text" id="inpt" name="product_name" placeholder="Nom du produit" required>
        <input type="text" id="inpt" name="product_description" placeholder="Description" required>
        <input type="number" id="inpt" name="product_price" placeholder="Prix" required>
        <input type="number"  id="inpt" name="product_quantity" placeholder="Quantité" required>
        <input type="url"id="inpt" name="product_image" placeholder="URL de l'image" required>
        <input type="hidden" name="category" value="accessoires">
        <button type="submit">Add</button>
    </form>
    <button id="miseajour" onclick="toggleForm('addForm3')">Add product</button>
</div>
<div class="management">
    <form action="delete_product.php" method="post" id="deleteForm3" style="display: none;">
    <select style="padding: 8px; margin: 5px;" name="product_id" required>
            <option value="" disabled selected>Sélectionner un produit</option>
            <?php
            $result = mysqli_query($con, "SELECT id, nom FROM pc");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
            }
            ?>
        </select>
        <input type="hidden" name="category" value="accessoires">
        <button type="submit">Delete</button>
    </form>
    <button id="miseajour" onclick="toggleForm('deleteForm3')">Delete product</button>
</div>


<div class="user-management">
    <h2>Clients :</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($con, "SELECT flname, email FROM form WHERE type != 'admin'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['flname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>





<script>
        function toggleForm(formId) {
            var form = document.getElementById(formId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>
