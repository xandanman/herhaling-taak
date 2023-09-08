<?php
session_start();
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==0){
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}
if (isset($_POST['knop'])) {
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $type = $_POST['type'];

    include "connect.php";
    $sql = "INSERT INTO tblboek (naam, prijs, type) VALUES ('" . $naam . "', '" . $prijs . "', 
        '" . $type . "')";
    if ($mysqli->query($sql)) {
        echo "Record succesvol toegevoegd<br>";
    } else {
        echo 'Error record toevoegen: ' . $mysqli->error . "<br>";
    }
    $mysqli->close();
    print "<br><a href='index.php'>Ga terug naar de lijst</a>";
}else{

    echo'
<form method="post" action="toevoegen_boek.php">
    <h3>toevoegen hier</h3>
   
                <label for="naam"></label>
                <input type="text" name="naam" id="naam" placeholder="naam">
                  <input type="text" name="prijs" id="prijs" placeholder="prijs">
                  <input type="type" name="type" id="type" placeholder="type">
                  

    <input type="submit" id="knop" name="knop" value="Toevoegen">
    
</form>
';
}
?>