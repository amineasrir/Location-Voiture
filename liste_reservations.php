<?php
session_start();
include 'db.php';

$req = $bdd->query("
    SELECT r.id, r.date_debut, r.date_fin, r.statut, 
           u.nom_utilisateur, v.nom_voiture
    FROM reservations r
    JOIN utilisateurs u ON r.utilisateur_id = u.id
    JOIN voitures v ON r.voiture_id = v.id
    ORDER BY r.date_debut DESC
");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Réservations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="form-container">
    <h2>Liste des Réservations</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Voiture</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $req->fetch()): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['nom_utilisateur']) ?></td>
                    <td><?= htmlspecialchars($r['nom_voiture']) ?></td>
                    <td><?= $r['date_debut'] ?></td>
                    <td><?= $r['date_fin'] ?></td>
                    <td><?= ucfirst($r['statut']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
