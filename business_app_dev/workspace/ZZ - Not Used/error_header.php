<?php

// This page is not used, but it does show an earlier version of header.php from line 9 to 45.

// Create connection
include "connection.php";
    
    
    //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another
    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    $email2         = $email;
    
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed
        
        $customer = true;
        $company  = false;
       
        $row             = $result->fetch_assoc(); /* These lines query the database when user enters email */

        $first_name      = $row['first_name'];//
		$nav_message	 = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$first_name;

    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result2        = $db->query($query2);
           if($result2->num_rows>0){
               
                $customer = false;
                $company  = true;
                
                
                $row2           = $result2->fetch_assoc(); /* These lines query the database when user enters email */
    
                $rep_first_name = $row2["rep_first_name"];
    			$nav_message	 = "<a href='account/logged_out.php'>Sign out</a>"."Hello ".$rep_first_name;
        }
        else{
        $nav_message = "<a href='account/login.php'>Log in</a>";
        }
    }
    
?>

<head>
    <title>Hybrid - 404! Page not found!</title>
    
    <script src= js/javascript.js></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
  <div class="header-right">
    <a href="/">Home</a>
    <div class="dropdown">
    <button class="active dropbtn">Account

    </button>
    <div class="dropdown-content">
      <a href="account/register.php">Register</a>
      <a href="account/profile.php" >Profile</a>
      <a href="account/edit.php">Edit details</a>
      <a href="account/logged_out.php">Sign out</a>
    </div>
  </div> 
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>
