<?php
// Vos informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "becode";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Vérification si les variables du formulaire sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) {
    
    // Prévention des injections SQL en utilisant des déclarations préparées
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE username = ? AND password = SHA1(?)");
    $requete->bind_param("ss", $_POST['login'], $_POST['pwd']);
    $requete->execute();
    $resultat = $requete->get_result();

    // Vérification du résultat de la requête
    if ($resultat->num_rows > 0) {
        // Utilisateur trouvé, démarrer la session
        session_start();
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['pwd'] = $_POST['pwd'];
        
        // Redirection vers la page des membres
        header('location: read.php');
    } else {
        // Utilisateur non trouvé
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }

    // Fermer la requête
    $requete->close();

} else {
    echo 'Les variables du formulaire ne sont pas déclarées.';
}

// Fermer la connexion à la base de données
$connexion->close();
?>
