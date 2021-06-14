<?php
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();
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
      <a id="Tickets" href='http://wwwlab.cs.univie.ac.at/~lindpointl95/Test/index.php'>Home</a>
    </div>
  </div>
  <div class="bg-image"></div>

<div id="dropdown-player" class="dropdown"> <!--Player-->
  <button onclick="playdropdown()" class="dropbtn">Players</button>
  <div id="PlayerDropdown" class="dropdown-content">
    <div id="lPlay1" class="addForm"> <!-- Add Player -->
      <h2>Add Player:</h2>
      <form method="post" action="addPlayer.php" autocomplete="off">
        <label for="ssn">SSN:</label>
        <input id="ssn" name="ssn" type="text" minlength="10" maxlength="10" placeholder="DDMMYYXXXX" required>

        <label for="pname">Name:</label>
        <input id="pname" name="pname" type="text" maxlength="50" placeholder="z.B: Franz Mayr" required>

        <label for ="psalary">Salary (in €): </label>
        <input id="psalary" name="psalary" type = "number" min = "0" placeholder="z.B: 1234.56">

        <label>Position: </label>
        <select id = "pposition" name="pposition">
           <option value = "G">Goalie</option>
           <option value = "D">Defender</option>
           <option value = "LW">Left Wing</option>
           <option value = "C">Center</option>
           <option value = "RW">Right Wing</option>
        </select>

        <label>Nationality: </label>
        <select id = "nationality" name="nationality">
            <option value="Austria">Austria</option>
            <option value="Canada">Canada</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="Hungary">Hungary</option>
            <option value="Italy">Italy</option>
            <option value="Latvia">Latvia</option>
            <option value="Norway">Norway</option>
            <option value="Russia">Russia</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Sweden">Sweden</option>
            <option value="Swizerland">Swizerland</option>
            <option value="USA">USA</option>
          </select>

        <label for="shirtnumber">Shirtnumber:</label>
        <input id="shirtnumber" name="shirtnumber" type="number" min="1" max="98" placeholder="[1,98]" required>

        <label>Team: </label>
        <select id = "team" name="team">
        <?php
        $team = $database->selectTeamIDFromTeam();
        for($x = 0; $x < sizeof($team); $x++){
        ?>
           <option value = "<?php echo $team[$x]["TEAMID"]?>"><?php echo $team[$x]["TEAMID"]?></option>
        <?php }?>
        </select>

        <button class = "submit" type="submit">
            Add Player
        </button>
      </form>
    </div>

    <div id="rPlay1" class="addForm"> <!-- Update Player -->
      <h2>Update Player</h2>
      <form method="post" action="updatePlayer.php" autocomplete="off">
        <label for="updatePlayer">Player to be updated (SSN):</label>
        <select id = "updatePlayer" name="updatePlayer">
        <?php
        $players = $database->selectSVFromTable('player','ssn');
        for($x = 0; $x < sizeof($players); $x++){
        ?>
           <option value = "<?php echo $players[$x]["SSN"]?>"><?php echo $players[$x]["SSN"]?></option>
        <?php }?>
        </select>

        <label for="updatesalary">New Salary (in €):</label>
        <input id="updatesalary" name="updatesalary" type="number" min="0" placeholder="z.B: 1234.56" required>

        <label for="updatepposition">New Position:</label>
        <select id = "updatepposition" name="updatepposition">
           <option value = "G">Goalie</option>
           <option value = "D">Defender</option>
           <option value = "LW">Left Wing</option>
           <option value = "C">Center</option>
           <option value = "RW">Right Wing</option>
        </select>

        <label for="updateshirtnumber">New Shirtnumber:</label>
        <input id="updateshirtnumber" name="updateshirtnumber" type="number" min="1" max="98" placeholder="[1,98]" required>

        <label>New Team: </label>
        <select id = "updateteam" name="updateteam">
        <?php
        $team = $database->selectTeamIDFromTeam();
        for($x = 0; $x < sizeof($team); $x++){
        ?>
           <option value = "<?php echo $team[$x]["TEAMID"]?>"><?php echo $team[$x]["TEAMID"]?></option>
        <?php }?>
        </select>

        <button class = "submit" type='submit'>
            Update Player
        </button>
      </form>
    </div>

    <div id="lPlay2" class="addForm"> <!--Search Player-->
      <h2>Search Player:</h2>
      <form method="post" action="searchPlayer.php" autocomplete="off">
        <label for="searchssn">SSN:</label>
        <input id="searchssn" name="searchssn" type="text" maxlength="10" placeholder="DDMMYYXXXX or parts">

        <label for="searchpname">Name:</label>
        <input id="searchpname" name="searchpname" type="text" maxlength="50" placeholder="z.B: Franz Mayr or Franz">

        <label for="searchnationality">Nationality: </label>
        <select id = "searchnationality" name="searchnationality">
          <option value="">----select----</option>
          <option value="Austria">Austria</option>
          <option value="Canada">Canada</option>
          <option value="Czech Republic">Czech Republic</option>
          <option value="Denmark">Denmark</option>
          <option value="Finland">Finland</option>
          <option value="France">France</option>
          <option value="Germany">Germany</option>
          <option value="Hungary">Hungary</option>
          <option value="Italy">Italy</option>
          <option value="Latvia">Latvia</option>
          <option value="Norway">Norway</option>
          <option value="Russia">Russia</option>
          <option value="Slovakia">Slovakia</option>
          <option value="Slovenia">Slovenia</option>
          <option value="Sweden">Sweden</option>
          <option value="Swizerland">Swizerland</option>
          <option value="USA">USA</option>
        </select>

        <label for="searchposition">Position:</label>
        <select id = "searchposition" name="searchposition">
          <option value="">----select----</option>
           <option value = "G">Goalie</option>
           <option value = "D">Defender</option>
           <option value = "LW">Left Wing</option>
           <option value = "C">Center</option>
           <option value = "RW">Right Wing</option>
        </select>

        <label>Team: </label>
        <select id = "searchteam" name="searchteam">
        <?php
        $team = $database->selectTeamIDFromTeam();
        for($x = -1; $x < sizeof($team); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $team[$x]["TEAMID"]?>"><?php echo $team[$x]["TEAMID"]?></option>
        <?php }}?>
        </select>

        <button class = "submit" type='submit'>
            Search Player
        </button>
      </form>
    </div>

    <div id="rPlay2" class="addForm"> <!--Delete Player-->
      <h2>Delete Player:</h2>
      <form method="post" action="delPlayer.php" autocomplete="off">
        <label for="deletessn">Player to be deleted (SSN):</label>
        <select id = "deletessn" name="deletessn">
        <?php
        $players = $database->selectSVFromTable('player','ssn');
        for($x = -1; $x < sizeof($players); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $players[$x]["SSN"]?>"><?php echo $players[$x]["SSN"]?></option>
        <?php }} ?>
        </select>

        <label for="pname">Name:</label>
        <select id = "pname" name="pname">
        <?php
        $players = $database->selectSVFromTable('player','pname');
        for($x = -1; $x < sizeof($players); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $players[$x]["PNAME"]?>"><?php echo $players[$x]["PNAME"]?></option>
        <?php }} ?>
        </select>

        <button class = "submit" type='submit'>
            Delete Player
        </button>
      </form>
    </div>
  </div>
