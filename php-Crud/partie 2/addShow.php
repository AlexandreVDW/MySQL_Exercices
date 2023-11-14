<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $dbname = 'colyseum';
    $user = 'root';
    $pass = '';

    try {
        // Connexion à la base de données avec PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        // Préparation de la requête d'insertion
        $query = $pdo->prepare('INSERT INTO shows (title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

        // Récupération des données du formulaire
		$title = isset($_POST['title']) ? $_POST['title'] : '';
		$performer = isset($_POST['performer']) ? $_POST['performer'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $showTypesId = isset($_POST['showTypesId']) ? $_POST['showTypesId'] : '';
        $firstGenresId = isset($_POST['firstGenresId']) ? $_POST['firstGenresId'] : '';
        $secondGenreId = isset($_POST['secondGenreId']) ? $_POST['secondGenreId'] : '';
        $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
        $startTime = isset($_POST['startTime']) ? $_POST['startTime'] : '';
        
        // Exécution de la requête avec les valeurs du formulaire
        $query->execute([$title, $performer, $date, $showTypesId, $firstGenresId, $secondGenreId, $duration, $startTime]);

        header('Location: show.php');
		exit();
    } catch (PDOException $e) {
        echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add show</title>
</head>
<body>
	<a href="./show.php">Liste des données</a>
	<h1>Ajouter un spectacle :</h1>
	<form action="" method="post">
		<div>
			<label for="title">title</label>
			<input type="text" name="title" value="">
		</div>
        <div>
            <label for="performer">performer</label>
            <input type="text" name="performer" value="">
        </div>
        <div>
            <label for="date">date</label>
            <input type="date" name="date" value="">
        </div>
        <div>
            <label for="showTypesId">showTypesId</label>
            <input type="text" name="showTypesId" value="">
        </div>
        <div>
            <label for="firstGenresId">firstGenresId</label>
            <input type="text" name="firstGenresId" value="">
        </div>
        <div>
            <label for="secondGenreId">secondGenreId</label>
            <input type="text" name="secondGenreId" value="">
        </div>
        <div>
            <label for="duration">duration</label>
            <input type="time" name="duration" value="">
        </div>
        <div>
            <label for="startTime">startTime</label>
            <input type="time" name="startTime" value="">
        </div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>