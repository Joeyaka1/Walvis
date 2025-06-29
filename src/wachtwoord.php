<?php 
session_start();

$loginError = "";

if (!isset($_SESSION['email'])) {
    $loginError = "Je moet ingelogd zijn om je wachtwoord te wijzigen.";
    exit;
}

include 'database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['h_password'], $_POST['n_password'], $_POST['c_password'])) {
  $h_password = $_POST['h_password'];//huidigen wachtwoord
  $n_password = $_POST['n_password'];//Nieuw wachtwoord
  $c_password = $_POST['c_password'];//confirm wachtwoord
  $email = $_SESSION['email'];

  $stmt = $conn->prepare("SELECT Password FROM Account WHERE Email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($wachtwoord_hash);
  $stmt->fetch();
  $stmt->close();

  if (!password_verify($h_password, $wachtwoord_hash)) {
     $loginError = "Huidig wachtwoord is onjuist.";
  
  }else if ($n_password !== $c_password) {
        $loginError = "Nieuwe wachtwoorden komen niet overeen.";

  }else if (password_verify($n_password, $wachtwoord_hash)){
    $loginError = 'Nieuw wachtwoord moet anders zijn dan huidige';
  
  }else{
  $n_password = password_hash($n_password, PASSWORD_DEFAULT);
  $update = $conn->prepare("UPDATE Account SET Password = ? WHERE Email = ?");
  $update->bind_param("ss", $n_password, $email);

  if (password_verify($n_password, $wachtwoord_hash)) {
    $loginError = "Het nieuwe wachtwoord moet anders zijn dan het huidige.";
  }

  if ($update->execute()) {
        $loginError = "Wachtwoord succesvol gewijzigd.";
    } else {
        $loginError = "Fout bij updaten van wachtwoord.";
    }

    $update->close();  
  }
}
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>Document</title>
</head>
<body>
  
 <style>
 h1 {text-align: center;}
    form {text-align: center;}
    label {text-align: center;}
</style>

  
<div class="achtergrond">
<div  class="box"> 

  <h1>Wachtwoord veranderen</h1>

   <?php
      if (!empty($loginError)) {
        $colorClass = str_starts_with($loginError, 'gelukt') ? 'success' : 'error';
        echo "<p class='$colorClass'>$loginError</p>";
      }
    ?>



   <form method="post">
    
    <label>Huidig wachtwoord:</label><br>
    <input class="textInput" type="password" name="h_password" placeholder='Huidig wachtwoord' required><br><br>

    <label>Nieuw wachtwoord:</label><br>
    <input class="textInput" type="password" name="n_password" placeholder='Nieuw wachtwoord' required><br><br>

    <label>Bevestig nieuw wachtwoord:</label><br>
    <input class="textInput" type="password" name="c_password" placeholder='Bevestig wachtwoord' required><br><br>
    <input class='button' type="submit" value="Wijzigen">

  </form>

  <a href='account.php'>Gedachte veranderd? Keer dan terug naar uw account</a>

</div> 
</div>

</div>

</body>
</html>