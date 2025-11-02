<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: gerer_utilisateur.php");
    exit();
}

$id = intval($_GET['id']);

if ($id == $_SESSION['utilisateur_id']) {
    header("Location: gerer_utilisateur.php?erreur=self-delete");
    exit();
}

$stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: gerer_utilisateur.php?success=suppression");
    exit();
} else {
    header("Location: gerer_utilisateur.php?erreur=sql");
    exit();
}
?>
