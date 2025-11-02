<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: liste_voitures.php");
    exit();
}

$id = $_GET['id'];

$req = $conn->prepare("SELECT * FROM voitures WHERE id = :id");
$req->bind_param(":id", $id);
$req->execute();
$voiture = $req->fetch();

if (!$voiture) {
    echo "Voiture introuvable.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_voiture = $_POST['nom_voiture'];
    $marque = $_POST['marque'];
    $prix_jour = $_POST['prix_jour'];
    $disponibilite = $_POST['disponibilite'];

    $update = $conn->prepare("UPDATE voitures SET nom_voiture = ?, marque = ?, prix_jour = ?, disponibilite = ? WHERE id = ?");
    $update->execute([$nom_voiture, $marque, $prix_jour, $disponibilite, $id]);

    header("Location: liste_voitures.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une voiture</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="form-container">
    <h2>Modifier une voiture</h2>
    <form method="POST">
        <input type="text" name="nom_voiture" value="<?= htmlspecialchars($voiture['model']) ?>" required>
        <input type="text" name="marque" value="<?= htmlspecialchars($voiture['marque']) ?>" required>
        <input type="number" name="prix_jour" value="<?= $voiture['prix_jour'] ?>" required>
        <select name="disponibilite">
            <option value="oui" <?= $voiture['disponibilite'] === 'oui' ? 'selected' : '' ?>>Oui</option>
            <option value="non" <?= $voiture['disponibilite'] === 'non' ? 'selected' : '' ?>>Non</option>
        </select>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
