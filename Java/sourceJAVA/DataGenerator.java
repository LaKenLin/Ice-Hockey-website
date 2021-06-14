//Database Systems (Module IDS) 

import java.util.ArrayList;
import java.util.*;

public class DataGenerator {
    public static void main(String args[]) {

        RandomHelper rdm = new RandomHelper();
        DatabaseHelper dbHelper = new DatabaseHelper();
        
        //Insert into Club
        dbHelper.insertIntoClub();
        
        //Insert into Offices
        for (int i = 0;i < rdm.getOfficesSize();i++) {
        	String office = rdm.getOffice(i);
        	int constyear = rdm.getRandomInteger(1950,2017);
        	double floorspace = rdm.getRandomDouble(250,500,1);
        	String openhours = "Mo-Fr 09:00-18:00";
        	dbHelper.insertIntoOffice(office,constyear,floorspace,openhours);
        }
        
        //Insert into Stadium
        dbHelper.insertIntoStadium();
        
        //Insert into Dressingroom
        for (int i = 1; i <= 10; i++) {
        	dbHelper.insertIntoDressingroom(i, rdm.getRandomInteger(25,35));
        }

        // Insert into Eposition
		for (int i = 0; i < rdm.getPositionsSize(); i++) {
        	String position = rdm.getPosition(i);
        	String supervisor;
        	String issupervisor;
        	int salary;
        	String address;
        	if (i==0) {
        		salary = 10000;
        		supervisor = "NULL";
        		issupervisor = "Y";
        		address = rdm.getOffice(0);
        	}
        	else if (i>0 && i<15) {
            	salary = 8000;
            	supervisor = rdm.getPosition(0);
            	issupervisor = "Y";
            	address = rdm.getOffice(0);
            }
            else {
            	salary = 5000;
            	supervisor = rdm.getPosition(rdm.getRandomInteger(0, 14));
            	issupervisor = "N";
            	address = rdm.getOffice(rdm.getRandomInteger(1, rdm.getOfficesSize()-1));
            }
            dbHelper.insertIntoEPosition(position, salary,supervisor,issupervisor,address);
        }
        
        // Insert Into Employees and employee_position
        for (int i = 0; i < 100; i++) {
            String ename = rdm.getRandomFirstName() + " " + rdm.getRandomLastName();				//Insert into Employee Part
            ArrayList<String> ssnbirthday = rdm.getRandomSSNbirthday(rdm.getYears());
            dbHelper.insertIntoEmployees(ssnbirthday.get(0), ename,ssnbirthday.get(1));
            
            String position;																		//Insert into Employee_position Part
            if (i<14) {
            	position = rdm.getPosition(i);
            } else {
            	position = rdm.getPosition(rdm.getRandomInteger(15,rdm.getPositionsSize()-1));
            }
            dbHelper.insertIntoEmployeePosition(ssnbirthday.get(0),position);
        }
        
        //Insert into flat
        for (int i = 0; i < 100; i++) {
        	String address = rdm.getRandomAddress();
        	double rent = rdm.getRandomDouble(1000, 2300, 2);
        	double floorspace = rdm.getRandomDouble(65, 140, 1);
        	dbHelper.insertIntoFlat(address,rent,floorspace);
        }

        //Insert into Team
        ArrayList<Integer> DrNumber = dbHelper.selectDrNumberFromDressingroom();
        int index=0;
        for (int i = 22; i > 4; i--) {
        	if (i==22) {
        		dbHelper.insertIntoTeam("PRO","PRO",dbHelper.selectAddressFromStadium(),DrNumber.get(index));
        		++index;
        		continue;
        	}
        	String TeamID = "U" +i;
        	int j = i-1;
    		String AgeRange = i + "-" + j;
    		dbHelper.insertIntoTeam(TeamID,AgeRange,dbHelper.selectAddressFromStadium(),DrNumber.get(index));
    		--i;
    		++index;
        }
       
        //Insert into Player
        for (int i = 0; i<250;i++) {
            String pname = rdm.getRandomPlayerName() + " " + rdm.getRandomLastName();				//Insert into Employee Part
            ArrayList<String> ssnbirthday = rdm.getRandomSSNbirthday(rdm.getPlayerYears());
            String nationality = rdm.getNationality(rdm.getRandomInteger(0,rdm.getNationalitiesSize()-1));
            String playerposition = rdm.getRandomPlayerposition();
            dbHelper.insertIntoPlayer(ssnbirthday.get(0), pname,ssnbirthday.get(1),playerposition,nationality,rdm.getRandomInteger(1, 98));
            int age = 2019 - Integer.parseInt(ssnbirthday.get(2));
            if (age >21 && age < 35) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"PRO",rdm.getRandomDouble(3000,9000,2));
            }else if (age == 21 || age == 20) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U21",0);
            }else if (age == 19 || age == 18) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U19",0);
            }else if (age == 17 || age == 16) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U17",0);
            }else if (age == 15 || age == 14) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U15",0);
            }else if (age == 13 || age == 12) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U13",0);
            }else if (age == 11 || age == 10) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U11",0);
            }else if (age == 9 || age == 8) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U9",0);
            }else if (age == 7 || age == 6) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U7",0);
            }else if (age == 5 || age == 4) {
            	dbHelper.insertIntoPlaysfor(ssnbirthday.get(0),"U5",0);
            }
        }
        
        //Insert into cposition
        for (int i = 0;i < 50;i++) {
        	String Position = rdm.getCoachPosition(i);
        	double salary = rdm.getRandomDouble(3500,7500,2);
        	String TeamID = Position.substring(Position.length()-3,Position.length());
        	if(TeamID.equals(" U9") || TeamID.equals(" U7") || TeamID.equals(" U5")) {
        		TeamID = Position.substring(Position.length()-2,Position.length());
        	}
        	dbHelper.insertIntoCPosition(Position,salary,TeamID);
        }
        
        //Insert into Coach
        for (int i = 0; i < 50; i++) {
            String CoachName = rdm.getRandomFirstName() + " " + rdm.getRandomLastName();
            ArrayList<String> ssnbirthday = rdm.getRandomSSNbirthday(rdm.getYears());
            dbHelper.insertIntoCoach(ssnbirthday.get(0), CoachName, ssnbirthday.get(1));
            String cposition = rdm.getCoachPosition(i);
            dbHelper.insertIntoCoachPosition(ssnbirthday.get(0),cposition);
        }
       
        //Insert into game_location
        for (int i = 0; i < rdm.getOpponentsSize(); i++) {
        	dbHelper.insertIntoGameLocation(rdm.getOpponent(i), "H");
        	dbHelper.insertIntoGameLocation(rdm.getOpponent(i), "A", rdm.getRandomAddress());
        }
        
        //Insert into game
        int schedulenumber = 1;
        Integer arr[] = {4,6,9,11};
        Set<Integer> thirtymonths = new HashSet<>(Arrays.asList(arr));
        Integer arr1[] = {1,3,5,7,8,10,12};
        Set<Integer> thirty1months = new HashSet<>(Arrays.asList(arr1));
        int day = 14;
        int month = 9;
        int year = 19;
        String Time = " 19:15";
        String TeamID = "PRO";
       	ArrayList<ArrayList<String>> OpponentHA = dbHelper.selectOpponentHAFromGameLocation();
        int OpponentIndex = 0;
       	for (int i = 1; i<= 44; i++) {
        	String Date = rdm.DateBuilder(day, month, year);
        	String StartTime = Date + Time;
        	String Opponent = OpponentHA.get(0).get(OpponentIndex);
        	String HomeAway = OpponentHA.get(1).get(OpponentIndex);
        	dbHelper.insertIntoGame(schedulenumber, StartTime, TeamID, Opponent, HomeAway);
        	//day += 3;
        	if (thirtymonths.contains(month) && day>27) {
        		day = 0 + (day-30) + 3;
        		month += 1;
        	}else if (thirty1months.contains(month) && day>28) {
        		day = 0 + (day-31) + 3;
        		month += 1;
        	}else if (month == 2 && day>25) {
        		day = 0 + (day-28) + 3;
        		month += 1;
        	}else {
        		day += 3;
        	}
        	if (month == 13) {
        		month = 1;
        		year += 1;
        	}
        	schedulenumber += 6;
        	OpponentIndex +=1;
        	if (OpponentIndex == OpponentHA.get(0).size()) {
        		OpponentIndex = 0;
        	}	
        }
        
        //INSERT into Fan
        for (int i=0; i<2000; i++) {
        	String fristname = rdm.getRandomFirstName();
        	String lastname = rdm.getRandomLastName();
        	String fanname = fristname + " " + lastname;
        	String email = fristname + "." + lastname + "@gmail.com";
        	dbHelper.insertIntoFan(email,fanname);
        }
        
        //Insert into Ticket_category
       	ArrayList<String> allTickets = rdm.getAllTickets();
        for (int i = 0; i < allTickets.size(); i++)
        	dbHelper.insertIntoTicketCategory(allTickets.get(i), 25);
        
       	//Insert into Ticket
       	for (int scheduleNumber = 1; scheduleNumber <= 25; scheduleNumber+=12) {
       		for (int sold = 1; sold < 1000; sold++) {
       			String Mistake = dbHelper.selectStartTimeFromGame(scheduleNumber);
       			String StartTime = Mistake.substring(8,10) + Mistake.substring(4,7) + "-" + Mistake.substring(2,4) + Mistake.substring(10);
       			dbHelper.insertIntoTicket(allTickets.get(sold), scheduleNumber, StartTime);
       		}
       	}
       	
       	
       	System.out.println("Club: " + dbHelper.count("club"));
       	System.out.println("Office: " + dbHelper.count("Office"));
       	System.out.println("Stadium: " + dbHelper.count("stadium"));
       	System.out.println("Dressingroom: " + dbHelper.count("dressingroom"));
       	System.out.println("Eposition: " + dbHelper.count("eposition"));
       	System.out.println("Employees: " + dbHelper.count("employees"));
       	System.out.println("employee_position: " + dbHelper.count("employee_position"));
       	System.out.println("Flat: " + dbHelper.count("flat"));
       	System.out.println("Player: " + dbHelper.count("player"));
       	System.out.println("Team: " + dbHelper.count("team"));
       	System.out.println("playsfor: " + dbHelper.count("playsfor"));
       	System.out.println("Coach: " + dbHelper.count("coach"));
       	System.out.println("Cposition: " + dbHelper.count("cposition"));
       	System.out.println("Coach_position: " + dbHelper.count("coach_position"));
       	System.out.println("game_location: " + dbHelper.count("game_location"));
       	System.out.println("Game: " + dbHelper.count("game"));
       	System.out.println("Fan: " + dbHelper.count("fan"));
       	System.out.println("Tickets: " + dbHelper.count("tickets"));
       	System.out.println("Ticket category: " + dbHelper.count("ticket_category"));
       	dbHelper.close();
    }
}
