<?php
require 'Baza.php';

$koszyk = isset($_COOKIE['koszyk']) ? json_decode($_COOKIE['koszyk'], true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dodaj_do_koszyka'])) {
    $produkt_id = $_POST['produkt_id'];

    $query = "SELECT * FROM `produkty` WHERE id = $produkt_id";
    $result = mysqli_query($conn, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $koszyk[] = [
            'id' => $row['id'],
            'nazwa' => $row['nazwa'],
            'cena' => $row['cena'],
            'img' => $row['img'],
            'ilosc' => 1
        ];

        setcookie('koszyk', json_encode($koszyk), time() + (24 * 60 * 60));
    }
}

$produktyResult = mysqli_query($conn, "SELECT * FROM `produkty`");

$tileStyle = "
    display: inline-block;
    border: 1px solid #ddd;
    padding: 10px;
    margin: 10px;
    text-align: center;
    width: calc(33.33% - 20px);
    box-sizing: border-box;
";

$produktyContainerStyle = "
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 20px;
";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Strona główna</title>
</head>
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
        .product-tile {
            <?php echo $tileStyle; ?>
        }

        .product-img {
            max-width: 100%;
            height: auto;
        }

        #produkty-container {
            <?php echo $produktyContainerStyle; ?>
        }

        .add-to-cart-btn {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
    </style>
<body>
    <header>
        <h1>Sklep</h1>
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
     <div id="produkty-container">
     <?php
        while ($row = mysqli_fetch_assoc($produktyResult)) {
            echo '<div class="product-tile">';
            echo '<img class="product-img" src="' . $row['img'] . '" alt="' . $row['nazwa'] . '">';
            echo '<h3>' . $row['nazwa'] . '</h3>';
            echo '<p>Cena: ' . $row['cena'] . ' PLN</p>';
            echo '<form method="post">';
            echo '<input type="hidden" name="produkt_id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="dodaj_do_koszyka" class="add-to-cart-btn">Dodaj do koszyka</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
