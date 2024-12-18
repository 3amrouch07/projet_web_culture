<?php
include '../../controller/signupcontroller.php';
$error = "";
$signup = null;
$signupcontroller = new signup();

$pdo = Config::getConnection(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $secretKey = '6LcO25YqAAAAAKzakuS2L-pdiHrKsnXeQnocG_Sz'; // Replace with your actual secret key

    // Verify the reCAPTCHA response
    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $response = file_get_contents($verifyUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
    $responseData = json_decode($response);

    if (!$responseData->success) {
        $error = "reCAPTCHA verification failed. Please try again.";
    } else {
        $Email = $_POST['Email'];
        $queryCheckEmail = $pdo->prepare("SELECT * FROM signup WHERE Email = ?");
        $queryCheckEmail->execute([$Email]);
        $resultCheckEmail = $queryCheckEmail->rowCount();

        if ($resultCheckEmail > 0) {
            $error = "<span class='text-danger'>L'adresse e-mail existe déjà. Veuillez choisir une autre.</span>";
        } else {
            if (
                isset($_POST["Nom"], $_POST["Prenom"], $_POST["date"], $_POST["Email"], $_POST["Mot_de_passe"], $_POST["role"]) &&
                !empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["date"]) && !empty($_POST["Email"]) && !empty($_POST["Mot_de_passe"]) && !empty($_POST["role"])
            ) {
                try {
                    $date = new DateTime($_POST["date"]); // Convert string to DateTime object
                    $signup = new signupp(
                        null,
                        $_POST['Nom'],
                        $_POST['Prenom'],
                        $date, 
                        $_POST["Email"],
                        $_POST["Mot_de_passe"],
                        $_POST["role"]
                    );
                    $signupcontroller->addsignup($signup);
                } catch (Exception $e) {
                    $error = "Error during registration: " . $e->getMessage();
                }
            } else {
                $error = "Missing information.";
            }
        }
    }
}

if (!empty($error)) {
    echo "<div class='error'>$error</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontoffice/css/add.css">
    <title>S'inscrire</title>

    <!-- Add reCAPTCHA API script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <nav>
        <center>
            <a href="acceuil.html">Acceuil</a>
            <a href="prduit.htm">Produit</a>
            <a href="evenement.html">Evenement</a>
            <a href="reclamation.html">Reclamation</a>
            <a href="cour.html">Cour</a> 
        </center>
    </nav>
    
    <section>
       <form class="addsignup-form" action="" method="post">
            <center><h1>S'inscrire</h1></center>
            <div>
                <center><input type="text"  name="Nom" placeholder="Nom" required></center>
                <center><input type="text" name="Prenom" placeholder="Prénom" required></center>
                <center><input type="date" name="date" id="date" class="date" required></center>
                <center><input type="email"  name="Email" placeholder="Email" required></center>
                <center><input type="password" name="Mot_de_passe" placeholder="Mot de passe" required></center>
                <center><select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="client">Client</option>
                </select></center>

                <!-- Google reCAPTCHA widget -->
                <center>
                    <div class="g-recaptcha" data-sitekey="6LcO25YqAAAAAOqwDdZlsHqDnNTLv_LVfZcluIeT"></div>
                </center>

                <a href="signin.php">Se connecter</a>
                <center><button type="submit">S'inscrire</button></center>
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
