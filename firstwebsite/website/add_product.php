<?php

include("rtz.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST["product_name"]) && isset($_POST["product_description"]) && isset($_POST["product_price"]) && isset($_POST["product_quantity"]) && isset($_POST["product_image"]) && isset($_POST["category"])) {
        // Récupération des données du formulaire et sécurisation
        $product_name = mysqli_real_escape_string($con, $_POST["product_name"]);
        $product_description = mysqli_real_escape_string($con, $_POST["product_description"]);
        $product_price = mysqli_real_escape_string($con, $_POST["product_price"]);
        $product_quantity = mysqli_real_escape_string($con, $_POST["product_quantity"]);
        $product_image = mysqli_real_escape_string($con, $_POST["product_image"]);
        $category = mysqli_real_escape_string($con, $_POST["category"]);

      
        $query = "INSERT INTO $category (nom, description, prix, quantité, image) VALUES ('$product_name', '$product_description', '$product_price', '$product_quantity', '$product_image')";

      
        if (mysqli_query($con, $query)) {
     
            header("Location: products.php");
            exit();
        } else {
        
            echo "Erreur lors de l'ajout du produit : " . mysqli_error($con);
        }
    } else {
      
        echo "Erreur : Données manquantes pour l'ajout du produit.";
    }
} else {
   
    echo "Erreur : Requête invalide.";
}
?>
