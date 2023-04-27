<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("Location:login.php");
    }
    require "database.php"; // Connexion à la base de données

    $check = $db->prepare('SELECT `Pseudo_user`, `Email_user`, `Password_user` FROM user WHERE Pseudo_user = ?');
    $check->execute(array($_SESSION['user']));
    $data = $check->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Blog/images/logo.ico">
    <link rel="stylesheet" href="./style.css">
    <title>Max Making - My Profil</title>
</head>
<body> 
    <div class="profil_main">
        <header>
            <?php include 'navbar.php';?>
        </header>
        <div class="profil_info">
            <form action="update_check.php" method="POST">
                <br>
                <h2>Mon Profil</h2>
                <div>
                    <input id="type_profil" type="text" name="pseudo" placeholder="Pseudo" size="55" value="<?= $data['Pseudo_user'] ?>">
                </div>
                <div>
                    <input id="type_profil" type="email" name="email" placeholder="Email" size="55" value="<?= $data['Email_user'] ?>">
                </div>
                <div>
                    <input id="type_profil" type="password" name="password" size="55" placeholder="Mot de passe">
                </div>
                <div>
                    <input id="type_profil" type="password" name="password_retype" size="55" placeholder="Confirmez le mot de passe">
                </div>
                <br>
                <input id="button_log_reg" type="submit" value="Valider les modifications">
                <br><br>
                <?php
                    if(isset($_GET['update_err']))
                    {
                        $err = htmlspecialchars($_GET['update_err']);
                        switch($err)
                        {
                            case 'pseudo':
                                ?>
                                <div class="err_profil"><strong>Erreur</strong> pseudo déjà utilisé !</div>
                            <?php
                            break;
                            case 'email':
                                ?>
                                <div class="err_profil"><strong>Erreur</strong> email déjà associé à un compte !</div>
                            <?php
                            break;
                            case 'password':
                                ?>
                                <div class="err_profil"><strong>Erreur</strong> les mots de passes sont différents !</div>
                            <?php
                            break;
                            case 'done':
                                ?>
                                <div class="good_profil"><strong>Modifications effectuées !</strong></div>
                            <?php
                            break;
                        }
                    }
                ?>
            </form><br>  
        </div>
    </div>
</body>
</html>