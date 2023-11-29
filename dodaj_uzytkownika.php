<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];

    $result = mysqli_query($conn, "INSERT INTO `użytkownicy` (`imie`, `nazwisko`, `email`, `haslo`) VALUES ('$imie', '$nazwisko', '$email', '$haslo')");

    if ($result) {
        echo "<script>alert('Nowy użytkownik został dodany.')</script>";
    } else {
        echo "<script>alert('Błąd podczas dodawania nowego użytkownika: " . mysqli_error($conn) . "')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Użytkownika</title>
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
            background-color: #4caf50;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Dodaj Użytkownika</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="imie">Imię:</label>
    <input type="text" name="imie" required>

    <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko" required>

    <label for="email">Email:</label>
    <input type="text" name="email" required>

    <label for="haslo">Hasło:</label>
    <input type="password" name="haslo" required>

    <input type="submit" name="submit" value="Dodaj">
</form>
<center>
<a href="uzytkownicy.php" class="back-button">Powrót</a>
</center>
</body>
</html>
