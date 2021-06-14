<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$ssn = '';
if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
}

$cname = '';
if(isset($_POST['cname'])){
    $cname = $_POST['cname'];
}

$cposition = '';
if(isset($_POST['cposition'])){
    $cposition = $_POST['cposition'];
}

$team = '';
if(isset($_POST['team'])){
    $team = $_POST['team'];
}

$coach_array = $database->selectFromCoachWithInfo($ssn, $cname, $cposition, $team);
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
      <div id="uberschrift"><h1>Coach Search Results</h1></div>
    </div>
    <div class="bg-image"></div>

<div class="searchdiv">
  <?php if (sizeof($coach_array)==0) { ?>
    <div class="message">
      <p> <?php echo "No Coaches found!"; ?> </p>
    </div>
  <?php } else { ?>
    <p> <?php echo "Number of hits: " . sizeof($coach_array); ?> </p>
  <table id="searchResult">
      <tr>
          <th>SSN</th>
          <th>Name</th>
          <th>Position</th>
          <th>Salary</th>
          <th>Team</th>
      </tr>
      <?php foreach ($coach_array as $coach) : ?>
          <tr>
              <td><?php echo $coach['SSN']; ?>  </td>
              <td><?php echo $coach['CNAME']; ?>  </td>
              <td><?php echo $coach['CPOSITION']; ?>  </td>
              <td><?php echo $coach['SALARY']; ?>  </td>
              <td><?php echo $coach['TEAM']; ?>  </td>
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
