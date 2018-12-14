<?php
// Create connection
    $servername = getenv('IP'); 
    $username = getenv('C9_USER');
    $password = "";
    $database = "hybrid";
    $dbport = 3306; //these are required to create the connection

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport); //this is actually creating the connection
    $conn = $db;
    
    // Check connection
    if ($db->connect_error) { //if the connection cannot be made, the error page is displayed.
        //die('Could not connect: ' . mysql_error());
        header( 'Location: error.php' );
        
    }
?>
