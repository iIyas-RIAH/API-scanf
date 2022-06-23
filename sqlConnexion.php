<?php
$connexion = mysqli_connect('localhost', 'abcglkvl_scanf', '11808192@Rs', 'abcglkvl_scanf');
mysqli_set_charset($connexion, "utf8");
if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>