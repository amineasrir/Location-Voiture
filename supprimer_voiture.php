<?php
session_start();
require_once 'db.php';


// Vérifier que l'ID est bien passé en paramètre GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Vérifier si la voiture existe
    $voiture = mysqli_query($conn, "SELECT * FROM voitures WHERE id = $id");
    if (mysqli_num_rows($voiture) > 0) {
        // Supprimer la voiture
        $query = "DELETE FROM voitures WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Voiture supprimée avec succès.";
        } else {
            $_SESSION['erreur'] = "Erreur lors de la suppression.";
        }
    } else {
        $_SESSION['erreur'] = "Voiture introuvable.";
    }
} else {
    $_SESSION['erreur'] = "ID non spécifié.";
}

// Redirection vers la liste
header("Location: liste_voitures.php");
exit();
?>
