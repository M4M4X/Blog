<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("Location:login.php");
    }
    require_once "database.php"; // Connexion à la base de données

    $save = $db->prepare('SELECT `Pseudo_user`, `Email_user`, `Password_user` FROM user WHERE Pseudo_user = ?');
    $save->execute(array($_SESSION['user']));
    $save_data = $save->fetch();

    if(isset($_POST['pseudo']) && ($_POST['pseudo']!=null))
    {
        $check = $db->prepare('SELECT `Pseudo_user` FROM user');
        $check->execute();
        while($q = $check->fetch())
        {
            if($_POST['pseudo'] == $q['Pseudo_user'])
            {
                header('Location:profil.php?update_err=pseudo');
            }
        }
        $insert = $db->prepare('UPDATE `user` SET `Pseudo_user`=(:new_pseudo) WHERE Pseudo_user=(:old_pseudo)');
        $insert->execute(array(
            'new_pseudo' => $_POST['pseudo'],
            'old_pseudo' => $save_data['Pseudo_user']
        ));
        $_SESSION['user'] = $_POST['pseudo'];
        header('Location:profil.php?update_err=done');
    }
    if(isset($_POST['email']))
    {
        $check = $db->prepare('SELECT `Email_user` FROM user');
        $check->execute();
        while($q = $check->fetch())
        {
            if($_POST['email'] == $q['Email_user'])
            {
                header('Location:profil.php?update_err=email');
            }
        }
        $insert = $db->prepare('UPDATE `user` SET `Email_user`=(:new_email) WHERE Email_user=(:old_email)');
        $insert->execute(array(
            'new_email' => $_POST['email'],
            'old_email' => $save_data['Email_user']
        ));
        header('Location:profil.php?update_err=done');
    }
    if(isset($_POST['password']) && isset($_POST['password_retype']) && ($_POST['password'] === $_POST['password_retype']))
    {
        $insert = $db->prepare('UPDATE `user` SET `Password_user`=(:new_password) WHERE Pseudo_user=(:pseudo)');
        $insert->execute(array(
            'new_password' => hash('sha256',$_POST['password']),
            'pseudo' => $_SESSION['user']
        ));
        header('Location:profil.php?update_err=done');
    }else header('Location:profil.php?update_err=password')
    
?>
