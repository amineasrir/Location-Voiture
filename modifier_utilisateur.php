<?php
session_start();
include 'db.php';
include 'header_admin.php';

if (!isset($_GET['id'])) {
    header("Location: gerer_utilisateur.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$utilisateur = $result->fetch_assoc();

if (!$utilisateur) {
    echo "<p>Utilisateur introuvable.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    $stmt = $conn->prepare("UPDATE utilisateurs SET nom = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nom, $email, $role, $id);
    if ($stmt->execute()) {
        header("Location: gerer_utilisateur.php");
        exit();
    } else {
        echo "<p>Erreur lors de la mise à jour.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="form-section">
    <h2>Modifier utilisateur</h2>
    <form action="" method="POST" class="form-style">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required value="<?= htmlspecialchars($utilisateur['nom']) ?>">

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required value="<?= htmlspecialchars($utilisateur['email']) ?>">

        <label for="role">Rôle :</label>
        <select name="role" id="role" required>
            <option value="utilisateur" <?= $utilisateur['role'] == 'utilisateur' ? 'selected' : '' ?>>Utilisateur</option>
            <option value="admin" <?= $utilisateur['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>

        <button type="submit" class="btn">💾 Enregistrer</button>
    </form>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
