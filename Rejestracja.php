<?php
require 'Baza.php';
if(isset($_POST["submit"])){
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    $potwierdzhaslo = $_POST["potwierdzhaslo"];
    $duplicate = mysqli_query($conn, "SELECT * FROM użytkownicy WHERE imie = '$imie' OR email = '$email'");

    if(mysqli_num_rows($duplicate) > 0 ){
        echo
        "<script> alert('Email został juz wykorzystany'); </script>";
    }
    else{
        if($haslo == $potwierdzhaslo){
            $query = "INSERT INTO użytkownicy VALUES('','$imie','$nazwisko','$email','$haslo')";
            mysqli_query($conn,$query);
            echo
            "<script> alert('Rejestracja sie powiodła') </script>";
            header("Location: Logowanie.php");
        }
        else {
            echo "<script> alert('Hasła nie są takie same'); </script>";
        } 
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep</title>
    <link rel="stylesheet" href="style.css">
</head>
</head>
<body>
    <div class="glowny">
        <h2>Rejestracja</h2>
        <form class= "" action="" method="post" autocomplete="off">
            <lanel for="imie">Imie : </label>
            <input type="text" name="imie" id="imie" require value=""><br>

            <lanel for="nazwisko">Nazwisko : </label>
            <input type="text" name="nazwisko" id="nazwisko" require value=""><br>
            
            <label for="email">Adres email : </label>
            <input type="text" name="email" id="email" require value=""><br>

            <label for="haslo">Haslo : </label>
            <input type="password" name="haslo" id="haslo" require value=""><br>

            <label for="potwierdzhaslo">Potwierdz haslo : </label>
            <input type="password" name="potwierdzhaslo" id="potwierdzhaslo" require/><br>

            <button type="submit" name="submit">Rejestruj</button>
        </form>
    <p>Masz już konto? <a href="Logowanie.php">Zaloguj sie</p>
</body>
<script>
function checkEmail()
{
  var email = document.forms.form1.email.value;
  var re = /^[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*@([a-zA-Z0-9_-]+)(\.[a-zA-Z0-9_-]+)*(\.[a-zA-Z]{2,4})$/i;
  if(email.match(re) == null)
      alert('Ten adres email jest nieprawidłowy');
  else
      alert('Poprawnie zarejestrowano');
}
</script>
</html>
