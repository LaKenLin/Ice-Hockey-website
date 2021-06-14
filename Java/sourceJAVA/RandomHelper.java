//Database Systems (Module IDS) 

import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.Random;
import java.util.Set;

// The RandomHelper class wraps around the JAVA Random class to provide convenient access to random data as we need it
// Additionally it provides access to external single-columned files (e.g. courses.csv, names.csv, surnames.csv)
class RandomHelper {
    private Random rand;
    private ArrayList<String> firstNames;
    private ArrayList<String> playerNames;
    private ArrayList<String> lastNames;
    private ArrayList<String> Years;
    private ArrayList<String> PlayerYears;
    private ArrayList<String> Months;
    private ArrayList<String> Days;
    private ArrayList<String> Positions;
    private ArrayList<String> Offices;
    private ArrayList<String> OfficeCities;
    private ArrayList<String> Streets;
    private ArrayList<String> Cities;
    private ArrayList<String> Nationalities;    
    private ArrayList<String> Playerpositions;
    private ArrayList<String> Coachpositions;
    private ArrayList<String> Opponents;
    private static final String firstNameFile = "./resources/names.csv";
    private static final String playerNameFile = "./resources/playernames.csv";
    private static final String lastNameFile = "./resources/surnames.csv";
    private static final String YearsFile = "./resources/years.csv";
    private static final String MonthsFile = "./resources/months.csv";
    private static final String DaysFile = "./resources/days.csv";
    private static final String PositionsFile = "./resources/positions.csv";
    private static final String OfficesFile = "./resources/offices.csv";
    private static final String OfficeCitiesFile = "./resources/officecities.csv";
    private static final String StreetsFile = "./resources/streetnames.csv";
    private static final String CitiesFile = "./resources/ortsnamen.csv";
    private static final String NationalitiesFile = "./resources/nationalities.csv";
    private static final String PlayerpositionsFile = "./resources/playerpositions.csv";
    private static final String CoachpositionsFile = "./resources/coachpositions.csv";
    private static final String PlayerYearsFile = "./resources/PlayerYears.csv";
    private static final String OpponentsFile = "./resources/opponents.csv";

    //instantiate the Random object and store data from files in lists
    RandomHelper() {
        this.rand = new Random();
        this.lastNames = readFile(lastNameFile);
        this.firstNames = readFile(firstNameFile);
        this.playerNames = readFile(playerNameFile);
        this.Years = readFile(YearsFile);
        this.Months = readFile(MonthsFile);
        this.Days = readFile(DaysFile);
        this.Positions = readFile(PositionsFile);
        this.Offices = readFile(OfficesFile);
        this.OfficeCities = readFile(OfficeCitiesFile);
        this.Streets = readFile(StreetsFile);
        this.Cities = readFile(CitiesFile);
        this.Nationalities = readFile(NationalitiesFile);
        this.Playerpositions = readFile(PlayerpositionsFile);
        this.Coachpositions = readFile(CoachpositionsFile);
        this.PlayerYears = readFile(PlayerYearsFile);
        this.Opponents = readFile(OpponentsFile);
    }
    
    //returns random element from list
    String getRandomFirstName() {
        return firstNames.get(getRandomInteger(0, firstNames.size() - 1));
    }

    String getRandomPlayerName(){
    	return playerNames.get(getRandomInteger(0, playerNames.size()-1));
    }
    
    //returns random element from list
    String getRandomLastName() {
        return lastNames.get(getRandomInteger(0, lastNames.size() - 1));
    }
    
    String getRandomPlayerposition() {
    	return Playerpositions.get(getRandomInteger(0,Playerpositions.size()-1));
    }
    
    ArrayList<String> getRandomSSNbirthday(ArrayList<String> Years) {
    	ArrayList<String> Date = getRandomDate(Years);
    	String ssn = Date.get(0) + Date.get(1) + Date.get(2).substring(2,4) + Integer.toString(getRandomInteger(1000,9999));
    	String birthday = Date.get(0) + "-" + Date.get(1) + "-" + Date.get(2); 
    	ArrayList<String> ssnbirthday = new ArrayList<String>();
    	ssnbirthday.add(ssn);
    	ssnbirthday.add(birthday);
    	ssnbirthday.add(Date.get(2));
    	return ssnbirthday;
    }
    
