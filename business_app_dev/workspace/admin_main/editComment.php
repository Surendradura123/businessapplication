<?php


     
      include "../connection.php";
        include 'comments.inc.php';
        include "../extras.php";
       
     date_default_timezone_set('Europe/Dublin');
    include("db.php");


//include "../connection.php"; //  This will not work as we're already in the Main folder, and it cannot go back further, it should be "/connection.php".
    
    
    //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another
    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    $email2         = $email;
    
    $db = $conn;
    
    $query3  = "SELECT * FROM Customer WHERE email = '$email'";
    $result3 = $db->query($query3);

    if ($result3->num_rows > 0){ // if results are in Customer table, this if will proceed
        
        $logged_in = true;
       
        $row3             = $result3->fetch_assoc(); /* These lines query the database when user enters email */

        $first_name      = $row3['first_name'];//
        $customer_id     = $row3['customer_id'];
		$nav_message	 = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$first_name;

    }
    else if($result3->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
       $query4         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result4        = $db->query($query4);
           if($result4->num_rows>0){
               
                $logged_in = true;
                
                
                $row4           = $result4->fetch_assoc(); /* These lines query the database when user enters email */
    
                $rep_first_name = $row4["rep_first_name"];
                $company_email = $row4["rep_email"];
    			$nav_message	 = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$rep_first_name;
        }
        else{
        $nav_message = "<a href='../account/login.php'>Log in</a>";
        $logged_in = false;
        }
    }
    


        
?>

<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
   
  <div class="header-right">
       <div class="header-center">
            
        </div>
    <a href="/" class="active"><font color="white">Home</font></a>
   <div class='dropdown'>
             <button class='dropbtn'>Account</button>
             <div class='dropdown-content'>
             <a href='../account/register.php'>Register</a>
             <a href='../account/profile.php'>Profile</a>
             <a href='../account/edit.php'>Edit details</a>
             <a href='../account/logged_out.php'>Sign out</a>
             </div>
         </div>
         
  <div class='dropdown'>
         <button class='dropbtn'>Company Events</button>
             <div class='dropdown-content'>
                 <a href="../company_add/addEvent.php">Add Event</a>
                 <a href="../company_add/showEvent.php">View/Edit/Delete Event</a>
                 <a href="../customersaveevent/approveevents.php">Approve Event</a>
             </div>
         </div>
         
         <div class='dropdown'>
         <button class='dropbtn'>Customer Events</button>
             <div class='dropdown-content'>
                 <a href="../customersaveevent/home.php">Events List</a>
                 <a href="../customersaveevent/myevents.php">Saved Events</a>
                 <a href="../customersearch/search.php">Search Events</a>
                 
             </div>
         </div>

              <item>&nbsp;</itmem>
              <item>&nbsp;</itmem>
         </div>
     </div>
?>



<?php

        $cid = $_POST['cid'];
        $email = $_POST['email'];
        $event_id = $_POST['event_id'];
        $date = $_POST['date'];
        $comments = $_POST['comments'];

echo "<br><br><center><form method='POST' action='".editComments($conn)."'>
    <input type='hidden'name='email' value='".$email."'>
     <input type='hidden'name='event_id' value='".$event_id."'>
    <input type='hidden'name='date' value='".$date."'>
    <textarea name='comments'>".$comments."</textarea> <br>
    <button name='commentSubmit'>Edit</button>
</form><center>";


?>
    <?php echo $footer_msg;?>
</body>
</html>
<?php
function editComments($conn){
     if(isset($_POST['commentSubmit'])) {
        
        $cid = $POST['cid'];
        $email = $_POST['email'];
        $event_id=$_POST['event_id'];
        $date = $_POST['date'];
        $comments = $_POST['comments'];
        $ip_add = getRealIpAddr();
        
         $sql = "UPDATE Comments SET comments='$comments' WHERE email ='$email'";
        $result = $conn->query($sql);
        header("Location:../admin_main/index2.php?event_id=$event_id.php");
    }
    
}
function getRealIpAddr() {
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
 
    return $ip;
}
?>