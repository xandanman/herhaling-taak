<?php
include "connect.php";
session_start();

if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == 0) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>

<?php
if(isset($_POST['knop'])) {
    $klas = $_POST['klassen'];

    $sql = "SELECT tblboek.naam, tblboek.prijs,volgnummer FROM tblboekinklas
                INNER JOIN tblboek
                ON (tblboekinklas.boeknummer = tblboek.boeknummer)
                WHERE klasnummer = '".$klas."'";
    $result = $mysqli->query($sql);

    echo "<table>
        <tr>
        <th>Boek</th>
        <th>Prijs</th>
        </tr>";

    $totaleprijs = 0;

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row['naam']."</td>
            <td>€".$row['prijs']."</td>
            <td>";
        $totaleprijs += $row['prijs'];


        if ($_SESSION['admin']==1){
            echo " <a href=wissen_boek_van_klas.php?tewissen=".$row["volgnummer"]. ">Wissen</a></td></tr>";
        }

    }

    echo "
        <tr>
        <td colspan=2>Totale prijs: €".$totaleprijs."</td>
        </tr>
        </table>";
    if ($_SESSION["admin"]) {
        print "<a href='toevoegen_boek_van_klas.php'>voeg een record toe</a>";
    }

} else {
    echo "
        <form method='post' action='bekijken_gegevens.php'>
            <label for='klassen'>Kies een klas</label>
            <br>
            <select name='klassen' id='klassen'>
            ";

    $sql = "SELECT * FROM tblklas";
    $resultaat = $mysqli->query($sql);

    while ($row = $resultaat->fetch_assoc()) {
        echo "
                <option value='".$row['klasnummer']."'>".$row['klasnaam']."</option>
                ";
    }

    echo "
            </select>
            
            <input type='submit' id='knop' name='knop' value='gegevens bekijken'>
        </form>
        ";
}
?>
</body>
</html>