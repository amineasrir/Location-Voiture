<?php
session_start();
include 'db.php';

$id_utilisateur = $_SESSION['utilisateur_id'];
$id_voiture = $_SESSION['voiture_id'];
$date_debut = $_SESSION['date_debut'];
$date_fin = $_SESSION['date_fin'];
$prix_total = $_SESSION['prix_total'];

$sql = "INSERT INTO reservations (utilisateur_id, voiture_id, date_debut, date_fin, prix_total)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iissd", $id_utilisateur, $id_voiture, $date_debut, $date_fin, $prix_total);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
