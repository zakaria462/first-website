<?php
include("rtz.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $id = $_POST["id"];

    if (isset($_POST["delete_action"]) && $_POST["delete_action"] === "delete") {
        $query = "DELETE FROM $category WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        
        // Vérifiez si la préparation de la requête a réussi
        if ($stmt) {
            // Liez le paramètre ID à la requête préparée
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            // Exécutez la requête préparée
            $result = mysqli_stmt_execute($stmt);
            
            if ($result) {
                echo "Product #$id deleted successfully!"; // Afficher un message de succès
                header("Location: products.php"); // Rediriger vers la liste des produits
                exit();
            } else {
                echo "Error deleting product #$id: " . mysqli_error($con); // Afficher un message d'erreur
            }
        } else {
            echo "Error preparing delete statement: " . mysqli_error($con); // Afficher un message d'erreur de préparation
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request.";
}
?>
