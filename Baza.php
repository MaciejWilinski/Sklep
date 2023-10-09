<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sklep");
if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}
?>