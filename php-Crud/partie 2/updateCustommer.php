<?php
try {
    $host = 'localhost';
    $dbname = 'colyseum';
    $user = 'root';
    $pass = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $name = isset($_POST['lastName']) ? $_POST['lastName'] : '';
        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
        $birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : '';
        $card = isset($_POST['card']) ? $_POST['card'] : 0; // Default value if not defined
        $cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';

        // Update the customer in the database
        $id = $_GET['id'];
        $query = $pdo->prepare('UPDATE clients SET lastName=?, firstName=?, birthDate=?, card=?, cardNumber=? WHERE id=?');
        $query->execute([$name, $firstName, $birthDate, $card, $cardNumber, $id]);

        // Redirect to the list after updating
        header('Location: custommer.php');
        exit();
    } else {
        // Retrieve client data based on the provided ID
        $id = $_GET['id'];
        $query = $pdo->prepare('SELECT * FROM clients WHERE id=?');
        $query->execute([$id]);
        $custommer = $query->fetch(PDO::FETCH_ASSOC);

        // Check if the customer exists
        if (!$custommer) {
            echo 'Client(e) non trouvé(e).';
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
    <title>Modifier un client</title>
</head>
<body>
    <a href="./custommer.php">Liste des clients</a>
    <h1>Modifier</h1>
    <form action="" method="post">
        <!-- Check if $custommer is defined before using it -->
        <?php if (isset($custommer)): ?>
            <div>
                <label for="lastName">Lastname</label>
                <input type="text" name="lastName" value="<?php echo $custommer['lastName'] ?>">
            </div>
            <div>
                <label for="firstName">Firstname</label>
                <input type="text" name="firstName" value="<?php echo $custommer['firstName'] ?>">
            </div>
            <div>
                <label for="birthDate">Date de naissance</label>
                <input type="date" name="birthDate" value="<?php echo $custommer['birthDate'] ?>">
            </div>
            <div>
                <label for="card">Carte de fidélité</label>
                <input type="checkbox" name="card" value="1" <?php echo $custommer['card'] ? 'checked' : '' ?>>
            </div>
            <div>
                <label for="cardNumber">Numéro de carte</label>
                <input type="text" name="cardNumber" value="<?php echo $custommer['cardNumber'] ?>">
            </div>
            <button type="submit" name="button">Modifier</button>
        <?php endif; ?>
    </form>
</body>
</html>
