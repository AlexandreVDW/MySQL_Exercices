<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Php Crud</title>
  </head>
  <body>
    <?php
      // Remplacez ces informations par les vôtres
      $host = 'localhost';
      $dbname = 'colyseum';
      $user = 'root';
      $pass = '';

      try {
          // Connexion à la base de données avec PDO
          $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

          // Sélection des spectale depuis la base de données
          $query1 = $pdo->query('SELECT * FROM shows');
          $shows = $query1->fetchAll(PDO::FETCH_ASSOC);

          // Affichage des spectacle dans un tableau HTML
          if (!empty($shows)) {
            echo '<h2>Spectacle:</h2>';
            echo '<table border="1">
                    <tr>
                        <th>Title</th>
                        <th>Performer</th>
                        <th>Date</th>
                        <th>Show Type Id</th>
                        <th>First Genre Id</th>
                        <th>Second Genre Id</th>
                        <th>Duration</th>
                        <th>Start Time</th>
                    </tr>';

            foreach ($shows as $show) {
                echo '<tr>
                        <td><a href="./updateShow.php?id=' . $show['id'] . '">' . $show['title'] . '</a></td>
                        <td>' . $show['performer'] . '</td>
                        <td>' . $show['date'] . '</td>
                        <td>' . $show['showTypesId'] . '</td>
                        <td>' . $show['firstGenresId'] . '</td>
                        <td>' . $show['secondGenreId'] . '</td>
                        <td>' . $show['duration'] . '</td>
                        <td>' . $show['startTime'] . '</td>
                      </tr>';
            }
  
            echo '</table>';
        } 
        else {
        echo 'Aucunes données trouvées.';
      }
  } catch (PDOException $e) {
      echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
  }
?>
</body>
</html>