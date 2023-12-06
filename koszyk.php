<?php
require 'Baza.php';

$koszyk = isset($_COOKIE['koszyk']) ? json_decode($_COOKIE['koszyk'], true) : [];

if (isset($_GET['usun_produkt']) && isset($_GET['produkt_id'])) {
    $produkt_id = $_GET['produkt_id'];
    $koszyk = array_filter($koszyk, function ($produkt) use ($produkt_id) {
        return $produkt['id'] != $produkt_id;
    });
    zapiszKoszykCookie($koszyk);
}

if (isset($_POST['zapisz_ilosc']) && isset($_POST['produkt_id'])) {
    $produkt_id = $_POST['produkt_id'];
    $nowa_ilosc = isset($_POST['nowa_ilosc']) ? max(1, (int)$_POST['nowa_ilosc']) : 1;

    for ($i = 0; $i < count($koszyk); $i++) {
        if (isset($koszyk[$i]['id']) && $koszyk[$i]['id'] == $produkt_id) {
            $koszyk[$i]['ilosc'] = $nowa_ilosc;
            break;
        }
    }

    zapiszKoszykCookie($koszyk);
}

if(isset($_POST['zamow'])){
    if (empty($koszyk)) {
        echo '<script> alert("Koszyk jest pusty")</script>';
    } else {
        $temp_sql = "SELECT MAX(id_zamow) as 'nr' FROM zamowienia;";
        $temp_numer = mysqli_query($conn, $temp_sql);
        if ($temp_numer) {
            $temp_result = mysqli_fetch_assoc($temp_numer);
            $temp_number = ((int)$temp_result['nr']) + 1;
        } else {
            echo "Błąd zapytania: " . mysqli_error($conn);
        }
        $suma1 = 0;
        foreach ($koszyk as $produkt) {
            $suma1 += $produkt['cena'] * (isset($produkt['ilosc']) ? $produkt['ilosc'] : 1);
            $sql = "INSERT INTO zamowienia (id_zamow, produkt_id, ilosc, cena_suma, user_id) VALUES (".$temp_number.",".$produkt['id'].",".$produkt['ilosc'].",".$suma1.", null)";
            $zapisz_zamowienie = mysqli_query($conn, $sql);
            setcookie('koszyk', '', time() - 3600);
            header("Location:koszyk.php");
        }
    }
}


function zapiszKoszykCookie($koszyk)
{
    setcookie('koszyk', json_encode($koszyk), time() + (24 * 60 * 60));
}

$produktyResult = mysqli_query($conn, "SELECT * FROM `produkty`");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #3498db;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            background-color: #4caf50;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
        }

        nav ul li a:hover {
            color: #ecf0f1;
        }

        #koszyk-container {
            margin: 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .koszyk-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            width: 50%;
        }

        .left{
            display: flex;
            flex-direction: column;
        }

        .usun-produkt {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }

        .suma-container {
            margin-top: 20px;
        }

        #zamow {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: 2px solid #275929;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            margin-top: 10px;
            margin-bottom: 30px;
        }
        a{
            text-decoration: none;
            color: white;
        }
        .main{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Koszyk</h1>
        <nav>
            <ul>
                <li><a href="Sklep.php">Strona główna</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
                <li><a href="regulamin.html">Regulamin</a></li>                
                <li><a href="Logowanie.php" id="logowanie-link">Zaloguj</a></li>
                <li><a href="Rejestracja.php">Rejestracja</a></li>
                <li><a href="koszyk.php">Koszyk</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="main">
    <div id="koszyk-container">
        <?php
        if (empty($koszyk)) {
            echo '<p>Twój koszyk jest pusty.</p>';
        } else {
            foreach ($koszyk as $produkt) {
                echo '<div class="koszyk-item">';
                echo '<div class="left">';
                echo '<h3>' . $produkt['nazwa'] . '</h3>';
                echo '<p>Cena: ' . $produkt['cena'] . ' PLN</p>';
                echo '<p>Ilość: <form method="post" action=""><input type="number" name="nowa_ilosc" value="' . (isset($produkt['ilosc']) ? $produkt['ilosc'] : 1) . '" min="1"><input type="hidden" name="produkt_id" value="' . $produkt['id'] . '"><button type="submit" name="zapisz_ilosc">Zapisz</button></form></p>';
                echo '<button class="usun-produkt"><a href="?usun_produkt=1&produkt_id=' . $produkt['id'] . '">Usuń produkt</a></button>';
                echo '<br>';
                echo '</div>';
                echo '<div class="right">';
                echo '<img src="' . $produkt['img'] . '" alt="' . $produkt['nazwa'] . '" style="max-width: 400px; max-height: 400px;">';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <div class="suma-container">
        <?php
        if (!empty($koszyk)) {
            $suma = 0;

            foreach ($koszyk as $produkt) {
                $suma += $produkt['cena'] * (isset($produkt['ilosc']) ? $produkt['ilosc'] : 1);
            }

            echo '<p>Łączna suma: ' . $suma . ' PLN</p>';
        }
        ?>
    </div>
    <form action="" method="POST">
        <button type="submit" name="zamow" id="zamow">Kup teraz</button>
    </form>
    </div>
</body>
</html>