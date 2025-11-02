<?php
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, email, motdepasse) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nom_utilisateur, $email, $mot_de_passe);

    if ($stmt->execute()) {
        $message = "Inscription réussie.";
    } else {
        $message = "Erreur : " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Créer un compte</h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Nom d'utilisateur :</label>
            <input type="text" name="nom_utilisateur" required><br>

            <label>Adresse e-mail :</label>
            <input type="email" name="email" required><br>

            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required><br>

            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
