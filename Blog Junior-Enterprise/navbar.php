<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul id="ul">
        <a id="li_max" class="" href="https://www.instagram.com/max_making/?hl=fr">Max Making Blog</a>
        <li id="li"><a href="disconnect.php">Deconnexion</a></li>
        <?php if($_SESSION['admin'] == 1){ ?><li id="li"><a href="admin.php">Admin</a></li><?php } ?>
        <li id="li"><a href="profil.php">Mon Profil</a></li>
        <li id="li"><a href="website.php">Accueil</a></li>
    </ul>     
</body>
</html>