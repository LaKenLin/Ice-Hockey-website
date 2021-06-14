<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$ssn = '';
if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
}

$ename = '';
if(isset($_POST['ename'])){
    $ename = $_POST['ename'];
}

$eposition = '';
if(isset($_POST['searchposition'])){
    $eposition = $_POST['searchposition'];
}

$office = '';
if(isset($_POST['searchoffice'])){
    $office = $_POST['searchoffice'];
}

$employee_array = $database->selectFromEmployeeWithInfo($ssn, $ename, $eposition, $office);
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
      <div id="uberschrift"><h1>Employee Search Results</h1></div>
    </div>
    <div class="bg-image"></div>

<div class="searchdiv">
  <?php if (sizeof($employee_array)==0) { ?>
    <div class="message">
      <p> <?php echo "No Employees found!"; ?> </p>
    </div>
  <?php } else { ?>
  <p> <?php echo "Number of hits: " . sizeof($employee_array); ?> </p>
  <table id="searchResult">
      <tr>
          <th>SSN</th>
          <th>Name</th>
          <th>Position</th>
          <th>Salary</th>
          <th>Office</th>
      </tr>
      <?php foreach ($employee_array as $employee) : ?>
          <tr>
              <td><?php echo $employee['SSN']; ?>  </td>
              <td><?php echo $employee['ENAME']; ?>  </td>
              <td><?php echo $employee['EPOSITION']; ?>  </td>
              <td><?php echo $employee['SALARY']; ?>  </td>
              <td><?php echo $employee['OFFICE']; ?>  </td>
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
