<?php
session_start();


if (isset($_SESSION['login'])){
    if ($_SESSION['login']==0){
        header('Location: login.php');
    }
}else{
    header('Location: login.php');
}
echo "<h2>wachtwoord wijziggen</h2><br>";

include "connect.php";




if (isset($_POST['knop'])) {
    $nummer = $_POST['nummer'];

    $wachtwoord = $_POST['wachtwoord'];

    $sql = "UPDATE tblgebruiker SET wachtwoord = '" .$wachtwoord."'Where gebruikernummer='".$nummer ."'";

    if ($mysqli->query($sql)) {
        echo 'het is gelukt !!!.';
        echo '<a href="index.php">klik hier om terug te gaan</a>';
    } else {
        echo 'het is mislukt !!!.';
        echo '<a href="aanpassen_wachtwoord.php">klik hier om terug te proberen</a>';
        echo '<a href="index.php">klik hier om terug te gaan</a>';
    }


} else {

    $sql = "select * from tblgebruiker where gebruikernummer = " . $_GET['aantepassen'];
    $resultaat = $mysqli->query($sql);
    $row = $resultaat->fetch_assoc();
    echo '
<form method="post" action="aanpassen_wachtwoord.php">
   
              <table>
            
              <input type="hidden" name="nummer" id="nummer" value="' . $row["gebruikernummer"] . '">
                <label>'.$row["naam"].'</label>
                <br><br>
              <input type="text" name="wachtwoord" value="' . $row['wachtwoord'] . '">
               <input type="submit" id="knop" name="knop" value="wijzig ">
</form>
';
}

