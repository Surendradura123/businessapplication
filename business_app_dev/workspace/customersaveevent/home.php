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
            <form method="get" action="../customersaveevent/search.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Search a Product by City" />
                <input type="submit" name="search" value="Search" />
            </form>
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
 

<h2 style=text-align:center;>View Events</h2>
   
   <?php
            
            
            
                $per_page=5;
                if(isset($_GET['page'])){
                     
                    $page = $_GET['page'];
                }
                else{
                    $page=1;
                }
                
                $start_from =($page-1) * $per_page;
                
      // @ref: from comapny_add/hybridweb.php
     
    $sql = "SELECT * FROM Event ORDER by 1 DESC LIMIT $start_from, $per_page";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
          $event_id = $row['event_id'];
        $id = $row['company_id'];
            $sql2 = "SELECT * FROM Company WHERE  company_id ='$id' ";
           $result2 = $conn->query($sql2);
          if($row2 = $result2->fetch_assoc()){
                       echo"
                        
                        <div style='text-align:center;background-color:#d9bbf7'>
                        
                             <div class='panel-heading'>
                               <h1 class='panel-title'>
                               Company Name&nbsp;:&nbsp{$row2['name']}<br>
                                Event Name&nbsp;:&nbsp;{$row['event_name']}<br>
                               </h1>
                             </div>
                             
                             <div class='panel-body'>
                               <h3>
                                  Description&nbsp;:&nbsp;{$row['description']}<br>
                                  Address&nbsp;:&nbsp;{$row['event_address1']},&nbsp;{$row['event_address2']}<br>
                                  City&nbsp;:{$row['event_city']}<br>
                                  Eircode&nbsp;:{$row['event_eircode']}<br>
                                  Start_Date&nbsp;:{$row['date']}<br>
                                  Time&nbsp;:&nbsp;{$row['start_time']}--{$row['end_time']}
                              </h3>
                               </div> 
                   <a href='../customersaveevent/event.php?event_id=$event_id' class='button'>View In Details</a>
                                  <br>
                                  <br>  
                         ";
              
                  
                       echo" </div>";
                       
                       
          }
             
            
    }
         
              

    ?>
    <br>
    
     <div>
         <?php include ("../customersaveevent/pagination.php"); ?>
          </div>
          <br>
          <br>
          <br>
          
          <?php echo $footer_msg;?>
</body>
  
</html


   