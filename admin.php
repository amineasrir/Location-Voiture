<?php include 'header_admin.php'; ?>
<h2>Tableau de bord - Administration</h2>

<p><a href="ajouter_voiture.php">➕ Ajouter une nouvelle voiture</a></p>
<p><a href="admin_reservations.php">📋 Voir toutes les réservations</a></p>

<hr>

<h3>🚗 Liste des voitures</h3>

<?php
include 'db.php';
$voitures = $connexion->query("SELECT * FROM voitures");

if ($voitures->num_rows > 0):
    while ($v = $voitures->fetch_assoc()):
?>
    <div class="voiture">
        <h4><?php echo htmlspecialchars($v['nom']); ?> - <?php echo htmlspecialchars($v['marque']); ?></h4>
        <?php if (!empty($v['image'])): ?>
            <img src="<?php echo $v['image']; ?>" width="150"><br>
        <?php endif; ?>
        <p>Prix par jour : <?php echo $v['prix_par_jour']; ?>€</p>
        <a href="modifier_voiture.php?id=<?php echo $v['id']; ?>">✏️ Modifier</a> |
        <a href="supprimer_voiture.php?id=<?php echo $v['id']; ?>" onclick="return confirm('Confirmer la suppression ?');">🗑️ Supprimer</a>
    </div>
    <hr>
<?php
    endwhile;
else:
    echo "<p>Aucune voiture trouvée.</p>";
endif;
?>

<?php include 'footer.php'; ?>