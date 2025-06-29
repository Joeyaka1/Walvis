<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
include 'database.php';

$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT Username, Email FROM Account WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>




<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mijn Account</title>
  <link rel="stylesheet" href="website.css">
</head>
<body>

  <div class="achtergrond">
  <div class="box">
    <h1>U bent ingelogd</h1>
    <p>Verander hier je account gegevens</p>

    <div class="extra-buttons">

    <form action="username.php" method="post">
        <button type="submit" class="linkButton">Username Veranderen</button>
      </form>

    <form action="email.php" method="post">
        <button type="submit" class="linkButton">E-mail Veranderen</button>
      </form>

      <form action="wachtwoord.php" method="post">
        <button type="submit" class="linkButton">Wachtwoord Veranderen</button>
      </form>

      <form action="verwijderen.php" method="post">
        <button type="submit" class="linkButton">Account verwijderen</button>
      </form>

      <form action="uitloggen.php" method="post">
        <button type="submit" class="linkButton">Uitloggen</button>
      </form>
    </div>

    <table class="gegevens-tabel">
      <tr><th>Email&nbsp;:</th><td><?php echo $user['Email']; ?></td></tr>
      <tr><th>Username&nbsp;:</th><td><?php echo $user['Username']; ?></td></tr>
    </table>
  </div>
</div>




</body>
</html>
