<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("Location:login.php");
    }
    require "database.php"; // Connexion à la base de données

    $query1 = $db->prepare('SELECT `ID_article`, `Title_article`, `Content_article` FROM article WHERE Category_article=? ORDER BY Title_article');
    $query1->execute(array('Photographie'));

    $query2 = $db->prepare('SELECT `ID_article`, `Title_article`, `Content_article` FROM article WHERE Category_article=? ORDER BY Title_article');
    $query2->execute(array('Voyage'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Blog/images/logo.ico">
    <link rel="stylesheet" href="style.css">
    <title>Max Making - Home</title>
</head>
<body>
    <div id="scrollPath"></div>
    <div id="progressbar"></div>
    <div class="background_1 parallax">
        <header class="nav_main">
            <ul id="ul">
                <a id="li_max_main" class="" href="https://www.instagram.com/max_making/?hl=fr">Max Making Blog</a>
                <li id="li_main"><a href="disconnect.php">Deconnexion</a></li>
                <?php if($_SESSION['admin'] == 1){ ?><li id="li_main"><a href="admin.php">Admin</a></li><?php } ?>
                <li id="li_main"><a href="profil.php">Mon Profil</a></li>
                <li id="li_main"><a href="website.php">Accueil</a></li>
            </ul>
        </header>
        <p class="welcome">Bienvenue <?= $_SESSION['user']; ?> !</p>
    </div>

    <div class="intro">
        <h2>MON HISTOIRE</h2>
        <h3><i>J'adore voyager et immortaliser ses moments grâce à la photographie !</i></h3>
        <p>Lorem ipsum dolor sit amet. In totam dolorem et soluta aliquam sit molestias perspiciatis voluptatem corporis. Qui iusto quisquam sed amet recusandae eum adipisci explicabo.
        Quo ratione amet non unde nihil est Quis quia ut inventore eius aut error aut nobis esse. 
        Eos consequatur veritatis non culpa perspiciatis qui fugiat natus a nisi labore sit dolor aperiam. Qui rerum rerum in voluptate quaerat non voluptatem vero aut iusto velit id delectus velit vel quos voluptatem. 
        Ut nemo deleniti et consequatur quia cum quod iste id adipisci nemo ad molestiae architecto aut porro quia.
        </p>
        <div class="sum">
            <a href="#photo" class="sum1">Photographie</a>
            <a href="#trip" class="sum2">Voyage</a>
        </div>
    </div>

    <div id="photo"></div>
    <div class="background_2 parallax">
        <p>Photographie</p>
    </div>
    <div class="article_main">
        <?php while($p = $query1->fetch()){ ?>
            <a id="article_main_a" href="article.php?ID_article=<?= $p['ID_article'] ?>"><li><h2><?= $p['Title_article'] ?></h2><br><p><?= substr($p['Content_article'],0,1000) ?>...</p></li></a>
        <?php } ?>
    </div>

    <div id="trip"></div>
    <div class="background_3 parallax">
        <p>Voyage</p>
    </div>
    <div class="article_main">
        <?php while($v = $query2->fetch()){ ?>
            <a id="article_main_a" href="article.php?ID_article=<?= $v['ID_article'] ?>"><li><h2><?= $v['Title_article'] ?></h2><br><p><?= substr($v['Content_article'],0,1000) ?>...</p></li></a>
        <?php } ?>
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