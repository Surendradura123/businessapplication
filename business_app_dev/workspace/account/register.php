    <?php
// Create connection
include "../extras.php";
include "../connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Register</title>
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src= ../js/javascript.js></script>
    <!-- <style>
    body{
        background-color: #ca97e5;
    }
    </style> -->
    <script>
   
    function showDiv() {    //@ref: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
                            //If a user is NOT logged in, showReg is displayed. If the user IS logged in, the hideReg is displayed. This prevents a logged in user from trying to register again.
        var show = document.getElementById("showReg"); //shows the form for Company to edit their details
        var hide = document.getElementById("hideReg"); //hides the form from other user types.
        
        var user_type_id = "<?php echo $user_type_id ?>";
        
        if (user_type_id== "") {
            show.style.display = "block"; //displays block
            hide.style.display = "none"; //does not display

        } else {
            show.style.display = "none"; //true
            hide.style.display = "block"; //false
        }
    } 

    </script>
    

</head>

<body onload="showDiv()">

<?php echo $header_text;?><!-- taken from extras.php -->

    <?php
       
    if(isset($password_enc)){
       echo "";
    }else{
       echo "";
    
    /* TESTING ONLY -- is required for some reason, page will not load if not included*/
    
    }

        

    
    ?> <!-- testing only -->
  <center>
<div class="bodyContainer">
  <div id="showReg">
  
    <h2>Register</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
    
    <p><a href="../account/customer/customer_register.php" class="button">Customer registration</a></p>
    <p><a href="../account/company/company_register.php" class="button">Company registration</a></p>
  
  </div>
  <div id="hideReg">
      <p>You are trying to register an account when you are already logged in. Please sign out first if you wish to do this.</p>
      <br><br><br>
      <p><a href="../account/profile.php" class="button">Profile</a></p>
      <p><a href="../account/logged_out.php" class="button">Sign out</a></p>
      </p>
  </div>
</div>
</body>
<?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>