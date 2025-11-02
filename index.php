<?php
session_start();
include "db.php"; 
include 'header.php';

// Récupérer les voitures les plus louées
$req = $conn->prepare("
    SELECT v.*, COUNT(r.id) AS total_reservations
    FROM voitures v
    JOIN reservations r ON v.id = r.id_voiture
    GROUP BY v.id
    ORDER BY total_reservations DESC
    LIMIT 4
");
$req->execute();
$voitures_populaires = $req->get_result();  
?>

<section class="hero">
  <div class="hero-content">
    <h1>Louez votre voiture en quelques clics</h1>
    <p>Des centaines de véhicules disponibles partout au Maroc</p>
    <a href="reserver.php" class="btn">Réserver maintenant</a>
  </div>
</section>

<section class="avantages">
  <h2>Pourquoi nous choisir ?</h2>
  <div class="avantage-liste">
    <div class="avantage">
      <i class="fa-solid fa-car"></i>
      <h3>Large choix</h3>
      <p>Voitures économiques, SUV, luxe et plus</p>
    </div>
    <div class="avantage">
      <i class="fa-solid fa-wallet"></i>
      <h3>Prix compétitifs</h3>
      <p>Location journalière ou longue durée à petit prix</p>
    </div>
    <div class="avantage">
      <i class="fa-solid fa-clock"></i>
      <h3>Réservation rapide</h3>
      <p>Réservez votre voiture en moins d'une minute</p>
    </div>
  </div>
</section>

<section class="top-voitures">
  <h2>Les voitures les plus louées</h2>
  <div class="voitures-grid">
    <?php while ($v = $voitures_populaires->fetch_assoc()): ?>
      <div class="voiture-card">
        <img src="uploads/<?= htmlspecialchars($v['image']) ?>" alt="<?= htmlspecialchars($v['marque']) ?>">
        <h3><?= htmlspecialchars($v['marque']) ?> <?= htmlspecialchars($v['modele']) ?></h3>
        <p><?= htmlspecialchars($v['prix_par_jour']) ?>€ / jour</p>
        <a href="details_voiture.php?id=<?= $voiture['id'] ?>" class="btn">Voir plus</a>
        <a href="reserver.php?id=<?= $v['id'] ?>" class="btn-secondary">Réserver</a>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php include 'footer.php'; ?>
