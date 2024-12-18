<?php
include '../../controller/signupartcontroller.php';
$error = "";
$signupart = null;
$signupartcontroller = new signupart();

$pdo = Config::getConnection(); 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Email = $_POST['Email'];
    $queryCheckEmail = $pdo->prepare("SELECT * FROM signup WHERE Email = ?");
    $queryCheckEmail->execute([$Email]);
    $resultCheckEmail = $queryCheckEmail->rowCount();
    if ($resultCheckEmail > 0) 
    {
        $prob = "<span class='text-danger'>L'adresse e-mail existe déjà. Veuillez choisir une autre.</span>";
    }
    else
    {
if (
    isset($_POST["Nom"], $_POST["Prenom"], $_POST["date"], $_POST["Numero"], $_POST["Email"], $_POST["Mot_de_passe"]) &&
    !empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["date"]) && !empty($_POST["Numero"]) && !empty($_POST["Email"]) && !empty($_POST["Mot_de_passe"])
) {
    try {
        $date = new DateTime($_POST["date"]); // Convert string to DateTime object
    
        $signupart = new signuppart(
            null,                      // ID (nullable)
            $_POST['Nom'],             // Nom
            $_POST['Prenom'],          // Prenom
            $date,                     // Date (DateTime object)
            $_POST['Numero'],          // Numero (string)
            $_POST['Email'],           // Email
            $_POST['Mot_de_passe']     // Mot de passe
        );
    
        $signupartcontroller->addsignupart($signupart);
        header("Location: signart.php");
    } catch (Exception $e) {
        $error = "Error during registration: " . $e->getMessage();
    }
    
} else {
    $error = "Missing information.";
}


if (!empty($error)) {
    echo "<div class='error'>$error</div>";
}
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontoffice/css/adds.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <center>
            <a href="acceuil.html">Acceuil</a>
            <a href="prduit.htm">Produit</a>
            <a href="evenement.html">Evenement</a>
            <a href="reclamation.html">Reclamation</a>
            <a href="cours.html">Cour</a> 
        </center>
    </nav>
    
    <section>
        <form action="" method="post">
        <center><h1>S'inscrire</h1></center>
        <div>
            <center><input type="text" name="Nom" placeholder="Nom"></center>
            <center><input type="text" name="Prenom" placeholder="Prénom"></center>
            <center><input type="date" name="date" id="date" class="date"></center>
            <center><input type="text" name="Numero" placeholder="Numero"></center>
            <center><input type="text" name="Email" placeholder="Email"></center>
            <center><input type="password" name="Mot_de_passe" placeholder="Mot_de_passe"></center>
            <a href="signart.php">Se connecter</a>
            <br>
            <center><button>S'inscrire</button></center>
        </div>
       </form>  
    </section>
    
    <footer>
        <center>
            <h2>Qui sommes-nous?</h2>
            <p>CRAFTOPIA est une plateforme dédiée à la promotion de l'artisanat tunisien. Nous connectons les artisans locaux avec des passionnés de culture et de traditions, permettant à chacun de découvrir et d'acheter des produits uniques et faits à la main. 
            Soutenez l'artisanat durable et contribuez au développement de l'économie locale.</p>
            <p>&copy; 2024 CRAFTOPIA. Tous droits réservés.</p>
        </center>
    </footer>
</body>
</html>