<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: voitures.php");
    exit();
}

$id_voiture = intval($_GET['id']);

$req = $conn->prepare("SELECT * FROM voitures WHERE id = ?");
$req->bind_param("i", $id_voiture);
$req->execute();
$resultat = $req->get_result();

if ($resultat->num_rows === 0) {
    echo "Voiture introuvable.";
    exit();
}

$voiture = $resultat->fetch_assoc();
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails - <?= htmlspecialchars($voiture['marque']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="details-voiture">
    <div class="image-voiture">
        <img src="uploads/<?= htmlspecialchars($voiture['image']) ?>" alt="<?= htmlspecialchars($voiture['marque']) ?>">
    </div>

    <div class="infos-voiture">
        <h2><?= htmlspecialchars($voiture['marque']) ?> - <?= htmlspecialchars($voiture['modele']) ?></h2>
        <p><strong>Prix/jour :</strong> <?= htmlspecialchars($voiture['prix_jour']) ?> €</p>
        <p><strong>Année :</strong> <?= htmlspecialchars($voiture['annee']) ?></p>
        <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($voiture['description'])) ?></p>

        <?php if (isset($_SESSION['utilisateur_id'])) : ?>
            <a href="reserver.php?id=<?= $voiture['id'] ?>" class="btn">Réserver cette voiture</a>
        <?php else : ?>
            <p><a href="connexion.php" class="btn">Connectez-vous pour réserver</a></p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
