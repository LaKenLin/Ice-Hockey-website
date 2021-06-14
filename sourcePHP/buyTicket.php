<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$schedulenumber = '';
if(isset($_GET['schedulenumber'])){
    $schedulenumber = $_GET['schedulenumber'];
}

$starttime = $database->selectStartTimeFromGameWhereSchedulenumber($schedulenumber);
$StartTime = $starttime[0]['STARTTIME'];

$seat = '';
if(isset($_POST['seat'])){
    $seat = $_POST['seat'];
}

$success = $database->insertIntoTicket($schedulenumber,$StartTime,$seat);
$booking_info = $database->selectFromTickets($schedulenumber,$seat);
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
    <div id="mainnav">
      <a id="Tickets" href='http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/schedule.php'>Back</a>
    </div>
  </div>
  <div class="bg-image"></div>
<div class="message">
  <?php
    if ($success && is_bool($success)){?>
    <p><?php echo "Ticket bought!"; ?> <br>Have fun at the game! <br>
    Your receipt:</p>
    <table id="searchResult">
      <tr>
        <td>Booking Number:</td>
        <td><?php echo $booking_info[0]['BOOKINGNUMBER'] ?></td>
      </tr>
      <tr>
        <td>Seat:</td>
        <td><?php echo $booking_info[0]['TCATEGORY'] ?></td>
      </tr>
      <tr>
        <td>Date & Time:</td>
        <td><?php echo substr($booking_info[0]['STARTTIME'],0,2) . '. ' . substr($booking_info[0]['STARTTIME'],3,3) . ' 20' . substr($booking_info[0]['STARTTIME'],7,2) . ' ' . substr($booking_info[0]['STARTTIME'],11,1) . ':' . substr($booking_info[0]['STARTTIME'],13,2) . ' PM'; ?>  </td>
      </tr>
    </table>
  <?php } else { ?>
    <p><?php echo $success; ?></p>
  <?php }?>
</div>
</div>
</body>
</html>
