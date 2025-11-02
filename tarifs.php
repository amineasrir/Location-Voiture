<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Tarifs de location</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="tarifs-section">
  <h2>Nos tarifs</h2>

  <div class="tarifs-table">
    <table>
      <thead>
        <tr>
          <th>Catégorie</th>
          <th>Modèle Exemple</th>
          <th>Prix / jour</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Économique</td>
          <td>Peugeot 208, Renault Clio</td>
          <td>35€</td>
        </tr>
        <tr>
          <td>Compacte</td>
          <td>Volkswagen Golf, Ford Focus</td>
          <td>45€</td>
        </tr>
        <tr>
          <td>Berline</td>
          <td>BMW Série 3, Audi A4</td>
          <td>65€</td>
        </tr>
        <tr>
          <td>SUV</td>
          <td>Hyundai Tucson, Dacia Duster</td>
          <td>70€</td>
        </tr>
        <tr>
          <td>Utilitaire</td>
          <td>Renault Kangoo, Citroën Berlingo</td>
          <td>60€</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="services-plus">
    <h3>Services supplémentaires</h3>
    <ul>
      <li>Assurance complète : +10€/jour</li>
      <li>GPS : +5€/jour</li>
      <li>Siège bébé : +3€/jour</li>
      <li>Conducteur additionnel : +7€/jour</li>
    </ul>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
