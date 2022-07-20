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


    $city = $_POST['city_name'];
    $start = date('Y-m-d', strtotime($_POST['start_date']));
    $end = date('Y-m-d', strtotime($_POST['end_date']));

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
    $array = array();

    $hotel_count = "SELECT hotel_id, COUNT(*) as count  from bookings WHERE hotel_id IN 
            (SELECT hotel_id FROM hotels_cities_relation WHERE city_id = 
             (SELECT city_id FROM cities WHERE city_name ='$city')) AND 
            ((check_in_date >= '$start') AND (check_out_date <= '$end'))GROUP BY hotel_id ;";
    $count_result = $conn->query($hotel_count);

    if ($count_result->num_rows > 0) {
        while ($row = $count_result->fetch_assoc()) {
            array_push($array, $row["count"]);
        }
    } else {
        echo "0 results hotel_count";
    }

    $hotels = "SELECT * from hotels WHERE hotel_id IN 
         (SELECT DISTINCT(hotel_id) AS hotel_id from bookings WHERE hotel_id IN 
          (SELECT hotel_id FROM hotels_cities_relation WHERE city_id = 
           (SELECT city_id FROM cities WHERE city_name ='$city')) AND 
          ((check_in_date >= '$start') AND (check_out_date <= '$end')));";
    $result = $conn->query($hotels);
    if ($result->num_rows > 0) {
        $i = 0;
        echo "<table border='1'>";
        echo "<tr><td>count</td><td>hotel_name</td></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $array[$i] . "</td><td>" . $row["hotel_name"] . "</td>";
            echo "</tr>";
            $i++;
        }
        echo "</table>";
    } else {
        echo "0 results hotels";
    }

    $hotels = "SELECT * from hotels WHERE hotel_id IN 
         (SELECT DISTINCT(hotel_id) AS hotel_id from bookings WHERE hotel_id IN 
          (SELECT hotel_id FROM hotels_cities_relation WHERE city_id = 
           (SELECT city_id FROM cities WHERE city_name ='$city')) AND 
          ((check_in_date >= '$start') AND (check_out_date <= '$end')));";
    $result = $conn->query($hotels);
    if ($result->num_rows > 0) {
        echo "<form action='get_details_hotel.php' method='post'>";
        echo '<select name="hotel">';
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["hotel_name"] . "'>";
            echo $row["hotel_name"];
            echo "</option>";
        }
        echo '</select>';
        echo '<select name="city">';
        echo "<option value='" . $city . "'>";
        echo $city;
        echo "</option>";
        echo '</select>';

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

        echo '<input type="submit" value="Submit">';
        echo "</form>";
    } else {
        echo "0 results";
    }
    $conn->close();
    // after click on the install button on the install.php
    // the database and tables is created on FilterHotels.php file 
    // so in order not to recreate the database , tables and records
    // the person who has review this project should comment out the lines from 838 to 852 on FilterHotels.php
    // routing is on the down below
    // install.php -> FilterHotels.php -> show_hotels.php -> get_details.php
    ?>


</body>

</html>