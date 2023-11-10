<?php
require "database.php";

$bdd = connectDB();
 var_dump($_POST);
$sql = "DELETE FROM météo WHERE ville = :ville";
$statement = $bdd->prepare($sql);
$statement->bindParam(':ville', $_POST["ville"], PDO::PARAM_STR);
$statement->execute();
header('Location: index.php');
exit;
?>