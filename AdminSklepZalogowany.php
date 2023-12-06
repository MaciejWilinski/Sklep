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
<html>
<head>
    <title>Strona główna</title>
    <style>
header {
    background-color:  #4caf50;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 40px;
}

nav ul li a {
    text-decoration: none;
    color: white;
}

#login-form, #register-form {
    display: none;
}
#logowanie-link{
    margin-right: 40px;
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #f6f6f6;
}

.menu-container {
    position: fixed;
    top: 0;
    right: 0;
    padding: 10px;
}

.dropdown {
    display: inline-block;
}

.dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    background-color: inherit;
    cursor: pointer;
    border-radius: 50%;
    padding: 50px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
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
</head>
<body>
    <header>
        <h1>Sklep</h1>
        <nav>
        <ul>
                <li><a href="Sklep.php">Strona główna</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
                <li><a href="regulamin.html">Regulamin</a></li>                
                <li><a href="Logowanie.php">Wyloguj</a></li><li></li></ul>
                <li><a href="koszyk.php">Koszyk</a></li>
        </nav>
        <div class="menu-container">
        <div class="dropdown">
            <button class="dropbtn">Edytuj</button>
            <div class="dropdown-content">
                <a href="produkty.php">Produkty</a>
                <a href="kategorie.php">Kategorie</a>
                <a href="uzytkownicy.php">Użytkownicy</a>
            </div>
        </div>
    </div>
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
