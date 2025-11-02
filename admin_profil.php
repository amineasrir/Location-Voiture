<?php
session_start();
require_once 'db.php';

// Vérifier si l'admin est connecté
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

$admin_id = $_SESSION['utilisateur']['id'];
$erreur = '';
$success = '';

// Récupérer les données actuelles
$sql = "SELECT * FROM utilisateurs WHERE id = $admin_id";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

// Mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $motdepasse = mysqli_real_escape_string($conn, $_POST['motdepasse']);

    if (!empty($motdepasse)) {
        $sql_update = "UPDATE utilisateurs SET nom='$nom', email='$email', motdepasse='$motdepasse' WHERE id = $admin_id";
    } else {
        $sql_update = "UPDATE utilisateurs SET nom='$nom', email='$email' WHERE id = $admin_id";
    }

    if (mysqli_query($conn, $sql_update)) {
        $success = "Profil mis à jour avec succès.";
        $_SESSION['utilisateur']['nom'] = $nom;
        $_SESSION['utilisateur']['email'] = $email;
    } else {
        $erreur = "Erreur lors de la mise à jour.";
    }
}
?>

<?php include("includes/header_admin.php"); ?>
<div class="container" style="max-width: 600px; margin: auto; padding: 30px; background: #1f1f1f; color: white;">
    <h2>Mon profil (Admin)</h2>

    <?php if ($erreur): ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?php echo $admin['nom']; ?>" required><br><br>

        <label>Email :</label>
        <input type="email" name="email" value="<?php echo $admin['email']; ?>" required><br><br>

        <label>Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
        <input type="password" name="motdepasse"><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>