</div>

<div id="dropdown-employees"class="dropdown"> <!--Employees-->
  <button onclick="empdropdown()" class="dropbtn">Employees</button>
  <div id="EmployeeDropdown" class="dropdown-content">
      <div id="lEmp1" class="addForm"> <!--Add Employee-->
        <h2>Add Employee:</h2>
        <form method="post" action="addEmployee.php" autocomplete="off">
        <label for="new_ssn">SSN:</label>
        <input id="new_ssn" name="ssn" type="text" minlength = "10" maxlength="10" placeholder="DDMMYYXXXX" required>

        <label for="new_ename">Name:</label>
        <input id="new_ename" name="ename" type="text" maxlength="100" placeholder="z.B: Franz Mayr" required>

        <label>Position: </label>
        <select id = "eposition" name="eposition">
          <?php
          $eposition = $database->selectEpositionFromEposition();
          for($x = 0; $x < sizeof($eposition); $x++){
          ?>
             <option value = "<?php echo $eposition[$x]["EPOSITION"]?>"><?php echo $eposition[$x]["EPOSITION"]?></option>
          <?php }?>
        </select>

        <button class="submit" type="submit">
            Add Employee
        </button>
      </form>
      </div>

      <div id="rEmp1" class="addForm"> <!--Update Employee-->
        <h2>Update Employee</h2>
        <form method="post" action="updateEmployee.php" autocomplete="off">
          <label for="ssn">Employee to be updated (SSN):</label>
          <select id = "ssn" name="ssn">
          <?php
          $employees = $database->selectSVFromTable('employees','ssn');
          for($x = 0; $x < sizeof($employees); $x++){
          ?>
             <option value = "<?php echo $employees[$x]["SSN"]?>"><?php echo $employees[$x]["SSN"]?></option>
          <?php }?>
          </select>

          <label for="updateposition">New Position:</label>
          <select id = "updateposition" name="updateposition">
          <?php
          $eposition = $database->selectEpositionFromEposition();
          for($x = 0; $x < sizeof($eposition); $x++){ ?>
              <option value = "<?php echo $eposition[$x]["EPOSITION"]?>"><?php echo $eposition[$x]["EPOSITION"]?></option>
          <?php }?>
          </select>

          <button class = "submit" type='submit'>
              Update Employee
          </button>
        </form>
      </div>

      <div id="lEmp2" class="addForm"> <!--Employee search-->
        <h2>Employee Search:</h2>
        <form method="post" action="searchEmployee.php" autocomplete="off">
          <label for="ssn">SSN:</label>
          <input id="ssn" name="ssn" type="text" maxlength="10" placeholder="DDMMYYXXXX">

          <label for="ename">Name:</label>
          <input id="ename" name="ename" type="text" maxlength="50" placeholder="z.B: Franz Mayr">

          <label for="searchposition">Position:</label>
          <select id = "searchposition" name="searchposition">
          <?php
          $eposition = $database->selectEpositionFromEposition();
          for($x = -1; $x < sizeof($eposition); $x++){
            if($x==-1) { ?>
              <option value="">----select----</option>
          <?php } else { ?>
              <option value = "<?php echo $eposition[$x]["EPOSITION"]?>"><?php echo $eposition[$x]["EPOSITION"]?></option>
          <?php }}?>
          </select>

          <label for="searchoffice">Office: </label>
          <select id = "searchoffice" name="searchoffice">
          <?php
          $offices = $database->selectAddressFromEposition();
          for($x = -1; $x < sizeof($offices); $x++){
            if($x==-1) { ?>
              <option value="">----select----</option>
          <?php } else { ?>
             <option value="<?php echo $offices[$x]["ADDRESS"]?>"><?php echo $offices[$x]["ADDRESS"]?></option>
          <?php }}?>
          </select>

          <button class = "submit" type='submit'>
              Search Employees
          </button>
      </form>
      </div>

      <div id= "rEmp2" class="addForm"> <!--Delete Employee-->
        <h2>Delete Employee:</h2>
        <form method="post" action="delEmployee.php" autocomplete="off">
          <label for="ssn">SSN:</label>
          <select id = "ssn" name="ssn">
          <?php
          $employees = $database->selectSVFromTable('employees','ssn');
          for($x = -1; $x < sizeof($employees); $x++){
            if($x==-1) { ?>
              <option value="">----select----</option>
          <?php } else { ?>
             <option value = "<?php echo $employees[$x]["SSN"]?>"><?php echo $employees[$x]["SSN"]?></option>
          <?php }} ?>
          </select>

          <label for="new_ename">Name:</label>
          <select id = "new_ename" name="ename">
          <?php
          $employees = $database->selectSVFromTable('employees','ename');
          for($x = -1; $x < sizeof($employees); $x++){
            if($x==-1) { ?>
              <option value="">----select----</option>
          <?php } else { ?>
             <option value = "<?php echo $employees[$x]["ENAME"]?>"><?php echo $employees[$x]["ENAME"]?></option>
          <?php }} ?>
          </select>
          <button class = "submit" type="submit">
              Delete Employee
          </button>
        </form>
      </div>
  </div>
