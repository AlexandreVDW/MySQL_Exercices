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
        $query = $pdo->prepare('INSERT INTO clients (lastName, firstName, birthDate, card, cardNumber) VALUES (?, ?, ?, ?, ?)');
		$query2 = $pdo->prepare('INSERT INTO cards (cardNumber, cardTypesId) VALUES (?, ?)');

        // Récupération des données du formulaire
		$name = isset($_POST['lastName']) ? $_POST['lastName'] : '';
		$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
		$birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : '';
		$card = isset($_POST['card']) ? $_POST['card'] : 0; // Valeur par défaut si non définie
		$cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
		$cardTypesId = isset($_POST['cardTypesId']) ? $_POST['cardTypesId'] : '';
        
        // Exécution de la requête avec les valeurs du formulaire
        $query->execute([$name, $firstName, $birthDate, $card, $cardNumber]);
		$query2->execute([$cardNumber, $cardTypesId]);

        header('Location: Custommer.php');
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
	<title>Add custommer</title>
</head>
<body>
	<a href="./custommer.php">Liste des données</a>
	<h1>Ajouter un client/une cliente :</h1>
	<form action="" method="post">
		<div>
			<label for="lastName">Lastname</label>
			<input type="text" name="lastName" value="">
		</div>
		<div>
			<label for="firstName">Firstname</label>
			<input type="text" name="firstName" value="">
		</div>
		<div>
			<label for="birthDate">Date de naissance</label>
			<input type="date" name="birthDate" value="">
		</div>
		<div>
			<label for="card">Carte de fidélité</label>
			<input type="checkbox" name="card" value="1">
		</div>
		<div>
			<label for="cardNumber">Numéro de carte</label>
			<input type="text" name="cardNumber" value="">
		</div>
		<div>
			<label for="cardTypesId">Type de carte</label>
			<select name="cardTypesId">
				<option value="1">Fidélité</option>
				<option value="2">Famille nombreuse</option>
				<option value="3">Etudiant</option>
				<option value="4">Employé</option>
			</select>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>