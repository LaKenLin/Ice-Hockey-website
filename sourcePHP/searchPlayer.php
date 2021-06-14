<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$ssn = '';
if(isset($_POST['searchssn'])){
    $ssn = $_POST['searchssn'];
}

$pname = '';
if(isset($_POST['searchpname'])) {
  $pname = $_POST['searchpname'];
}

$nationality = '';
if(isset($_POST['searchnationality'])) {
  $nationality = $_POST['searchnationality'];
}

$team = '';
if(isset($_POST['searchteam'])) {
  $team = $_POST['searchteam'];
}

$position = '';
if(isset($_POST['searchposition'])) {
  $position = $_POST['searchposition'];
}

$player_array = $database->selectFromPlayerWithInfo($ssn,$pname,$nationality,$team,$position);
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
      <div id="uberschrift"><h1>Player Search Results</h1></div>
    </div>
    <div class="bg-image"></div>

<div class="searchdiv">
  <?php if (sizeof($player_array)==0) { ?>
    <div class="message">
      <p> <?php echo "No Players found!"; ?> </p>
    </div>
  <?php } else { ?>
  <p> <?php echo "Number of hits: " . sizeof($player_array); ?> </p>
<table id="searchResult">
    <tr>
        <th>SSN</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Position</th>
        <th>Nationality</th>
        <th>Shirtnumber</th>
        <th>Team</th>
        <th>Salary</th>
    </tr>
    <?php foreach ($player_array as $player) : ?>
        <tr>
            <td><?php echo $player['SSN']; ?>  </td>
            <td><?php echo $player['PNAME']; ?>  </td>
            <td><?php echo $player['BIRTHDAY']; ?>  </td>
            <td><?php echo $player['PPOSITION']; ?>  </td>
            <td><?php echo $player['NATIONALITY']; ?>  </td>
            <td><?php echo $player['SHIRTNUMBER']; ?>  </td>
            <td><?php echo $player['TEAM']; ?>  </td>
            <td><?php echo $player['SALARY']; ?>  </td>
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