</div>

<div id="dropdown-position" class="dropdown"> <!--Position-->
  <button onclick="posdropdown()" class="dropbtn">Positions</button>
  <div id="PositionDropdown" class="dropdown-content">
    <div id="lPos1" class="addForm"> <!--Add Position-->
      <h2>Add Position:</h2>
      <form method="post" action="addEposition.php" autocomplete="off">
        <label for="new_eposition">New Position:</label>
        <input id="new_eposition" name="eposition" type="text" maxlength="50" placeholder="z.B: Analyst" required>

        <label for="new_salary">Salary (in €):</label>
        <input id="new_salary" name="salary" type="number" min="0" max="100000" placeholder="z.B: 1234.56" required>

        <label>Supervisor: </label>
        <select id = "supervisor" name="supervisor">
        <?php
        $issupervisor="Y";
        $supervisors = $database->selectEpositionFromEpositionWhereIssupervisor($issupervisor);
        for($x = 0; $x < sizeof($supervisors); $x++){
        ?>
           <option value = "<?php echo $supervisors[$x]["EPOSITION"]?>"><?php echo $supervisors[$x]["EPOSITION"]?></option>
        <?php }?>
        </select>

        <label>Office: </label>
        <select id = "address" name="address">
        <?php
        $offices = $database->selectAddressFromOffice();
        for($x = 0; $x < sizeof($offices); $x++){
        ?>
           <option value = "<?php echo $offices[$x]["ADDRESS"]?>"><?php echo $offices[$x]["ADDRESS"]?></option>
        <?php }?>
        </select>

        <button class = "submit" type="submit">
            Add Position
        </button>
      </form>
    </div>

    <div id="rPos1" class="addForm"> <!--Update Position-->
      <h2>Update Position</h2>
      <form method="post" action="updateEposition.php" autocomplete="off">
        <label for="updateposition">Position to be updated:</label>
        <select id = "updateposition" name="updateposition">
        <?php
        $eposition = $database->selectEpositionFromEposition();
        for($x = 0; $x < sizeof($eposition); $x++){ ?>
            <option value = "<?php echo $eposition[$x]["EPOSITION"]?>"><?php echo $eposition[$x]["EPOSITION"]?></option>
        <?php }?>
        </select>

        <label for="updatesalary">Salary (in €):</label>
        <input id="updatesalary" name="updatesalary" type="number" min="0" placeholder="z.B: 1234.56" required>

        <label for="updatesupervisor">Supervisor:</label>
        <select id = "updatesupervisor" name="updatesupervisor">
        <?php
        $issupervisor='Y';
        $supervisors = $database->selectEpositionFromEpositionWhereIssupervisor($issupervisor);
        for($x = 0; $x < sizeof($supervisors); $x++){ ?>
           <option value = "<?php echo $supervisors[$x]["EPOSITION"]?>"><?php echo $supervisors[$x]["EPOSITION"]?></option>
        <?php }?>
        </select>

        <label for="updateoffice">Office: </label>
        <select id = "updateoffice" name="updateoffice">
        <?php
        $offices = $database->selectAddressFromOffice();
        for($x = 0; $x < sizeof($offices); $x++){ ?>
           <option value = "<?php echo $offices[$x]["ADDRESS"]?>"><?php echo $offices[$x]["ADDRESS"]?></option>
        <?php }?>
        </select>

        <button class = "submit" type='submit'>
            Update Position
        </button>
      </form>
    </div>

    <div id="lPos1" class="addForm"> <!--Search Position-->
      <h2>Search Position</h2>
      <form method="post" action="searchEposition.php" autocomplete="off">
        <label for="eposition">Position:</label>
        <select id = "eposition" name="eposition">
        <?php
        $eposition = $database->selectEpositionFromEposition();
        for($x = -1; $x < sizeof($eposition); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
            <option value = "<?php echo $eposition[$x]["EPOSITION"]?>"><?php echo $eposition[$x]["EPOSITION"]?></option>
        <?php }}?>
        </select>

        <label for="salary">Salary (in €):</label>
        <input id="salary" name="salary" type="number" min="0" placeholder="z.B: 1234.56">

        <label for="supervisor">Supervisor: </label>
        <select id = "supervisor" name="supervisor">
        <?php
        $issupervisor='Y';
        $supervisors = $database->selectEpositionFromEpositionWhereIssupervisor($issupervisor);
        for($x = -1; $x < sizeof($supervisors); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $supervisors[$x]["EPOSITION"]?>"><?php echo $supervisors[$x]["EPOSITION"]?></option>
        <?php }}?>
        </select>

        <label for="searchaddress">Office: </label>
        <select id = "searchaddress" name="searchaddress">
        <?php
        $offices = $database->selectAddressFromEposition();
        for($x = -1; $x < sizeof($offices); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value="<?php echo $offices[$x]["ADDRESS"]?>"><?php echo $offices[$x]["ADDRESS"]?></option>
        <?php }}?>
        </select>

        <button class = "submit" type='submit'>
            Search Position
        </button>
      </form>
    </div>

    <div id="rPos1" class="addForm"> <!--Delete Position-->
      <h2>Delete Position</h2>
      <form method="post" action="delPosition.php" autocomplete="off">
        <label for="deleteposition">Position to be deleted:</label>
        <select id = "deleteposition" name="deleteposition">
        <?php
        $eposition = $database->selectEpositionFromEpositionWhereIssupervisor('N');
        for($x = -1; $x < sizeof($eposition); $x++){
          if ($x == -1) { ?>
            <option value="">----select----</option>
          <?php } else { ?>
            <option value = "<?php echo $eposition[$x]["EPOSITION"]?>"><?php echo $eposition[$x]["EPOSITION"]?></option>
        <?php }} ?>
        </select>

        <button class = "submit" type='submit'>
            Delete Position
        </button>
      </form>
    </div>
  </div>
