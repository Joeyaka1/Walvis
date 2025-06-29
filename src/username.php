<?php
session_start();
include 'database.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nieuw_username'])) {
        $nieuwUsername = $_POST['nieuw_username'];
        $email = $_SESSION['email'];

        
        $stmt = $conn->prepare("SELECT Username FROM Account WHERE Username = ?");
        $stmt->bind_param("s", $nieuwUsername);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Deze gebruikersnaam bestaat al.";
        } else {
            // Update username op basis van huidige e-mail
            $stmt = $conn->prepare("UPDATE Account SET Username = ? WHERE Email = ?");
            $stmt->bind_param("ss", $nieuwUsername, $email);

            if ($stmt->execute() && $stmt->affected_rows === 1) {
                echo "Gebruikersnaam succesvol gewijzigd!";
            } else {
                echo "Gebruikersnaam kon niet worden gewijzigd.";
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
  <title>Wijzig gebruikersnaam</title>
  <link rel="stylesheet" href="website.css">
</head>
<body>
  <div class="achtergrond">
    <div class="box">
      <h1>Wijzig je gebruikersnaam</h1>
      <form method="post">
        <label for="nieuw_username">Nieuwe gebruikersnaam:</label>
        <input class="textInput" type="text" name="nieuw_username" placeholder="Gebruikersnaam">
        <input type="submit" value="Wijzig gebruikersnaam" class="linkButton"><br><br>
        <a href='account.php'>Keer terug</a>
      </form>
    </div>
  </div>
</body>
</html>
