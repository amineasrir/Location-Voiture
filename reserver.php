<?php
session_start();
include 'db.php';
include 'header.php'; 


if (!isset($_GET['id'])) {
    header("Location: voitures.php");
    exit;
}

$voiture_id = intval($_GET['id']);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $utilisateur_id = $_SESSION['utilisateur_id'];

    $stmt = $conn->prepare("INSERT INTO reservations (id_utilisateur, id_ voiture, date_debut, date_fin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $utilisateur_id, $voiture_id, $date_debut, $date_fin);
    if ($stmt->execute()) {
        $message = "Réservation effectuée avec succès.";
    } else {
        $message = "Erreur lors de la réservation.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver</title>
</head>
<body>
    <div class="form-container">

        <h2>Réserver une voiture</h2>
        <a href="voitures.php">⬅ Retour</a>

        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Date de début :</label><input type="date" name="date_debut" required><br>
            <label>Date de fin :</label><input type="date" name="date_fin" required><br>
            <button type="submit">Confirmer la réservation</button>
        </form>
    </div>
<?php include 'footer.php'; ?>
