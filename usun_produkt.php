<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM `produkty` WHERE `id` = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: produkty.php");
        exit();
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
} else {
    echo "Nieprawidłowe żądanie.";
    exit();
}
?>
