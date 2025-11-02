<?php
include 'db.php';
include 'header.php';

$message_envoye = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $sujet = htmlspecialchars($_POST["sujet"]);
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO messages (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $email, $sujet, $message);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message_envoye = true;
    }
}
?>

<link rel="stylesheet" href="css/style.css">
<div class="contact-container form-container">
    <h2>Contactez-nous</h2>

    <?php if ($message_envoye): ?>
        <div class="success">Votre message a été envoyé avec succès.</div>
    <?php endif; ?>

    <form method="POST" action="contact.php">
        <input type="text" name="nom" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Votre email" required>
        <input type="text" name="sujet" placeholder="Sujet" required>
        <textarea name="message" placeholder="Votre message..." required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>

<?php include 'footer.php'; ?>
