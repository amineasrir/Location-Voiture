<?php
session_start();
include 'db.php';
include 'header.php';

$id = $_SESSION['utilisateur_id'];

// Récupérer les informations de l'utilisateur
$req = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$req->bind_param("i", $id);
$req->execute();
$result = $req->get_result();
$user = $result->fetch_assoc();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    if (!empty($mot_de_passe)) {
        $hashed = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE utilisateurs SET nom=?, email=?, mot_de_passe=? WHERE id=?");
        $update->bind_param("sssi", $nom, $email, $hashed, $id);
    } else {
        $update = $conn->prepare("UPDATE utilisateurs SET nom=?, email=? WHERE id=?");
        $update->bind_param("ssi", $nom, $email, $id);
    }

    if ($update->execute()) {
        $message = "Mise à jour réussie.";
    } else {
        $message = "Erreur lors de la mise à jour.";
    }
}

if (isset($_POST['supprimer_compte'])) {
    $delete = $conn->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $delete->bind_param("i", $id);
    if ($delete->execute()) {
        session_destroy();
        header("Location: index.php?message=compte_supprimé");
        exit;
    } else {
        $message = "Erreur lors de la suppression du compte.";
    }
}

?>

<div class="form-container">
    <h2>Paramètres du compte</h2>

    <?php if (!empty($message)): ?>
        <p style="color: lightgreen;"><?= $message ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Nouveau mot de passe (laisser vide si inchangé) :</label>
        <input type="password" name="mot_de_passe">

        <button type="submit" class="btn btn-edit">Enregistrer</button>
    </form>
    <hr style="margin: 30px 0; border-color: #555;">

    <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
        <input type="hidden" name="supprimer_compte" value="1">
        <button type="submit" class="btn btn-delete">Supprimer mon compte</button>
    </form>

</div>

<?php include 'footer.php'; ?>
