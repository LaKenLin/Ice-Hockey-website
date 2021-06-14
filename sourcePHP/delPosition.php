<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$position = '';
if(isset($_POST['deleteposition'])){
    $position = $_POST['deleteposition'];
}

$errorcode = $database->deleteFromEposition($position);
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
    if ($errorcode == 1){?>
    <p><?php echo "Position '{$position}' deleted!"; ?></p>
  <?php } else { ?>
    <p><?php echo "Errorcode: <br>" . $errorcode; ?></p>
  <?php }?>

<button class="back-button" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Employees.php';">GO BACK</button>
</div>
</div>
</body>
</html>
