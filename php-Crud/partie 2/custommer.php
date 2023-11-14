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

          // Affichage des clients dans un tableau HTML
          if (!empty($custommers)) {
            echo '<h2>Clients:</h2>';
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
                        <td><a href="./updateCustommer.php?id=' . $custommer['id'] . '">' . $custommer['lastName'] . '</a></td>
                        <td>' . $custommer['firstName'] . '</td>
                        <td>' . $custommer['birthDate'] . '</td>
                        <td>' . $custommer['card'] . '</td>
                        <td>' . $custommer['cardNumber'] . '</td>
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