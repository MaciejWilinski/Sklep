<!DOCTYPE html>
<html>
<head>
    <title>Strona logowania</title>
    <style>
header {
    background-color: royalblue;
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
    </style>
</head>
<body>
    <header>
        <h1>Sklep</h1>
        <nav>
            <ul>
                <li><a href="Sklep.php">Strona główna</a></li>
                <li><a href="#">O nas</a></li>
                <li><a href="#">Kontakt</a></li>
                <li id="user-menu">
                    <a href="Logowanie.php" id="logowanie-link">Zaloguj</a>
                    <a href="Rejestracja.php">Zarejestruj</a>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>
