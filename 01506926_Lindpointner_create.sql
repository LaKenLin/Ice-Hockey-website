alter session set nls_timestamp_format='DD-MM-YY HH24:MI';
alter session set nls_date_format='DD-MM-YY';

CREATE TABLE club (
  cname             varchar(25),
  foundingyear      int CONSTRAINT club_foundingyear_NN NOT NULL,
  CONSTRAINT club_pk PRIMARY KEY(cname)
);

CREATE TABLE office (
  address           varchar(40),
  constyear         numeric(4,0) CONSTRAINT office_constyear_NN NOT NULL,
  floorspace        real CONSTRAINT office_floorspace_NN NOT NULL,
  openhours         varchar(40),
  cname             varchar(25) DEFAULT 'EHC Black Wings Linz',
  CONSTRAINT office_pk PRIMARY KEY(address),
  CONSTRAINT office_fk_club FOREIGN KEY(cname) REFERENCES club,
  CONSTRAINT office_check_floorspace CHECK(floorspace>0)
);

CREATE TABLE employees (
  ssn               varchar(10),
  ename             varchar(30) CONSTRAINT employees_name_NN NOT NULL,
  birthday          date,
  cname             varchar(25) DEFAULT 'EHC Black Wings Linz',
  CONSTRAINT employees_pk PRIMARY KEY(ssn),
  CONSTRAINT employees_fk_club FOREIGN KEY(cname) REFERENCES club
);

CREATE TABLE eposition (
  eposition         varchar(50),
  salary            int DEFAULT 0 CONSTRAINT eposition_salary_NN NOT NULL,
  supervisor        varchar(50),
  issupervisor      varchar(1) CONSTRAINT eposition_issupervisor_NN NOT NULL,
  address           varchar(40) CONSTRAINT eposition_address_NN NOT NULL,    /*of the office they're working at*/
  CONSTRAINT eposition_pk PRIMARY KEY(eposition),
  CONSTRAINT eposition_fk_office FOREIGN KEY(address) REFERENCES office
                    ON DELETE SET NULL
);
ALTER TABLE eposition ADD CONSTRAINT eposition_fk_eposition FOREIGN KEY(supervisor) REFERENCES eposition(eposition);

CREATE TABLE employee_position (
  ssn               varchar(10),
  eposition         varchar(50),
  CONSTRAINT employee_position_pk PRIMARY KEY (ssn),
  CONSTRAINT employee_position_fk_employees FOREIGN KEY(ssn) REFERENCES employees(ssn)
                    ON DELETE CASCADE,
  CONSTRAINT employee_position_fk_eposition FOREIGN KEY(eposition) REFERENCES eposition(eposition)
                      ON DELETE SET NULL
);

CREATE TABLE stadium (
  address           varchar(40),
  ConstYear         numeric(4,0),
  StadiumCapacity   int,
  NumberParkingspots  int,
  cname             varchar(25) DEFAULT 'EHC Black Wings Linz',
  CONSTRAINT stadium_pk PRIMARY KEY(address),
  CONSTRAINT stadium_fk_club FOREIGN KEY(cname) REFERENCES club,
  CONSTRAINT stadium_check_constructionyear CHECK(constyear>0),
  CONSTRAINT stadium_check_stadiumcapacity CHECK(stadiumcapacity>0),
  CONSTRAINT stadium_check_numberparkingspots CHECK(numberparkingspots>0)
);

CREATE TABLE dressingroom (
  address           varchar(40),    /*inherited from the strong stadium entity*/
  DrNumber          int,            /*unique number of the dressing room within the stadium*/
  NumberLockers     int,
  CONSTRAINT dressingroom_pk PRIMARY KEY(address, drnumber),
  CONSTRAINT dressingroom_fk_stadium FOREIGN KEY(address) REFERENCES stadium
                    ON DELETE CASCADE,
  CONSTRAINT dressingroom_check_drnumber CHECK(drnumber>0),
  CONSTRAINT dressingroon_check_numberlockers CHECK(numberlockers>0)
);

CREATE TABLE flat (
  address           varchar(80),
  rent              real DEFAULT 0,
  floorspace        real CONSTRAINT flat_floorspace_NN NOT NULL,
  cname             varchar(25) DEFAULT 'EHC Black Wings Linz',
  CONSTRAINT flat_pk PRIMARY KEY(address),
  CONSTRAINT flat_fk_club FOREIGN KEY(cname) REFERENCES club
  );

