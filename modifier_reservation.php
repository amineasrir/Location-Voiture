<?php
session_start();
include 'header.php';
include 'db.php';

$id_utilisateur = $_SESSION['utilisateur_id'];
$id_reservation = $_GET['id'];

// Récupérer la réservation
$req = $conn->prepare("SELECT * FROM reservations WHERE id = ? AND utilisateur_id = ?");
$req->bind_param("ii", $id_reservation, $id_utilisateur);
$req->execute();
$result = $req->get_result();

if ($result->num_rows === 0) {
    echo "<p style='color:red;'>Réservation introuvable.</p>";
    exit;
}

$reservation = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    $debut = new DateTime($date_debut);
    $fin = new DateTime($date_fin);
    $jours = $debut->diff($fin)->days;

    if ($jours < 1) {
        echo "<p style='color:red;'>La date de fin doit être après la date de début.</p>";
    } else {
        $prix_total = $jours * $reservation['prix_jour'];

        $update = $conn->prepare("UPDATE reservations SET date_debut=?, date_fin=?, prix_total=? WHERE id=? AND utilisateur_id=?");
        $update->bind_param("ssdii", $date_debut, $date_fin, $prix_total, $id_reservation, $id_utilisateur);

        if ($update->execute()) {
            header("Location: mes_reservations.php?message=modification_reussie");
            exit;
        } else {
            echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
        }
    }
}
?>

<div class="form-container">
    <h2>Modifier ma réservation</h2>
    <form method="post">
        <label for="date_debut">Date de début :</label>
        <input type="date" name="date_debut" value="<?= $reservation['date_debut'] ?>" required>

        <label for="date_fin">Date de fin :</label>
        <input type="date" name="date_fin" value="<?= $reservation['date_fin'] ?>" required>

        <button type="submit" class="btn btn-edit">Enregistrer</button>
        <a href="mes_reservations.php" class="btn btn-delete">Annuler</a>
    </form>
</div>

<?php include 'footer.php'; ?>
