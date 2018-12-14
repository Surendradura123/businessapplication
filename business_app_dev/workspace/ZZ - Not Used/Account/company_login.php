<?php 
// Create connection
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "hybrid";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        //die('Could not connect: ' . mysql_error());
        header( 'Location: ../../error.html' ) ;
    }
    
    

if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $email              = !empty($_POST ['email']) ? $_POST['email'] : "";
    $entered_password   = !empty($_POST['entered_password']) ? $_POST['entered_password'] : "";
    
    // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c 
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
    
    $query2 = "SELECT * FROM Company WHERE rep_email = '$email'";
    $result2 = $db->query($query2);
    $row2 = $result2->fetch_assoc(); /* These lines query the dataabse when user enters email */


    $company_id     = $row2["company_id"];
    $name           = $row2["name"];
    $address1       = $row2["address1"];
    $address2       = $row2["address2"];
    $city           = $row2["city"];
    $eircode        = $row2["eircode"];
    $rep_first_name = $row2["rep_first_name"];
    $rep_last_name  = $row2["rep_last_name"];
    $rep_phone      = $row2["rep_phone"];
    $user_type_id   = $row2["user_type_id"];
    $password_enc   = $row2['password_enc'];
    $created_on     = $row2["created_on"];
    $ip_address     = $row2["ip_address"];
    
    $cookie_name = "user"; 
    $cookie_value = $email;   
    
        if($enc_entered_password == $password_enc){
        
            $correct_password="";
            $company_name   = $name;
            $address        = $address1.",<br>".$address2.",<br>".$city.",<br>".$eircode;
            $comp_id        = $company_id;
            $rep_name       = $rep_first_name." ".$rep_last_name;
            
            if ($rep_phone = ''){
              $trun_phone     = ''; //if no phone number, will not display anything, if number entered, will show last 3 to 4 digits.
            }
            else{
            $trun_phone     = "******".substr($rep_phone, 6);
            }
            
            
            if($user_type_id = "1"){
                $user_type_name = "Customer";
            }
            else if ($user_type_id = "2"){
                $user_type_name = "Company";
            }
            else if ($user_type_id = "3"){
                $user_type_name = "Admin";
            }
            else{
                $user_type_name = "";
            }
            
            $user_type      = $user_type_id." - (".$user_type_name.")";
            $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); //converts MySQL time to readable time -  @ref: http://php.net/manual/en/function.date.php
            $ip_add         = $ip_address;
            
            // @ref: https://www.w3schools.com/php/php_cookies.asp

            setcookie($cookie_name, $cookie_value, time() + (2592000), "/"); // 86400s = 1 day, 2592000s = 30 days
            
            
        
        }
        else{
            $correct_password="<font color='red'>Your email address and/or password is not valid</font>";
            setcookie($cookie_name, $cookie_value, time() - 3600);
        }
        $successDB = true;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Customer Login</title>
    
    <script src= ../js/javascript.js></script>
    <!-- <script>
        var phone_home_edit = "";
        var phone_home = document.getElementById('phone_home');
        phone_home = phone_home.toString().slice(-4) + '****';
        phone_home_edit = phone_home;
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.0.2/sha.js"></script>
    <script>
        /*function mySubmit(obj) {
          var pwdObj = document.getElementById('password2');
          var hashObj = new jsSHA("SHA-512", "TEXT", {numRounds: 1});
          hashObj.update(pwdObj.value);
          var hash = hashObj.getHash("HEX");
          pwdObj.value = hash;
        }*/
    </script>
</head>

<body>
      <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../user_register_login/index.html">Section Index</a>

<center>
<div>

    <table>
        <tr>
            <td colspan="2">
                <center>
                    <h2>Register</h2>
                    
                </center>
            </td>
            <td>
            </td>
        </tr>
        <br><br>
        <tr>
            <td>
            </td>
            <td>
                <center>
                    <h2>Login to your account</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                    <form action="" method="post">
                        <p>
                            <label for="email">Your Email:</label>
                            <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please ensure your email address is valid. Example: email@address.com" required><font color="red"><sup>*</sup></font>
                        </p>
                        <p>
                            <label for="entered_password">Enter Password</label>
                            <input type="password" name="entered_password" id="entered_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Please enter the password you previously registered with" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
                        </p>
                        </p>
                            <?php echo ($correct_password) ?>
                        </p>
                        <p>
                            <input type="submit" value="Login">
                            
                            <br><br><a href="../../account/company/company_register.php">Register Company account</a>
                        </p>
                    </form>
                    <?php
                    
                    /*if(!isset($bFieldRequired)){
                        echo ("");
                    }
                    else if(isset($bFieldRequired) && $bFieldRequired){
                        echo ("<font color='red'>Required fields not completed</font>");
                    }
                    else if (isset($successDB) && !$successDB){
                        echo ("<font color='red'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
                        //header( 'Location: ../../error.html' ) ;
                    }
                    else if (isset($successDB) && $successDB){
                        echo ("<font color='#3eb740'>Thank you. You are logged in</font>");
                    }*/
                    ?>
                    <br><br>
                    <table>
                    <tr>
                        <td colspan="2">
                            <h4><b><u>Your Details:</b></u></h4>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h4>Company Name:</h4>
                        </td>
                        <td>
                            <?php echo ($company_name)?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <h4>Address:</h4>
                        </td>
                        <td>
                            <?php echo ($address)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Company ID:</h4>
                        </td>
                        <td>
                           <?php echo ($comp_id)?>
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <h4>Rep's Name</h4>
                        </td>
                        <td>
                            <?php echo ($rep_name)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Rep's Phone Number</h4>
                        </td>
                        <td>
                            <?php echo ($trun_phone)?>
                        </td>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Account created on:</h4>
                        </td>
                        <td>
                            <?php echo ($converted_date)?>
                        </td>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Account created with IP:</h4>
                        </td>
                        <td>
                            <?php echo ($ip_add)?>
                        </td>
                    </td>
                    </tr>

                </table>
                    
                    
                    
                    
                    
                    
                    
                    <?php
                    /*if(!isset($bFieldRequired)){
                        echo ("");
                    }
                    else if(isset($bFieldRequired) && $bFieldRequired){
                        echo ("Required fields not completed");
                    }
                    else if (isset($successDB) && !$successDB){
                        echo ("Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error);
                        //header( 'Location: ../../error.html' ) ;
                    }
                    else if (isset($successDB) && $successDB){
                        echo ("Thank you. You're account needs to be activated. Please check your email<br><br><small>An email would be sent to the user, and the link would send them here: <a href='../user_register_login/create_password.php'>/user_register_login/create_password.php</a>.<br />In this demonstration, this is not active</small>");
                    }*/
                    ?>
                

                </center>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
 