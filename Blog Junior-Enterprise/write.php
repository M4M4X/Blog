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
    require "database.php";

    if(isset($_POST['article_title'], $_POST['article_content'], $_POST['article_category']))
    {
        if(!empty($_POST['article_title']) && !empty($_POST['article_content']) && !empty($_POST['article_category']))
        {
            $article_tilte = htmlspecialchars($_POST['article_title']);
            $article_content = htmlspecialchars($_POST['article_content']);
            $article_category = htmlspecialchars($_POST['article_category']);

            if(isset($_GET['edit']) && !empty($_GET['edit'])){
                $id_article = htmlspecialchars($_GET['edit']);
                $insert = $db->prepare('UPDATE `article` SET `Title_article`=(:new_title), `Content_article`=(:new_content), `Category_article`=(:new_category) WHERE ID_article=(:id_article)');
                $insert->execute(array(
                    'new_title' => $article_tilte,
                    'new_content' => $article_content,
                    'new_category' => $article_category,
                    'id_article' => $id_article
                ));
                $err = "edit";

            } else {
                $insert = $db->prepare('INSERT INTO article(Title_article,Content_article,Category_article) VALUES(:title, :content, :category)');
                $insert->execute(array(
                    'title' => $article_tilte,
                    'content' => $article_content,
                    'category' => $article_category
                ));
                $err = "done";
            }

        } else {
            $err = "empty";
        }
    }
    if(isset($_GET['edit']) && !empty($_GET['edit']))
    {
        // $edit = htmlspecialchar($_GET['edit']);
        $check = $db->prepare('SELECT `Title_article`, `Content_article`, `Category_article` FROM article WHERE ID_article = ?');
        $check->execute(array($_GET['edit']));
        $data = $check->fetch();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../Blog/images/logo.ico">
    <title>Max Making - Writting article...</title>
</head>
<body>
    <div id="scrollPath"></div>
    <div id="progressbar"></div>
    <div class="write">
        <header>
            <?php include "navbar.php" ?>
        </header>
    </div>
    <form class="write_form" method="POST">
        <?php
            if(isset($err))
            {
                // $err = htmlspecialchars($_GET['reg_err']);
                switch($err)
                {
                    case 'done':
                        ?>
                        <div class="done_write">Article posté !</div>
                    <?php
                    break;
                    case 'edit':
                        ?>
                        <div class="done_write">Article modifié !</div>
                    <?php
                    break;
                    case 'empty':
                        ?>
                        <div class="err_write"><strong>Erreur</strong> tous les champs ne sont pas remplis !</div>
                    <?php
                    break;
                }
            }
        ?>
        <p>Titre</p>
        <input id="type_form" type="text" name="article_title" size="80" placeholder="Titre..." required value="<?php if(isset($_GET['edit']) && !empty($_GET['edit']))
        {
            $check = $db->prepare('SELECT `Title_article`, `Content_article`, `Category_article` FROM article WHERE ID_article = ?');
            $check->execute(array($_GET['edit']));
            $data = $check->fetch();
            echo $data['Title_article'];
        } ?>">
        <p>Catégorie</p>
        <input id="type_form" type="text" name="article_category" size="50" placeholder="Categorie..." required value="<?php if(isset($_GET['edit']) && !empty($_GET['edit']))
        {
            echo $data['Category_article'];
        } ?>">
        <p>Contenu</p>
        <textarea name="article_content" id="type_form" cols="130" wrap="hard" rows="60" placeholder="Contenu de l'article..." required><?php if(isset($_GET['edit']) && !empty($_GET['edit'])){echo $data['Content_article'];} ?></textarea>
        <br><br><br><br>
        <input id="button_write" type="submit" value="Poster l'article">
        <br><br><br><br>
    </form>
    <?php include 'scroll.php' ?>
</body>
</html>