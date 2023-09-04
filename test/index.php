<?php
session_start();
include 'connect.php';
if (isset($_SESSION['login'])){
    if ($_SESSION['login']==0){
        header('Location: login.php');
    }
}else{
    header('Location: login.php');
}
print $_SESSION['admin'];
echo '<a href="logout.php">loguit</a><br><br><br>';
echo "<a href=aanpassen_wachtwoord.php?aantepassen=".$_SESSION["login"].">wachtwoord wijzigen</a><br>";

echo '<a href="bekijken_gegevens.php">bekijk hier jouw gegevens</a>';


