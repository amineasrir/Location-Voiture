<?php
session_start();
include 'db.php';
include 'header_admin.php';

// Valider ou refuser une réservation
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);

    if (in_array($action, ['valider', 'refuser'])) {
        $statut = $action === 'valider' ? 'validée' : 'refusée';
        $stmt = $connexion->prepare("UPDATE reservations SET statut = ? WHERE id = ?");
        $stmt->bind_param("si", $statut, $id);
        $stmt->execute();
    }
}

// Récupérer les réservations avec jointure utilisateur + voiture
$requete = "
    SELECT r.id, r.date_debut, r.date_fin, r.statut,
           u.nom AS nom_utilisateur, u.email,
           v.modele AS nom_voiture, v.marque
    FROM reservations r
    JOIN utilisateurs u ON r.id_utilisateur = u.id
    JOIN voitures v ON r.id_voiture = v.id
    ORDER BY r.id DESC
";
$reservations = $conn->query($requete);
?>

<h2>Gestion des réservations</h2>
<a href="admin.php">⬅ Retour à l'administration</a>

<?php while ($r = $reservations->fetch_assoc()): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
        <strong><?php echo $r['nom_utilisateur']; ?></strong> (<?php echo $r['email']; ?>)<br>
        <em>Voiture :</em> <?php echo $r['nom_voiture']; ?> - <?php echo $r['marque']; ?><br>
        <em>Période :</em> du <?php echo $r['date_debut']; ?> au <?php echo $r['date_fin']; ?><br>
        <em>Statut :</em> <strong><?php echo $r['statut']; ?></strong><br>

        <?php if ($r['statut'] === 'en attente'): ?>
            <a href="?action=valider&id=<?php echo $r['id']; ?>">✅ Valider</a>
            <a href="?action=refuser&id=<?php echo $r['id']; ?>">❌ Refuser</a>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
<?php include 'footer.php'; ?>
