<?php
include '../../controller/signupartcontroller.php';
$error = "";
$signupaart = null;
$signupartcontroller = new signupart();

if (
    isset($_POST["Nom"], $_POST["Prenom"],$_POST["Numero"], $_POST["Email"], $_POST["Mot_de_passe"]) &&
    !empty($_POST["Nom"]) && !empty($_POST["Prenom"])&& !empty($_POST["Numero"])&& !empty($_POST["Email"]) && !empty($_POST["Mot_de_passe"])
) 
{
        $signupart = new signuppart(
            null,
            $_POST['Nom'],
            $_POST['Prenom'],
            $_POST['Numero'],
            $_POST['Email'],
            $_POST['Mot_de_passe']
        );

        
            $signupartcontroller->updatesignupart ($signupart,$_POST['id']);
            echo "Registration successful!";
            header("Location:listesignupart.php");
        
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontoffice/css/cont.css">
    <title>Document</title>
</head>
<body>
    <section>
        <br>
        <div class="box">
            <span class="borderline"></span>
            <?php
            if (isset($_POST['id']))
            {
                $signupart = $signupartcontroller->showsignupart($_POST['id']);?>
                <form action="" method="post" class="signupart-form">
                    <h1 class="h3 mb-0 text-gray-800">Update the login with Id = <?php echo $_POST['id'] ?> </h1>  
                    <div class="inputBox">
                        <input type="hidden" name="id" id="id" value="<?php echo $signupart['id'];?>" required>
                        
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="Nom" id="Nom" value="<?php echo $signupart['Nom'];?>" required>
                        <span>Last Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="Prenom" id="Prenom" value="<?php echo $signupart['Prenom'];?>" required>
                        <span>First Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="date" name="date" id="date" value="<?php echo $signupart['date'];?>" required>
                        <span>First Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="Numero" id="Numero" value="<?php echo $signupart['Numero'];?>" required>
                        <span>First Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="Email" name="Email" id="Email" value="<?php echo $signupart['Email'];?>" required>
                        <span>E-mail</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="Mot_de_passe" id="Mot_de_passe" value="<?php echo $signupart['Mot_de_passe'];?>" required></td>
                        <span>Confirm Password</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="signupart"> 
                    </div>
                </form>
            <?php
            }
            ?> 
        </div>
        <br>       
    </section>
</body>
</html>