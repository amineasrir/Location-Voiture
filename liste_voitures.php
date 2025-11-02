<?php
session_start();
include 'db.php';
include 'header.php';

$categorie = $_GET['categorie'] ?? '';
$prix_min = $_GET['prix_min'] ?? '';
$prix_max = $_GET['prix_max'] ?? '';

$sql = "SELECT * FROM voitures WHERE disponible = 1";
$conditions = [];

if (!empty($categorie)) {
    $conditions[] = "categorie = '" . $conn->real_escape_string($categorie) . "'";
}
if (!empty($prix_min)) {
    $conditions[] = "prix_par_jour >= " . (float)$prix_min;
}
if (!empty($prix_max)) {
    $conditions[] = "prix_par_jour <= " . (float)$prix_max;
}
if ($conditions) {
    $sql .= " AND " . implode(" AND ", $conditions);
}

$resultat = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des voitures</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="voitures-section">
    <h2>Nos voitures disponibles</h2>

    <form method="GET" class="filtre-form">
        <select name="categorie">
            <option value="">Toutes les catégories</option>
            <option value="SUV" <?= ($categorie == 'SUV') ? 'selected' : '' ?>>SUV</option>
            <option value="Berline" <?= ($categorie == 'Berline') ? 'selected' : '' ?>>Berline</option>
            <option value="Citadine" <?= ($categorie == 'Citadine') ? 'selected' : '' ?>>Citadine</option>
        </select>

        <input type="number" name="prix_min" placeholder="Prix min" value="<?= htmlspecialchars($prix_min) ?>">
        <input type="number" name="prix_max" placeholder="Prix max" value="<?= htmlspecialchars($prix_max) ?>">
        <button type="submit">Filtrer</button>
    </form>

    <div class="voitures-grid">
        <?php if ($resultat->num_rows > 0): ?>
            <?php while ($v = $resultat->fetch_assoc()): ?>
                <div class="voiture-card">
                    <img src="uploads/<?= htmlspecialchars($v['image']) ?>" alt="<?= htmlspecialchars($v['modele']) ?>">
                    <h3><?= htmlspecialchars($v['marque']) ?> <?= htmlspecialchars($v['modele']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($v['description'])) ?></p>
                    <p class="prix"><?= $v['prix_par_jour'] ?> € / jour</p>
                    <?php if (isset($_SESSION['utilisateur_id'])): ?>
                        <a href="reserver.php?id=<?= $v['id'] ?>" class="btn">Réserver</a>
                    <?php else: ?>
                        <a href="connexion.php" class="btn">Se connecter pour réserver</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aucune voiture ne correspond à vos critères.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
