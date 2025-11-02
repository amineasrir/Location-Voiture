<?php
session_start();
?>

<?php include('header.php'); ?>
<main>
    <h2>Ajouter un administrateur</h2>
    <form action="traitement_ajouter_admin.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="motdepasse" placeholder="Mot de passe" required><br>
        <input type="submit" value="Ajouter">
    </form>
</main>
<?php include('footer.php'); ?>