<?php
session_start();
include 'db.php';
include 'header.php';

// Récupérer les paramètres de la requête GET
$marque = isset($_GET['marque']) ? $_GET['marque'] : '';
$prix_min = isset($_GET['prix_min']) ? $_GET['prix_min'] : 0;
$prix_max = isset($_GET['prix_max']) ? $_GET['prix_max'] : 100000;

// Construire la requête SQL avec les filtres
$sql = "SELECT * FROM voitures WHERE prix_par_jour BETWEEN ? AND ?";

if (!empty($marque)) {
    $sql .= " AND marque = ?";
}

// Préparer la requête
$stmt = $connexion->prepare($sql);

// Lier les paramètres
if (!empty($marque)) {
    $stmt->bind_param("iis", $prix_min, $prix_max, $marque);
} else {
    $stmt->bind_param("ii", $prix_min, $prix_max);
}

// Exécuter la requête
$stmt->execute();
$resultat = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Voitures - Location</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>

    <header>
        <h1>Location de Voitures</h1>
    </header>

    <div class="container">
        <h2>🔍 Recherche de voitures</h2>

        <!-- Formulaire de recherche -->
        <form action="recherche_voiture.php" method="get">
            <label for="marque">Marque</label>
            <select name="marque" id="marque">
                <option value="">Toutes</option>
                <option value="Renault" <?php if ($marque == 'Renault') echo 'selected'; ?>>Renault</option>
                <option value="BMW" <?php if ($marque == 'BMW') echo 'selected'; ?>>BMW</option>
                <option value="Toyota" <?php if ($marque == 'Toyota') echo 'selected'; ?>>Toyota</option>
                <!-- Ajoutez d'autres marques -->
            </select>

            <label for="prix_min">Prix minimum</label>
            <input type="number" name="prix_min" id="prix_min" min="0" placeholder="€" value="<?php echo htmlspecialchars($prix_min); ?>">

            <label for="prix_max">Prix maximum</label>
            <input type="number" name="prix_max" id="prix_max" min="0" placeholder="€" value="<?php echo htmlspecialchars($prix_max); ?>">

            <button type="submit">Rechercher</button>
        </form>

        <h3>Voitures disponibles</h3>
        
        <!-- Résultats de recherche -->
        <?php if ($resultat->num_rows > 0): ?>
            <div class="voitures-list">
                <?php while ($voiture = $resultat->fetch_assoc()): ?>
                    <div class="voiture">
                        <h3><?php echo htmlspecialchars($voiture['nom']); ?> (<?php echo htmlspecialchars($voiture['marque']); ?>)</h3>
                        <p>Prix: <?php echo htmlspecialchars($voiture['prix_par_jour']); ?>€ par jour</p>
                        <a href="reserver.php?id=<?php echo $voiture['id']; ?>">Réserver</a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Aucune voiture trouvée avec ces critères.</p>
        <?php endif; ?>

        <h3>📅 Sélectionner une date de réservation</h3>
        <form action="confirmer_reservation.php" method="post">
            <label for="date_debut">Date de début :</label>
            <input type="text" id="date_debut" name="date_debut">

            <label for="date_fin">Date de fin :</label>
            <input type="text" id="date_fin" name="date_fin">

            <button type="submit">Confirmer la réservation</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Location de Voitures. Tous droits réservés.</p>
    </footer>

    <script>
    $(function() {
        $("#date_debut, #date_fin").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0, // Désactiver les dates passées
            onSelect: function(selectedDate) {
                var option = this.id == "date_debut" ? "minDate" : "maxDate",
                    date = $.datepicker.parseDate($.datepicker._defaults.dateFormat, selectedDate);
                $("#date_debut, #date_fin").not(this).datepicker("option", option, date);
            }
        });
    });
    </script>

</body>
</html>
