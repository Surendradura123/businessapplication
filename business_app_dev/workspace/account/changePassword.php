<?php

//As the Profile page displays both the Company's and the Customer's account, the change password button on that page redirects here and checks which type of user they are and redirects them to their oen changePassword.php page. 

include "../connection.php";

    

    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    $email2         = $email;
    
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed

       header( 'Location: ../account/customer/changePassword.php' );
    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result2        = $db->query($query2);
           if($result2->num_rows>0){
                header( 'Location: ../account/company/changePassword.php' );
        }
        else{
             header( 'Location: ../account/login.php' );
        }
    }
    
?>