</div>

<div id="dropdown-coach" class="dropdown"> <!--Coach-->
  <button onclick="coachdropdown()" class="dropbtn">Coaches</button>
  <div id="CoachDropdown" class="dropdown-content">
    <div id="lCoa1" class="addForm"> <!-- Add Coach-->
      <h2>Add Coach:</h2>
      <form method="post" action="addCoach.php" autocomplete="off">
        <label for="new_ssn">SSN:</label>
        <input id="new_ssn" name="ssn" type="text" minlength="10" maxlength="10" placeholder="DDMMYYXXXX" required>

        <label for="new_coachname">Name:</label>
        <input id="new_coachname" name="coachname" type="text" maxlength="100" placeholder="z.B: Franz Mayr" required>

        <label>Position: </label>
        <select id = "cposition" name="cposition">
        <?php
        $cposition = $database->selectCpositionFromCposition();
        for($x = 0; $x < sizeof($cposition); $x++){
        ?>
           <option value = "<?php echo $cposition[$x]["CPOSITION"]?>"><?php echo $cposition[$x]["CPOSITION"]?></option>
        <?php }?>
        </select>

        <button class = "submit" type="submit">
            Add Coach
        </button>
      </form>
    </div>

    <div id="rCoa1" class="addForm"> <!--Update Coach-->
      <h2>Update Coach</h2>
      <form method="post" action="updateCoach.php" autocomplete="off">
        <label for="ssn">Coach to be updated (SSN):</label>
        <select id = "ssn" name="ssn">
        <?php
        $coaches = $database->selectSVFromTable('coach','ssn');
        for($x = 0; $x < sizeof($coaches); $x++){
        ?>
           <option value = "<?php echo $coaches[$x]["SSN"]?>"><?php echo $coaches[$x]["SSN"]?></option>
        <?php }?>
        </select>

        <label for="updateposition">New Position:</label>
        <select id = "updateposition" name="updateposition">
        <?php
        $cposition = $database->selectCpositionFromCposition();
        for($x = 0; $x < sizeof($cposition); $x++){ ?>
            <option value = "<?php echo $cposition[$x]["CPOSITION"]?>"><?php echo $cposition[$x]["CPOSITION"]?></option>
        <?php }?>
        </select>

        <button class = "submit" type='submit'>
            Update Coach
        </button>
      </form>
    </div>

    <div id="lCoa2" class="addForm"> <!--Coach search-->
      <h2>Coach Search:</h2>
      <form method="post" action="searchCoach.php" autocomplete="off">
        <label for="ssn">SSN:</label>
        <input id="ssn" name="ssn" type="text" maxlength="10" placeholder="DDMMYYXXXX">

        <label for="cname">Name:</label>
        <input id="cname" name="cname" type="text" maxlength="50" placeholder="z.B: Franz Mayr">

        <label>Position: </label>
        <select id = "cposition" name="cposition">
        <?php
        $cposition = $database->selectCpositionFromCposition();
        for($x = -1; $x < sizeof($cposition); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $cposition[$x]["CPOSITION"]?>"><?php echo $cposition[$x]["CPOSITION"]?></option>
        <?php }}?>
        </select>

        <label>Team: </label>
        <select id = "team" name="team">
        <?php
        $team = $database->selectTeamIDFromTeam();
        for($x = -1; $x < sizeof($team); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $team[$x]["TEAMID"]?>"><?php echo $team[$x]["TEAMID"]?></option>
        <?php }}?>
        </select>

        <button class = "submit" type='submit'>
            Search Coach
        </button>
    </form>
    </div>

    <div id="rCoa2" class="addForm"> <!--Delete Coach-->
      <h2>Delete Coach:</h2>
      <form method="post" action="delCoach.php" autocomplete="off">
        <label for="ssn">SSN:</label>
        <select id = "ssn" name="ssn">
        <?php
        $coaches = $database->selectSVFromTable('coach','ssn');
        for($x = -1; $x < sizeof($coaches); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $coaches[$x]["SSN"]?>"><?php echo $coaches[$x]["SSN"]?></option>
        <?php }} ?>
        </select>

        <label for="coachname">Name:</label>
        <select id = "coachname" name="coachname">
        <?php
        $coaches = $database->selectSVFromTable('coach','coachname');
        for($x = -1; $x < sizeof($coaches); $x++){
          if($x==-1) { ?>
            <option value="">----select----</option>
        <?php } else { ?>
           <option value = "<?php echo $coaches[$x]["COACHNAME"]?>"><?php echo $coaches[$x]["COACHNAME"]?></option>
        <?php }} ?>
        </select>

        <button class = "submit" type="submit">
            Delete Coach
        </button>
      </form>
    </div>
  </div>
</div>

</div>

<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function empdropdown() {
  document.getElementById("EmployeeDropdown").classList.toggle("show");
}
function posdropdown() {
  document.getElementById("PositionDropdown").classList.toggle("show");
}
function playdropdown() {
  document.getElementById("PlayerDropdown").classList.toggle("show");
}
function coachdropdown() {
  document.getElementById("CoachDropdown").classList.toggle("show");
}
</script>

</body>
</html>
