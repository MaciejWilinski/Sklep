<?php
require 'Baza.php';

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["haslo"];

    if ($email == "admin@gmail.com" && $password == "admin123") {
        header("Location: AdminSklepZalogowany.php");
        exit();
    }

    $result = mysqli_query($conn, "SELECT * FROM użytkownicy WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if ($password == $row["haslo"]) {
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["imie"] = $row["imie"];
            header("Location: SklepZalogowany.php");
            exit();
        } else {
            echo "<script> alert('Złe hasło') </script>";
        }
    } else {
        echo "<script> alert('Zły email') </script>";
    }
}
?>
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="glowny">
    <h2>Logowanie</h2>
        <form class= "" action="" method="post" autocomplete="off">

            <label for="email">Email: </label>
            <input type="text" name="email" id="email" required value=""> <br>

            <label for="haslo">Hasło: </label>
            <input type="password" name="haslo" id="haslo" required value=""> <br>

            <button type="submit" name="submit">Zaloguj</button>
        <p>Nie posiadasz jeszcze konta? <a href="Rejestracja.php">Zarejestruj się</a></p>
    </div>
</body>
</html>