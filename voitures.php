<?php
session_start();
include 'db.php';
include 'header.php';

// Récupérer toutes les voitures disponibles
$req = $conn->prepare("SELECT * FROM voitures WHERE disponible = '1'");
$req->execute();
$resultat = $req->get_result();
?>

<div class="voitures-container">
    <h2>Nos Voitures Disponibles</h2>

    <div class="voitures-grid">
        <?php while ($v = $resultat->fetch_assoc()): ?>
            <div class="voiture-card">
                <img src="uploads/<?= htmlspecialchars($v['image']) ?>" alt="<?= htmlspecialchars($v['marque']) ?>">
                <h3><?= htmlspecialchars($v['marque']) ?> <?= htmlspecialchars($v['modele']) ?></h3>
                <p><?= htmlspecialchars($v['categorie']) ?></p>
                <p><strong><?= $v['prix_par_jour'] ?>€ / jour</strong></p>
                <a href="reserver.php?id=<?= $v['id'] ?>" class="btn">Réserver</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
