<?php
require 'Baza.php';
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
            background-color: #4caf50;
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

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f6f6f6;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
        }

        #login-form,
        #register-form {
            display: none;
        }

        #logowanie-link {
            margin-right: 40px;
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
                <li><a href="logowanie.php">Wyloguj</a></li>
                <li></li>
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
            echo '<button class="add-to-cart-btn">Dodaj do koszyka</button>';
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>
