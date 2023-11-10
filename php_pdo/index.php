<?php
require "database.php";

$bdd = connectDB();

$SQL = $bdd->query("SELECT * FROM météo");

$data = $SQL->fetchAll();

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Ville</th>
                <th>Haut</th>
                <th>Bas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?= $row['ville'] ?></td>
                    <td><?= $row['haut'] ?></td>
                    <td><?= $row['bas'] ?></td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="ville" value="<?= $row['ville'] ?>">
                            <input type="checkbox" name="delete" onchange="this.form.submit()">
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <form action="add.php" method="post">
        <input type="text" name="ville" placeholder="Ville" required>
        <input type="text" name="haut" placeholder="Haut" required>
        <input type="text" name="bas" placeholder="Bas" required>
        <input type="submit" value="Add">
    </form>
</body>
</html>
