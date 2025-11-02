<?php
include 'includes/db.php';
include 'includes/header_admin.php';

// Suppression d'un message si demandé
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    $conn->query("DELETE FROM messages WHERE id = $id");
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="admin-container">
    <h2>📩 Messages reçus</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM messages ORDER BY date_envoi DESC");
            while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['nom']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['sujet']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    <td><?= $row['date_envoi'] ?></td>
                    <td><a href="admin_messages.php?supprimer=<?= $row['id'] ?>" class="btn-danger" onclick="return confirm('Supprimer ce message ?')">Supprimer</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
