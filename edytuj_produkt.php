<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = mysqli_query($conn, "SELECT * FROM `produkty` WHERE `id` = $id");
    $produkt = mysqli_fetch_assoc($result);

    if (!$produkt) {
        echo "Produkt nie istnieje.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nazwa = $_POST["nazwa"];
    $kategoria = $_POST["kategoria"];
    $cena = $_POST["cena"];

    $query = "UPDATE `produkty` SET `nazwa`='$nazwa', `kategoria`='$kategoria', `cena`=$cena WHERE `id`=$id";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Produkt</title>
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

<h2>Edytuj Produkt</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $produkt['id']; ?>">
    Nazwa: <input type="text" name="nazwa" value="<?php echo $produkt['nazwa']; ?>" required><br>
    Kategoria:
    <select name="kategoria" required>
        <option value="buty">Buty</option>
        <option value="spodnie">Spodnie</option>
        <option value="koszulka">Koszulka</option>
    </select><br>
    Cena: <input type="number" name="cena" value="<?php echo $produkt['cena']; ?>" required><br>
    <input type="submit" value="Zapisz zmiany">
</form>

<center>
<a href="Kategorie.php" class="back-button">Powrót</a>
</center>

</body>
</html>
