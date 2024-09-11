<?php
// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification de l'existence et de la validité des données
    if (isset($_POST['category'])) {
        // Inclure le fichier de connexion à la base de données
        include("rtz.php");

        // Échapper les données pour éviter les injections SQL
        $category = mysqli_real_escape_string($con, $_POST['category']);

        // Récupérer les clés des champs de quantité
        $quantityFields = preg_grep('/^new_quantity_/', array_keys($_POST));

        // Itérer sur chaque champ de quantité
        foreach ($quantityFields as $field) {
            // Récupérer l'ID du produit à partir du nom du champ
            $id = substr($field, strlen('new_quantity_'));

            // Échapper les autres champs
            $productName = mysqli_real_escape_string($con, $_POST["product_name_$id"]);
            $productDescription = mysqli_real_escape_string($con, $_POST["product_description_$id"]);
            $productPrice = mysqli_real_escape_string($con, $_POST["product_price_$id"]);
            $newQuantity = mysqli_real_escape_string($con, $_POST[$field]);

            // Mettre à jour les informations du produit dans la base de données
            $query = "UPDATE $category SET nom = ?, description = ?, prix = ?, quantité = ? WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssdii", $productName, $productDescription, $productPrice, $newQuantity, $id);
            $result = mysqli_stmt_execute($stmt);

            // Vérifier si la mise à jour a réussi
            if (!$result) {
                // En cas d'échec, afficher un message d'erreur
                die('Erreur lors de la mise à jour de la base de données : ' . mysqli_error($con));
            }
        }

        // Redirection vers la page précédente avec un message de succès
        header("Location: {$_SERVER['HTTP_REFERER']}?success=1");
        exit();
    } else {
        // Si les données requises ne sont pas fournies, rediriger avec un message d'erreur
        header("Location: {$_SERVER['HTTP_REFERER']}?error=2");
        exit();
    }
} else {
    // Si la méthode de requête n'est pas POST, rediriger avec un message d'erreur
    header("Location: {$_SERVER['HTTP_REFERER']}?error=3");
    exit();
}
?>
