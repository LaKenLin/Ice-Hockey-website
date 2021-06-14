//Database Systems (Module IDS) 

import java.sql.*;
import java.util.ArrayList;


// The DatabaseHelper class encapsulates the communication with our database
class DatabaseHelper {
    // Database connection info
    private static final String DB_CONNECTION_URL = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
    private static final String USER = "a01506926";
    private static final String PASS = "dbs19";

    // The name of the class loaded from the ojdbc14.jar driver file
    //private static final String CLASSNAME = "oracle.jdbc.driver.OracleDriver";

    // We need only one Connection and one Statement during the execution => class variable
    private static Statement stmt;
    private static Connection con;
    
    //CREATE CONNECTION
    DatabaseHelper() {
        try {
            //Loads the class into the memory
            //Class.forName(CLASSNAME);

            // establish connection to database
            con = DriverManager.getConnection(DB_CONNECTION_URL, USER, PASS);
            stmt = con.createStatement();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    
    //INSERT INTO
    void insertIntoClub() {
    	try {
    		stmt.execute("INSERT INTO club (cname,foundingyear) VALUES ('EHC Black Wings Linz', 1992)");
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoClub\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoOffice(String office, int constyear, double floorspace, String openhours) {
    	try {
    		String sql;
    		sql = "INSERT INTO office (address,constyear,floorspace,openhours) VALUES ('" +
    				office +
                    "', " +
                    constyear + 
                    ", " +
                    floorspace + 
                    ", '" +
                    openhours +
                    "')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoOffice\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoStadium() {
    	try {
    		stmt.execute("INSERT INTO stadium (address,constyear,stadiumcapacity,numberparkingspots) VALUES ('Untere Donaulände 11, 4020 Linz', 1986,4863,1200)");
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoStadium\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoDressingroom(int DrNumber, int NumberLockers) {
    	try {
    		String sql;
    		sql = "INSERT INTO dressingroom (address,DrNumber,NumberLockers) VALUES ('Untere Donaulände 11, 4020 Linz', " +
                    DrNumber + 
                    ", " +
                    NumberLockers + 
                    ")";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoDressingroom\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoEPosition(String position, int salary, String supervisor, String issupervisor, String address) {
        try {
        	String sql;
        	if (salary == 10000) {
        		sql = "INSERT INTO eposition VALUES ('" +
                        position +
                        "', " +
                        salary +
                        ", " +
                        supervisor +
                        ", '" +
                        issupervisor +
                        "', '" +
                        address +
                        "')";
        	}
        	else {
        		sql = "INSERT INTO eposition VALUES ('" +
                    position +
                    "', " +
                    salary +
                    ", '" +
                    supervisor +
                    "', '" +
                    issupervisor +
                    "', '" +
                    address +
                    "')";
        	}
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoEposition\nmessage: " + e.getMessage());
        }
    }
    
    void insertIntoEmployees(String ssn, String ename, String birthday) {
        try {
            String sql = "INSERT INTO employees (ssn,ename,birthday) VALUES ('" +
                    ssn +
                    "', '" +
                    ename +
                    "', '" +
                    birthday +
                    "')";
            stmt.execute(sql);
        } catch (Exception e) {
            System.err.println("Error at: insertIntoEmployees\nmessage: " + e.getMessage());
    		System.out.println("Birthday: " + birthday);
        }
    }

    void insertIntoEmployeePosition(String SSN,String position) {
    	try {
    		String sql;
    		sql = "INSERT INTO employee_position VALUES ('" + 
    				SSN + 
    				"', '" +
    				position +
    				"')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoEmployeePosition\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoFlat(String address, double rent, double floorspace) {
    	try {
    		String sql;
    		sql = "INSERT INTO flat (address,rent,floorspace) VALUES ('" + 
    				address + 
    				"', " +
    				rent + 
    				", " +
    				floorspace +
    				")";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoFlat\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoTeam(String TeamID, String AgeRange, String stadium, int DrNumber) {
    	try {
    		String sql;
    		sql = "INSERT INTO Team (TeamID,AgeRange,address,drnumber) VALUES ('" + 
    				TeamID + 
    				"', '" +
    				AgeRange + 
    				"', '" +
    				stadium +
    				"', " +
    				DrNumber +
    				")";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoTeam\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoPlayer(String SSN, String pname, String birthday, String playerposition, String nationality, int shirtnumber) {
    	try {
    		String sql;
    		sql = "INSERT INTO Player (SSN,pname,birthday,playerposition,nationality,shirtnumber) VALUES ('" + 
    				SSN + 
    				"', '" +
    				pname + 
    				"', '" +
    				birthday +
    				"', '" +
    				playerposition +
    				"', '" +
    				nationality + 
    				"', " +
    				shirtnumber +
    				")";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoPlayer\nmessage: " + e.getMessage());
    		System.out.println("Birthday: " + birthday);
    	}
    }
    
    void insertIntoPlaysfor(String SSN, String TeamID, double salary) {
    	try {
    		String sql;
    		sql = "INSERT INTO Playsfor (SSN,TeamID,salary) VALUES ('" + 
    				SSN + 
    				"', '" +
    				TeamID + 
    				"', " +
    				salary +
    				")";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoPlaysfor\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoCPosition(String cposition, double salary, String TeamID) {
    	try {
    		String sql;
    		sql = "INSERT INTO CPosition (cposition,salary,teamid) VALUES ('" + 
    				cposition +
    				"', " +
    				salary +
    				", '" +
    				TeamID +
    				"')";
    		stmt.execute(sql);
    	}catch (Exception e) {
    		System.err.println("Error at: insertIntoCPosition\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoCoach(String SSN, String CoachName, String birthday) {
    	try {
    		String sql;
    		sql = "INSERT INTO Coach (SSN,CoachName,birthday) VALUES ('" + 
    				SSN + 
    				"', '" +
    				CoachName + 
    				"', '" +
    				birthday +
    				"')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoCoach\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoCoachPosition(String SSN, String cposition) {
    	try {
    		String sql;
    		sql = "INSERT INTO Coach_position (SSN,cposition) VALUES ('" + 
    				SSN + 
    				"', '" +
    				cposition +
    				"')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoCoachPosition\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoGameLocation(String opponent, String HomeAway, String glocation) {
    	try {
    		String sql;
    		sql = "INSERT INTO Game_location (opponent,HomeAway,glocation) VALUES ('" + 
    				opponent + 
    				"', '" +
    				HomeAway + 
    				"', '" +
    				glocation +
    				"')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoGameLocation\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoGameLocation(String opponent, String HomeAway) {
    	try {
    		String sql;
    		sql = "INSERT INTO Game_location (opponent,HomeAway) VALUES ('" + 
    				opponent + 
    				"', '" +
    				HomeAway + 
    				"')";
    		stmt.execute(sql);
    	} catch (Exception e) {
    		System.err.println("Error at: insertIntoGameLocation\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoGame(int schedulenumber, String StartTime, String TeamID, String Opponent, String HomeAway) {
    	try {
    		String sql;
    		sql = "INSERT INTO game VALUES (" +
    				schedulenumber + 
    				" ,'" +
    				StartTime + 
    				"', '" +
    				TeamID + 
    				"', '" +
    				Opponent + 
    				"', '" +
    				HomeAway + 
    				"')";
    		stmt.execute(sql);
    	}catch (Exception e) {
    		System.err.println("Error at: insertIntoGame\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoFan(String email, String fanname) {
    	try {
    		String sql;
    		sql = "INSERT INTO fan (email,fanname) VALUES ('" +
    				email + 
    				"' ,'" +
    				fanname +
    				"')";
    		stmt.execute(sql);
    	}catch (Exception e) {
    		System.err.println("Error at: insertIntoFan\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoTicketCategory(String TCategory, double Price) {
    	try {
    		String sql;
    		sql = "INSERT INTO ticket_category (TCategory,Price) VALUES ('" +
    				TCategory + 
    				"' ," +
    				Price +
    				")";
    		stmt.execute(sql);
    	}catch (Exception e) {
    		System.err.println("Error at: insertIntoTicketCategory\nmessage: " + e.getMessage());
    	}
    }
    
    void insertIntoTicket(String TCategory, int schedulenumber, String StartTime) {
    	try {
    		String sql;
    		sql = "INSERT INTO tickets (Bookingnumber,BookingTime,TCategory,schedulenumber,StartTime)" + 
    				"VALUES (TICKETS_SEQ.NEXTVAL,systimestamp,'" +
    				TCategory + 
    				"' ," +
    				schedulenumber + 
    				", '" +
    				StartTime + 
    				"')";
    		stmt.execute(sql);    		
    	}catch (Exception e) {
    		System.err.println("Error at: insertIntoTicket\nmessage: " + e.getMessage());
    	}
    }
    
    
    
    //Select methods
    ArrayList<String> selectTeamIDFromTeam() {
        ArrayList<String> TeamIDs = new ArrayList<>();

        try {
            ResultSet rs = stmt.executeQuery("SELECT TeamID FROM Team");
            while (rs.next()) {
                TeamIDs.add(rs.getString("TeamID"));
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectTeamIDFromTeam\n message: " + e.getMessage()).trim());
        }
        return TeamIDs;
    }
    
    ArrayList<ArrayList<String>> selectOpponentHAFromGameLocation() {
        ArrayList<ArrayList<String>> OpponentHA = new ArrayList<ArrayList<String>>();
        ArrayList<String> Opponent = new ArrayList<>();
        ArrayList<String> HomeAway = new ArrayList<>();
        try {
            ResultSet rs = stmt.executeQuery("SELECT opponent FROM game_location");
            while (rs.next()) {
                Opponent.add(rs.getString("opponent"));
            }
            rs.close();
            for (int i=0;i<Opponent.size();i++) {
            	if (i%2==1) {
            		HomeAway.add("A");
            	} else
            		HomeAway.add("H");
            	}
            OpponentHA.add(Opponent);
            OpponentHA.add(HomeAway);
            } catch (Exception e) {
            System.err.println(("Error at: selectTeamIDFromTeam\n message: " + e.getMessage()).trim());
        }
        return OpponentHA;
    }
    
    String selectStartTimeFromGame(int schedulenumber) {
        String StartTime = "0";

        try {
            ResultSet rs = stmt.executeQuery("SELECT StartTime FROM Game WHERE schedulenumber = " + schedulenumber);
            while (rs.next()) {
                StartTime = rs.getString("StartTime");
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectStartTimeFromGame\n message: " + e.getMessage()).trim());
        }
        return StartTime;
    }
    
    String selectAddressFromStadium() {
    	String address = "";
    	try {
    		ResultSet rs = stmt.executeQuery("SELECT address FROM stadium");
    		while (rs.next()) {
    			address = rs.getString("address");
    		}
    		rs.close();
    	} catch (Exception e) {
            System.err.println(("Error at: selectAddressFromStadium\n message: " + e.getMessage()).trim());
        }
        return address;
    }
    
    ArrayList<Integer> selectDrNumberFromDressingroom() {
        ArrayList<Integer> DrNumbers = new ArrayList<>();
        try {
            ResultSet rs = stmt.executeQuery("SELECT DrNumber FROM dressingroom");
            while (rs.next()) {
                DrNumbers.add(rs.getInt("DrNumber"));
            }
            rs.close();
        } catch (Exception e) {
            System.err.println(("Error at: selectDrNumberFromDressingroom\n message: " + e.getMessage()).trim());
        }
        return DrNumbers;
    }
    
    int count(String table) {
    	int count=0;
    	try {
    		ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM " + table);
    		while (rs.next()){
    			count = rs.getInt("COUNT(*)");
    		}
    	} catch (Exception e) {
    		System.err.println("Error at: count\nmessage: " + e.getMessage());
    	}
    	return count;
    }
    
    public void close()  {
        try {
            stmt.close(); //clean up
            con.close();
        } catch (Exception ignored) {
        }
    }
}