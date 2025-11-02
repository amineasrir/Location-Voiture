<?php
session_start();
include 'db.php';
include 'header.php';

// Traitement ajout témoignage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['utilisateur_id'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $message = htmlspecialchars($_POST['message']);
    $utilisateur_id = $_SESSION['utilisateur_id'];

    $stmt = $conn->prepare("INSERT INTO temoignages (utilisateur_id, nom, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $utilisateur_id, $nom, $message);
    $stmt->execute();
}

// Récupération des témoignages
$result = $conn->query("SELECT nom, message, date_ajout FROM temoignages ORDER BY date_ajout DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Témoignages</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="temoignages-section">
    <h2>Ce que disent nos clients</h2>

    <div class="temoignages-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="temoignage">
                <h4><?= htmlspecialchars($row['nom']) ?></h4>
                <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                <span class="date"><?= date('d/m/Y', strtotime($row['date_ajout'])) ?></span>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if (isset($_SESSION['utilisateur_id'])): ?>
    <div class="form-temoignage">
        <h3>Partager votre expérience</h3>
        <form method="POST">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <textarea name="message" placeholder="Votre message" required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
