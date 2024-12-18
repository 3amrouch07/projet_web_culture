<?php
    include '../../controller/signupcontroller.php';
    $signupcontroller = new signup();
    $searchTerm = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $searchTerm = trim($_POST['search']);
        $signups = $signupcontroller->searchInscrit($searchTerm);
    } else {
        $signups = $signupcontroller->listesignup();
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontoffice/css/signup.css">
    <title>Liste des Inscrits</title>
</head>
<body>
    <h1>Liste des Inscrits</h1>
    <form action="" method="POST" class="search-form">
        <input type="text" name="search" placeholder="Rechercher par nom, prénom ou email" value="<?= htmlspecialchars($searchTerm); ?>">
        <button type="submit">Rechercher</button>
    </form>

    <table border="2">
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Rôle</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>

        <?php foreach ($signups as $signup) { 
            // Crypter le nom si le nom est "pata"
            $nomCrypte = strtolower($signup['Nom']) === 'pata' ? '****' : htmlspecialchars($signup['Nom']);
        ?>
        <tr>
            <td><?= htmlspecialchars($signup['id']); ?></td>
            <td><?= $nomCrypte; ?></td>
            <td><?= htmlspecialchars($signup['Prenom']); ?></td>
            <td><?= htmlspecialchars($signup['date']); ?></td>
            <td><?= htmlspecialchars($signup['Email']); ?></td>
            <td><?= htmlspecialchars($signup['Mot_de_passe']); ?></td>
            <td><?= htmlspecialchars($signup['role']); ?></td>
            <td>
                <form action="updatesignup.php" method="POST">
                    <input type="submit" name="update" value="Modifier">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($signup['id']); ?>">
                </form>
            </td>
            <td>
                <a href="deletesignup.php?id=<?= $signup['id']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <a href="export_pdf.php" class="btn">Télécharger la liste en PDF</a>
    <a href="statistic.php">Voir les statistiques</a>
</body>
</html>
