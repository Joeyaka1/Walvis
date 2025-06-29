<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Games; met SQL plain en geen partial</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <table>
    <tr>
      <th>studentNummer</th>
      <th>Naam</th>
      <th>schoolgeld</th>
      <th>Betaald</th>
    </tr>

    <?php
    $servername = "mysql";
    $username = "root";
    $password = "password";

    try {
      $conn = new mysqli($servername, $username, $password, "school");
      if ($conn->connect_error) {
        error_log($conn->connect_error);
        exit("Connection DB failed");
      }
    } catch (Exception $e) {
      error_log($e);
      exit("Connection DB failed");
    }

    $result = $conn->query("SELECT * FROM student;");
    if ($result->num_rows == 0) {
      exit('No rows');
    }

    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td> <a href='details.php?id=" . $row['studentnr'] . "'>" . $row['studentnr'] . "</a></td>";
      echo "<td>" . $row['roepnaam'] . "</td>";
      echo "<td>" . substr($row['schoolgeld'], 0, 50) . "</td>";
      echo "<td>" . $row['betaald'] . "</td>";
      echo "</tr>";
    }
    ?>
</body>

</html>