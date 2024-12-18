<?php
    include '../../controller/signupcontroller.php';
    session_start() ;
    
    $signup = new signup();
    if ($_SERVER['REQUEST_METHOD']==='POST')
    {

        $Email=$_POST['Email'];
        $role = $signup->connecter($Email);
        if ($role) {
            if ($role === 'admin') {
                header('Location: ../backoffice/listesignup.php');
                exit();
            } elseif ($role === 'client') {
                header('Location: acceuil.html');
                exit();
            }else {
                echo "Role invalide.";
            }
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontoffice/css/add.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <center>
            <a href="acceuil.html">Acceuil</a>
            <a href="prduit.htm">Produit</a>
            <a href="evenement.html">Evenement</a>
            <a href="reclamation.html">Reclamation</a>
            <a href="cours.html">Cours</a> 
        </center>
    </nav>
    
    <section>
       <form action="" method="post">
        <center><h1>Se connecter</h1></center>
        <div>
            <center><input type="text" name="Email" placeholder="Email"></center>
            <center><input type="password" placeholder="Mot_de_passe"></center>
            <center><a href="../../controller/sendmail.php">Forgot Password?</a></center>
            <center><button>Se connecter</button></center>
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