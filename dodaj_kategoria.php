<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nazwa_kategorii = $_POST["nazwa_kategorii"];

    $result = mysqli_query($conn, "INSERT INTO `kategoria` (`kategoria`) VALUES ('$nazwa_kategorii')");

    if ($result) {
        echo "<script>alert('Nowa kategoria została dodana.')</script>";
    } else {
        echo "<script>alert('Błąd podczas dodawania nowej kategorii.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Kategorię</title>
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
            width: 40%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
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

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .back-button{
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

<h2>Dodaj Kategorię</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="nazwa_kategorii">Nowa Kategoria:</label>
    <input type="text" name="nazwa_kategorii" required>
    <input type="submit" name="submit" value="Dodaj">
</form>

<center>
    <a href="kategorie.php" class="back-button">Powrót</a>
</center>

</body>
</html>
