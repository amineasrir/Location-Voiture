<?php
session_start();
include 'db.php';
include 'header_admin.php';


// Récupérer les statistiques
$total_utilisateurs = $conn->query("SELECT COUNT(*) FROM utilisateurs")->fetch_row()[0];
$total_voitures     = $conn->query("SELECT COUNT(*) FROM voitures")->fetch_row()[0];
$total_reservations = $conn->query("SELECT COUNT(*) FROM reservations")->fetch_row()[0];
$total_messages     = $conn->query("SELECT COUNT(*) FROM messages")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="dashboard-section">
  <h2>Tableau de bord</h2>

  <div class="dashboard-cards">
    <div class="dashboard-card">
      <h3>Utilisateurs</h3>
      <p><?= $total_utilisateurs ?></p>
    </div>
    <div class="dashboard-card">
      <h3>Voitures</h3>
      <p><?= $total_voitures ?></p>
    </div>
    <div class="dashboard-card">
      <h3>Réservations</h3>
      <p><?= $total_reservations ?></p>
    </div>
    <div class="dashboard-card">
      <h3>Messages</h3>
      <p><?= $total_messages ?></p>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
