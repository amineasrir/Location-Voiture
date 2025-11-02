<?php include('header_admin.php'); ?>
<main>
    <h2>Ajouter une voiture</h2>
    <form action="traitement_ajout_voiture.php" method="post" enctype="multipart/form-data">
        <input type="text" name="marque" placeholder="Marque" required><br>
        <input type="text" name="modele" placeholder="Modèle" required><br>
        <input type="number" name="prix" placeholder="Prix par jour" required><br>
        <input type="file" name="image" required><br>
        <input type="submit" value="Ajouter">
    </form>
</main>
<?php include('footer.php'); ?>