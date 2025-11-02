<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: connexion.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "Aucune facture sélectionnée.";
    exit();
}

$id_reservation = intval($_GET['id']);

// Récupérer les infos de la réservation
$req = $conn->prepare("
    SELECT r.*, v.marque, v.modele, v.prix_par_jour, u.nom, u.prenom, u.email
    FROM reservations r
    JOIN voitures v ON v.id = r.voiture_id
    JOIN utilisateurs u ON u.id = r.utilisateur_id
    WHERE r.id = ? AND r.utilisateur_id = ?
");
$req->bind_param("ii", $id_reservation, $_SESSION['utilisateur_id']);
$req->execute();
$resultat = $req->get_result();

if ($resultat->num_rows === 0) {
    echo "Réservation non trouvée.";
    exit();
}

$reservation = $resultat->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Facture</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="facture-section">
  <h2>Facture de réservation</h2>
  <div class="facture-contenu">
    <p><strong>Nom du client:</strong> <?= htmlspecialchars($reservation['prenom']) . ' ' . htmlspecialchars($reservation['nom']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($reservation['email']) ?></p>
    <p><strong>Voiture:</strong> <?= htmlspecialchars($reservation['marque']) . ' ' . htmlspecialchars($reservation['modele']) ?></p>
    <p><strong>Date de début:</strong> <?= htmlspecialchars($reservation['date_debut']) ?></p>
    <p><strong>Date de fin:</strong> <?= htmlspecialchars($reservation['date_fin']) ?></p>
    <p><strong>Prix par jour:</strong> <?= $reservation['prix_par_jour'] ?>€</p>
    <p><strong>Total:</strong> <?= $reservation['total_prix'] ?>€</p>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
