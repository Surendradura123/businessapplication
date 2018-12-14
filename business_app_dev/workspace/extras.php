<?php

include "connection.php";

     //This gets the email address stored in the cookie "user" and assigns the $cookie_value to $email.
    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user' cookie.
    $email2         = $email;
    $email3         = $email; //email2 and email3 are used, as it was thought that the email could affect different queries in the db.
    
    
    // The database first quiries the Customer table, if the email matches, it sets the person's name, user_type_id and nav_message,
    // If the email is not found in the Customer table, it continues to the Company table. Again if the email is found, the name, user_type_id and the nav_message are set.
    // If the email address was not found in either the Customer or Company tables, it will query the Admin table and if found set the varaibles.
    // If the email address is not in any of the 3 tables, the nav_message only dispalys..
    
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed

        $row             = $result->fetch_assoc(); /* These lines query the database when user enters email */

        $first_name      = $row['first_name'];//
        $user_type_id    = $row['user_type_id'];
	   $nav_message	 = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$first_name;

    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result2        = $db->query($query2);
           if($result2->num_rows>0){

                
                $row2           = $result2->fetch_assoc(); /* These lines query the database when user enters email */
    
                $rep_first_name = $row2["rep_first_name"];
                $user_type_id   = $row2['user_type_id'];
                $company_id     = $row2['company_id'];
    			 $nav_message	  = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$rep_first_name;
             }
             else if($result2->num_rows == 0){
                 $query3     = "SELECT * FROM Admin WHERE email = '$email3'";
                 $result3    = $db->query($query3);
                      if($result3->num_rows>0){
                       $row3           = $result3->fetch_assoc(); /* These lines query the database when user enters email */
            
                       $full_name     = $row3["full_name"];
                       $user_type_id  = $row3['user_type_id'];
            		   $nav_message   = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$full_name;
                       }
                       
                       else{
                       $nav_message = "<a href='../../account/login.php'>Log in</a>";
                       $user_type_id= "";
                }
        }
    }
     


$header_text = "
     
     <head>
     <link rel='shortcut icon' href='img/fav_icon.ico'>
     </head>
     <body>
     <base href='/'>
         <div class='header'>
      <a href='/' class='logo'>Hybrid WebSearch</a>
      &nbsp;
      $nav_message
     <div class='header-right'>
     <a href='/'>Home</a>
         <div class='dropdown'>
             <button class='dropbtn'>Account</button>
             <div class='dropdown-content'>
             <a href='account/register.php'>Register</a>
             <a href='account/profile.php'>Profile</a>
             <a href='account/edit.php'>Edit details</a>
             <a href='account/logged_out.php'>Sign out</a>
             </div>
         </div>
           
          
         <div class='dropdown'>
         <button class='dropbtn'>Company Events</button>
             <div class='dropdown-content'>
                 <a href='company_add/addEvent.php'>Add Event</a>
                 <a href='company_add/showEvent.php'>View/Edit/Delete Event</a>
                 <a href='customersaveevent/approveevents.php'>Approve Event</a>
             </div>
         </div>
         
         <div class='dropdown'>
         <button class='dropbtn'>Customer Events</button>
             <div class='dropdown-content'>
                 <a href='customersaveevent/home.php'>Events List</a>
                 <a href='customersaveevent/myevents.php'>Saved Events</a>
                 <a href='customersearch/search.php'>Search Events</a>
                 
             </div>
         </div>

              <item>&nbsp;</itmem>
              <item>&nbsp;</itmem>
         </div>
     </div>
     ";

// The footer was not getting the CSS code from the CSS file, so had to manually put it into <style>.
$footer_msg = "

     <head>
          <style>
               footer {
                   position: fixed;
                   left: 0;
                   bottom: 0;
                   width: 100%;
                   background-color: #ca97e5;
                   color: #7d24ad;
                   text-align: center;
               }
          </style>
     </head>
     <body>
          <base href='/'>
     </body>
     
     <footer><p>&copy; 2018 HybridWebSearch.com</p></footer>
     
     ";
?>