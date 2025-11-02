<?php
$hote = "localhost";
$utilisateur = "root";
$mot_de_passe = ""; // vide par défaut sous XAMPP
$base_de_donnees = "location_voitures";

// Connexion à la base de données avec gestion d'erreurs
$conn = new mysqli($hote, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Forcer l'encodage UTF-8 pour supporter les caractères spéciaux en français
$conn->set_charset("utf8");
?>
