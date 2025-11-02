<?php
include 'includes/db.php';
include 'includes/header.php';

$marque = $_GET['marque'] ?? '';
$modele = $_GET['modele'] ?? '';
$disponible = $_GET['disponible'] ?? '';

$sql = "SELECT * FROM voitures WHERE 1=1";
$params = [];

if (!empty($marque)) {
    $sql .= " AND marque LIKE ?";
    $params[] = "%$marque%";
}
if (!empty($modele)) {
    $sql .= " AND modele LIKE ?";
    $params[] = "%$modele%";
}
if ($disponible !== "") {
    $sql .= " AND disponible = ?";
    $params[] = $disponible;
}

$stmt = $conn->prepare($sql);
$types = str_repeat("s", count($params));
$stmt->bind_param($types, ...$params);
$stmt->execute();
$resultat = $stmt->get_result();
?>

<div class="resultats-container">
    <h2>Résultats de la recherche</h2>
    <div class="cartes">
        <?php while ($voiture = $resultat->fetch_assoc()) : ?>
            <div class="carte">
                <img src="images/<?= $voiture['image'] ?>" alt="Voiture">
                <h3><?= htmlspecialchars($voiture['marque']) ?> <?= htmlspecialchars($voiture['modele']) ?></h3>
                <p><?= number_format($voiture['prix_par_jour'], 2) ?> € / jour</p>
                <p>Status: <?= $voiture['disponible'] ? "Disponible" : "Indisponible" ?></p>
                <a href="details_voiture.php?id=<?= $voiture['id'] ?>" class="btn">Détails</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
