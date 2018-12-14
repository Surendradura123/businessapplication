<!-- Edits made that were not used are in /account/not_used/login_old.php, i.e. to see my work and what I've tried --Keith -->


<?php 
include "../connection.php";
include "../extras.php";
    

    $cookie_name    = 'user';
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    
    if ($_COOKIE[$cookie_name] == ''){ // This is used to check whether a user is logged in or not.
        $cookie = false;
    }
    else{
        $cookie = true;
    }
    
    // This was doing the same thing as the Header in extras.php, so not needed here. 
//     $query  = "SELECT * FROM Customer WHERE email = '$email'";
//     $result = $db->query($query);

//     if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed
        
//         $customer = true;
//         $company  = false;
       
//         $row             = $result->fetch_assoc(); /* These lines query the database when user enters email */

//         $first_name      = $row['first_name'];//
// 		$nav_message	 = $nav_message = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$first_name;

//     }
//     else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
//       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
//       $result2        = $db->query($query2);
//           if($result2->num_rows>0){
               
//                 $customer = false;
//                 $company  = true;
                
                
//                 $row2           = $result2->fetch_assoc(); /* These lines query the database when user enters email */
    
//                 $rep_first_name = $row2["rep_first_name"];
//     			$nav_message	 = $nav_message = "<a href='../../account/logged_out.php'>Sign out</a>"."Hello ".$rep_first_name;
//         }
//         else{
//         $nav_message = "<a href='../account/login.php'>Log in</a>";
//         }
//     }


// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $email              = !empty($_POST ['email']) ? $_POST['email'] : "";
    $entered_password   = !empty($_POST['entered_password']) ? $_POST['entered_password'] : "";
    $email2             = $email;
    
    // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c // This converts the entered password into an encrypted passwor
    $key    = '3sc3RLrpd17'; /* random */
    $method = 'aes-256-cbc';
    $iv     = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $enc_entered_password = base64_encode(openssl_encrypt($entered_password , $method, $key, OPENSSL_RAW_DATA, $iv));
    
        /* Field Required */
    $aFieldRequired = [
        $email,
        $entered_password
    ];
    /* End */

    /* Check Filled Fields */
    $bFieldRequired = false;
    foreach($aFieldRequired as $aField){
        if(trim($aField) == ""){
            $bFieldRequired = true;
            break;
        }
    
        //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another/50875462#50875462
        $query  = "SELECT * FROM Customer WHERE email = '$email'";
        $result = $db->query($query);
        
        if ($result->num_rows > 0){
           $row            = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */
           $password_enc   = $row['password_enc'];
           $user_type_id   = $row['user_type_id'];
        }
        else
        {
           $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
           $result2        = $db->query($query2);
           if($result2->num_rows>0){
              $row2           = $result2->fetch_assoc(); /* These lines query the dataabse when user enters email */
              $password_enc   = $row2['password_enc'];
              $user_type_id   = $row2['user_type_id'];
           }
        }
        
                        
        $cookie_name = "user";
        $cookie_value = $email;
    
    
        $successDB = false;
    
            
        if($enc_entered_password == $password_enc){ //Will only show user's details if password entered is matched with the password in the database.
        
            
            //setcookie($cookie_name, $cookie_value, time() + (2592000), "/"); // 86400 = 1 day, 2592000 = 30 days
            setcookie($cookie_name, $cookie_value, NULL, "/"); // NULL sets the expiration time to when the browser is closed.
            
            $cookie_name = "user_id";
            $cookie_value = $user_type_id;
            setcookie($cookie_name, $cookie_value, NULL, "/"); //sets user_id cookie before redirecting
            
            header('Location: ../account/profile.php');
            $cookie = true;
        
        }
            
        else{
                $correct_password="<font color='red'>Your email address and/or password is not valid</font>";
                $cookie_value = '';
                setcookie($cookie_name, $cookie_value, 0, '/'); // minus 60 minutes. Will remove the cookie
                
                $cookie_name = "user_id";
                $cookie_value = $user_type_id;
                setcookie($cookie_name, $cookie_value, NULL, "/");

                $cookie = false;
        }
            $successDB = true;
        

        
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Login</title>
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src= ../js/javascript.js></script>
    <!-- <style>
    body{
        background-color: #ca97e5;
    }
    </style> -->
    <script>
    function showDiv() {    //@ref: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
                            //This function is shown when the body loads. If a user is NOT logged in, the showLogin is displayed. If a user IS logged in, the hideLogin is dispalyed. This prevents a user trying to sign more than once.

        var show = document.getElementById("showLogin"); //shows login for users who are not signed in
        var hide = document.getElementById("hideLogin"); //hides the form if users are laready signed in
        
        var cookie = "<?php echo $cookie ?>";
        
        if (cookie == false) {
            show.style.display = "block"; //displays a block of text (does NOT mean 'to block' something)
            hide.style.display = "none"; // does not display

        } else {
            show.style.display = "none";
            hide.style.display = "block"; 
        }
    }

    </script>
    

</head>

<body onload="showDiv()">

<?php echo $header_text; ?> <!-- taken from extras.php -->


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
    <div id="showLogin">
    
        <table width="20%">
    
            <tr>
                <td>
                </td>
                <td>
                    <center>
                       
                        <h2>Login to your account</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                        <form action="" method="post">
                                <br>
                                
                                <label for="email">Email:</label>
                                <br>
                                <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please ensure your email address is valid. Example: email@address.com" required><font color="red"><sup>*</sup></font>
                                
                                <br><br>
                                
                                <label for="entered_password">Password:</label>
                                <br>
                                <input type="password" name="entered_password" id="entered_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Please enter the password you previously registered with" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
                                
                                <br><br>
                                
                                <?php echo ($correct_password) ?>
                                
                                
                                <br><br>
                                <input type="submit" value="Login">
          
                                
                                <br><br><br>
                                <p><a href="../account/customer/customer_register.php" class="button">Customer registration</a></p>
                                <p><a href="../account/company/company_register.php" class="button">Company registration</a></p>
    
                            </p>
                            </p>
                        </form>
                    </center>
                    
                </td>
            </tr>
        </table>
    </div>
    <div id="hideLogin">
        <p>You can not login as you are already logged in.</p>
        <br><br><br>
        <p><a href="../account/profile.php" class="button">Profile</a></p>
        <p><a href="../account/logged_out.php" class="button">Sign out</a></p>
        </p>
    </div>

</div>
</center>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>