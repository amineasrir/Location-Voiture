<?php
session_start();
include 'db.php';

$id_utilisateur = $_SESSION['utilisateur_id'];
$id_reservation = $_GET['id'];

// Supprimer la réservation uniquement si elle appartient à l'utilisateur
$req = $conn->prepare("DELETE FROM reservations WHERE id = ? AND utilisateur_id = ?");
$req->bind_param("ii", $id_reservation, $id_utilisateur);

if ($req->execute()) {
    header("Location: mes_reservations.php?message=suppression_reussie");
} else {
    echo "Erreur lors de la suppression.";
}
