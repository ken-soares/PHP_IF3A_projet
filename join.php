<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
  </head>
    <body>

    <?php
    // lister les cours disponibles
    include("connection.php");
    foreach($bdd->query("SELECT * from cours") as $row) {
        echo "<h1>". ."</h1>";
    }
    ?>
    <script src="index.js"></script>
  </body>
</html>
