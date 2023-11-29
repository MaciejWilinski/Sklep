<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = mysqli_query($conn, "SELECT * FROM `kategoria` WHERE `id` = $id");
    $kategoria = mysqli_fetch_assoc($result);

    if (!$kategoria) {
        echo "Kategoria nie istnieje.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $nazwa_kategorii = $_POST["nazwa_kategorii"];

    $query = "UPDATE `kategoria` SET `kategoria`='$nazwa_kategorii' WHERE `id`=$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: Kategorie.php");
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
    <title>Edytuj Kategorię</title>
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
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"], .back-button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="submit"]:hover, .back-button:hover {
            background-color: #2980b9;
        }
        .back-button{
            background-color:#4caf50;
        }
        
    </style>
</head>
<body>

<h2>Edytuj Kategorię</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $kategoria['id']; ?>">
    <label for="nazwa_kategorii">Nazwa Kategorii:</label>
    <input type="text" name="nazwa_kategorii" value="<?php echo $kategoria['kategoria']; ?>" required>
    <input type="submit" value="Zapisz zmiany" style="background-color:#4caf50;">
</form>
<center>
<a href="kategorie.php" class="back-button">Powrót</a>
</center>

</body>
</html>
