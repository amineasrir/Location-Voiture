<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $motdepasse = mysqli_real_escape_string($conn, $_POST['motdepasse']);

    // Vérifier si l'email existe déjà
    $verif = mysqli_query($conn, "SELECT * FROM utilisateurs WHERE email = '$email'");
    if (mysqli_num_rows($verif) > 0) {
        $_SESSION['erreur'] = "Un utilisateur avec cet email existe déjà.";
        header("Location: ajouter_admin.php");
        exit();
    }

    // Ajouter l'administrateur
    $role = 'admin';
    $req = "INSERT INTO utilisateurs (nom, email, motdepasse, role)
            VALUES ('$nom', '$email', '$motdepasse', '$role')";
    
    if (mysqli_query($conn, $req)) {
        $_SESSION['success'] = "Administrateur ajouté avec succès.";
        header("Location: liste_utilisateurs.php"); // ou vers une autre page
        exit();
    } else {
        $_SESSION['erreur'] = "Erreur lors de l'ajout.";
        header("Location: ajouter_admin.php");
        exit();
    }
} else {
    header("Location: ajouter_admin.php");
    exit();
}
?>
