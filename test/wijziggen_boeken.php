<?php
session_start();
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==0){
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}
print $_SESSION['admin'];
echo "<h2>Tabel aanpassen</h2><br>";
include "connect.php";
if (isset($_POST['knop'])){
    $nummer = $_POST['nummer'];
    print $nummer;
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $type = $_POST['afbeelding'];

    $sql = "UPDATE tblboek SET naam = '".$naam."', prijs = '".$prijs."',type = '".$type."' WHERE boeknummer =".$nummer;

    if ($mysqli->query($sql)) {
        echo "Record succesvol bijgewerkt";
    } else {
        echo "Error record wijzigen: ".$mysqli->error;
    }
   header('Location: index.php');

}else{

    $sql = "select * from tblboek where boeknummer = ".$_GET['teveranderen'];
    $resultaat = $mysqli->query($sql);
    $row = $resultaat->fetch_assoc();
    print $sql;
    echo'
<form method="post" action="wijziggen_boeken.php">
    <h3>wijziggen hier</h3>
   
              <table>
            
              <input type="hidden" name="nummer" id="nummer" value="'.$row["boeknummer"].'">

              <input type="text" name="naam" value="'.$row["naam"].'">
              <input type="text" name="prijs" value="'.$row["prijs"].'">
              <input type="text" name="afbeelding" value="'.$row["type"].'">         

</table>

    <input type="submit" id="knop" name="knop" value="Wijzigen">
</form>';
}
?>