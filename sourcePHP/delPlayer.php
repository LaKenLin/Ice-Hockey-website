<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$ssn = '';
if(isset($_POST['deletessn'])){
    $ssn = $_POST['deletessn'];
}

$pname = '';
if(isset($_POST['pname'])){
    $pname = $_POST['pname'];
}

$success = $database->deleteFromPlayer($ssn,$pname);
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
    if ($success && is_bool($success) && strlen($ssn)>0){?>
    <p><?php echo "Player '{$ssn}' deleted!"; ?></p>
  <?php } else if ($success && is_bool($success) && strlen($pname)>0) { ?>
    <p><?php echo "Player '{$pname}' deleted!"; ?></p>
  <?php } else { ?>
    <p><?php echo $success; ?></p>
  <?php }?>

<button class="back-button" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Employees.php';">GO BACK</button>
</div>
</div>
</body>
</html>
