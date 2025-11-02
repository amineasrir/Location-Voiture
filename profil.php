<?php
session_start();
include 'db.php';
include 'header.php';

$id = $_SESSION['utilisateur_id'];

// Récupération des données utilisateur
$req = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$req->bind_param("i", $id);
$req->execute();
$result = $req->get_result();
$user = $result->fetch_assoc();
?>

<div class="profile-container">
    <h2>Mon profil</h2>

    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>

    <a href="parametres.php" class="btn btn-edit">Modifier mes informations</a>
</div>

<?php include 'footer.php'; ?>
