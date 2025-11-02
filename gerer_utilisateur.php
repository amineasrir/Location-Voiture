<?php
session_start();
include 'db.php';
include 'header_admin.php';


$resultat = $conn->query("SELECT * FROM utilisateurs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les utilisateurs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="section-utilisateurs">
    <h2>Gérer les utilisateurs</h2>
    
    <a href="ajouter_admin.php" class="btn-ajouter">➕ Ajouter un administrateur</a>

    <table class="table-utilisateurs">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($u = $resultat->fetch_assoc()): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nom']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['role']) ?></td>
                    <td>
                        <a href="modifier_utilisateur.php?id=<?= $u['id'] ?>" class="btn modifier">✏️</a>
                        <a href="supprimer_utilisateur.php?id=<?= $u['id'] ?>" class="btn supprimer" onclick="return confirm('Supprimer cet utilisateur ?')">🗑️</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
