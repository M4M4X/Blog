<?php 
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("Location:login.php");
    }
    if ($_SESSION['admin'] == 0)
    {
        header("Location:website.php");
    }
    require "database.php"; // Connexion à la base de données

    $user = $db->prepare('SELECT `ID_user`,`Pseudo_user`, `Email_user`, `CreationDate_user` FROM user ORDER BY Pseudo_user');
    $user->execute();
    if(isset($_GET['delete']) AND !empty($_GET['delete']))
    {
        $delete1 = (int)$_GET['delete'];

        $query1 = $db->prepare('DELETE FROM user WHERE ID_user=?');
        $query1->execute(array($delete1));
        header('Location:admin.php');
    }

    $article = $db->prepare('SELECT `ID_article`, `Title_article`, `Category_article` FROM article ORDER BY Category_article');
    $article->execute();
    if(isset($_GET['delete']) AND !empty($_GET['delete']))
    {
        $delete2 = (int)$_GET['delete'];

        $query2 = $db->prepare('DELETE FROM article WHERE ID_article=?');
        $query2->execute(array($delete2));
        header('Location:admin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Blog/images/logo.ico">
    <link rel="stylesheet" href="style.css">
    <title>Max Making - Admin</title>
</head>
<body>
    <div class="admin">
        <header>
            <?php include 'navbar.php';?>
        </header>
        <div class="admin_body">
            <div class="admin_left">
                <h2 class="admin_title">Liste des utilisateurs :</h2>
                <ul class="ul_admin">
                    <?php while($u = $user->fetch()){ ?>
                    <li id="list"><?= $u['Pseudo_user'] ?>  -  <?= $u['Email_user'] ?>     
                    <a id="a" href="admin.php?delete=<?= $u['ID_user'] ?>"><button class="admin_button">Supprimer</button></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="admin_right">
                <div class="admin_article">
                    <h2 class="admin_title">Liste des articles :</h2>
                    <a href="write.php"><button class="write_article">Rédiger un article</button></a>
                </div>
                <ul class="ul_admin">
                    <?php while($a = $article->fetch()){ ?>
                    <li id="list"><?= $a['Category_article'] ?> - <?= $a['Title_article'] ?>
                        <div class="button_group">
                            <a id="" href="write.php?edit=<?= $a['ID_article'] ?>"><button class="admin_button_edit">Modifier</button></a>
                            <a id="a" href="admin.php?delete=<?= $a['ID_article'] ?>"><button class="admin_button">Supprimer</button></a>
                        </div>
                    </li>
                    <?php } ?>
                </ul><br>
                <br><br>
            </div>
        </div>
        
    </div>
</body>
</html>