<?php
      include 'connect.php';
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
                $company_name =$row4["name"];
    			$nav_message	 = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$rep_first_name;
        }
        else{
        $nav_message = "<a href='../account/login.php'>Log in</a>";
        $logged_in = false;
        }
    }
    


        
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 
<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
  <div class="header-right">
    <a href="/" class="active"><font color="white">Home</font></a>
    <div class="dropdown">
    <button class="dropbtn">Account

    </button>
    <div class="dropdown-content">
      <a href="../../account/register.php" class="active">Register</a>
      <a href="../../account/profile.php">Profile</a>
      <a href="../../account/edit.php">Edit details</a>
      <a href="../../account/logged_out.php">Sign out</a>
    </div>
  </div>
    <a href="../customersaveevent/home.php">Event</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>

 



 <div class="container">
  <h1 style="text-align-center">View you save events</h1>
  <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Save_Event_Number</th>
        <th>Event_Name</th>
        <th>Customer_id</th>
        <th>Company_id</th>
        <th>Customer_email</th>
        <th>DATETIME</th>
        <th>Status</th>
      </tr>
    </thead>
    
     <?php
       
  
          
          
            $i=0;
            
            $get_event = "select * from Save_Event where customer_id='$customer_id'";
            
            $run_event = mysqli_query($conn, $get_event);
            
            while($row_event=mysqli_fetch_array($run_event)){
                
                $event_id = $row_event['event_id'];
                $customer_id = $row_event['customer_id'];
                $company_id = $row_event['company_id'];
                $customer_email = $row_event['customer_email'];
                $date =$row_event['date'];
                $status =$row_event['status'];
                
                $i++;
            
            ?>
    <tbody>
      <tr>
        <td><?php echo $i; ?></td>
        <td>
             <?php
              $sql = "SELECT * FROM Save_Event";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
                $id = $row['event_id'];
               $sql2 = "SELECT * FROM Event WHERE  event_id ='$id' ";
               $result2 = $conn->query($sql2);
          if($row2 = $result2->fetch_assoc()){
               
              echo  $row2['event_name'];
               
          }
               ?>
             
        </td>
        <td>
             <?php
              $sql = "SELECT * FROM Save_Event";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
                $id = $row['customer_id'];
               $sql2 = "SELECT * FROM Customer WHERE  customer_id ='$id' ";
               $result2 = $conn->query($sql2);
          if($row2 = $result2->fetch_assoc()){
              echo "{$row2['first_name']}&nbsp;{$row2['last_name']}";
              
          }
               ?>
        </td>
        <td>
               <?php
              $sql = "SELECT * FROM Save_Event";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
                $id = $row['company_id'];
               $sql2 = "SELECT * FROM Company WHERE  company_id ='$id' ";
               $result2 = $conn->query($sql2);
          if($row2 = $result2->fetch_assoc()){
              echo  $row2['name'];
              
          }
               ?>
             
        </td>
        <td><?php echo $customer_email; ?></td>
        <td><?php echo $date; ?></td>
         <td><?php echo $status; ?></td>
      </tr>
    </tbody>
     <?php } ?>
    
  </table>
  </div>
  </div>

</body>
</html>