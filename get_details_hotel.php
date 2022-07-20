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
    function calculate_price($room_id)
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT price from room_types WHERE room_type_id IN (SELECT room_type_id from rooms WHERE room_id = '$room_id');";
        $result = $conn->query($sql);
        $price = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $price = $row["price"];
            }
            return $price;
        } else {
            echo "0 Results <br>";
        }
        $conn->close();
    }
    function get_travel_agency_name($id)
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * from travel_agents WHERE travel_agent_id = '$id'";
        $result = $conn->query($sql);
        $name = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row["travel_agent_name"];
            }
            return $name;
        } else {
            echo "0 Results <br>";
        }
        $conn->close();
    }
    function get_hotel_name($id){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * from hotels WHERE hotel_id = '$id'";
        $result = $conn->query($sql);
        $name = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row["hotel_name"];
            }
            return $name;
        } else {
            echo "0 Results <br>";
        }
        $conn->close();
    }
    function get_hotel_id($name){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * from hotels WHERE hotel_name = '$name'";
        $result = $conn->query($sql);
        $name = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row["hotel_id"];
            }
            return $name;
        } else {
            echo "0 Results <br>";
        }
        $conn->close();
    }

    $start = $_POST["start"];
    $end = $_POST["end"];
    $city = $_POST["city"];
    $hotel_name = $_POST["hotel"];

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


    $sql = "SELECT * FROM travel_agents";
    $result = $conn->query($sql);
    
    
    
    echo '<form method="post">';
    echo '<input type="submit" name="room_type" value="Room Type" />';
    echo '<input type="submit" name="agency" value="Agency" />';
    if (mysqli_num_rows($result) > 0) {
        echo '<select name="choose_agency">';
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row["travel_agent_name"] . "'>";
            echo $row["travel_agent_name"];
            echo "</option>";
        }
        echo '</select>';
        echo '<input type="submit" value="Choose Agency">';
        
    } else {
        echo "0 results";
    }
    $hotel_id = get_hotel_id($hotel_name);
    $persons = "SELECT * from clients WHERE booking_id IN (SELECT booking_id from bookings where hotel_id = '$hotel_id');";
    $person_result = $conn->query($persons);
    if (mysqli_num_rows($person_result) > 0) {
        
        
        echo '<select name="person">';
        while($row = mysqli_fetch_array($person_result)) {
            $full_name = $row["client_name"]." ". $row["client_last_name"];
            echo "<option value='" . $row["client_id"] . "'>";
            echo $full_name;
            echo "</option>";
        }
        echo '</select>';
        
    } else {
        echo "0 results";
    }
    echo '<input type="submit" name="invoice" value="Invoice">';
    echo '<select name="start">';
    echo "<option value='" . $start . "'>";
    echo $start;
    echo "</option>";
    echo '</select>';
    echo '<select name="end">';
    echo "<option value='" . $end . "'>";
    echo $end;
    echo "</option>";
    echo '</select>';
    echo '<select name="city">';
    echo "<option value='" . $city . "'>";
    echo $city;
    echo "</option>";
    echo '</select>';
    echo '<select name="hotel">';
    echo "<option value='" . $hotel_name . "'>";
    echo $hotel_name;
    echo "</option>";
    echo '</select>';
    echo '</form>';
    if (isset($_POST['room_type'])) {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $start = $_POST["start"];
        $end = $_POST["end"];
        $city = $_POST["city"];
        $hotel_name = $_POST["hotel"];

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hotel_id_query = "SELECT  * from hotels WHERE hotel_name = '$hotel_name'";
        $result = $conn->query($hotel_id_query);
        $hotel_id;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hotel_id = $row["hotel_id"];
            }
        } else {
            echo "0 Results <br>";
        }

        $room_type_name_query = "SELECT * from room_types WHERE room_type_id IN 
        (SELECT room_type_id from rooms WHERE room_id IN 
        (SELECT room_id FROM bookings WHERE hotel_id = '$hotel_id' AND 
        (bookings.check_in_date > '$start' AND bookings.check_out_date <= '$end')) GROUP BY room_type_id);";

        $rtn_result = $conn->query($room_type_name_query);

        $array = array();

        if ($rtn_result->num_rows > 0) {
            while ($row = $rtn_result->fetch_assoc()) {
                array_push($array, $row["room_type_name"]);
            }
        } else {
            echo "0 results hotel_count";
        }


        $room_type_query = "SELECT room_type_id ,COUNT(*) AS count from rooms WHERE room_id IN
        (SELECT room_id FROM bookings WHERE hotel_id = '$hotel_id' AND 
        (check_in_date > '$start' AND check_out_date <= '$end')) GROUP BY room_type_id;";

        $result_room_type = $conn->query($room_type_query);
        if ($result_room_type->num_rows > 0) {

            echo "<table border='1'>";
            echo "<tr><td>count</td><td>room_type</td></tr>";
            $i = 0;
            while ($row = $result_room_type->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["count"] . "</td><td>" . $array[$i] . "</td>";
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        } else {
            echo "0 results hotels";
        }
        $conn->close();
    }
    else if (isset($_POST['agency'])) {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $start = $_POST["start"];
        $end = $_POST["end"];
        $city = $_POST["city"];
        $hotel_name = $_POST["hotel"];


        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hotel_id_query = "SELECT  * from hotels WHERE hotel_name = '$hotel_name'";
        $result = $conn->query($hotel_id_query);
        $hotel_id;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hotel_id = $row["hotel_id"];
            }
        } else {
            echo "0 Results <br>";
        }


        $days = "SELECT *, DATEDIFF(check_out_date, check_in_date) AS days FROM bookings 
        WHERE hotel_id = '$hotel_id' AND 
        (check_in_date > '$start' AND check_out_date <= '$end');";
        $result = $conn->query($days);

        $travel_agents_array = array();

        $price_array = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($travel_agents_array, $row["travel_agent_id"]);
                $total_price = calculate_price($row["room_id"]) * $row["days"];
                array_push($price_array, $total_price);
            }
        } else {
            echo "0 results";
        }
        $new_array = array();
        $price1 = 0;
        $price2 = 0;
        $price3 = 0;
        $price4 = 0;
        $price5 = 0;
        $price6 = 0;
        $price7 = 0;
        $price8 = 0;
        $price9 = 0;
        $price10 = 0;

        for ($i = 0; $i < count($travel_agents_array); $i++) {
            if ($travel_agents_array[$i] == 1) {
                $price1 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 2) {
                $price2 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 3) {
                $price3 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 4) {
                $price4 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 5) {
                $price5 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 6) {
                $price6 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 7) {
                $price7 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 8) {
                $price8 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 9) {
                $price9 += $price_array[$i];
            }
            if ($travel_agents_array[$i] == 10) {
                $price10 += $price_array[$i];
            }
        }
        $number = count(array_unique($travel_agents_array));
        echo "<table border='1'>";
        echo "<tr><td>Travel Agency Name </td><td>Total Price</td></tr>";
        for ($i = 1; $i <= $number; $i++) {
            if ($i == 1) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price1 . "</td>";
                echo "</tr>";
            }
            if ($i == 2) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price2 . "</td>";
                echo "</tr>";
            }
            if ($i == 3) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price3 . "</td>";
                echo "</tr>";
            }
            if ($i == 4) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price4 . "</td>";
                echo "</tr>";
            }
            if ($i == 5) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price5 . "</td>";
                echo "</tr>";
            }
            if ($i == 6) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price6 . "</td>";
                echo "</tr>";
            }
            if ($i == 7) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price7 . "</td>";
                echo "</tr>";
            }
            if ($i == 8) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price8 . "</td>";
                echo "</tr>";
            }
            if ($i == 9) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price9 . "</td>";
                echo "</tr>";
            }
            if ($i == 10) {
                echo "<tr>";
                echo "<td>" . get_travel_agency_name($i) . "</td><td>" . $price10 . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        $conn->close();
    }
    else if (isset($_POST['invoice'])) {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $start = $_POST["start"];
        $end = $_POST["end"];
        $city = $_POST["city"];
        $hotel_name = $_POST["hotel"];
        $person_id = $_POST["person"];
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * from bookings where booking_id IN
        (SELECT booking_id from clients WHERE client_id = '$person_id');";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            echo "<table border='1'>";
            echo "<tr><td>Booking Date</td><td>Check-in Date</td><td>Check-out Date</td><td>Travel Agent Name</td><td>Room No</td><td>Hotel Name</td></tr>";
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row["booking_date"] . "</td><td>" . $row["check_in_date"]. "</td><td>" . $row["check_out_date"]."</td><td>" . get_travel_agency_name($row["travel_agent_id"])."</td><td>" . $row["room_id"]."</td><td>" . get_hotel_name($row["hotel_id"]). "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        mysqli_close($conn);
    }
    else if (isset($_POST['choose_agency'])) {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "anil_duyguc";

        $start = $_POST["start"];
        $end = $_POST["end"];
        $city = $_POST["city"];
        $hotel_name = $_POST["hotel"];
        $agency = $_POST["choose_agency"];

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        

        $sql = "SELECT * from bookings WHERE travel_agent_id IN (SELECT travel_agent_id FROM travel_agents WHERE travel_agent_name = '$agency');";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table border='1'>";
            echo "<tr><td>Booking Date</td><td>Check-in Date</td><td>Check-out Date</td><td>Room No</td><td> Hotel Name</td></tr>";
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row["booking_date"] . "</td><td>" . $row["check_in_date"]. "</td><td>" . $row["check_out_date"]. "</td><td>" . $row["room_id"]. "</td><td>" . get_hotel_name($row["hotel_id"]). "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
    }
 
    // after click on the install button on the install.php
    // the database and tables is created on FilterHotels.php file 
    // so in order not to recreate the database , tables and records
    // the person who has review this project should comment out the lines from 838 to 852 on FilterHotels.php
    // routing is on the down below
    // install.php -> FilterHotels.php -> show_hotels.php -> get_details.php
    
    
    ?>
</body>

</html>