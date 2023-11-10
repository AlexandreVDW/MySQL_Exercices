-- Affiche toutes les données.
SELECT * FROM becode;

-- Affiche uniquement les prénoms.
SELECT prenom FROM students;

-- Affiche les prénoms, les dates de naissance et l’école de chacun.
SELECT prenom, datenaissance, school FROM students;

-- Affiche uniquement les élèves qui sont de sexe féminin.
SELECT * FROM students WHERE genre = "F";

-- Affiche uniquement les élèves qui font partie de l’école d'Addy.
SELECT * FROM students where school=1;

-- Affiche uniquement les prénoms des étudiants, par ordre inverse à l’alphabet (DESC). 
SELECT prenom FROM students ORDER BY prenom DESC;

-- Ensuite, la même chose mais en limitant les résultats à 2.
SELECT prenom FROM students ORDER BY prenom DESC LIMIT 2;

-- Ajoute Ginette Dalor, née le 01/01/1930 et affecte-la à Bruxelles, toujours en SQL.
INSERT INTO students (prenom, nom, datenaissance, genre, school) VALUES ("Ginette", "Dalor", "1930-01-01", "F", 2);

-- Modifie Ginette (toujours en SQL) et change son sexe et son prénom en “Omer”.
UPDATE students SET prenom="Omer", genre="M" WHERE prenom="Ginette";

-- Supprimer la personne dont l’ID est 3.
DELETE FROM students WHERE idStudent=3;

-- Modifier le contenu de la colonne School de sorte que "1" soit remplacé par "Liege" et "2" soit remplacé par "Gent". (attention au type de la colonne !)
UPDATE school SET school = "Liège" WHERE idschool=1;
UPDATE school SET school = "Gent" WHERE idschool=2;