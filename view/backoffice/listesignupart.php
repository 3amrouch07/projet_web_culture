<?php
    include '../../controller/signupartcontroller.php';
    $signupartcontroller = new signupart();
    $signupsart = $signupartcontroller->listesignupart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="2">
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>date</th>
            <th>Numero</th>
            <th>Email</th>
            <th>Mot_de_passe</th>
        </tr>
        <?php
            foreach($signupsart as $signupart){
        ?>
        <tr>
            <td><?= htmlspecialchars ($signupart['id']); ?></td>
            <td><?= htmlspecialchars ($signupart['Nom']); ?></td>
            <td><?= htmlspecialchars ($signupart['Prenom']); ?></td>
            <td><?= htmlspecialchars ($signupart['date']); ?></td>
            <td><?= htmlspecialchars ($signupart['Numero']); ?></td>
            <td><?= htmlspecialchars ($signupart['Email']); ?></td>
            <td><?= htmlspecialchars ($signupart['Mot_de_passe']); ?></td>
            <td>
                <form action="updatessignupart.php" method="POST">
                    <input type="submit" name="update" value="Update">
                    <input type="hiden" name="id" value="<?=htmlspecialchars($signupart['id']);?>">
                </form>
            </td>
            <td>
                <a href="deletessignupart.php?id=<?php echo $signupart['id'];?>">Delete</a>
            </td>
        </tr>
        <?php }?>
    </table>
</body>
</html>