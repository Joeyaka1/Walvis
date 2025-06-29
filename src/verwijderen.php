<?php 
session_start();

$loginError = "";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['h_password'], $_POST['c_password'])) {

    $email = $_SESSION['email'];//email
    $h_password = $_POST['h_password'];//huidigen wachtwoord
    $c_password = $_POST['c_password'];//confirm wachtwoord
    
         if ($h_password !== $c_password) {
            echo "Wachtwoorden komen niet overeen.";
            exit;
        }
        
    $stmt = $conn->prepare("SELECT Password FROM Account WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($wachtwoord_hash);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($h_password, $wachtwoord_hash)) {
        echo "wachtwoWrd is onjuist.";
        exit;
    }

     $stmt = $conn->prepare("DELETE FROM Account WHERE Email = ?");
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                session_destroy(); 
                header("Location: frontpage.php?message=verwijderd");
                exit;
                echo "Account succesvol verwijderd.";
                exit;
            } else {
                echo "Er is een fout opgetreden bij het verwijderen.";
                exit;
            }
        } 
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="website.css">
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

  <h1>Account deleten</h1>

   <form method="post" onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen?');">
    <label>E-mail:</label><br>
    <input class="textInput" type="email" name="email" placeholder="E-mail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}"
               title="Geen geldig E-mail (moet een '@' en '.' bevatten)"
               required><br>

    <label>Huidig wachtwoord:</label><br>
    <input class="textInput" type="password" name="h_password" placeholder='Huidig wachtwoord' required><br><br>

    <label>herhaal wachtwoord:</label><br>
    <input class="textInput" type="password" name="c_password" placeholder='Bevestig wachtwoord' required><br><br>

    <input class='button' type="submit" value="Delete Account"  >

  </form>

    <a href='account.php'>Van gedachte veranderd? Keer dan terug naar uw account</a>

</div> 
</div>

</div>

</body>
</html>