<?php
// delete.php

try {
    $host = 'localhost';
    $dbname = 'becode';
    $user = 'root';
    $pass = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Vérifie si l'id de la randonnée à supprimer est présent dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Supprime la randonnée de la base de données
        $query = $pdo->prepare('DELETE FROM hiking WHERE id = ?');
        $query->execute([$id]);

        // Redirige automatiquement vers read.php après la suppression
        header('Location: read.php');
        exit();
    } else {
        echo 'ID de randonnée non spécifié.';
        exit();
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>