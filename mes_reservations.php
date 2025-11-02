<?php
session_start();
include 'header.php';
include 'db.php';

$id_utilisateur = $_SESSION['utilisateur_id'];

$req = $conn->prepare("
    SELECT r.*, v.marque, v.modele, v.image
    FROM reservations r
    JOIN voitures v ON r.id_voiture = v.id
    WHERE r.id_utilisateur = ?
    ORDER BY r.date_debut DESC
");
$req->bind_param("i", $id_utilisateur);
$req->execute();
$result = $req->get_result();
?>

<div class="container-reservations">
    <h1>Mes Réservations</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while($res = $result->fetch_assoc()): ?>
            <div class="carte-reservation">
                <img src="uploads/<?= htmlspecialchars($res['image']) ?>" alt="voiture">
                <div class="details-res">
                    <h2><?= htmlspecialchars($res['marque'] . " " . $res['modele']) ?></h2>
                    <p><strong>Du :</strong> <?= $res['date_debut'] ?></p>
                    <p><strong>Au :</strong> <?= $res['date_fin'] ?></p>
                </div>
                <div class="actions-reservation">
                    <a href="facture.php?id=<?= $reservation['id'] ?>" class="btn">Voir la facture</a>
                    <a href="modifier_reservation.php?id=<?= $res['id'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="supprimer_reservation.php?id=<?= $res['id'] ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment annuler cette réservation ?')">Annuler</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
