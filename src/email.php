<?php
session_start();

$loginError="";

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    
    exit;
}

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['nieuw_email'])) {
  $nieuwEmail = $_POST['nieuw_email'];//huidigen E-mail
  $email = $_SESSION['email'];

    $stmt = $conn->prepare("SELECT Email FROM Account WHERE Email = ?");
    $stmt->bind_param("s", $nieuwEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "E-mail adres bestaat al.";
    } else {
        $stmt = $conn->prepare("UPDATE Account SET Email = ? WHERE Email = ?");
        $stmt->bind_param("ss", $nieuwEmail, $email);

         if ($stmt->execute() && $stmt->affected_rows === 1) {
            $_SESSION['email'] = $nieuwEmail;
            echo "E-mail adres succesvol gewijzigd!";
        } else {
            echo "E-mail adres kon niet worden gewijzigd.";
        }
    }
}
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wijzig e-mail</title>
  <link rel="stylesheet" href="website.css">
</head>
<body>
  <div class="achtergrond">
    <div class="box">
      <h1>Wijzig je e-mailadres</h1>
      <form method="post">
        <label for="nieuw_email">Nieuw e-mailadres:</label>
        <input class="textInput" type="email" name="nieuw_email" placeholder="E-mail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}"
               title="Geen geldig E-mail (moet een '@' en '.' bevatten)"
               required>
        <input type="submit" value="Wijzig e-mail" class="linkButton"><br><br>

        <a href='account.php'>Keer terug</a>
      </form>
    </div>
  </div>
</body>
</html>
