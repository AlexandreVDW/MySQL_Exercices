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

          // Sélection des clients depuis la base de données
          $query1 = $pdo->query('SELECT * FROM clients');
          $custommers = $query1->fetchAll(PDO::FETCH_ASSOC);
          $query2 = $pdo->query('SELECT * FROM 	showtypes');
          $showTypes = $query2->fetchAll(PDO::FETCH_ASSOC);
          $query3 = $pdo->query('SELECT * FROM 	clients LIMIT 20;');
          $custommers20 = $query3->fetchAll(PDO::FETCH_ASSOC);
          $query4 = $pdo->query('SELECT * FROM 	clients WHERE card = 1;');
          $custommersCard = $query4->fetchAll(PDO::FETCH_ASSOC);
          $query5 = $pdo->query('SELECT * FROM 	clients WHERE lastName LIKE "M%" ORDER BY lastName ASC;');
          $custommersM = $query5->fetchAll(PDO::FETCH_ASSOC);
          $query6 = $pdo->query('SELECT * FROM 	shows ORDER BY title ASC;');
          $shows = $query6->fetchAll(PDO::FETCH_ASSOC);

          // Affichage des clients dans un tableau HTML
          if (!empty($custommers) && !empty($showTypes) && !empty($custommers20) && !empty($custommersCard) && !empty($custommersM) && !empty($shows)) {
            echo '<h2>Exercices 1:</h2>';
            echo '<table border="1">
                    <tr>
                        <th>LastName</th>
                        <th>FirstName</th>
                        <th>Birth Date</th>
                        <th>Card</th>
                        <th>Card Number</th>
                    </tr>';

            foreach ($custommers as $custommer) {
                echo '<tr>
                        <td>' . $custommer['lastName'] . '</td>
                        <td>' . $custommer['firstName'] . '</td>
                        <td>' . $custommer['birthDate'] . '</td>
                        <td>' . $custommer['card'] . '</td>
                        <td>' . $custommer['cardNumber'] . '</td>
                      </tr>';
            }
  
            echo '</table>';

            echo '<h2>Exercices 2:</h2>';
            echo '<table border="1">
                    <tr>
                        <th>Show Type</th>
                    </tr>';

            foreach ($showTypes as $showType) {
                echo '<tr>
                        <td>' . $showType['type'] . '</td>
                      </tr>';
            }

            echo '</table>';

            echo '<h2>Exercices 3:</h2>';
            echo '<table border="1">
                    <tr>
                        <th>LastName</th>
                        <th>FirstName</th>
                        <th>Birth Date</th>
                        <th>Card</th>
                        <th>Card Number</th>
                    </tr>';
  
            foreach ($custommers20 as $custommer20) {
                echo '<tr>
                        <td>' . $custommer20['lastName'] . '</td>
                        <td>' . $custommer20['firstName'] . '</td>
                        <td>' . $custommer20['birthDate'] . '</td>
                        <td>' . $custommer20['card'] . '</td>
                        <td>' . $custommer20['cardNumber'] . '</td>
                      </tr>';
            }
  
            echo '</table>';

            echo '<h2>Exercices 4:</h2>';
            echo '<table border="1">
                    <tr>
                        <th>LastName</th>
                        <th>FirstName</th>
                        <th>Birth Date</th>
                        <th>Card</th>
                        <th>Card Number</th>
                    </tr>';
  
            foreach ($custommersCard as $custommercard) {
                echo '<tr>
                        <td>' . $custommercard['lastName'] . '</td>
                        <td>' . $custommercard['firstName'] . '</td>
                        <td>' . $custommercard['birthDate'] . '</td>
                        <td>' . $custommercard['card'] . '</td>
                        <td>' . $custommercard['cardNumber'] . '</td>
                      </tr>';
            }
  
            echo '</table>';

            echo '<h2>Exercices 5:</h2>';
            foreach ($custommersM as $custommerM) {
                echo '<p> Nom: ' . $custommerM['lastName'] . '</p>';
                echo '<p> Prénom: ' . $custommerM['firstName'] . '</p>';
            }

            echo '<h2>Exercices 6:</h2>';
            foreach ($shows as $show) {
                echo '<p>' . $show['title'] . ' par ' . $show['performer'] . ', le ' . $show['date'] . ' à ' . $show['startTime'] . '</p>';
            }

            echo '<h2>Exercices 7:</h2>';
            foreach ($custommers as $custommer) {
                echo "Nom : " . $custommer['lastName'] . "<br>";
                echo "Prénom : " . $custommer['firstName'] . "<br>";
                echo "Date de naissance : " . $custommer['birthDate'] . "<br>";

                // Vérifier si le client a une carte de fidélité
                echo "Carte de fidélité : " . ($custommer['card'] ? 'Oui' : 'Non') . "<br>";

                // Afficher le numéro de la carte de fidélité s'il en possède une
                if ($custommer['card']) {
                    echo "Numéro de carte : " . $custommer['cardNumber'] . "<br>";
                }

                echo "<br>";
            }
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