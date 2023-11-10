# Exercice PHP / MySQL

## Objectif
Exercice pratique visant la maîtrise de la librairie php "PDO" pour manipuler des bases de données via PHP.

## Pré-requis
- LAMP installé et fonctionnel
- phpmyadmin installé et fonctionnel

## Préparation
On va créer une petite application "weather-app" (oui, encore, désolé...) cette appli doit simplement afficher les températures du jour (minima et maxima) pour des villes belges.

Dans phpmyadmin (probablement ici: http://localhost/phpmyadmin), crée une base de données :
```
CREATE DATABASE weatherapp;`
```
Créer une table "Météo" :
```
CREATE TABLE Météo
    (`ville` varchar(255), `haut` int, `bas` int);
```
Injectes-y quelques données :
```
INSERT INTO Météo
    (`ville`, `haut`, `bas`)
VALUES
    ('Bruxelles', 27, 13),
    ('Liège', 25, 15),
    ('Namur', 26, 15),
    ('Charleroi', 25, 12),
    ('Bruges', 28, 16)
;
```

## Exercice
- Crée un dossier dans lequel héberger cet exercice, par exemple: "php-pdo" quelque part dans le dossier servi par localhost. (sans doute /var/www/html
- À l'intérieur, crée un fichier index.php
    - Modifie ce fichier php et crée un script qui:
    - se connecte à la base de données weatherapp
    - lit le contenu de la table Météo
- affiche un tableau html avec une rangée par rangée du tableau retourné
- Ajoute un formulaire avec 3 champs (ville, haut, bas) permettant d'ajouter d'autres villes
- Fais en sorte que lorsque le formulaire est envoyé, son contenu soit ajouté à la table "Météo".
- Fait ? Ajoute à présent le code html nécessaire pour ajouter une checkbox à chaque ville, et fais en sorte, en php, que lorsqu'on clique dessus, cela efface la ville en question de la table "Météo".
- Concentre toi sur la logique et moins sur le design (sauf si t'as du temps)