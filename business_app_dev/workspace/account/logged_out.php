<?php
include "../extras.php";
include "../connection.php";
    

    $nav_message = "<a href='../account/login.php'>Log in</a>"; 
    
    $cookie_name = 'user';
    $coookie_value  = '';
    setcookie($cookie_name, $cookie_value, -3600, '/');  //this deletes all cookies previously stored on the computer, -3600 is minus one hour
    
    $cookie_name    = "admin_edit_company";
    if(!($_COOKIE[$cookie_name] == "")) {
          $coookie_value  = '';
          setcookie($cookie_name, $cookie_value, -3600, "/"); 
    }
    
    $cookie_name    = "admin_edit_customer";
    if(!($_COOKIE[$cookie_name] == "")) {
          $coookie_value  = '';
          setcookie($cookie_name, $cookie_value, -3600, "/"); 
    }
    
    $cookie_name = "user_id";
    if(!($_COOKIE[$cookie_name] == "")) {
          $coookie_value  = '';
          setcookie($cookie_name, $cookie_value, -3600, "/");
    }
    

    
?>
<html>
<head>
    <meta http-equiv="refresh" content="7; url=/" /> <!-- After the user is logged out, it redirects to the home page after 7 seconds --> 
    <link rel="stylesheet" href="../css/style.css">
    <title>Hybrid - Signed Out</title>
</head>

<?php echo $header_text;?>
    <center>
<div class="bodyContainer">
    You have been signed out. You are being redirected to the homepage.
    
    
    <p><a href="/" class="button">Home</a></p>
    
    <p><a href="../account/login.php" class="button">Login</a></p>
</div>
    </center>
</body>
     <?php echo $footer_msg ?>
</html>