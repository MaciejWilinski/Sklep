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
body {
    font-family: Arial, sans-serif;
    margin: 0;
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
    </style>
</head>
<body>
    <header>
        <h1>Sklep</h1>
        <nav>
        <ul>
                <li><a href="Sklep.php">Strona główna</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
                <li><a href="Regulamin.html">Regulamin</a></li>                
                <li><a href="Logowanie.php">Wyloguj</a></li><li></li></ul>
        </nav>
    </header>
</body>
</html>
