<?php
$connexion = mysqli_connect('eu-cdbr-west-02.cleardb.net', 'b261f7527db285', '29509f46', 'heroku_378e833f98f78f3');
mysqli_set_charset($connexion, "utf8");
if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
