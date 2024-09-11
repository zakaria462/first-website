<?php
session_start(); // Démarrer la session si ce n'est pas déjà fait

// Vérifie si l'e-mail est défini dans la requête POST
if(isset($_POST['email'])) {
    // Connexion à la base de données
    include("rtz.php");

    // Échapper les caractères spéciaux pour éviter les attaques par injection SQL
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Requête SQL pour supprimer l'utilisateur avec l'e-mail donné
    $query = "DELETE FROM form WHERE email = '$email'";

    // Exécute la requête
    if(mysqli_query($con, $query)) {
        $_SESSION['success_message'] = "L'utilisateur avec l'adresse e-mail $email a été supprimé avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($con);
    }

    // Ferme la connexion à la base de données
    mysqli_close($con);

    // Redirection vers la page des clients
    header("Location: custemors.php");
    exit();
} else {
    // Redirection vers une autre page si l'e-mail n'est pas défini
    header("Location: error.php");
    exit();
}
?>
