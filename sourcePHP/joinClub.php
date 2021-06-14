<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$email = '';
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

$fanname = '';
if(isset($_POST['fanname'])){
    $fanname = $_POST['fanname'];
}

$success = $database->insertIntoFan($email,$fanname);
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
    if ($success && is_bool($success)){?>
    <p><?php echo "You have successfully joined the Club!"; ?></p>
  <?php } else { ?>
    <p><?php echo $success; ?></p>
  <?php }?>

<button class="back-button" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/index.php';">GO BACK</button>
</div>
</div>
</body>
