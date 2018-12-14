<?php  

include "connection.php";
    
    //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another
    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    $email2         = $email;
    $email3         = $email; //email2 and email3 are used, as it was thought that the email could affect different queries in the db.
    
    
    // The database first quiries the Customer table, if the email matches, it sets the person's name, user_type_id and nav_message,
    // If the email is not found in the Customer table, it continues to the Company table. Again if the email is found, the name, user_type_id and the nav_message are set.
    // If the email address was not found in either the Customer or Company tables, it will query the Admin table and if found set the varaibles.
    // If the email address is not in any of the 3 tables, the nav_message only.
    
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
                }
        }
    }
    
?>

