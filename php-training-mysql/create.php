<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Remplacez ces informations par les vôtres
    $host = 'localhost';
    $dbname = 'becode';
    $user = 'root';
    $pass = '';

    try {
        // Connexion à la base de données avec PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        // Préparation de la requête d'insertion
        $query = $pdo->prepare('INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (?, ?, ?, ?, ?)');

        // Récupération des données du formulaire
        $name = $_POST['name'];
        $difficulty = $_POST['difficulty'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $height_difference = $_POST['height_difference'];

        // Exécution de la requête avec les valeurs du formulaire
        $query->execute([$name, $difficulty, $distance, $duration, $height_difference]);

        echo 'Randonnée ajoutée avec succès!';
    } catch (PDOException $e) {
        echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="./read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<div>
			<label for="available">Disponibilité</label>
			<select name="available">
				<option value="1">Disponible</option>
				<option value="0">Non disponible</option>
			</select>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
