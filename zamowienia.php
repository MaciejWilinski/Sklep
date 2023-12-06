<?php 
require 'Baza.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienia</title>
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

<?php
$sql = "SELECT id_zamow, produkt_id, SUM(ilosc) as ilosc, SUM(cena_suma) as cena_suma FROM zamowienia GROUP BY id_zamow";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID Zamówienia</th><th>ID Produktu</th><th>Ilość</th><th>Cena Suma</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id_zamow"]."</td><td>".$row["produkt_id"]."</td><td>".$row["ilosc"]."</td><td>".$row["cena_suma"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Brak danych do wyświetlenia.";
}
?>
<center>
  <a href='AdminSklepZalogowany.php' class='back-button'>Powrót</a>
</center>


</body>
</html>
