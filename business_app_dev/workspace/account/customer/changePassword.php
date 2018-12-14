<?php
include "../../extras.php";
include "../../connection.php";
    
    // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
    if(count($_POST)>0){//Check if there are variables passed in $ _POST
    
    $current_password = !empty($_POST['current_password']) ? $_POST['current_password'] : ""; /* not null */
    
    // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c 
    // This converts the current password into encrypted
    $key    = '3sc3RLrpd17'; /* random */
    $method = 'aes-256-cbc';
    $iv     = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    
    $current_password_enc = base64_encode(openssl_encrypt($current_password, $method, $key, OPENSSL_RAW_DATA, $iv));
    
    $query      = "SELECT * FROM Customer WHERE email = '$email'";
    $result     = $db->query($query);
    
    $row            = $result->fetch_assoc();
    $password_enc   = $row['password_enc']; // This code gets the current password stored in the database (encrypted)
    
    if($password_enc == $current_password_enc){ //this chacks if the current encrypted password matches the one in the database

        // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c 
        $new_password   = !empty($_POST['new_password']) ? $_POST['new_password'] : ""; /* not null */
        $key            = '3sc3RLrpd17'; /* random */
        $method         = 'aes-256-cbc';
        $iv             = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        
        $password_enc_new = base64_encode(openssl_encrypt($new_password, $method, $key, OPENSSL_RAW_DATA, $iv));

        /* Field Required */
        $aFieldRequired = [
            $current_password,
            $new_password, //without these fields, the form will not be processed
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
            $sql = "UPDATE Customer
                SET
                    password_enc    = '$password_enc_new'
                WHERE
                    email           = '$email'";
    
            $successDB = $db->query($sql);
            $password_message = '';
        }
    }
            
    else{
        $password_message = "<font color='red'>Your password was not correct</font>";
    }
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
                            //If a Customer account is logged in, the showPwChange is displayed. If lot logged in or other user-type, the hidePwChange is displayed.
        var show = document.getElementById("showPwChange"); //shows the form for Company to edit their details
        var hide = document.getElementById("hidePwChange"); //hides the form from other user types.
        
        var user_type_id = "<?php echo $user_type_id?>";
        
        if (user_type_id == "1") {
            show.style.display = "block";
            hide.style.display = "none";

        } 
        else {
            show.style.display = "none"; //does not displaye
            hide.style.display = "block"; //displays block

        }
    }
        
    </script>
    <script>
    
    //@ref: https://stackoverflow.com/questions/21727317/how-to-check-confirm-password-field-in-form-without-reloading-page
    // This checks when the user enteres the password in field "new_password", that it is the same password as in field as "confirm_password". If it's not correct; a red X appreas. If it is correct, a green checkmark is appears.
    var check = function() { 
        var password_verify = document.getElementById('password_verify');
        
        
        if ((document.getElementById('new_password').value != '') && (document.getElementById('confirm_password').value != '')){
        
            if (document.getElementById('new_password').value ==
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
    
    <div id = "showPwChange">
    
        <table>
            <tr>
                        <h2>Change password</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                       	<form action="" method="post">
                        <table>
							<tr>
								<td>
									<label for="email">Email:</label>
								</td>
								<td>
									<input type="email" name="email" id="email" value="<?php echo $email;?>" readonly='true'><br><small>You cannot change your email address.</small>
								</td>
							</tr>
							<tr>
								<td colspan='2'>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td>
									<label for="current_password">Current Password</label>
                                </td>
								<td>
									<input type="password" name="current_password" id="current_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number, one uppercase and one lowercase letter, and at least 6 characters or more" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
                                </td>
							</tr>
							<tr>
								<td colspan='2'>
                                <p style='text-align:center;'><?php echo $password_message;?></p>
								</td>
							</tr>
							<tr>
								<td>
									<label for="new_password">Enter new password</label>
								</td>
								<td>
									<input type="password" name="new_password" id="new_password" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number, one uppercase and one lowercase letter, and at least 6 characters or more" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
								</td>
							</tr>
							<tr>
								<td colspan='2'>
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
    
								<input type="text" name="password_verify" id="password_verify" hidden="true">
			
								</td>
							</tr>
							<tr>
								<td colspan='2'>
									&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan='2'>
                                    
                            <!-- &nbsp;
                            <input type="text" name="login" id="login" readonly="true"/><font color="red"><sup> (required)</sup></font> -->
                            
                            
									<p style='text-align:center;'><input type="submit" value="Submit"></p>
								</td>
							</tr>
                        
						</form>
						
							<tr>
								<td colspan='2'>
								
									<?php // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland
									if(!isset($bFieldRequired)){
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
										echo ("<font color='#3eb740'>Thank you. Your password has been changed.</font>");
									}
									?>
								</td>
							</tr>
						</table>
                    
                        <br><br><br>
                                <p><a href="../../account/profile.php" class="button">Profile</a></p>
                    </center>
                </td>
            </tr>
        </table>
    </div>
    <div id="hidePwChange">
      <p>You are not logged in or you do not have permission to view this page.
        </p>
          <br><br><br>
        <p><a href="../../account/login.php" class="button">Login</a></p>
        <p><a href="/" class="button">Home</a></p>
    </p>
    </div>
</div>
</body>
</center>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>

    