CREATE TABLE player (
  ssn               varchar(10),
  pname             varchar(50) CONSTRAINT player_name_NN NOT NULL,
  birthday          date,
  playerposition    varchar(2) CONSTRAINT player_playerposition_NN NOT NULL,
  nationality       varchar(50) CONSTRAINT player_nationality_NN NOT NULL,
  shirtnumber       int DEFAULT 1 CONSTRAINT player_shirtnumber_NN NOT NULL,
  CONSTRAINT player_pk PRIMARY KEY(ssn),
  CONSTRAINT player_check_shirtnumber CHECK(shirtnumber BETWEEN 1 AND 98)
);

CREATE TABLE team (
  teamID            varchar(3),
  AgeRange          varchar(5) CONSTRAINT team_agerange_NN NOT NULL,
  cname             varchar(25) DEFAULT 'EHC Black Wings Linz',
  address           varchar(40),    /*Address and number of the dressing room, the team is placed in*/
  DRnumber          int,
  CONSTRAINT team_pk PRIMARY KEY(teamID),
  CONSTRAINT team_uk_age UNIQUE(AgeRange),
  CONSTRAINT team_fk_club FOREIGN KEY(cname) REFERENCES club,
  CONSTRAINT team_fk_dressingroom FOREIGN KEY(address,drnumber) REFERENCES dressingroom
                    ON DELETE SET NULL
);

CREATE TABLE playsfor (
  ssn               varchar(10),
  teamID            varchar(3),
  salary            real DEFAULT 0,
  address           varchar(40) DEFAULT NULL,    /*address of the flat the player is living in, if applicable*/
  CONSTRAINT playsfor_pk PRIMARY KEY(ssn),
  CONSTRAINT playsfor_fk_player FOREIGN KEY(ssn) REFERENCES player
                    ON DELETE CASCADE,
  CONSTRAINT playsfor_fk_team FOREIGN KEY(teamID) REFERENCES team
                    ON DELETE SET NULL,
  CONSTRAINT player_fk_flat FOREIGN KEY(address) REFERENCES flat
                    ON DELETE SET NULL,
  CONSTRAINT flat_uk_address UNIQUE(address)
);

CREATE TABLE coach (
  ssn               varchar(10),
  CoachName         varchar(30) CONSTRAINT coach_name_NN NOT NULL,
  birthday          date,
  CONSTRAINT coach_pk PRIMARY KEY(ssn)
);

CREATE TABLE cposition (
  cposition         varchar(50),
  salary            real DEFAULT 0,
  teamID            varchar(3),
  CONSTRAINT cposition_pk PRIMARY KEY(cposition),
  CONSTRAINT cposition_fk_team FOREIGN KEY(teamID) REFERENCES team
                    ON DELETE CASCADE
);
  
CREATE TABLE coach_position (
  ssn               varchar(10),
  cposition         varchar(50),
  CONSTRAINT coach_position_pk PRIMARY KEY(ssn),
  CONSTRAINT coach_position_fk_coach FOREIGN KEY(ssn) REFERENCES coach
                    ON DELETE CASCADE,
  CONSTRAINT coach_position_fk_cposition FOREIGN KEY(cposition) REFERENCES cposition
                    ON DELETE SET NULL
);

CREATE TABLE game_location (
  opponent          varchar(25),
  HomeAway          varchar(1),
  glocation         varchar(60) DEFAULT 'Untere Donaulände 11, 4020 Linz' CONSTRAINT game_location_NN NOT NULL,
  CONSTRAINT game_location_pk PRIMARY KEY(opponent,Homeaway)
);

CREATE TABLE game (
  ScheduleNumber    int,
  StartTime         timestamp,
  teamID            varchar(3) CONSTRAINT game_teamid_NN NOT NULL,
  opponent          varchar(25) CONSTRAINT game_opponent_NN NOT NULL,
  HomeAway          varchar(1)  CONSTRAINT game_homeaway_NN NOT NULL,
  CONSTRAINT game_pk PRIMARY KEY(schedulenumber,StartTime),
  CONSTRAINT game_uk UNIQUE(schedulenumber,teamID),
  CONSTRAINT game_fk_team FOREIGN KEY(teamID) REFERENCES team
                    ON DELETE CASCADE,
  CONSTRAINT game_fk_game_location FOREIGN KEY(opponent,HomeAway) REFERENCES game_location
                    ON DELETE CASCADE
);
  
CREATE TABLE ticket_category (
  TCategory         varchar(10),
  price             real NOT NULL,
  CONSTRAINT ticket_category_pk PRIMARY KEY(Tcategory)
);

CREATE TABLE tickets (
  BookingNumber     int,
  BookingTime       timestamp,
  TCategory         varchar(10) CONSTRAINT tickets_tcategory_NN NOT NULL,
  ScheduleNumber    int,
  StartTime         timestamp ,
  CONSTRAINT tickets_pk PRIMARY KEY(bookingnumber),
  CONSTRAINT tickets_fk_category FOREIGN KEY(tcategory) REFERENCES ticket_category,
  CONSTRAINT tickets_fk_game FOREIGN KEY(schedulenumber, StartTime) REFERENCES game(schedulenumber,StartTime),
  CONSTRAINT tickets_uk UNIQUE(Tcategory,schedulenumber)
);

