<?php
class DatabaseHelper
{
    const username = ###;
    const password = ###;
    const con_string = ###;
    protected $conn;
    public function __construct() {
        try {
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );
            if (!$this->conn) {
                die("DB error: Connection can't be established!");
            }
        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }
    public function __destruct() {
        @oci_close($this->conn);
    }

/* Employees.php functions*/

//------------------------------------Insert Functions-----------------------------------//
    public function insertIntoPlayer($ssn,$pname,$pposition,$nationality,$shirtnumber) {
      $birthday = substr($ssn,0,2) . '.' . substr($ssn,2,2) . '.' . substr($ssn,4,2);
      $sql = "INSERT INTO player (ssn,pname,birthday,playerposition,nationality,shirtnumber) VALUES ('$ssn','$pname',to_date('{$birthday}', 'DD-MM-YY'),'$pposition','$nationality','$shirtnumber')";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Player $pname into player. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoPlaysfor($ssn,$team,$psalary) {
      $sql = "INSERT INTO playsfor (ssn,teamID,salary) VALUES ('$ssn','$team',$psalary)";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Player $ssn into Playsfor. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoEmployees($ssn, $ename) {
      $birthday = substr($ssn,0,2) . '.' . substr($ssn,2,2) . '.' . substr($ssn,4,2);
      $sql = "INSERT INTO employees (ssn,ename,birthday) VALUES ('{$ssn}', '{$ename}' , to_date('{$birthday}', 'DD-MM-YY'))";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Employee $ename into employees. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoEmployeePosition($ssn,$eposition) {
      $sql = "INSERT INTO employee_position (ssn,eposition) VALUES ('$ssn','$eposition')";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Employee $ename into employee_position. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoEPosition($eposition, $salary,$supervisor,$address) {
      if ($supervisor == '') {
        $sql = "INSERT INTO eposition (eposition,salary,supervisor,issupervisor,address) VALUES ('$eposition', '$salary' , NULL,'Y', '$address')";
      } else {
        $sql = "INSERT INTO eposition (eposition,salary,supervisor,issupervisor,address) VALUES ('$eposition', '$salary' , '$supervisor','N', '$address')";
      }
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Position $eposition into eposition. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoCoach($ssn,$coachname) {
      $birthday = substr($ssn,0,2) . '.' . substr($ssn,2,2) . '.' . substr($ssn,4,2);
      $sql = "INSERT INTO coach (ssn,coachname,birthday) VALUES ('$ssn','$coachname',to_date('{$birthday}', 'DD-MM-YY'))";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Coach $coachname into coach. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoCoachPosition($ssn,$cposition) {
      $sql = "INSERT INTO coach_position (ssn,cposition) VALUES ('$ssn','$cposition')";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Coach $ssn into coach_position. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

//------------------------------------Search Functions-----------------------------------//
    public function selectFromPlayerWithInfo($ssn, $pname,$nationality,$team,$position){
      $sql = "SELECT * FROM PlayerWithInfo
          WHERE ssn LIKE '%{$ssn}%'
            AND pname LIKE '%{$pname}%'
            AND nationality LIKE '%{$nationality}%'
            AND team LIKE '%$team%'
            AND pposition LIKE '%$position%'
          ORDER BY birthday ASC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectFromEmployeeWithInfo($ssn,$ename,$eposition,$office){
      $sql = "SELECT * FROM employeewithinfo
          WHERE ssn LIKE '%{$ssn}%'
            AND upper(ename) LIKE upper('%{$ename}%')
            AND upper(eposition) LIKE upper('%{$eposition}%')
            AND upper(office) LIKE upper('%{$office}%')
          ORDER BY salary DESC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectFromEpositionWhere($eposition, $salary,$supervisor,$office){
      $sql = "SELECT * FROM eposition
          WHERE eposition LIKE '%{$eposition}%'
            AND salary LIKE '%{$salary}%'
            AND supervisor LIKE '%{$supervisor}%'
            AND address LIKE '%{$office}%'
          ORDER BY eposition ASC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectFromCoachWithInfo($ssn, $cname, $cposition, $team){
      $sql = "SELECT * FROM coachwithinfo
          WHERE ssn LIKE '%{$ssn}%'
            AND upper(cname) LIKE upper('%{$cname}%')
            AND upper(cposition) LIKE upper('%$cposition%')
            AND upper(team) LIKE upper('%$team%')
          ORDER BY salary DESC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectSVFromTable($table,$column){
      $sql = "SELECT $column FROM $table
              ORDER BY $column ASC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectAddressFromOffice() {
      $sql = "SELECT address FROM office";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select address from office. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectAddressFromEposition() {
      $sql = "SELECT address FROM eposition GROUP BY address ORDER BY address";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select address from eposition. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectEpositionFromEposition() {
      $sql = "SELECT eposition FROM eposition ORDER BY eposition ASC";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select eposition from eposition. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectEpositionFromEpositionWhereIssupervisor($issupervisor){
      $sql = "SELECT eposition FROM eposition
              WHERE issupervisor = '$issupervisor'
              ORDER BY eposition ASC";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select supervisor positions from eposition. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectTeamIDFromTeam() {
      $sql = "SELECT teamid FROM team ORDER BY TeamID ASC";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select TeamID from Team. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectNationalityFromPlayer() {
      $sql = "SELECT nationality FROM player";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select Nationality from Player. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectCpositionFromCposition() {
      $sql = "SELECT cposition FROM cposition";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement);
      if (!$success) {
        echo "Error! Can't select Cposition from Cposition. <br>";
        $e = oci_error($statement);
        echo "Error message: " . $e['message'] . "<br>";
      }
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

//------------------------------------Delete Functions-----------------------------------//
    public function deleteFromPlayer($ssn,$pname) {
      $sql = "DELETE FROM player WHERE ssn='$ssn' OR pname='$pname'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't delete Player $ssn from player. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function deleteFrom($table,$ssn,$ename) {
      $sql = "DELETE FROM $table WHERE ssn = '$ssn' OR ename = '$ename'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't delete Employee $ssn from employees. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function deleteFromEposition($position) {
      $errorcode=1;

      $sql = "BEGIN DELETEPOSITION('$position'); END;";
      $statement = @oci_parse($this->conn, $sql);
      // @oci_bind_by_name($statement, ':delposition', $position);
      @oci_execute($statement);
      @oci_free_statement($statement);
      return $errorcode;
    }

    public function deleteFromCoach($ssn,$coachname) {
      $sql = "DELETE FROM coach WHERE ssn='$ssn' OR coachname = '$coachname'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't delete Coach $ssn,$coachname from coach. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

//------------------------------------Update Functions-----------------------------------//
    public function updatePlayer($ssn,$pposition,$shirtnumber) {
      $sql = "UPDATE player
              SET playerposition='$pposition', shirtnumber=$shirtnumber
              WHERE ssn = '$ssn'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't update Player $ssn in player. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function updatePlaysfor($ssn,$team,$psalary) {
      $sql = "UPDATE playsfor
              SET TeamID='$team', salary=$psalary
              WHERE ssn = '$ssn'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't update Player $ssn in playsfor. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function updateEmployee($ssn,$new_position) {
      $sql = "UPDATE employee_position
              SET eposition='$new_position'
              WHERE ssn = '$ssn'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't update Employee $ssn. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function updateEposition($eposition,$salary,$supervisor,$office) {
      $sql = "UPDATE eposition
              SET salary=$salary, supervisor='$supervisor', address='$office'
              WHERE eposition = '$eposition'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't update Position $eposition. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function updateCoach($ssn,$new_position) {
      $sql = "UPDATE coach_position
              SET cposition='$new_position'
              WHERE ssn = '$ssn'";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't update Coach $ssn. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

/*------------------------------------------index.php functions------------------------------------*/
    public function selectFromGame(){
      $sql = "SELECT * FROM game
              ORDER BY schedulenumber ASC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectStartTimeFromGameWhereSchedulenumber($schedulenumber){
      $sql = "SELECT * FROM game
              WHERE schedulenumber='$schedulenumber'";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectTCategoryFromTicketCategory(){
      $sql = "SELECT tcategory FROM ticket_category
              ORDER BY tcategory ASC";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function insertIntoFan($email, $fanname) {
      $sql = "INSERT INTO fan (email,fanname) VALUES ('$email', '$fanname')";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't insert Fan $fanname into fan. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function insertIntoTicket($schedulenumber,$StartTime,$seat) {
      $sql = "INSERT INTO tickets (Bookingnumber,BookingTime,TCategory,schedulenumber,StartTime)
              VALUES (TICKETS_SEQ.NEXTVAL,systimestamp,'$seat',$schedulenumber,'$StartTime')";
      $statement = @oci_parse($this->conn, $sql);
      $success = @oci_execute($statement) && @oci_commit($this->conn);
      if (!$success) {
        $success = "Error! Can't buy Ticket. <br>";
        $e = oci_error($statement);
        $success = $success . "Error message: " . $e['message'] . "<br>";
      }
      @oci_free_statement($statement);
      return $success;
    }

    public function availableTickets($schedulenumber) {
      $sql = "SELECT tcategory FROM ticket_category tc
              WHERE NOT EXISTS
              (SELECT tcategory FROM tickets t
                WHERE tc.tcategory=t.tcategory
                AND t.schedulenumber='$schedulenumber')";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }

    public function selectFromTickets($schedulenumber,$tcategory) {
      $sql = "SELECT * FROM tickets
              WHERE schedulenumber='$schedulenumber'
              AND tcategory='$tcategory'";
      $statement = @oci_parse($this->conn, $sql);
      @oci_execute($statement);
      @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
      @oci_free_statement($statement);
      return $res;
    }
}
?>
