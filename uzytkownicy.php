<?php
require 'Baza.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = mysqli_query($conn, "DELETE FROM `użytkownicy` WHERE `id` = $id");

    if ($result) {
        echo "<script>alert('Użytkownik został usunięty.')</script>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<script>alert('Błąd podczas usuwania użytkownika.')</script>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM `użytkownicy`");
$uzytkownicy = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $uzytkownicy[] = $row;
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
    <title>Użytkownicy</title>
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

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Użytkownicy</h2>

<?php
if (isset($uzytkownicy) && !empty($uzytkownicy)) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Email</th><th>Akcje</th></tr>";

    foreach ($uzytkownicy as $uzytkownik) {
        echo "<tr>";
        echo "<td>" . $uzytkownik['id'] . "</td>";
        echo "<td>" . $uzytkownik['imie'] . "</td>";
        echo "<td>" . $uzytkownik['nazwisko'] . "</td>";
        echo "<td>" . $uzytkownik['email'] . "</td>";
        echo "<td><a href='edytuj_uzytkownika.php?id=" . $uzytkownik['id'] . "'>Edytuj</a> | ";

        echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=delete&id=" . $uzytkownik['id'] . "' onclick='return confirm(\"Czy na pewno chcesz usunąć tego użytkownika?\")'>Usuń</a>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<div class='button-container'>";
    echo "<button class='add-button' onclick='location.href=\"dodaj_uzytkownika.php\"'>Dodaj Użytkownika</button>";
    echo "</div>";
} else {
    echo "Brak dostępnych użytkowników.";
}
?>
<center>
    <a href="AdminSklepZalogowany.php" class="back-button">Powrót</a>
</center>
</body>
</html>
