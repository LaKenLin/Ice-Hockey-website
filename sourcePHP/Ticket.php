<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$schedulenumber = '';
if(isset($_GET['schedulenumber'])){
    $schedulenumber = $_GET['schedulenumber'];
}

$tickets_array = $database->availableTickets($schedulenumber);
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
      <div id="uberschrift"><h1>buy ticket</h1></div>
      <div id="mainnav">
        <a id="Tickets" href='http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/schedule.php'>Back</a>
      </div>
    </div>
    <div class="bg-image"></div>

<div id="signup" class="addForm">
  <p>Available Tickets: <?php echo sizeof($tickets_array); ?></p>
  <form method="post" action="buyTicket.php?schedulenumber=<?php echo $schedulenumber; ?>" autocomplete="off">
    <label>Select Seat (Sector/Row Number/Seat Number): </label>
    <select id = "seat" name="seat">
    <?php
    for($x = 0; $x < sizeof($tickets_array); $x++){
    ?>
       <option value = "<?php echo $tickets_array[$x]["TCATEGORY"]?>"><?php echo $tickets_array[$x]["TCATEGORY"] . " - (25€)" ?></option>
    <?php }?>
    </select>

    <button class = "submit" type="submit">
        Buy Ticket
    </button>
  </form>
</div>
</div>
</body>
</html>
