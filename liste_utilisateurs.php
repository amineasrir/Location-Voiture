<?php
session_start();
include 'db.php';

$req = $bdd->query("SELECT * FROM utilisateurs ORDER BY date_inscription DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="form-container">
    <h2>Liste des Utilisateurs</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Date d'inscription</th>
        </tr>
        <?php while ($user = $req->fetch()): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['nom_utilisateur']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['date_inscription'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
