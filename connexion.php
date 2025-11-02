<?php include('header.php'); ?>
<main class="form-container">
    <h2>Connexion</h2>
    <form action="traitement_connexion.php" method="post">
        <label for="email">Email :</label><br>
        <input type="email" name="email" required><br>
        <label for="motdepasse">Mot de passe :</label><br>
        <input type="password" name="motdepasse" required><br>
        <input type="submit" value="Se connecter">
    </form>
</main>
<?php include('footer.php'); ?>