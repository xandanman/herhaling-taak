<?php
session_start();
include "connect.php";
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==0){
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}
if (isset($_POST['knop'])) {
    $klas=$_POST['klassen'];
    $boek=$_POST['boeken'];


    $sql = "INSERT INTO tblboekinklas (klasnummer, boeknummer) VALUES ('" . $klas . "', '" . $boek . "')";
    if ($mysqli->query($sql)) {
        echo "Record succesvol toegevoegd<br>";
    } else {
        echo 'Error record toevoegen: ' . $mysqli->error . "<br>";
    }
    $mysqli->close();
    print "<br><a href='bekijken_gegevens.php'>Ga terug naar de lijst</a>";
}else{

    echo'
<form method="post" action="toevoegen_boek_van_klas.php">
    <h3>toevoegen hier</h3>
   
                   <select name="klassen" id="klassen">
            ';

    $sql = "SELECT * FROM tblklas";
    $resultaat = $mysqli->query($sql);
    print $sql;

    while ($row = $resultaat->fetch_assoc()) {
        echo "
                <option value='".$row['klasnummer']."'>".$row['klasnaam']."</option>
                ";
    }

    echo '
            </select>
            <select name="boeken" id="boeken">
            ';

    $sql = "SELECT * FROM tblboek";
    $resultaat = $mysqli->query($sql);

    while ($row = $resultaat->fetch_assoc()) {
        echo "
                <option value='".$row['boeknummer']."'>".$row['naam']."</option>
                ";
    }

    echo '
            </select>
                  

    <input type="submit" id="knop" name="knop" value="Toevoegen">
    
</form>
';
}
?>