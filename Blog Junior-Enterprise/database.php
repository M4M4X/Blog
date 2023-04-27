<?php
    define('HOST','localhost');
    define('DB_NAME','website');
    define('USER','root');
    define('PASS','');

    try {
        $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8", USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connect > ok ! ";
    } catch (PDOException $e) {
        die('Erreur : '.$e->getMessage());
        echo $e; 
    }
?>