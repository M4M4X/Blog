<?php
    require 'database.php';

    if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        $check = $db->prepare('SELECT `Pseudo_user`, `Email_user`, `Password_user` FROM user WHERE Email_user = :email OR Pseudo_user=:pseudo');
        $check->execute(array(
            'email' => $email,
            'pseudo' => $pseudo
        ));
        $data = $check->fetch();
        $row = $check->rowCount();
        echo $row;
        if($row == 0)
        {
            if(strlen($pseudo) <= 20)
            {
                if(strlen($email) <= 100)
                {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        if($password == $password_retype)
                        {
                            $password = hash('sha256',$password);
                            $insert = $db->prepare('INSERT INTO user(Pseudo_user,Email_user,Password_user) VALUES(:pseudo, :email, :password)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password
                            ));
                            header('Location:login.php?login_err=account');
                        }else header('Location:register.php?reg_err=password');
                    }else header('Location:register.php?reg_err=email');
                }else header('Location:register.php?reg_err=email_length');
            }else header('Location:register.php?reg_err=pseudo_length');
        }else header('Location:register.php?reg_err=already');
    }
?>