<?php
    session_start();
    require "database.php"; // Connexion à la base de données

    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $check = $db->prepare('SELECT `Pseudo_user`, `Email_user`, `Password_user`,`Admin_user` FROM user WHERE Email_user = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if ($row == 1) 
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $password = hash("sha256", $password);
                if($data['Password_user'] === $password)
                {
                    $_SESSION['user'] = $data['Pseudo_user'];
                    $_SESSION['admin'] = $data['Admin_user'];
                    header('Location:website.php');
                }else header('Location:login.php?login_err=password');
            }else header('Location:login.php?login_err=email');
        }else header('Location:login.php?login_err=already');
    }else header('Location:login.php');
?>