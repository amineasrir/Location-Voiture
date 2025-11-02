<?php
session_start();
include 'header.php';
include 'db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: connexion.php");
    exit;
}

// Vérifier que l'ID de la voiture est présent
if (!isset($_GET['id'])) {
    echo "<p style='color:red;'>Voiture non spécifiée.</p>";
    exit;
}

$id_voiture = $_GET['id'];
$req = $conn->prepare("SELECT * FROM voitures WHERE id = ?");
$req->bind_param("i", $id_voiture);
$req->execute();
$resultat = $req->get_result();
$voiture = $resultat->fetch_assoc();

if (!$voiture) {
    echo "<p style='color:red;'>Voiture introuvable.</p>";
    exit;
}
?>

<div class="container-reservation">
  <h1>Réserver la voiture : <?= htmlspecialchars($voiture['marque'] . " " . $voiture['modele']) ?></h1>

  <form action="paiement.php" method="post">
    <input type="hidden" name="voiture_id" value="<?= $voiture['id'] ?>">
    
    <label for="date_debut">Date de début :</label>
    <input type="date" name="date_debut" required>

    <label for="date_fin">Date de fin :</label>
    <input type="date" name="date_fin" required>

    <label for="prix_jour">Prix par jour :</label>
    <input type="text" value="<?= $voiture['prix_jour'] ?> DH" disabled>

    <input type="hidden" name="prix_jour" value="<?= $voiture['prix_jour'] ?>">

    <button type="submit">Réserver et Payer</button>
  </form>
</div>

<?php include 'footer.php'; ?>
