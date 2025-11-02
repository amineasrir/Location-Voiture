<?php
session_start();
include 'db.php';
include 'header_admin.php';

$resultat = $conn->query("SELECT * FROM voitures ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les voitures</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="voitures-section">
    <h2>Gérer les voitures</h2>

    <a href="ajouter_voiture.php" class="btn-ajouter">➕ Ajouter une voiture</a>

    <div class="voitures-grid">
        <?php while ($v = $resultat->fetch_assoc()): ?>
            <div class="voiture-card">
                <img src="uploads/<?= htmlspecialchars($v['image']) ?>" alt="<?= htmlspecialchars($v['modele']) ?>">
                <h3><?= htmlspecialchars($v['marque']) ?> <?= htmlspecialchars($v['modele']) ?></h3>
                <p><?= htmlspecialchars($v['categorie']) ?></p>
                <p class="prix"><?= $v['prix_par_jour'] ?> € / jour</p>
                <a href="modifier_voiture.php?id=<?= $v['id'] ?>" class="btn modifier">✏️ Modifier</a>
                <a href="supprimer_voiture.php?id=<?= $v['id'] ?>" class="btn supprimer" onclick="return confirm('Supprimer cette voiture ?')">🗑️ Supprimer</a>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
