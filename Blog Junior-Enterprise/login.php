<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Blog/images/logo.ico">
    <link rel="stylesheet" href="style.css">
    <title>Max Making Blog - Login</title>
</head>
<body>
    <div class="login">
        <div class="login_gauche">
            <form class="form" action="login_check.php" method="POST">
                <h2>Connexion</h2>
                <div>
                    <input id="type" type="email" name="email" placeholder="Email" size="60" required>
                </div>
                <div>
                    <input id="type" type="password" name="password" placeholder="Mot de passe" size="60" required>
                </div>
                <br><br>
                <div>
                    <input id="button_log_reg" type="submit" name ="submit" value="Connexion">
                </div>
                <br><br><br>
                <?php
                    if(isset($_GET['login_err']))
                    {
                        $err = htmlspecialchars($_GET['login_err']);
                        switch($err)
                        {
                            case 'password':
                                ?>
                                <div class="err"><strong>Erreur</strong> mot de passe incorrect !</div>
                            <?php
                            break;
                            case 'email':
                                ?>
                                <div class="err"><strong>Erreur</strong> email incorrect !</div>
                            <?php
                            break;
                            case 'already':
                                ?>
                                <div class="err"><strong>Erreur</strong> compte non existant !</div>
                            <?php
                            break;
                            case 'account':
                                ?>
                                <div class="good"><strong>Compte crée !</strong></div>
                            <?php
                            break;
                        }
                    }
                ?>
            </form>
        </div>
        <div class="login_droit">
            <p><strong>Salut !</strong></p><br><br>
            <p><i>Crée ton compte et viens rejoindre l'aventure !</i></p><br><br>
            <a href="register.php"><button>Inscription</button></a>
        </div>
    </div>
</body>
</html>