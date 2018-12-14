<?php

//A̶s̶ ̶t̶h̶e̶ ̶P̶r̶o̶f̶i̶l̶e̶ ̶p̶a̶g̶e̶ ̶d̶i̶s̶p̶l̶a̶y̶s̶ ̶b̶o̶t̶h̶ ̶t̶h̶e̶ ̶C̶o̶m̶p̶a̶n̶y̶'̶s̶ ̶a̶n̶d̶ ̶t̶h̶e̶ ̶C̶u̶s̶t̶o̶m̶e̶r̶'̶s̶ ̶a̶c̶c̶o̶u̶n̶t̶,̶ ̶t̶h̶e̶ ̶E̶d̶i̶t̶ ̶D̶e̶t̶a̶i̶l̶s̶ ̶b̶u̶t̶t̶o̶n̶ ̶o̶n̶ ̶t̶h̶a̶t̶ ̶p̶a̶g̶e̶ ̶r̶e̶d̶i̶r̶e̶c̶t̶s̶ ̶h̶e̶r̶e̶ ̶a̶n̶d̶ ̶c̶h̶e̶c̶k̶s̶ ̶w̶h̶i̶c̶h̶ ̶t̶y̶p̶e̶ ̶o̶f̶ ̶u̶s̶e̶r̶ ̶t̶h̶e̶y̶ ̶a̶r̶e̶ ̶a̶n̶d̶ ̶r̶e̶d̶i̶r̶e̶c̶t̶s̶ ̶t̶h̶e̶m̶ ̶t̶o̶ ̶t̶h̶e̶i̶r̶ ̶o̶w̶n̶ ̶e̶d̶i̶t̶C̶o̶m̶p̶a̶n̶y̶.̶p̶h̶p̶ ̶o̶r̶ ̶e̶d̶i̶t̶C̶u̶s̶t̶o̶m̶e̶r̶.̶p̶h̶p̶ ̶p̶a̶g̶e̶.̶ 

// The above is no longer the case as account/profile.php redirects to the relevant user area. However, there is an Edit Profile link in the nav bar that this still directs to.

include "../connection.php";


    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    $email2         = $email;
    
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed

       header( 'Location: ../account/customer/editCustomer.php' );
    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result2        = $db->query($query2);
           if($result2->num_rows>0){
                header( 'Location: ../account/company/editCompany.php' );
        }
        else{
             header( 'Location: ../account/login.php' );
        }
    }
?>