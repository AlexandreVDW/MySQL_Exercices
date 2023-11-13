<?php
try {
    $host = 'localhost';
    $dbname = 'becode';
    $user = 'root';
    $pass = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = $_POST['name'];
        $difficulty = $_POST['difficulty'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $height_difference = $_POST['height_difference'];

        // Update the hiking trail in the database
        $id = $_GET['id'];
        $query = $pdo->prepare('UPDATE hiking SET name=?, difficulty=?, distance=?, duration=?, height_difference=? WHERE id=?');
        $query->execute([$name, $difficulty, $distance, $duration, $height_difference, $id]);
        
        // Redirect to the list after updating
        header('Location: read.php');
        exit();
    } else {
        // Retrieve hiking trail data based on the provided ID
        $id = $_GET['id'];
        $query = $pdo->prepare('SELECT * FROM hiking WHERE id=?');
        $query->execute([$id]);
        $randonnee = $query->fetch(PDO::FETCH_ASSOC);

        // Check if the hiking trail exists
        if (!$randonnee) {
            echo 'Randonnée non trouvée.';
            exit();
        }
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
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
    <h1>Modifier</h1>
    <form action="" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $randonnee['name'] ?>">
        </div>

        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty">
                <option value="très facile" <?= ($randonnee['difficulty'] == 'très facile') ? 'selected' : '' ?>>Très facile</option>
                <option value="facile" <?= ($randonnee['difficulty'] == 'facile') ? 'selected' : '' ?>>Facile</option>
                <option value="moyen" <?= ($randonnee['difficulty'] == 'moyen') ? 'selected' : '' ?>>Moyen</option>
                <option value="difficile" <?= ($randonnee['difficulty'] == 'difficile') ? 'selected' : '' ?>>Difficile</option>
                <option value="très difficile" <?= ($randonnee['difficulty'] == 'très difficile') ? 'selected' : '' ?>>Très difficile</option>
            </select>
        </div>

        <div>
            <label for="distance">Distance</label>
            <input type="text" name="distance" value="<?= $randonnee['distance'] ?>">
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="duration" name="duration" value="<?= $randonnee['duration'] ?>">
        </div>
        <div>
            <label for="height_difference">Dénivelé</label>
            <input type="text" name="height_difference" value="<?= $randonnee['height_difference'] ?>">
        </div>
		<div>
			<label for="available">Disponibilité</label>
			<select name="available">
				<option value="1" <?= ($randonnee['available'] ? 'selected' : '') ?>>Disponible</option>
				<option value="0" <?= (!$randonnee['available'] ? 'selected' : '') ?>>Non disponible</option>
			</select>
		</div>
        <button type="submit" name="button">Modifier</button>
    </form>
</body>
</html>