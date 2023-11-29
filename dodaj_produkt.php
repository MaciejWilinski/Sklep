<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST["nazwa"];
    $kategoria = $_POST["kategoria"];
    $cena = $_POST["cena"];

    $query = "INSERT INTO `produkty` (`nazwa`, `kategoria`, `cena`) VALUES ('$nazwa', '$kategoria', $cena)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: produkty.php");
        exit();
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Produkt</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            text-align: center;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
<body>

<h2>Dodaj Produkt</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p>Nazwa: <input type="text" name="nazwa" required><br></p>
    <p>Kategoria:
    <select name="kategoria" required>
        <option value="buty">Buty</option>
        <option value="spodnie">Spodnie</option>
        <option value="koszulka">Koszulka</option>
    </select><br></p>
    <p>Cena: <input type="number" name="cena" required><br>
    <input type="submit" value="Dodaj"></p>
</form>

<center>
<a href="Kategorie.php" class="back-button">Powrót</a>
</center>

</body>
</html>
