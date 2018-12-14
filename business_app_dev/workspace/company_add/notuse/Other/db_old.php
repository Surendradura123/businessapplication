<?php
// Create connection
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "hybrid";
    $dbport = 3306;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($conn->connect_error) {
        //die('Could not connect: ' . mysql_error());
        header( 'Location: ../error.html' ) ;
    }
    
    ?>
      <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../company_add/index.html">Section Index</a>