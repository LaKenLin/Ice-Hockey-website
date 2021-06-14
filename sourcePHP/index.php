<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Black Wings Linz</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
  <div class="topnav">
    <div id="logo">
      <img src="https://www.blackwings.at/fileadmin/templates/img/logo.svg" alt="Liwest Black Wings Linz Logo" width="190" height="115">
    </div>
    <div id="mainnav">
            <a id="Tickets" href="http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/schedule.php">Schedule & Tickets</a>
      <a id="Employee" href="http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Employees.php">For Employees</a>
    </div>
  </div>
  <div class="frontpage">
    <div class="bg-image"></div>
    <!-- <button class="button-frontpage1" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/schedule.php';">See Schedule & Buy Tickets</button> -->
  </div>

  <div id="signup" class="addForm"> <!-- Join Club -->
    <h2>Join the Club!</h2>
    <form method="post" action="joinClub.php" autocomplete="off">
      <label for="fanname">Your Name:</label>
      <input id="fanname" name="fanname" type="text" maxlength="50" placeholder="z.B: Franz Mayr" required>

      <label for="email">Your Email Address:</label>
      <input id="email" name="email" type="email" maxlength="100" placeholder="z.B: franz.mayr@bwlmail.at" required>

      <button class = "submit" type="submit">
          Sign me up!
      </button>
    </form>
  </div>


</body>
</html>