    ArrayList<String> getRandomDate(ArrayList<String> Years) {
    	ArrayList<String> Date = new ArrayList<String>();
    	String year = Years.get(getRandomInteger(0,Years.size()-1));
    	String month = Months.get(getRandomInteger(0,11));
    	String day;
        Integer arr[] = {4,6,9,11}; Set<Integer> thirtymonths = new HashSet<>(Arrays.asList(arr));
        Integer arr1[] = {1,3,5,7,8,10,12}; Set<Integer> thirty1months = new HashSet<>(Arrays.asList(arr1));
    	if(thirty1months.contains(Integer.getInteger(month))) {
    		day = Days.get(getRandomInteger(0,Months.size()-1));
    	}
    	else if(thirtymonths.contains(Integer.getInteger(month))) {
    		day = Days.get(getRandomInteger(0,Months.size()-2));
    	}
    	else {
    		day = Days.get(getRandomInteger(0,27));
    	}
    	Date.add(day);
    	Date.add(month);
    	Date.add(year);
    	return Date;
    }
    
    String DateBuilder(int day,int month,int year) {
    	return day + "-" + month + "-" + year;
    }
    
    String getRandomAddress () {
    	String street = Streets.get(getRandomInteger(0,Streets.size()-1));
    	String city = Cities.get(getRandomInteger(0,Cities.size()-1));
    	int number = getRandomInteger(1,100);
    	int postalcode = getRandomInteger(2000,9000);
    	return street + " " + number + ", " + postalcode+ " " + city;
    }
    
    ArrayList<String> getAllTickets() {
    	ArrayList<String> AllTickets = new ArrayList<String>();
    	for (int i = 1; i<= 10; i++) {
    		for (int j = 1; j <= 120; j++) {
    			AllTickets.add("W" + i + 'S' + j);
    			AllTickets.add("E" + i + 'S' + j);
    			if (j<57) {
    				AllTickets.add("S" + i + 'S' + j);
    				AllTickets.add("N" + i + 'S' + j);
    			}
    		}
    	}
    	
    	return AllTickets;
    }
    
    String getRandomTicket(String block) {
    	return block + getRandomInteger(1,10) + "S" + getRandomInteger(1,120);
    }
    
    
    
    //Get functions
    ArrayList<String> getYears () {
    	return Years;
    }
    
    ArrayList<String> getPlayerYears () {
    	return PlayerYears;
    }
    
    String getPosition (int i) {
    	return Positions.get(i);
    }
    
    String getOffice (int i) {
    	String Office = Offices.get(i) + ", " + OfficeCities.get(i);
    	return Office;
    }
    
    String getNationality(int i) {
    	return Nationalities.get(i);
    }
    
    String getOpponent(int i) {
    	return Opponents.get(i);
    }
    
    String getCoachPosition(int i) {
    	return Coachpositions.get(i);
    }
    
    //Get Sizes of Array lists
    Integer getOfficesSize() {
    	return Offices.size();
    }
    
    Integer getPositionsSize() {
    	return Positions.size();
    }
    
    Integer getNationalitiesSize() {
    	return Nationalities.size();
    }
    
    Integer getOpponentsSize() {
    	return Opponents.size();
    }
    
    //returns random double from the Interval [min, max] and a defined precision (e.g. precision:2 => 3.14)
    Double getRandomDouble(int min, int max, int precision) {
        //Hack that is not the cleanest way to ensure a specific precision, but...
        double r = Math.pow(10, precision);
        int i=1;
        for (int k=1;k<precision+1;k++)
        	i*=10;
        double nachcomma = (getRandomInteger(1,i)%i)/r;
        return getRandomInteger(min,max-1) + nachcomma;
        //return Math.round(min + (rand.nextDouble() * (max - min)) * r) / r;
    }

    //return random Integer from the Interval [min, max]; (min, max are possible as well)
    Integer getRandomInteger(int min, int max) {
        return rand.nextInt((max - min) + 1) + min;
    }

    //reads single-column files and stores its values as Strings in an ArraList
    private ArrayList<String> readFile(String filename) {
        String line;
        ArrayList<String> set = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new FileReader(filename))) {
            while ((line = br.readLine()) != null) {
                try {
                    set.add(line);
                } catch (Exception ignored) {
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
        return set;
    }
}