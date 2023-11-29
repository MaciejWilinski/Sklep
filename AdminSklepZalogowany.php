<?php
require 'Baza.php';
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
</body>
</html>
