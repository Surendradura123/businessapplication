<?php
// Create connection
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "hybrid";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        //die('Could not connect: ' . mysql_error());
        header( 'Location: ../error.html' ) ;
    }


    //And now to perform a simple query to make sure it's working
   /* $query = "SELECT * FROM services";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "The ID is: " . $row['id'] . " and the Username is: " . $row['username'];
    }
    $id = '1';
    
    $query = "SELECT * FROM Customer WHERE customer_id = '$id'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();  These lines query the dataabse when user enters email */

    $first_name     = $row['first_name'];
    $email          = $row['email'];
    echo 'First Name: '. $first_name . '. Email: '. $email;
?>
  <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../customersearch/index.html">Section Index</a>
