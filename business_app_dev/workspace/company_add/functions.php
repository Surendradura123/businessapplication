<?php
include '../header.php';

if (!($user_type_id == '2')){ // if account is NOT a Company account, redirect to Home page.
     header ('Location: /');
}
else{ //if account IS a company account, do the folowing:
     function setEvents($conn){
         if(isset($_POST['eventSubmit'])){
             $company_id      = $_POST['company_id'];
             $event_name      = $_POST['event_name'];
             $description     = $_POST['desscription'];
             $event_address1  = $_POST['event_address1'];
             $event_address2  = $_POST['event_address2']; 
             $event_city      = $_POST['event_city'];
             $event_eircode   = $_POST['event_eircode'];
             $date            = $_POST['date'];
             $start_time      = $_POST['start_time'];
             $end_time        = $_POST['end_time'];
             
             $sql = "INSERT INTO Event (event_id, company_id, event_name, description, event_address1, event_address2, event_city, event_eircode, date, start_time, end_time) 
             VALUES ('', $company_id', '$event_name', '$description','$event_address1','$event_address2','$event_city','$event_eircode','$date','$start_time', '$end_time)'";
             $result = $db->query($sql);        
         }
     }
     
     
     
     
     
     
     // function getLogin($db){
     //      if(isset($_POST['loginSubmit'])){
     //            $_SESSION['company_id'] = $row['company_id'];
     //            header("Location:addEvent.php?loginsucsess");
                      
     //      }
     // }
     
     
     // function userLogout(){
     //      if(isset($_POST['logoutSubmit'])){
     //         session_start();
              
     //         session_destroy();
     //           header("Location:addEvent.php");
     //                     exit();
     //      }
     // }
     
     
     
     
     
}     
     ?>
       

     
