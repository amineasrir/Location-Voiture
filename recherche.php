<!-- recherche.php -->
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/style.css">

<div class="recherche-container form-container">
    <h2>Rechercher une voiture</h2>
    <form method="GET" action="resultats.php">
        <input type="text" name="marque" placeholder="Marque (ex: Toyota)">
        <input type="text" name="modele" placeholder="Modèle (ex: Corolla)">
        <select name="disponible">
            <option value="">Disponibilité</option>
            <option value="1">Disponible</option>
            <option value="0">Indisponible</option>
        </select>
        <button type="submit">Rechercher</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
