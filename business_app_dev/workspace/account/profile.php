<?php

include "../connection.php";
    
    $cookie_name    = 'user_id';
    $user_type_id   = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the user id number from type "user_id".
    
    if($user_type_id == '3'){ //3 is Admin
    
    header ("Location: ../account/admin/index.php");
    }
    else{
        
                //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another
        $cookie_name    = 'user';
        $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
        $email2         = $email;

    
        $query  = "SELECT * FROM Customer WHERE email = '$email'";
        $result = $db->query($query);
    
        if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed
    
           header( 'Location: ../account/customer/customer_profile.php' );
        }
        else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
           $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
           $result2        = $db->query($query2);
               if($result2->num_rows>0){
                    header( 'Location: ../account/company/company_profile.php' );
            }
            else{
                 header( 'Location: ../account/login.php' );
            }
        }
    }
?>