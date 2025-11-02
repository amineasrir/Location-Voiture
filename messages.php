<?php
session_start();
include 'db.php';
include 'header_admin.php';

// Récupération des messages
$sql = "SELECT * FROM messages ORDER BY date_envoi DESC";
$resultat = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messages reçus</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="messages-section">
  <h2>Messages reçus</h2>

  <?php if ($resultat->num_rows > 0): ?>
    <div class="messages-table">
      <table>
        <thead>
          <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Sujet</th>
            <th>Message</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($msg = $resultat->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($msg['nom']) ?></td>
              <td><?= htmlspecialchars($msg['email']) ?></td>
              <td><?= htmlspecialchars($msg['sujet']) ?></td>
              <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
              <td><?= htmlspecialchars($msg['date_envoi']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p>Aucun message trouvé.</p>
  <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
