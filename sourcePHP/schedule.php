<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$game_array = $database->selectFromGame();
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
      <div id="uberschrift"><h1>Schedule</h1></div>
      <div id="mainnav">
        <a id="Tickets" href='http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/index.php'>Home</a>
      </div>
    </div>
    <div class="bg-image"></div>

<div class="ticketdiv">
  <table id="searchResult">
      <tr>
          <th>Schedule Number</th>
          <th>Date & Time</th>
          <th>Home</th>
          <th></th>
          <th>Away</th>
          <th>Buy Ticket</th>
      </tr>
      <?php foreach ($game_array as $game) :
        if($game['HOMEAWAY']=='H') {?>
          <tr>
              <td><?php echo $game['SCHEDULENUMBER']; ?>  </td>
              <td><?php echo substr($game['STARTTIME'],0,2) . '. ' . substr($game['STARTTIME'],3,3) . ' 20' . substr($game['STARTTIME'],7,2) . ' ' . substr($game['STARTTIME'],11,1) . ':' . substr($game['STARTTIME'],13,2) . ' PM'; ?>  </td>
              <td>EHC Black Wings Linz</td>
              <td>:</td>
              <td><?php echo $game['OPPONENT']; ?>  </td>
              <td id="buyTicket"><button class="buyTicket" type="button" onclick="window.location.href= 'http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/Ticket.php?schedulenumber=<?php echo $game['SCHEDULENUMBER']; ?>';">Buy Ticket</button></td>
          </tr>
        <?php } else { ?>
          <tr>
            <td><?php echo $game['SCHEDULENUMBER']; ?>  </td>
            <td><?php echo substr($game['STARTTIME'],0,2) . '. ' . substr($game['STARTTIME'],3,3) . ' 20' . substr($game['STARTTIME'],7,2) . ' ' . substr($game['STARTTIME'],11,1) . ':' . substr($game['STARTTIME'],13,2) . ' PM'; ?>  </td>
            <td><?php echo $game['OPPONENT']; ?>  </td>
            <td>:</td>
            <td>EHC Black Wings Linz</td>
            <td></td>
          </tr>
      <?php } endforeach; ?>
  </table>
</div>
</div>
</body>
</html>
