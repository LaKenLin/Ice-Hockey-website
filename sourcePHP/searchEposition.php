<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$eposition = '';
if(isset($_POST['eposition'])){
    $eposition = $_POST['eposition'];
}

$salary = '';
if(isset($_POST['salary'])){
    $salary = $_POST['salary'];
}

$supervisor = '';
if(isset($_POST['supervisor'])){
    $supervisor = $_POST['supervisor'];
}

$address = '';
if(isset($_POST['searchaddress'])){
    $address = $_POST['searchaddress'];
}

$eposition_array = $database->selectFromEpositionWhere($eposition, $salary,$supervisor,$address);
?>
<html>
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
      <div id="uberschrift"><h1>Position Search Results</h1></div>
    </div>
    <div class="bg-image"></div>

<div class="searchdiv">
  <?php if (sizeof($eposition_array)==0) { ?>
    <div class="message">
      <p> <?php echo "No Positions found!"; ?> </p>
    </div>
  <?php } else { ?>
    <p> <?php echo "Number of hits: " . sizeof($eposition_array); ?> </p>
  <table id="searchResult">
      <tr>
          <th>Position</th>
          <th>Salary</th>
          <th>Supervisor</th>
          <th>Address</th>
      </tr>
      <?php foreach ($eposition_array as $position) : ?>
          <tr>
              <td><?php echo $position['EPOSITION']; ?>  </td>
              <td><?php echo $position['SALARY']; ?>  </td>
              <td><?php echo $position['SUPERVISOR']; ?>  </td>
              <td><?php echo $position['ADDRESS']; ?>  </td>
          </tr>
      <?php endforeach; ?>

  </table>
  <?php } ?>
</div>

<div class="buttondiv">
<button class="back-button" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Employees.php';">GO BACK</button>
</div>
</div>
</body>
</html>
