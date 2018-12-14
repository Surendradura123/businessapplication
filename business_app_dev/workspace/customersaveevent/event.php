<?php
      include 'connect.php';
       include 'comments.inc.php';
     date_default_timezone_set('Europe/Dublin');
    include("db.php");
    include "../extras.php";
   

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
<!DOCTYPE html>
<head>
     <link rel="stylesheet" href="../css/style.css">
     <title>HybridWebSearch</title>

     <script>
     function myFunction() {
            alert("Your request is submiteed!");
          }
     </script>
</head>
<body>
<?php echo $header_text;?>
 

    <br>
    <center style="background-color:green;"><h1>Adding Customer to Event</h1></center>
    <br>
<center>    
    
    
     
    <?php
        
      // @ref: from comapny_add/hybridweb.php
      
      //showing the events
      if(isset($_GET['event_id'])){
           
      $get_id = $_GET['event_id'];
      
    $get_event = "SELECT * FROM Event where event_id = '$get_id'";
    
    $run_event = $conn->query($get_event);
    
    $row = $run_event->fetch_assoc();
        $id = $row['company_id'];
            $sql2 = "SELECT * FROM Company WHERE  company_id ='$id' ";
           $result2 = $conn->query($sql2);
          if($row2 = $result2->fetch_assoc()){
               $date = $row['date'];
               $coverted_date = date('l, j F, Y',strtotime($date));
                       echo"
                        
  <div class='mouse'>
                          <div class='panel panel-default'>
                              <center>
                               <table style='text-algin:center;'>
                                             
									<tr>
										<th width='250px' colspan='2'>
											<font size='8'><b><u>{$row['event_id']} - {$row['event_name']}</u></b></font>
										</th>
									</tr>
									<tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
									<tr>
										<td width='250px' style='text-align:right;'>
										     <font size='4'><b><u>Description:</u></b></font>
										</td width='250px'>
										<td>
											<font size='4'><b>{$row['description']}</b></font>
										</td>
									</tr>
									<tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
									<tr>
										<td width='250px' style='text-align:right;'>
											<font size='4'><b><u>Date:</u></b></font>
										</td width='250px'>
										<td>
											<font size='4'><b>$coverted_date</font>
										</td>
									</tr>
									<tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
									<tr>
										<td width='250px' style='text-align:right;'>
											<font size='4'><b><u>Time:</u></b></font>
										</td>
										<td>
											<font size='4'><b>{$row['start_time']}~{$row['end_time']}</b></font>
										</td>
									</tr>
                                             <tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
									<tr>
										<td width='250px' style='text-align:right;'>
											<font size='4'><b><u>Address:</u></b></font>
										</td>
										<td>
											<font size='4'><b>
     											{$row['event_address1']},<br>
     											{$row['event_address2']},<br>
     											{$row['event_city']},<br>
     											{$row['event_eircode']}</b>
     										</font>
										</td width='250px'>
									</tr>
									<tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
									<tr>
										<td width='250px' style='text-align:right;'>
											<font size='4'><b><u>Company Name:</u></b></font>
										</td>
										<td>
											<font size='4'><b>{$row2['name']}</b></font>
										</td>
									</tr>
									<tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
                                             <tr>
                                             	<td>
                                             		&nbsp;
                                             	</td>
                                             </tr>
								</table>
							   
							   
							   
							   
                         </center>
                             </div>

                             
                              
                              
                             ";
                             
                           
        
                             
     ?>
        
         <?php
         
         //register  the customer for this event 
                            
                             if(isset($_COOKIE[$cookie_name])) {
                           
                             echo "<form method='POST' action='".setCustomerEvents($conn)."'>
                         
                             <label for='email'>Your Email:</label>
                             <input type='text' name='customer_email' value='$email' />

                            
                             <input  type='hidden' id='event_id' name='event_id'  value='$get_id' />
                             <input type='hidden' id='customer_id' name='customer_id'  value='$customer_id' />
                             <input type='hidden' id='company_id' name='company_id'  value='$id' />
                             <input type='hidden' id='date' name='date' value='".date('Y-m-d H:i:s')."'  />
                             <input type='hidden' id='status' name='status' value='Pending'  />
                              <button type='submit' name='customerSubmit'onclick='myFunction()'>Send Request By using email address</button> 
                            </form></br></br>";
                    
                              
                             } else {
                            echo "<p style='color:#f44262';><font size='5'>Please login to book event</font></p><br></br>";
                        
                        }
                    
          }
          
                      if(isset($_COOKIE[$cookie_name])) {
  
                     echo "<form method='POST' action='".setComments($conn)."'>
                          <input type='hidden'name='email' value='".$email."'>
                          <input type='hidden'name='event_id' value='".$get_id."'>
                          <input type='hidden'name='date' value='".date('Y-m-d H:i:s')."'>
                          <textarea name='comments'></textarea> <br>
                          <button type='submit' name='commentSubmit'>Comments</button>
                      </form><br>
                      <br>";
       
               } else {
                        echo "<p style='color:#f44262';><font size='5'>Please login to comment</font></p>";
                      }
                                                
          
                      
  
                     echo "</div>";        
                   
           echo"
                             </div>
                           
                        ";
}

 echo "<h2 class='mice'> View the Comments</h2>";
                        getComments($conn); 
 echo "</div>";
    ?>

<?php

//register for the event
function setCustomerEvents($conn){
    if(isset($_POST['customerSubmit'])){
        $event_id       = $_POST['event_id'];
        $customer_id    = $_POST['customer_id'];
        $company_id     = $_POST['company_id'];
        $customer_email = $_POST['customer_email'];
        $date           = $_POST['date'];
        $status         = $_POST['status'];
     
      
        $sql3 = "INSERT INTO Save_Event (event_id,customer_id,company_id,customer_email,date,status) 
        VALUES ('$event_id','$customer_id','$company_id','$customer_email','$date','$status')";
        $result3 = $conn->query($sql3);        
    }
}






//set for the comments

 function setComments($conn){
    if(isset($_POST['commentSubmit'])){
        $email    = $_POST['email'];
        $event_id = $_POST['event_id'];
        $date     = $_POST['date'];
        $comments = $_POST['comments'];
        $ip_add   = getRealIpAddr();
        
        $sql5 = "INSERT INTO Comments (email,event_id,date,comments,ip_add) VALUES ('$email','$event_id','$date','$comments','$ip_add')";
        $result5 = $conn->query($sql5);
    }
    
    
}


//get for the comments
function getComments($conn){
                
                global $conn;
                
                 $get_id = $_GET['event_id'];
                 $get_com= "select * from Comments where event_id='$get_id' ORDER by 1 DESC";
                 $run_com = mysqli_query($conn,$get_com);
           
     while($row = mysqli_fetch_array($run_com)){
    
         $email = $row['email'];
        $event_id = $row['event_id'];
        $date = $row['date'];
        $comments = $row['comments'];
        
             echo 
             "<div class='comment-box'>
             <p>$comments </p>
             <p>$email </p>
            <p>$date </p>
             </div>";
               
             
            echo "</p>";
                
            echo "</div>";
            }
       
    
}



?>
</center>
</body>
<?php echo $footer_msg;?>
</html>



