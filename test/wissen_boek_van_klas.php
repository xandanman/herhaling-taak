<?php
session_start();
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin']==0){
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}

include "connect.php";
echo "<h1>Record verwijderen</h1>";

$sql = "DELETE FROM tblboekinklas WHERE volgnummer =" . $_GET['tewissen'];
if ($mysqli->query($sql)) {
    echo "Record succesvol gewist.";
} else {
    echo "Error record wissen:" . $mysqli->error;
}
$mysqli->close();
print "<br><a href='bekijken_gegevens.php'>Ga terug naar de lijst</a>";

?>