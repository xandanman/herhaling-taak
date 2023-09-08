<?php

session_start();
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] == 0) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

include "connect.php";
echo "<h1>Record verwijderen</h1>";
$sql = " SELECT * From tblboekinklas Where boeknummer =" . $_GET['tewissen'];

$resultaat = $mysqli->query($sql);
$row = $resultaat->fetch_assoc();
$row_cnt = $resultaat->num_rows;
if ($row_cnt == 0) {

    $sql = "DELETE FROM tblboek WHERE boeknummer =" . $_GET['tewissen'];
    if ($mysqli->query($sql)) {
        echo "Record succesvol gewist.";
    } else {
        echo "Error record wissen:" . $mysqli->error;
    }
    $mysqli->close();
    print "<form><a href='index.php'>Ga terug naar de lijst</a></form>";
}else{
    echo 'dit boek word gebruikt dus dit boek kan niet vewijderd worden';
    print "<form><a href='index.php'>Ga terug naar de lijst</a></form>";
}
