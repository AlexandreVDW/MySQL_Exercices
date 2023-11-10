<?php
require "database.php";

function sanitize($data){
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    $data = trim($data);
    return $data;
}
 
if(( !isset($_POST['ville']) OR $_POST['ville']=='')OR  
    (!isset($_POST['haut']) OR $_POST['haut']=='') OR 
    (!isset($_POST['bas']) OR $_POST['bas']==''))
{
    header('Location: index.php');
    exit;
}

$ville = sanitize($_POST['ville']);
$haut = sanitize($_POST['haut']);
$bas = sanitize($_POST['bas']);

$bdd = connectDB();

$SQL = $bdd->prepare("INSERT INTO météo (ville, haut, bas) VALUES (:ville, :haut, :bas)");

$SQL->execute([
    'ville' => $ville,
    'haut' => $haut,
    'bas' => $bas
]);

header('Location: index.php');
?>