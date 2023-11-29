<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = mysqli_query($conn, "SELECT * FROM `użytkownicy` WHERE `id` = $id");
    $uzytkownik = mysqli_fetch_assoc($result);

    if (!$uzytkownik) {
        echo "Użytkownik nie istnieje.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];

    $query = "UPDATE `użytkownicy` SET `imie`='$imie', `nazwisko`='$nazwisko', `email`='$email', `haslo`='$haslo' WHERE `id`=$id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: uzytkownicy.php");
        exit();
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
} else {
    echo "Nieprawidłowe żądanie.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Użytkownika</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h2 {
    color: #333;
    text-align: center;
}

form {
    width: 80%;
    margin: 20px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    padding: 15px;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    display: block;
    margin: 20px auto;
}

button:hover {
    background-color: #45a049;
}

.back-button {
    background-color: #3498db;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
    background-color: #2980b9;
    background-color:#4caf50;
}
    </style>
</head>
<body>

<h2>Edytuj Użytkownika</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $uzytkownik['id']; ?>">
    Imię: <input type="text" name="imie" value="<?php echo $uzytkownik['imie']; ?>" required><br>
    Nazwisko: <input type="text" name="nazwisko" value="<?php echo $uzytkownik['nazwisko']; ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo $uzytkownik['email']; ?>" required><br>
    Nowe hasło: <input type="password" name="haslo" placeholder="Wprowadź nowe hasło"><br>

    <input type="submit" value="Zapisz zmiany">
</form>
<center>
    <a href="uzytkownicy.php" class="back-button">Powrót</a>
</center>
</body>
</html>

