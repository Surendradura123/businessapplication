<?php
include "../../extras.php";
include "../../connection.php";

$cookie_name = 'user';
if ($_COOKIE[$cookie_name] == ''){
    $cookie = false;  //checks to see if cookie is present so it can show relevant div (see showDiv() in <head>).
}
else{
    $cookie = true;
}

// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
if(count($_POST)>0){//Check if there are variables passed in $ _POST
        
    // @ref: https://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
    function getIP() {
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else if(!empty($_SERVER['REMOTE_ADDR']))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    else{
        $ip = "Unavailable";
    }
 
    return $ip;
    }


    $first_name     = !empty($_POST['first_name']) ? $_POST['first_name'] : ""; /* not null */
    $last_name      = !empty($_POST['last_name']) ? $_POST['last_name'] : ""; /* not null */
    $email          = !empty($_POST['email']) ? $_POST['email'] : "";  /* not null */
    $phone_home     = !empty($_POST['phone_home']) ? $_POST['phone_home'] : ""; 
    $phone_mobile   = !empty($_POST['phone_mobile']) ? $_POST['phone_mobile'] : "";
    $entered_password = NULL;
    $user_type_id   = '1';
    $date           = new DateTime(); /*gets the current datetime*/
    $created_on     = $date->format('Y-m-d H:i:s'); 
    
    $password       = !empty($_POST['password']) ? $_POST['password'] : "";
    $password_verify= !empty($_POST['password_verify']) ? $_POST['password_verify'] : "";
    $ip_address     = getIP();
    $ip_message     = "Your IP address is: ".$ip_address.".";
    
    // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c 
    $key    = '3sc3RLrpd17'; /* random */
    $method = 'aes-256-cbc';
    $iv     = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    
    $encrypted_password = base64_encode(openssl_encrypt($password , $method, $key, OPENSSL_RAW_DATA, $iv));
    
    }

    
    /* Field Required */
    $aFieldRequired = [
        $first_name,
        $last_name,
        $email
    ];
    /* End */

    /* Check Filled Fields */
    $bFieldRequired = false;
    foreach($aFieldRequired as $aField){
        if(trim($aField) == ""){
            $bFieldRequired = true;
            break;
        }
    }
    /* END */
    

    $successDB = false;
    if(!$bFieldRequired){//Insert in db only if the mandatory fields are filled.
        $sql = "INSERT INTO Customer(customer_id, first_name, last_name, email, phone_home, phone_mobile, user_type_id, password_enc, created_on, ip_address)
                VALUES ('', '$first_name', '$last_name', '$email', '$phone_home', '$phone_mobile', '$user_type_id', '$encrypted_password', '$created_on', '$ip_address')";

        $successDB = $db->query($sql);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Customer Registration</title>
    
    <link rel="stylesheet" href="../../css/style.css">
    
    <script src='../js/javascript.js'></script>
    <script>
    function showDiv() {    //@ref: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
                            //If a user is NOT logged in, showReg is displayed. If the user IS logged in, the hideReg is displayed. This prevents a logged in user from trying to register again.
        var show = document.getElementById("showReg"); //shows the form for Customer to edit their details
        var hide = document.getElementById("hideReg"); //hides the form from other user types.
        
        var cookie = "<?php echo $cookie?>";
        
        if (cookie == true){
            
                show.style.display = "none"; //showreg is hidden
                hide.style.display = "block"; //hideReg displays as a block
        }
        else{
                show.style.display = "block"; //displays block
                hide.style.display = "none"; //does not display
    
        } 
        
    }
        
    </script>
    <script>
    
    //@ref: https://stackoverflow.com/questions/21727317/how-to-check-confirm-password-field-in-form-without-reloading-page
    // This checks when the user enteres the password in field "new_password", that it is the same password as in field as "confirm_password". If it's not correct; a red X appreas. If it is correct, a green checkmark is appears.
    var check = function() { 
        var password_verify = document.getElementById('password_verify');
        
        
        if ((document.getElementById('password').value != '') && (document.getElementById('confirm_password').value != '')){
        
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = '#3eb740';
                document.getElementById('message').innerHTML = '&#10004;'; //displays green check mark
                password_verify.value = "true";
                
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = '&#10008;'; //displays red X
                password_verify.value = "";
            }
        }
        else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = '&#10008;'; //displays red X
            password_verify.value = "";
        }
    }

    </script>
    <script>
    /* @ref: https://stackoverflow.com/questions/30158574/how-to-convert-result-from-date-now-to-yyyy-mm-dd-hhmmss-ffff, edited by Feeney, K. */
       /* var login_date = function() {
        
            var d = new Date();
            
            login_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));

            var day = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            var hour =  d.getHours();
            var minute =  d.getMinutes();
            var second =  d.getSeconds();
            
            
            if (month.toString().length < 2) month = '0' + month;
            if (hour.toString().length < 2) hour = '0' + hour;
            if (minute.toString().length < 2) minute = '0' + minute;
            if (second.toString().length < 2) second = '0' + second;

            document.getElementById('login').value = year + '-' + month + '-' + day + " " + hour + ":" + minute + ":" + second;
            document.write(login_date);
        }*/
    </script>

