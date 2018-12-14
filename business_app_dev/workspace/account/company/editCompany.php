<?php
include "../../extras.php";
include "../../connection.php";
    
    $query  = "SELECT * FROM Company WHERE rep_email = '$email'";
    $result = $db->query($query);
    
    if($result->num_rows>0){

        $row2           = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */

        $company_id     = $row2["company_id"];//
        $name           = $row2["name"];//
        $address1       = $row2["address1"];//
        $address2       = $row2["address2"];//
        $city           = $row2["city"];//
        $eircode        = $row2["eircode"];//
        $rep_first_name = $row2["rep_first_name"];//
        $rep_last_name  = $row2["rep_last_name"];//
        $rep_phone      = $row2["rep_phone"];

        $user_type_id   = $row2["user_type_id"];
        $password_enc   = $row2['password_enc'];
        $created_on     = $row2["created_on"];
        $ip_address     = $row2["ip_address"];
        
            
    }  

// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->   
if(count($_POST)>0){//Check if there are variables passed in $ _POST
    
    $name_new           = !empty($_POST['name']) ? $_POST['name'] : ""; /* not null */
    $address1_new       = !empty($_POST['address1']) ? $_POST['address1'] : ""; /* not null */
    $address2_new       = !empty($_POST['address2']) ? $_POST['address2'] : "";
    $city_new           = !empty($_POST['city']) ? $_POST['city'] : ""; /* not null */
    $eircode_new        = !empty($_POST['eircode']) ? $_POST['eircode'] : "";
    $rep_first_name_new = !empty($_POST['rep_first_name']) ? $_POST['rep_first_name'] : "";
    $rep_last_name_new  = !empty($_POST['rep_last_name']) ? $_POST['rep_last_name'] : "";
    $rep_phone_new      = !empty($_POST['rep_phone']) ? $_POST['rep_phone'] : "";

    }
    
    /* Field Required */
    $aFieldRequired = [
        $name_new,
        $address1_new,
        $city_new,
        $rep_first_name_new,
        $rep_last_name_new  //without these fields, the form will not be processed
        
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
        $sql = "UPDATE Company 
            SET 
                name            = '$name_new', 
                address1        = '$address1_new', 
                address2        = '$address2_new', 
                city            = '$city_new', 
                eircode         = '$eircode_new', 
                rep_first_name  = '$rep_first_name_new', 
                rep_last_name   = '$rep_last_name_new', 
                rep_phone       = '$rep_phone_new'
            WHERE
                rep_email       = '$email'";

        $successDB = $db->query($sql);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Company - Edit Details</title>
    
    <script src= ../js/javascript.js></script>
        <link rel="stylesheet" href="../../css/style.css">
    
    <script src='../js/javascript.js'></script>
    <script>
    //@ref: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
    //This function is shown when the body loads. It shows the details if the user_type_id matches, i.e. if it's a company account and prevents other user-types from viewing this page.
    function showDiv() { 
        var show = document.getElementById("showDetails"); //shows the form for Company to edit their details
        var hide = document.getElementById("hideDetails"); //hides the form from other user types.
        
        var user_type_id = "<?php echo $user_type_id ?>";
        
        if (user_type_id === "2") { // Company = 2, shows form if this is matched.
            show.style.display = "block"; //true
            hide.style.display = "none"; //false
        } else {
            show.style.display = "none";
            hide.style.display = "block";
        }
    }

    </script>

</head>

<body onload="showDiv()">

<?php echo $header_text;?> <!-- taken from extras.php -->

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
    <div id="showDetails">
    
        <table width="50%">
            <tr>
                <td>
                    <center>
                        <h2>Edit your details:</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                        <form action="" method="post">
                         <table>
                            <tr>
                                <td>  
									<label for="email">Your Email:</label>
								</td>
                                <td>
									<input type="text" name="email" id="email" value="<?php echo $email; ?>" readonly="true"><br><small>You cannot change your email address.</small>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="company_id">Company ID:</label>
								</td>
                                <td>	
									<input type="text" name="company_id" id="company_id" value="<?php echo $company_id; ?>" readonly="true"><br><small>You cannot change your company ID.</small>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="name">Company Name:</label>
								</td>
                                <td>
									<input type="text" name="name" id="name" value="<?php echo $name; ?>" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="address1">Address 1:</label>
								</td>
                                <td>
									<input type="text" name="address1" id="address1" value="<?php echo $address1; ?>" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only">
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="address2">Address 2:</label>
								</td>
                                <td>
									<input type="text" name="address2" id="address2" value="<?php echo $address2; ?>" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only">
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="city">City:</label>
								</td>
                                <td>
									<input type="text" name="city" id="city" value="<?php echo $city; ?>" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
								<label for="eircode">Eircode:</label>
								</td>
                                <td>
									<input type="text" name="eircode" id="eircode" value="<?php echo $eircode; ?>" pattern="[a-zA-Z0-9-]{6)" title="Format: D01AB2C, no spaces">
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_first_name">Your first name:</label>
								</td>
                                <td>
									<input type="text" name="rep_first_name" id="rep_first_name" value="<?php echo $rep_first_name; ?>" pattern="[a-zA-Z0-9\s]+{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_last_name">Your last name:</label>
								</td>
                                <td>
									<input type="text" name="rep_last_name" id="rep_last_name" value="<?php echo $rep_last_name; ?>" pattern="[a-zA-Z0-9\s]+{3,}" tiitle="Min 3 characters. Letters, numbers and spaces onlys" required><font color="red"><sup>*</sup></font>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="rep_phone">Your phone number:</label>
								</td>
                                <td>
									<input type="text" name="rep_phone" id="rep_phone" value="<?php echo $rep_phone; ?>" pattern="\d{9,10}" title="Not your personal phone number. Numbers only. 9 or 10 numbers including area code.">
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
							
                            <tr>
                                <td colspan="2">
                                <p style="text-align:center"><input type="submit" value="SUBMIT"></p>
								</td>
                            </tr>
							
							</form>
							
                            <tr>
								<td colspan="2" style="text-align:center">
                                <?php  // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland
                                    if(!isset($bFieldRequired)){
                                        echo ("");
                                    }
                                    else if(isset($bFieldRequired) && $bFieldRequired){
                                        echo ("");
                                    }
                                    else if (isset($successDB) && !$successDB){
                                        echo ("<font color='red'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
                                        //header( 'Location: ../../error.html' ) ;
                                    }
                                    else if (isset($successDB) && $successDB){
                                        echo ("<font color='#3eb740'>Thank you. Your account details have been changed.<br><small>You may not see the changes above.</small></font>");
                                    }
                                ?>
                                </td>
							</tr>
							<tr>
							    <td colspan="2">
							        &nbsp;
							    </td>
							</tr>
							<tr>
                                <td colspan="2" style="text-align:center">
									<a href="../../account/changePassword.php" class="button">Change Password</a>
                                </td>
							</tr>
							<tr>
							    <td colspan="2" style="text-align:center">
                                    <a href="../../account/profile.php" class="button">Profile</a>
                            </td>
							</tr>
							<tr>
							    <td colspan="2">
							        &nbsp;
							    </td>
							</tr>
							<tr>
							    <td colspan="2" style="text-align:center">
                                    <a href="/" class="button">Home</a>
								</td>
							</tr>
						    <tr>
							    <td colspan="2">
							        &nbsp;
							    </td>
							</td>
                        </table>   
                    
                </td>
            </tr>
        </table>
    </div>
    <div id="hideDetails">
        <p>Sorry, you do not have permission to view this page.
        <br><br><br>
        <!--<p><a href="../../account/profile.php" class="button">Profile</a></p>-->
        <!--<p><a href="/" class="button">Home</a></p>-->
        </p>
    </div>
</div>

</center>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>