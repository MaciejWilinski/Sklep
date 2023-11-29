<?php
require 'Baza.php';

$result = mysqli_query($conn, "SELECT * FROM `produkty`");
$produkty = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $produkty[] = $row;
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
    <title>Produkty</title>
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
            background-color: #4caf50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        .button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }

        .add-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-button:hover {
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
</head>
<body>

<h2>Produkty</h2>

<?php
if (isset($produkty) && !empty($produkty)) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nazwa</th><th>Kategoria</th><th>Cena</th><th>Akcje</th></tr>";

    foreach ($produkty as $produkt) {
        echo "<tr>";
        echo "<td>" . $produkt['id'] . "</td>";
        echo "<td>" . $produkt['nazwa'] . "</td>";
        echo "<td>" . $produkt['kategoria'] . "</td>";
        echo "<td>" . $produkt['cena'] . " zł</td>";
        echo "<td><a href='edytuj_produkt.php?id=" . $produkt['id'] . "'>Edytuj</a> | <a href='usun_produkt.php?id=" . $produkt['id'] . "'>Usuń</a></td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<div class='button-container'>";
    echo "<a href='dodaj_produkt.php' class='add-button'>Dodaj Produkt</a>";

    echo "</div>";
} else {
    echo "Brak dostępnych produktów.";
}
?>
<center>
<a href='AdminSklepZalogowany.php' class='back-button'>Powrót</a>
</center>
</body>
</html>
