<?php
session_start();
include 'db.php';

$utilisateur_id = $_SESSION['utilisateur_id'];
$requete = $connexion->prepare("
    SELECT r.*, v.nom AS nom_voiture, v.marque 
    FROM reservations r 
    JOIN voitures v ON r.id_voiture = v.id 
    WHERE r.id_utilisateur = ? 
    ORDER BY r.date_debut DESC
");
$requete->bind_param("i", $utilisateur_id);
$requete->execute();
$resultat = $requete->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
</head>
<body>
    <h2>Bienvenue sur votre tableau de bord</h2>
    <a href="reserver.php">Réserver une voiture</a> | <a href="deconnexion.php">Se déconnecter</a>

    <h3>Vos réservations</h3>
    <?php if ($resultat->num_rows > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Voiture</th>
                <th>Marque</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Prix total</th>
            </tr>
            <?php while ($res = $resultat->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $res['nom_voiture']; ?></td>
                    <td><?php echo $res['marque']; ?></td>
                    <td><?php echo $res['date_debut']; ?></td>
                    <td><?php echo $res['date_fin']; ?></td>
                    <td><?php echo $res['prix_total']; ?>€</td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Vous n'avez pas encore de réservations.</p>
    <?php endif; ?>
</body>
</html>
