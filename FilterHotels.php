<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php


    function create_districs_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  districts (
            district_id INT AUTO_INCREMENT NOT NULL , 
            district_name VARCHAR(30) NOT NULL,
            PRIMARY KEY (district_id)
            ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_cities_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  cities (
           city_id INT AUTO_INCREMENT NOT NULL, 
           city_name VARCHAR(30) NOT NULL,
           district_id INT,
           PRIMARY KEY (city_id),
           FOREIGN KEY (district_id) REFERENCES districts(`district_id`)
           ON UPDATE CASCADE ON DELETE CASCADE
            ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_hotels_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  hotels (
            hotel_id INT AUTO_INCREMENT NOT NULL, 
            hotel_name VARCHAR(30) NOT NULL,
            PRIMARY KEY (hotel_id)
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_hotel_city_relation()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "CREATE TABLE  hotels_cities_relation (
            hotel_id INT  NOT NULL, 
            city_id INT NOT NULL,
            FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id), 
            FOREIGN KEY (city_id) REFERENCES cities(city_id),
            UNIQUE (hotel_id, city_id)
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }
        $conn->close();
    }
    function create_clients_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  clients (
            client_id INT AUTO_INCREMENT NOT NULL, 
            client_name VARCHAR(30) NOT NULL,
            client_last_name VARCHAR(30) NOT NULL,
            booking_id INT NOT NULL,
            PRIMARY KEY (client_id),
            FOREIGN KEY (booking_id) REFERENCES bookings(`booking_id`)
           ON UPDATE CASCADE ON DELETE CASCADE
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_facilities_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  facilities (
            facility_id INT AUTO_INCREMENT NOT NULL, 
            facility_name VARCHAR(30) NOT NULL,
            PRIMARY KEY (facility_id)
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_facility_hotel_relation()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "CREATE TABLE  facilities_hotels_relation (
            facility_id INT  NOT NULL, 
            hotel_id INT NOT NULL,
            FOREIGN KEY (facility_id) REFERENCES facilities(facility_id), 
            FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id),
            UNIQUE (facility_id, hotel_id)
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE) {
            echo "Error creating table: " . $conn->error . "<br>";
        }
        $conn->close();
    }
    function create_travel_agents_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  travel_agents (
            travel_agent_id INT AUTO_INCREMENT NOT NULL, 
            travel_agent_name VARCHAR(30) NOT NULL,
            PRIMARY KEY (travel_agent_id)
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_rooms_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table

        $sql = "CREATE TABLE  rooms (
            room_id INT AUTO_INCREMENT NOT NULL, 
            room_type_id INT NOT NULL,
            PRIMARY KEY (room_id),
            FOREIGN KEY (room_type_id) REFERENCES room_types(`room_type_id`)
            ON UPDATE CASCADE ON DELETE CASCADE
             ) ENGINE=INNODB;";

        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_room_types_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table

        $sql = "CREATE TABLE room_types (
               room_type_id INT AUTO_INCREMENT NOT NULL,
              room_type_name VARCHAR(30) NOT NULL,
              price INT NOT NULL,
               PRIMARY KEY (room_type_id) ) ENGINE=INNODB;";

        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    function create_room_hotels_relation()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "CREATE TABLE  hotels_rooms_relation (
            hotel_id INT  NOT NULL, 
            room_id INT NOT NULL,
            FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id), 
            FOREIGN KEY (room_id) REFERENCES rooms(room_id),
            UNIQUE (hotel_id, room_id)
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }
        $conn->close();
    }
    function create_booking_table()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // sql to create table
        $sql = "CREATE TABLE  bookings (
            booking_id INT AUTO_INCREMENT NOT NULL, 
            booking_date DATE NOT NULL,
            check_in_date DATE NOT NULL,
            check_out_date DATE NOT NULL,
            travel_agent_id INT NOT NULL,
            room_id INT NOT NULL,
            hotel_id INT NOT NULL,
            PRIMARY KEY (booking_id),
            FOREIGN KEY (travel_agent_id) REFERENCES travel_agents(`travel_agent_id`),
            FOREIGN KEY (room_id) REFERENCES rooms(`room_id`),
            FOREIGN KEY (hotel_id) REFERENCES hotels(`hotel_id`)
            ON UPDATE CASCADE ON DELETE CASCADE
             ) ENGINE=INNODB;";
        if ($conn->query($sql) === FALSE){
            echo "Error creating table: " . $conn->error . "<br>";
        }

        $conn->close();
    }
    class District
    {
        public $name;
        public $id;
        function __construct($name)
        {
            $this->name = $name;

            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO districts (district_name) VALUES ('$this->name')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        function get_name()
        {
            return $this->name;
        }
    }
    class City
    {
        public $name;
        public $city_id;
        public $district_id;
        function __construct($name, $district_id)
        {
            $this->name = $name;
            $this->district_id = $district_id;
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO cities (city_name, district_id) VALUES ('$this->name', $this->district_id)";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class Hotel
    {
        public $name;
        public $id;
        function __construct($name)
        {
            $this->name = $name;

            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO hotels (hotel_name) VALUES ('$this->name')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class HotelCityRelation
    {
        public $city_id;
        public $hotel_id;
        function __construct($city_id, $hotel_id)
        {
            $this->city_id = $city_id;
            $this->hotel_id = $hotel_id;
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO cities (hotel_id, city_id) VALUES ($this->hotel_id, $this->city_id)";

            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class Client
    {
        public $id;
        public $name;
        public $last_name;
        public $booking_id;
        function __construct($name, $last_name, $booking_id)
        {
            $this->name = $name;
            $this->last_name = $last_name;
            $this->booking_id = $booking_id;

            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO clients (client_name, client_last_name, booking_id) VALUES ('$this->name', '$this->last_name', '$this->booking_id')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        
    }
    class Facility
    {
        public $id;
        public $name;

        function __construct($name)
        {
            $this->name = $name;


            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO facilities (facility_name) VALUES ('$this->name')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class TravelAgent
    {
        public $id;
        public $name;
        function __construct($name)
        {
            $this->name = $name;


            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO travel_agents (travel_agent_name) VALUES ('$this->name')";

            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class Room
    {
        public $id;
        public $room_type_id;
        function __construct($room_type_id)
        {

            $this->room_type_id = $room_type_id;


            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO rooms (room_type_id) VALUES ('$this->room_type_id')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class RoomType
    {
        public $id;
        public $name;
        public $price;
        function __construct($name, $price)
        {
            $this->name = $name;
            $this->price = $price;

            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO room_types (room_type_name, price) VALUES ('$this->name', '$this->price')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    class Booking
    {
        public $id;
        public $booking_date;
        public $check_in_date;
        public $check_out_date;
        public $travel_agent_id;
        public $room_id;
        public $hotel_id;
        function __construct($booking_date, $check_in_date, $check_out_date, $travel_agent_id, $room_id, $hotel_id)
        {
            $this->booking_date = $booking_date;
            $this->check_in_date = $check_in_date;
            $this->check_out_date = $check_out_date;
            $this->travel_agent_id = $travel_agent_id;
            $this->room_id = $room_id;
            $this->hotel_id = $hotel_id;

            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "anil_duyguc";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO bookings (booking_date, check_in_date, check_out_date, travel_agent_id,room_id, hotel_id ) 
            VALUES ('$this->booking_date', '$this->check_in_date', '$this->check_out_date', '$this->travel_agent_id', '$this->room_id', '$this->hotel_id')";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
    function create_and_insert_cities()
    {
        create_cities_table();
        $row = 0;
        $filename = "city.csv";


        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if (!$header)
                    $header = $row;
                else {
                    new City($row[0], $row[1]);
                }
            }
            fclose($handle);
        }
    }

    function create_and_insert_districts()
    {
        create_districs_table();

        $row = 0;
        $filename = "district.csv";


        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if (!$header)
                    $header = $row;
                else {
                    new District($row[0]);
                }
            }
            fclose($handle);
        }
    }
    function create_and_insert_hotels()
    {
        create_hotels_table();
        new Hotel("Hilton");
        new Hotel("Dedeman");
        new Hotel("Side");
        new Hotel("Limak Thermal Boutique Hotel");
        new Hotel("Grand Swiss-Belhotel");
        new Hotel("Kervansaray");
        new Hotel("Doga Termal Hotel");
        new Hotel("Richmond Termal Hotel");
        new Hotel("SPA Hotel Colossae Termal");
        new Hotel("Marigold Thermal & SPA Hotel");
    }
    function create_and_insert_hotel_city_relation()
    {
        create_hotel_city_relation();
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        for ($x = 1; $x <= 81; $x++) {
            for ($j = 1; $j <= 5; $j++) {
                $get_query = "SELECT hotel_id from hotels WHERE hotel_id NOT IN (SELECT hotel_id FROM `hotels_cities_relation` WHERE city_id= '$x') ORDER BY RAND() LIMIT 1;";
                $result = mysqli_query($conn, $get_query) or die("Error");
                $row = mysqli_fetch_array($result);
                $number = $row["hotel_id"];
                $sql = "INSERT INTO `hotels_cities_relation` (`city_id`, `hotel_id`) VALUES ('$x', '$number')";

                if ($conn->query($sql) === FALSE) 
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    function create_and_insert_clients()
    {
        create_clients_table();
        $row = 0;
        $filename = "client.csv";


        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $number=1;
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if (!$header)
                    $header = $row;
                else {
                    new Client($row[0], $row[1], $number);
                    $number = $number + 1;
                }
            }
            fclose($handle);
        }
    }
    function create_and_insert_facilities()
    {
        create_facilities_table();
        create_facility_hotel_relation();
        new Facility("Swimming Pool");
        new Facility("Spa");
        new Facility("Basketball Court");
        new Facility("Aquapark");
        new Facility("Tennis Court");

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO `facilities_hotels_relation` (`facility_id`, `hotel_id`)
         VALUES ('4', '2'), ('3', '2'), ('2', '7'), ('1', '7'), ('5', '5'), ('4', '5'), ('1', '1'), ('3', '1'),
          ('4', '6'), ('2', '6'), ('5', '4'), ('2', '4'), ('4', '10'), ('3', '10'), ('5', '8'), ('2', '8'),
           ('3', '3'), ('4', '3'), ('2', '9'), ('4', '9')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    function create_and_insert_travel_agents()
    {
        create_travel_agents_table();
        new TravelAgent("Booking");
        new TravelAgent("Setur");
        new TravelAgent("Etstur");
        new TravelAgent("Anitur");
        new TravelAgent("Barlas Tourism");
        new TravelAgent("Global Europe");
        new TravelAgent("Henney");
        new TravelAgent("Konseytur");
        new TravelAgent("Mona Tourism");
        new TravelAgent("KKMA Toursim");
    }
    function create_and_insert_room_types()
    {
        create_room_types_table();
        new RoomType("Single", 100);
        new RoomType("King", 1000);
        new RoomType("Couple", 250);
        new RoomType("Family", 400);
        new RoomType("Suit", 500);
    }
    function create_and_insert_rooms()
    {
        create_rooms_table();

        new Room("1");
        new Room("2");
        new Room("3");
        new Room("4");
        new Room("5");
        new Room("1");
        new Room("3");
        new Room("1");
        new Room("4");
        new Room("4");
        new Room("4");
        new Room("5");
        new Room("2");
        new Room("1");
        new Room("1");
        new Room("2");
        new Room("2");
        new Room("1");
        new Room("1");
        new Room("1");
        new Room("1");
        new Room("2");
        new Room("4");
        new Room("3");
        new Room("1");
        new Room("1");
        new Room("2");
        new Room("5");
        new Room("1");
        new Room("1");
    }
    function create_and_insert_hotel_room_relation()
    {
        create_room_hotels_relation();

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        for ($x = 1; $x <= 10; $x++) {
            for ($j = 1; $j <= 30; $j++) {
                $sql = "INSERT INTO `hotels_rooms_relation` (`hotel_id`, `room_id`) VALUES ('$x', '$j')";
                if ($conn->query($sql) === FALSE) 
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    function create_and_insert_bookings()
    {
        create_booking_table();
        $row = 0;
        $filename = "client.csv";


        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
                if (!$header)
                    $header = $row;
                else {
                    $randomDate_1 = date("Y-m-d", mt_rand(1, time()));
                    $randomDate_2 = date('Y-m-d', mt_rand(strtotime($randomDate_1), strtotime(date("Y-m-d",time()))));
                    $randomDate_3 = date('Y-m-d', mt_rand(strtotime($randomDate_2), strtotime(date("Y-m-d",time()))));
                
                    new Booking($randomDate_1, $randomDate_2, $randomDate_3, rand(1,10), rand(1,30), rand(1,10));
                }
            }
            fclose($handle);
        }
    }
    function create_database(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 
        
        // Create database
        $sql = "CREATE DATABASE anil_duyguc";
        if ($conn->query($sql) === FALSE) 
        {
          echo "Error creating database: " . $conn->error;
        }
        
        $conn->close();


    }
    /*create_database();
    create_and_insert_districts();
    create_and_insert_cities();
    create_and_insert_hotels();
    create_and_insert_facilities();
    
    create_and_insert_hotel_city_relation();
    create_and_insert_travel_agents();

    create_and_insert_room_types();
    create_and_insert_rooms();
    create_and_insert_hotel_room_relation();
    
    create_and_insert_bookings();
    create_and_insert_clients();*/

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "anil_duyguc";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 


    $sql = "SELECT * FROM cities";



    $result = mysqli_query($conn, $sql) or die("Error");


    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo "<form action='show_hotels.php' method='post'>";
        echo '<select name="city_name">';
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row["city_name"] . "'>";
            echo $row["city_name"];
            echo "</option>";
        }
        echo '</select>';
        echo '<label for="date">Start:</label>';
        echo '<input type="date" id="start_date" name="start_date">';
        echo '<label for="date">End:</label>';
        echo '<input type="date" id="end_date" name="end_date">'; 
        echo '<input type="submit" value="Submit">';
        echo "</form>";
    } else {
        echo "0 results";
    }
    mysqli_close($conn);

    // after click on the install button on the install.php
    // the database and tables is created on FilterHotels.php file 
    // so in order not to recreate the database , tables and records
    // the person who has review this project should comment out the lines from 838 to 852 on FilterHotels.php
    // routing is on the down below
    // install.php -> FilterHotels.php -> show_hotels.php -> get_details.php
    ?>

</body>

</html>