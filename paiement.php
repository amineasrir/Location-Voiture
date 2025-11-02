<?php
session_start();
include 'header.php';
include 'db.php';

// Vérifier que les données viennent de reservation.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['voiture_id'] = $_POST['voiture_id'];
    $_SESSION['date_debut'] = $_POST['date_debut'];
    $_SESSION['date_fin'] = $_POST['date_fin'];
    $_SESSION['prix_jour'] = $_POST['prix_jour'];

    // Calcul du nombre de jours et du total
    $debut = new DateTime($_POST['date_debut']);
    $fin = new DateTime($_POST['date_fin']);
    $intervalle = $debut->diff($fin)->days;

    if ($intervalle < 1) {
        echo "<p style='color:red;'>La date de fin doit être après la date de début.</p>";
        exit;
    }

    $_SESSION['prix_total'] = $intervalle * $_POST['prix_jour'];
} else {
    header("Location: index.php");
    exit;
}
?>

<div class="container-paiement">
  <h1>Confirmation de réservation</h1>

  <div class="details-reservation">
    <p><strong>Date de début :</strong> <?= $_SESSION['date_debut'] ?></p>
    <p><strong>Date de fin :</strong> <?= $_SESSION['date_fin'] ?></p>
    <p><strong>Nombre de jours :</strong> <?= $intervalle ?> jours</p>
    <p><strong>Prix total :</strong> <?= $_SESSION['prix_total'] ?> DH</p>
  </div>

  <div id="paypal-button-container" style="margin-top: 30px;"></div>
</div>

<?php include 'footer.php'; ?>

<!-- Script PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?= round($_SESSION['prix_total'] / 10, 2) ?>' // Exemple conversion MAD → USD
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            fetch('enregistrer_reservation.php', {
                method: 'POST'
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "confirmation.php";
                } else {
                    alert("Erreur : " + data.error);
                }
            });
        });
    }
}).render('#paypal-button-container');
</script>
