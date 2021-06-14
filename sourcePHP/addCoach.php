<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$ssn = '';
if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
}

$coachname = '';
if(isset($_POST['coachname'])){
    $coachname = $_POST['coachname'];
}

$cposition = '';
if(isset($_POST['cposition'])) {
  $cposition = $_POST['cposition'];
}

$success = $database->insertIntoCoach($ssn, $coachname);
$success1 = $database->insertIntoCoachPosition($ssn,$cposition);
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Black Wings Linz</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wholepage">
  <div class="topnav">
    <div id="logo">
      <img src="https://www.blackwings.at/fileadmin/templates/img/logo.svg" alt="Liwest Black Wings Linz Logo" width="190" height="115">
    </div>
  </div>
  <div class="bg-image"></div>
<div class="message">
  <?php
    if ($success && $success1 && is_bool($success) && is_bool($success1)){?>
    <p><?php echo "Coach '{$coachname}' successfully added!"; ?></p>
  <?php } else { ?>
    <p><?php echo $success . $success1; ?></p>
  <?php }?>

<button class="back-button" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Employees.php';">GO BACK</button>
</div>
</div>
</body>
</html>
