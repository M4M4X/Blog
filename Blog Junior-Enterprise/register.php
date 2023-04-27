<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Blog/images/logo.ico">
    <link rel="stylesheet" href="style.css">
    <title>Max Making Blog - Register</title>
</head>
<body>
    <div class="register">
        <a href="login.php"></a>
        <div class="register_droit">
            <form class="register_check" action="register_check.php" method="POST">
                <h2>Inscription</h2>
                <div>
                    <input id="type" type="text" name="pseudo" placeholder="Pseudo" size="60" required>
                </div>
                <div>
                    <input id="type" type="email" name="email" placeholder="Email" size="60" required>
                </div>
                <div>
                    <input id="type" type="password" name="password" placeholder="Mot de passe" size="60" required>
                </div>
                <div>
                    <input id="type" type="password" name="password_retype" placeholder="Re-tapez le mot de passe" size="60" required>
                </div>
                <br><br>
                <input id="button_log_reg" type="submit" name ="submit" value="Inscription">
                <br><br><br>
                <?php
                    if(isset($_GET['reg_err']))
                    {
                        $err = htmlspecialchars($_GET['reg_err']);
                        switch($err)
                        {
                            case 'password':
                                ?>
                                <div class="err"><strong>Erreur</strong> mots de passe différents !</div>
                            <?php
                            break;
                            case 'email':
                                ?>
                                <div class="err"><strong>Erreur</strong> email non valide !</div>
                            <?php
                            break;
                            case 'email_length':
                                ?>
                                <div class="err"><strong>Erreur</strong> email trop long !</div>
                            <?php
                            break;
                            case 'pseudo_length':
                                ?>
                                <div class="err"><strong>Erreur</strong> pseudo trop long !</div>
                            <?php
                            break;
                            case 'already':
                                ?>
                                <div class="err"><strong>Erreur</strong> compte déjà existant !</div>
                            <?php
                            break;
                        }
                    }
                ?>
            </form>
        </div>
    </div>
    
</body>
</html>