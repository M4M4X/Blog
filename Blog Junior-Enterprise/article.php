<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("Location:login.php");
    }
    require "database.php";

    if(isset($_GET['ID_article']) AND !empty($_GET['ID_article']))
    {
        $get_id = htmlspecialchars($_GET['ID_article']);

        $article = $db->prepare('SELECT * FROM article WHERE ID_article=?');
        $article->execute(array($get_id));

        if($article->rowCount() == 1) {
            $article = $article->fetch();
            $titre = $article['Title_article'];
            $contenu = $article['Content_article'];

        } else header('Location:website.php');
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
    <title>Document</title>
</head>
<body>
    <div id="scrollPath"></div>
    <div id="progressbar"></div>
    <div class="mix_main parallax">
        <header>
            <?php include 'navbar.php';?>
        </header>
        <h1 class="mix_title"><?= $titre ?></h1>
    </div>
    <div class="mix_page">
        <div class="mix">
            <div class="mix1"></div>
            <div class="mix2"></div>
            <div class="mix3"></div>
        </div><br><br><br>
        <div class="mix_content">
            <pre><?= $contenu ?></pre>
        </div>
    </div>
    <footer id="phone" class="parallax">
        <h2>Contact</h2>
        <p><b>Email : </b><a href="mailto:maxime.innocenti@epfedu.fr">maxime.innocenti@epfedu.fr</a></p>
        <p><b>Tel : </b><a href="tel:+33695873066">+33 6 95 87 30 66</a></p>
        <div id="jump-line"></div>
    </footer>
    <?php include 'scroll.php' ?>
</body>
</html>