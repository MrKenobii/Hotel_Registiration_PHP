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
    ?>

</body>

</html>