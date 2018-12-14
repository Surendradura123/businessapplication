<?php

include "../../extras.php";
include "../../connection.php";;

$cookie_name = 'user';
if ($_COOKIE[$cookie_name] == ''){
    $cookie = false; //checks to see if cookie is present so it can show relevant div (see showDiv() in <head>).
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
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
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
    
    $name               = !empty($_POST['name']) ? $_POST['name'] : ""; /* not null */
    $address1           = !empty($_POST['address1']) ? $_POST['address1'] : ""; /* not null */
    $address2           = !empty($_POST['address2']) ? $_POST['address2'] : "";
    $city               = !empty($_POST['city']) ? $_POST['city'] : ""; /* not null */
    $eircode            = !empty($_POST['eircode']) ? $_POST['eircode'] : "";
    $rep_first_name     = !empty($_POST['rep_first_name']) ? $_POST['rep_first_name'] : "";
    $rep_last_name      = !empty($_POST['rep_last_name']) ? $_POST['rep_last_name'] : "";
    $rep_email          = !empty($_POST['rep_email']) ? $_POST['rep_email'] : "";
    $rep_phone          = !empty($_POST['rep_phone']) ? $_POST['rep_phone'] : "";
    $user_type_id       = "2";
    $date               = new DateTime(); /*gets the current datetime*/
    $created_on         = $date->format('Y-m-d H:i:s');
    $ip_address         = getIP();
    $ip_message         = "Your IP address is ".$ip_address;
    
    $password           = !empty($_POST['password']) ? $_POST['password'] : "";
    $password_verify    = !empty($_POST['password_verify']) ? $_POST['password_verify'] : "";

    
    // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c 
    $key    = '3sc3RLrpd17'; /* random */
    $method = 'aes-256-cbc';
    $iv     = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    
    $encrypted_password = base64_encode(openssl_encrypt($password, $method, $key, OPENSSL_RAW_DATA, $iv));
    
    }
    
    /* Field Required */
    $aFieldRequired = [
        $name,
        $address1,
        $city,
        $rep_first_name,
        $rep_last_name,
        $rep_email
        
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
        $sql = "INSERT INTO Company(company_id, name, address1, address2, city, eircode, rep_first_name, rep_last_name, rep_email, rep_phone, user_type_id, password_enc, created_on, ip_address)
                VALUES ('', '$name', '$address1', '$address2', '$city', '$eircode', '$rep_first_name', '$rep_last_name', '$rep_email', '$rep_phone', '$user_type_id', '$encrypted_password', '$created_on', '$ip_address')";

        $successDB = $db->query($sql);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Customer Regististration</title>
    <link rel="stylesheet" href="../../css/style.css">
    
    <script src='../js/javascript.js'></script>
    <script>
    
    function showDiv() {    //@ref: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
                            //If a user is NOT logged in, showReg is displayed. If the user IS logged in, the hideReg is displayed. This prevents a logged in user from trying to register again. 
        var show = document.getElementById("showReg"); //shows the form for Company to edit their details
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

<center>
<div class="bodyContainer">
    <div id="showReg">
    
        <table>
            <tr>
                <td colspan="2">
                    <center>
                        <h2>Company Register</h2>
                        
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
                    
                        
                        <center><h2>Your Details</h2> </center><!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                        <form action="" method="post">
                        <table>
                            <tr>
                                <td>   
									<label for="name">Company Name</label>
								</td>
                                <td>
									<input type="text" name="name" id="name" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="address1">Address 1</label>
								</td>
                                <td>
									<input type="address" name="address1" id="address1" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="address2">Address 2</label>
								</td>
                                <td>
									<input type="text" name="address2" id="address2" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only">
                                    </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="city">City</label>
								</td>
                                <td>
									<input type="text" name="city" id="city" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="eircode">Eircode</label>
								</td>
                                <td>
									<input type="text" name="eircode" id="eircode" pattern="[a-zA-Z0-9-]{6)" title="Format: D01AB2C, no spaces">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_first_name">Your first Name</label>
								</td>
                                <td>
									<input type="text" name="rep_first_name" id="rep_first_name" pattern="[a-zA-Z0-9\s]+{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_last_name">Your last Name</label>
								</td>
                                <td>	
									<input type="text" name="rep_last_name" id="rep_last_name" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces onlys" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_email">Your office email</label>
								</td>
                                <td>
									<input type="email" name="rep_email" id="rep_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  title="Not your personal email address. Format: example@address.com" required><font color="red"><sup>*</sup></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_phone">Your office phone number</label>
								</td>
                                <td>
									<input type="text" name="rep_phone" id="rep_phone" pattern="\d{9,10}" title="Not your personal phone number. Numbers only. 9 or 10 numbers including area code.">
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
								</td>
                            </tr>

                            <tr>
								<td colspan="2">
                                    <span id='message'></span>
								</td>
                            </tr>

                            <tr>
								<td colspan="2">
									<?php echo $ip_message?>
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
                                    echo ("<font color='#3eb740'>Thank you. Your account needs to be activated and verified by an admin. You will get an email shortly.</font>");
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
          <p>You are trying to register a Company account when you are already logged in. Please sign out first if you wish to do this</p>
          <br><br><br>
          <p><a href="../../account/profile.php" class="button">Profile</a></p>
          <p><a href="../../account/logged_out.php" class="button">Sign out</a></p>
          </p>
      </div>
</div>
</body>
</center>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>

