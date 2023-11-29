<?php
session_start();
$conn = mysqli_connect("mysql.ct8.pl", "m39337", "Admin1", "m39337_sklep");
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}
?>