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
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $performer = isset($_POST['performer']) ? $_POST['performer'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $showTypesId = isset($_POST['showTypesId']) ? $_POST['showTypesId'] : '';
        $firstGenresId = isset($_POST['firstGenresId']) ? $_POST['firstGenresId'] : '';
        $secondGenreId = isset($_POST['secondGenreId']) ? $_POST['secondGenreId'] : '';
        $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
        $startTime = isset($_POST['startTime']) ? $_POST['startTime'] : '';

        // Update the customer in the database
        $id = $_GET['id'];
        $query = $pdo->prepare('UPDATE shows SET title=?, performer=?, date=?, showTypesId=?, firstGenresId=?, duration=?, startTime=? WHERE id=?');
        $query->execute([$title, $performer, $date, $showTypesId, $firstGenresId, $duration, $startTime, $id]);

        // Redirect to the list after updating
        header('Location: show.php');
        exit();
    } else {
        // Retrieve show data based on the provided ID
        $id = $_GET['id'];
        $query = $pdo->prepare('SELECT * FROM shows WHERE id=?');
        $query->execute([$id]);
        $show = $query->fetch(PDO::FETCH_ASSOC);

        // Check if the customer exists
        if (!$show) {
            echo 'show non trouvé.';
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
    <title>Modifier un show</title>
</head>
<body>
    <a href="./show.php">Liste des clients</a>
    <h1>Modifier</h1>
    <form action="" method="post">
        <!-- Check if $show is defined before using it -->
        <?php if (isset($show)): ?>
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo $show['title'] ?>">
            </div>
            <div>
                <label for="performer">Performer</label>
                <input type="text" name="performer" value="<?php echo $show['performer'] ?>">
            </div>
            <div>
                <label for="date">Date</label>
                <input type="date" name="date" value="<?php echo $show['date'] ?>">
            </div>
            <div>
                <label for="showTypesId">Show Type Id</label>
                <input type="text" name="showTypesId" value="<?php echo $show['showTypesId'] ?>">
            </div>
            <div>
                <label for="firstGenresId">First Genre Id</label>
                <input type="text" name="firstGenresId" value="<?php echo $show['firstGenresId'] ?>">
            </div>
            <div>
                <label for="secondGenreId">Second Genre Id</label>
                <input type="text" name="secondGenreId" value="<?php echo $show['secondGenreId'] ?>">
            </div>
            <div>
                <label for="duration">Duration</label>
                <input type="time" name="duration" value="<?php echo $show['duration'] ?>">
            </div>
            <div>
                <label for="startTime">Start Time</label>
                <input type="time" name="startTime" value="<?php echo $show['startTime'] ?>">
            </div>
            <button>Modifier</button>
        <?php endif; ?>
    </form>
</body>
</html>
