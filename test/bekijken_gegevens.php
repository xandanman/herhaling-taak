<?php
include "connect.php";
session_start();

if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] = 0) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_POST['knop'])) {
    $klas = $_POST['klassen'];

    $sql = "SELECT tblboek.naam, tblboek.prijs FROM tblboekinklas
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
            </tr>";

        $totaleprijs += $row['prijs'];
    }

    echo "
        <tr>
        <td colspan=2>Totale prijs: €".$totaleprijs."</td>
        </tr>
        </table>";

} else {
    echo "
        <form method='post' action='bekijken_gegevens.php'>
            <label for='klassen'>Kies een klas</label>
            <br>
            <select name='klassen' id='klassen'>
            ";

    $sql = "SELECT * FROM tblklas";
    $result = $mysqli->query($sql);

    while ($row = $result->fetch_assoc()) {
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