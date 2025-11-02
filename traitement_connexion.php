<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $motdepasse = trim($_POST['motdepasse']);

    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $resultat = mysqli_query($conn, $sql);

    if ($resultat && mysqli_num_rows($resultat) == 1) {
        $utilisateur = mysqli_fetch_assoc($resultat);

        if ($motdepasse === $utilisateur['motdepasse']) {
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['role'] = $utilisateur['role'];

            if ($utilisateur['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $_SESSION['erreur_connexion'] = "Mot de passe incorrect.";
        }
    } else {
        $_SESSION['erreur_connexion'] = "Email non trouvé.";
    }

    header("Location: connexion.php");
    exit();
} else {
    header("Location: connexion.php");
    exit();
}
?>
