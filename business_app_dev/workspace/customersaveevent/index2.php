<?php

    date_default_timezone_set('Europe/Dublin');
    include 'comments.inc.php';
    include 'db.php';
    $cookie_name = "user";
$email          = $_COOKIE[$cookie_name];
   
?>



<title>Comments</title>

 <link rel="stylesheet" type="text/css" href="style.css">
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
    <a href="../Customer_Save_event/hybridweb.php">Event</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>

  
      
       

<?php
if(isset($_COOKIE[$cookie_name])) {
  
           echo "<form method='POST' action='".setComments($conn)."'>
                <input type='hidden'name='customer_id' value='".$email."'>
                <input type='hidden'name='date' value='".date('Y-m-d H:i:s')."'>
                <textarea name='comments'></textarea> <br>
                <button type='submit' name='commentSubmit'>Comments</button>
            </form>";
       
} else {
    echo "You have to login for the comments";
}
?>
   <?php
     
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
       
    
    
   getComments($conn);
 
    
    ?>

</body>
  <?php echo $footer_msg ?>
</html>