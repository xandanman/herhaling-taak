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

echo '<a href="logout.php">loguit</a><br><br><br>';
echo "<a href=aanpassen_wachtwoord.php?aantepassen=".$_SESSION["login"].">wachtwoord wijzigen</a><br>";

echo '<br><a href="bekijken_gegevens.php">bekijk hier jouw gegevens</a>';



echo '<h1>boeken</h1>';

$sql = "select * from tblboek";
$resultaat = $mysqli->query($sql);
echo '<table>';
while ($row = $resultaat->fetch_assoc()) {
    echo "<tr><td>". $row['naam'] ."</td><td>". $row['prijs'] . "</td><td>". $row['type'] . "</td><td>

    "; if ($_SESSION["admin"]){
             echo "
                 <a href=wissen_boek.php?tewissen=".$row["boeknummer"]. ">Wissen</a></td><td>
                 <a href=wijziggen_boeken.php?teveranderen=".$row["boeknummer"].">wijzig</a>
        
        </td>";}
}
echo "</table>";
if ($_SESSION["admin"]) {
    print "<a href='toevoegen_boek.php'>voeg een record toe</a>";
}

if ($_SESSION["admin"]) {
$sql="SELECT tblboek.boeknummer, tblboek.prijs,SUM(tblklas.aantalleerlingen),tblboek.prijs*SUM(tblklas.aantalleerlingen)
FROM tblklas,tblboekinklas,tblboek
WHERE tblboek.boeknummer=tblboekinklas.boeknummer
AND tblklas.klasnummer=tblboekinklas.klasnummer
GROUP BY tblboek.boeknummer";

    $resultaat = $mysqli->query($sql);

    echo '<br><br><br><br><br><h1>Bekijken te bestellen boeken</h1>';
    echo '<table>';
    echo '<tr><td>boeknummer</td><td>prijs</td><td>aantal leerlingen</td><td>totaal prijs</td></tr><tr>';
    while ($row = $resultaat->fetch_assoc()) {
        echo "<td>". $row['boeknummer'] ."</td><td>". $row['prijs'] . "</td>
<td>". $row['SUM(tblklas.aantalleerlingen)'] . "</td>
<td>". $row['tblboek.prijs*SUM(tblklas.aantalleerlingen)'] . "</td></tr>";
    }
    echo '';
}



