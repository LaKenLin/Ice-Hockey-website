<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$ssn = '';
if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
}

$pname = '';
if(isset($_POST['pname'])){
    $pname = $_POST['pname'];
}

$pposition = '';
if(isset($_POST['pposition'])) {
  $pposition = $_POST['pposition'];
}

$nationality = '';
if(isset($_POST['nationality'])) {
  $nationality = $_POST['nationality'];
}

$shirtnumber = '';
if(isset($_POST['shirtnumber'])) {
  $shirtnumber = $_POST['shirtnumber'];
}

$team = '';
if(isset($_POST['team'])) {
  $team = $_POST['team'];
}

$psalary = '';
if(isset($_POST['psalary'])) {
  $psalary = $_POST['psalary'];
}


$success = $database->insertIntoPlayer($ssn, $pname,$pposition,$nationality,$shirtnumber);
$success1 = $database->insertIntoPlaysfor($ssn,$team,$psalary);
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
    <p><?php echo "Player '{$pname}' successfully added!"; ?></p>
  <?php } else { ?>
    <p><?php echo $success . $success1; ?></p>
  <?php }?>

<button class="back-button" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Employees.php';">GO BACK</button>
</div>
</div>
</body>
</html>