</head>

<body onload="showDiv()">

<?php echo $header_text;?> <!-- taken from extras.php -->
        <?php /*
        echo ("entered_password: ".$entered_password."<br>enc_entered_password: ".$enc_entered_password."<br>password_enc (from db): ".$password_enc."<br> Last login date: ".$converted_date."<br><br>"); */
        //echo ("The value of ".$cookie_name. " is " .$_COOKIE[$cookie_name]);
        //echo ("<br>Client: ".$ip_client."<br>Forw: ".$ip_forw."<br>Remote: ".$ip_remote)
  

    
    ?> <!-- testing only -->
<center>
<div class="bodyContainer">
    <div id = "showReg">
    
        <table>
            <tr>
                <td colspan="2">
                    <center>
                        <h2>Customer Register</h2>
                        
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
                    
                        
                        <center><h2>Your details</h2></center> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                        <form action="" method="post">
                        <table>
                            <tr>
                                <td>
                                    <label for="first_name">First name</label>
                                </td>
                                <td>
                                    <input type="text" name="first_name" id="first_name" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last_name">Last name</label>
                                </td>
                                <td>
                                    <input type="text" name="last_name" id="last_name" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email">Email </label>
                                </td>
                                <td>
                                    <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Format: email@address.com" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone_home">Phone (Home)</label>
                                </td>
                                <td>
                                    <input type="text" name="phone_home" id="phone_home" pattern="\d{9,10}" title="Numbers only. 9 or 10 numbers including area code.">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone_mobile">Phone (Mobile)</label>
                                </td>
                                <td>
                                    <input type="text" name="phone_mobile" id="phone_mobile" pattern="\d{10}" title="Numbers only. 10 numbers including prefix.">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">Enter new password</label>
                                </td>
                                <td>
                                    <input type="password" name="password" id="password" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number, one uppercase and one lowercase letter, and at least 6 characters or more" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="confirm_password">Confirm password</label>
                                </td>
                                <td>
                                    <input type="password" name="confirm_password" id="confirm_password" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number, one uppercase and one lowercase letter, and at least 6 characters or more" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
                                    <span id='message'></span>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <?php $ip_message?>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="text" name="password_verify" id="password_verify" hidden="true">
                                </td>
                            </tr>
                            
                                                        <!-- &nbsp;
                            <input type="text" name="login" id="login" readonly="true"/><font color="red"><sup> (required)</sup></font> -->
                   
                             <tr>
                                 <td colspan="2">
                                    <p style="text-align:center"><input type="submit" value="Submit"></p>
                                </td>
                            </tr>
                        
                        </div>

                        </form>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <?php // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland
                                if(!isset($bFieldRequired)){
                                    echo ("");
                                }
                                else if(isset($bFieldRequired) && $bFieldRequired){
                                    echo ("<font color='red'>Required fields not completed</font>");
                                }
                                else if (isset($successDB) && !$successDB){
                                    echo ("<font color='red'>Sorry, an error occurred. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
                                    //header( 'Location: ../../error.html' ) ;
                                }
                                else if (isset($successDB) && $successDB){
                                    echo ("<font color='#3eb740'>Thank you. Your account needs to be activated. Please check your email</font>");
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="text-align:center"><a href="../../account/login.php" class="button">Login</a></p>
                            </td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
        </table>
    </div>
      <div id="hideReg">
          <br>You are trying to register a Customer account when you are already logged in. Please sign out first if you wish to do this.<br>
          <br><br><br>
          <br><a href="../../account/profile.php" class="button">Profile</a><br>
          <br><a href="../../account/logged_out.php" class="button">Sign out</a><br>
          <br>
      </div>
</div>
</body>
</center>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>


