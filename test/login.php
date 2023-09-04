<?php
session_start();
include "connect.php";

if (isset($_POST["knop"])) {
    $sql = "SELECT gebruikernummer,naam,wachtwoord,gebruikstype FROM tblgebruiker WHERE naam='".$_POST['name']."' and wachtwoord='".$_POST['password']."'";
    $resultaat = $mysqli->query($sql);
    $row = $resultaat->fetch_assoc();
    $row_cnt = $resultaat->num_rows;


    if ($row_cnt==1) {
        if ($row['gebruikstype']=="admin"){
            $_SESSION['admin']=1;
        }else{
            $_SESSION['admin']=0;
        }
            $_SESSION['login']=$row['gebruikernummer'];
        header('location: index.php');

    } else {
        $_SESSION["login"] = 0;
        echo 'login is fout';
    }

}
echo ' <form method="post" action="login.php">
        <h3>Login Hier</h3>

        <label for="name"></label>
        <input type="text" placeholder="name" name="name" id="name">
        <br><br>
        <label for="password"></label>
        <input type="password" placeholder="password" name="password" id="password">
        <br><br>
        <input type="submit" id="knop" name="knop" value="Login">
        
    </form>';