CREATE TABLE fan (
  email             varchar(50),
  fanname           varchar(50) CONSTRAINT fan_fanname_NN NOT NULL,
  cname             varchar(25) DEFAULT 'EHC Black Wings Linz',
  CONSTRAINT fan_pk PRIMARY KEY(email),
  CONSTRAINT fan_fk_club FOREIGN KEY(cname) REFERENCES club
);

CREATE SEQUENCE  "A01506926"."TICKETS_SEQ"
MINVALUE 1 MAXVALUE 9999999999999999999999999999 
INCREMENT BY 1 
START WITH 1 
CACHE 20
NOORDER
NOCYCLE
NOKEEP
NOSCALE
GLOBAL;

CREATE TRIGGER TICKETS_TRG 
BEFORE INSERT ON TICKETS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.BOOKINGNUMBER IS NULL THEN
      SELECT TICKETS_SEQ.NEXTVAL INTO :NEW.BOOKINGNUMBER FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/

CREATE OR REPLACE PROCEDURE deletePOSITION(delposition IN eposition.eposition%TYPE)
IS
BEGIN
  DELETE eposition where eposition = delposition;
  
  COMMIT;

END;
/

/*The following three views show the collected data for each employee, player and coach*/
CREATE VIEW EmployeeWithInfo(SSN,EName,EPosition,Salary,Office)
AS  SELECT ssn,ename,eposition,salary,address
    FROM (employees NATURAL JOIN employee_position) NATURAL JOIN eposition;
    
CREATE VIEW PlayerWithInfo(SSN,PName,Birthday,PPosition,Nationality,Shirtnumber,Team,Salary)
AS  SELECT ssn,pname,birthday,playerposition,nationality,shirtnumber,teamid,salary
    FROM player NATURAL JOIN playsfor;
    
CREATE VIEW CoachWithInfo(SSN,CName,CPosition,Salary,Team)
AS  SELECT ssn,coachname,cposition,salary,teamid
    FROM (coach NATURAL JOIN coach_position) NATURAL JOIN cposition;
  
/*This view shows Positions which supervise other positions and the number of supevised positons.*/
CREATE VIEW PositionSupervises(EPosition,NofSupervisees)
AS  SELECT supervisor,COUNT(supervisor)
    FROM eposition
    WHERE supervisor IS NOT NULL
    GROUP BY(supervisor)
    ORDER BY COUNT(supervisor) DESC;
    
/*This view shows the club's players' nationalities and how many players there are with each nationality.*/
CREATE VIEW PlayerNationalities(Nationality,Number_of_players)
AS  SELECT nationality,count(nationality)
    FROM player
    GROUP BY(nationality)
    ORDER BY count(nationality) DESC;
    
/*This view shows salary data of employees and players.*/
CREATE VIEW SalaryData (Categories,Number_of_Entries,Sum_of_Salary,Average_Salary,Max_Salary,Min_Salary)
AS  SELECT 'Players' as TableName,count(ssn),sum(salary),avg(salary),max(salary),min(salary) FroM playsfor WHERE SALARY>0
    UNION
    SELECT 'Positions' as TableName,count(eposition),sum(salary),avg(salary),max(salary),min(salary) FROM eposition;
    
/*This view shows all games for which more than 900 tickets were sold.*/
CREATE VIEW TicketsPerGame(Schedule_Number,Sold_Tickets)
AS  SELECT schedulenumber,count(*)
    FROM tickets
    GROUP BY schedulenumber
    HAVING count(*)>900;
    
CREATE VIEW TeamWithInfo(Team,PPOSITION, PLAYERCOUNTER)
AS  SELECT 'PRO' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='PRO' GROUP BY PPOSITION
    UNION
    SELECT 'U21' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U21' GROUP BY PPOSITION
    UNION
    SELECT 'U19' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U19' GROUP BY PPOSITION
    UNION
    SELECT 'U17' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U17' GROUP BY PPOSITION
    UNION
    SELECT 'U15' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U15' GROUP BY PPOSITION
    UNION
    SELECT 'U13' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U13' GROUP BY PPOSITION
    UNION
    SELECT 'U11' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U11' GROUP BY PPOSITION
    UNION
    SELECT 'U9' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U9' GROUP BY PPOSITION
    UNION
    SELECT 'U7' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U7' GROUP BY PPOSITION
    UNION
    SELECT 'U5' AS TableName, pposition,count(pposition) FROM PLAYERWITHINFO WHERE TEAM='U5' GROUP BY PPOSITION;