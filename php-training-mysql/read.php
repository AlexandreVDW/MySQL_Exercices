<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <?php
      // Remplacez ces informations par les vôtres
      $host = 'localhost';
      $dbname = 'becode';
      $user = 'root';
      $pass = '';

      try {
          // Connexion à la base de données avec PDO
          $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

          // Sélection des randonnées depuis la base de données
          $query = $pdo->query('SELECT * FROM hiking');
          $randonnees = $query->fetchAll(PDO::FETCH_ASSOC);

          // Affichage des randonnées dans un tableau HTML
          if (!empty($randonnees)) {
            echo '<table border="1">
                    <tr>
                        <th>Nom</th>
                        <th>Difficulté</th>
                        <th>Distance</th>
                        <th>Durée</th>
                        <th>Dénivelé</th>
                    </tr>';
  
            foreach ($randonnees as $randonnee) {
                echo '<tr>
                        <td><a href="./update.php?id=' . $randonnee['id'] . '">' . $randonnee['name'] . '</a></td>
                        <td>' . $randonnee['difficulty'] . '</td>
                        <td>' . $randonnee['distance'] . 'km</td>
                        <td>' . $randonnee['duration'] . '</td>
                        <td>' . $randonnee['height_difference'] . 'm</td>
                        <td>' . ($randonnee['available'] ? 'Disponible' : 'Non disponible') . '</td>
                        <td><a href="./delete.php?id=' . $randonnee['id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette randonnée ?\')">Supprimer</a></td>
                      </tr>';
            }
  
            echo '</table>';
          } else {
            echo 'Aucune randonnée trouvée.';
          }
      } catch (PDOException $e) {
          echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
      }
    ?>
  </body>
</html>
