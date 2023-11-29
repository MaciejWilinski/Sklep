<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = mysqli_query($conn, "DELETE FROM `kategoria` WHERE `id` = $id");

    if ($result) {
        echo "<script>alert('Kategoria została usunięta.')</script>";
    } else {
        echo "<script>alert('Błąd podczas usuwania kategorii.')</script>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM `kategoria`");
$kategorie = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $kategorie[] = $row;
    }
} else {
    echo "Błąd: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie</title>
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4caf50;;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        form {
            width: 80%;
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

<h2>Kategorie</h2>

<?php
if (isset($kategorie) && !empty($kategorie)) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Kategoria</th><th>Akcje</th></tr>";

    foreach ($kategorie as $kategoria) {
        echo "<tr>";
        echo "<td>" . $kategoria['id'] . "</td>";
        echo "<td>" . $kategoria['kategoria'] . "</td>";
        echo "<td><a href='edytuj_kategorie.php?id=" . $kategoria['id'] . "'>Edytuj</a> | ";
        echo "<a href='Kategorie.php?action=delete&id=" . $kategoria['id'] . "' onclick='return confirm(\"Czy na pewno chcesz usunąć tę kategorię?\")'>Usuń</a></td>";        
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Brak dostępnych kategorii.";
}

?>
<center>
<a href="dodaj_kategoria.php" class="back-button">Dodaj Kategorię</a>
</center><br>
<center><br>
<a href="AdminSklepZalogowany.php" class="back-button">Powrót</a>
</center>
</body>
</html>
