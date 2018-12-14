<?php
include '../../extras.php';
include "../../connection.php";
    
    if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.
         header( 'Location: /' );
    }
?>
<!DOCTYPE html>
<html>
     <head>
          <title>Hybrid - Admin Main</title>
          <link rel="stylesheet" href="../../css/style.css">
     </head>

<body>
<!-- Header start -->
<?php echo $header_text;?>
<center>
<div class="bodyContainer"> 
<center>
     <h2>Admin Index</h2>
     <hr/>
     <p>Which type of account would you like to look up?</p>
     <p>&nbsp;</p>
    <p><a href="../../account/admin/company_details.php" class="button">Company</a></p>
    <p><a href="../../account/admin/customer_details.php" class="button">Customer</a></p>
    
    <p>&nbsp;</p>
    <p>Note: A full list of users' email address is available from your Admin controls.</p>
     
     
     <hr/>
     <p><font size="4"><b>Events</b></font></p>
     <p>As Admin, you can edit or delete comments under a specific Event.<br><br>Click this button to take you to the Events List.
     <br>Click "View in Detail" and scroll down to the comments to do this.</p>
     <br>
<p><a href="../admin_main/home2.php" class="button">Events List</a></p>
    
</center>

<p>&nbsp;</p>
<hr/>
<p><a href="/" class="button">Home</a></p>
</div>
</body>
<?php echo $footer_msg ?>
</html>
