<?php
include '../../controller/signupcontroller.php';
$error = "";
$signup = null;
$signupcontroller = new signup();

if (
    isset($_POST["Nom"], $_POST["Prenom"], $_POST["date"],$_POST["Email"], $_POST["Mot_de_passe"], $_POST["role"]) &&
    !empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["date"])&& !empty($_POST["Email"]) && !empty( $_POST["Mot_de_passe"])&& !empty( $_POST["role"]))
{
        $signup = new signupp(
            null,
            $_POST['Nom'],
            $_POST['Prenom'],
            $_POST['date'],
            $_POST['Email'],
            $_POST['Mot_de_passe'],
            $_POST['role']
            

        );

        
            $signupcontroller->updatesignup ($signup,$_POST['id']);
            echo "Registration successful!";
            header("Location:listesignup.php");
        
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
                $signup = $signupcontroller->showsignup($_POST['id']);?>
                <form action="" method="post" class="signup-form">
                    <h1 class="h3 mb-0 text-gray-800">Update the login with Id = <?php echo $_POST['id'] ?> </h1>  
                    <div class="inputBox">
                        <input type="hidden" name="id" id="id" value="<?php echo $signup['id'];?>" required>
                        
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="Nom" id="Nom" value="<?php echo $signup['Nom'];?>" required>
                        <span>Last Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="Prenom" id="Prenom" value="<?php echo $signup['Prenom'];?>" required>
                        <span>First Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="date" name="date" id="date" value="<?php echo $signup['date'];?>" required>
                        <span>First Name</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="Email" name="Email" id="Email" value="<?php echo $signup['Email'];?>" required>
                        <span>E-mail</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="Mot_de_passe" id="Mot_de_passe" value="<?php echo $signup['Mot_de_passe'];?>" required></td>
                        <span>Confirm Password</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="role" id="role" value="<?php echo $signup['role'];?>" required></td>
                        <span>Confirm Password</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="signup"> 
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