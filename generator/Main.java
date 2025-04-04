import java.sql.*;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.text.ParseException;
import java.util.concurrent.*;


public class Main {

    private static final String URL = "jdbc:mysql://localhost:3306/trellis_db";
    private static final String USER = "root";
    private static final String PASSWORD = "root";

    private static final int MAX_BOOKINGS = 8;
    private static final int MAX_STATIONS = 10;

    public static int COUNTER = 0;

    private static Connection conn;


    public static void main(String[] args) {
        initializeConnection();

        while (true){
            if (checkBookingCount(MAX_BOOKINGS)){
                addNewBooking();
            }
            try {
                Thread.sleep(5000);
            } catch (InterruptedException e){
                e.printStackTrace();
            }
        }

        // closeConnection();
    }


    public static void initializeConnection() {
        try {
            conn = DriverManager.getConnection(URL, USER, PASSWORD);
            System.out.println("Connected to MySQL database!");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }


    public static void closeConnection() {
        try {
            if (conn != null) conn.close();
            System.out.println("Database connection closed.");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }


    public static boolean checkBookingCount(int maxBookings){
        int bookingCount = 0;
        String sql = "SELECT COUNT(*) FROM bookings";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            java.sql.ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                bookingCount = rs.getInt(1);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return bookingCount < maxBookings;
    }


    public static void addNewBooking(){
        String sql = "INSERT INTO bookings (`user_id`, `departure_station`, `destination_station`, `travel_date`, `status`, `created_at`, `travel_time`, `arrival_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        int pickup = ThreadLocalRandom.current().nextInt(1, MAX_STATIONS+1);
        int dropoff = (pickup + ThreadLocalRandom.current().nextInt(1, MAX_STATIONS-1)) % (MAX_STATIONS+1);
        String pickupStation = "Station"+Integer.toString(pickup);
        String dropoffStation = "Station"+Integer.toString(dropoff);

        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, 0);
            stmt.setString(2, pickupStation);
            stmt.setString(3, dropoffStation);
            stmt.setString(4, "2025-02-10");
            stmt.setString(5, "Confirmed");
            stmt.setString(6, "2025-03-09 05:27:20");
            stmt.setString(7, "00:00:00");
            stmt.setInt(8, 0);
            int rowsInserted = stmt.executeUpdate();
            if (rowsInserted > 0){
                COUNTER++;
                System.out.println(COUNTER+". Added booking from "+pickupStation+" to "+dropoffStation);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

}
