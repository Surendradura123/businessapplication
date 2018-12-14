<?php
// Create connection
include "../../extras.php";
include "../../connection.php";

    
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);
    
    if ($result->num_rows > 0){
       
        $row             = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */
       
        $customer_id     = $row['customer_id']; //
        $first_name      = $row['first_name'];//
        $last_name       = $row['last_name'];//
        $phone_home      = $row['phone_home'];//
        $phone_mobile    = $row['phone_mobile'];//
        $user_type_id   = $row["user_type_id"];
        $created_on     = $row["created_on"];
        $ip_address     = $row["ip_address"];
    
    }

// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland --> 
if(count($_POST)>0){//Check if there are variables passed in $ _POST

    $first_name_new     = !empty($_POST['first_name']) ? $_POST['first_name'] : ""; /* not null */
    $last_name_new      = !empty($_POST['last_name']) ? $_POST['last_name'] : ""; /* not null */
    $phone_home_new     = !empty($_POST['phone_home']) ? $_POST['phone_home'] : ""; 
    $phone_mobile_new   = !empty($_POST['phone_mobile']) ? $_POST['phone_mobile'] : "";


    
    /* Field Required */
    $aFieldRequired = [
        $first_name,
        $last_name  //without these fields, the form will not be processed
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
                first_name      = '$first_name_new', 
                last_name       = '$last_name_new', 
                phone_home      = '$phone_home_new',
                phone_mobile    = '$phone_mobile_new'
            WHERE
                email           = '$email'";

        $successDB = $db->query($sql);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Customer - Edit details</title>
    
    <script src= ../js/javascript.js></script>
    <link rel="stylesheet" href="../../css/style.css">
    
    <script>
    //@ref: https://www.w3schools.com/howto/howto_js_toggle_hide_show.asp
    //If a Customer account is logged in, the showDetails is displayed. If lot logged in or other user-type, the hideDetailse is displayed.
    function showDiv() { 
        var show = document.getElementById("showDetails"); //shows the form for Company to edit their details
        var hide = document.getElementById("hideDetails"); //hides the form from other user types.
        
        var user_type_id = "<?php echo $user_type_id ?>";
        
        if (user_type_id === "1") { // Customer = 1, shows form if this is matched.
            show.style.display = "block"; //true
            hide.style.display = "none"; //false
        } else {
            show.style.display = "none";
            hide.style.display = "block";
        }
    }

    </script>
    <!-- @ref: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_menu_icon_js  &  https://www.w3schools.com/howto/howto_css_dropdown.asp-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
</head>

<body onload="showDiv()">

     <!-- <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../account/index.html">Section Index</a> <!-- For Mid-point presentation only--> 
    <?php
       
    if(isset($password_enc)){
       echo "";
    }else{
       echo "";

    
    } 
        

    
    ?> <!-- testing only -->

<!-- Header start -->
<?php echo $header_text;?> <!-- taken from extras.php -->
<center>
<div class="bodyContainer">
    <div id="showDetails">
    
        <table width="50%">
            <tr>
                <td colspan="2">
                    <center>
    
                        
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
									<label for="customer_id">Customer ID:</label>
								</td>
                                <td>
									<input type="text" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>" readonly="true"><br><small>You cannot change your customer ID.</small>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="first_name">First Name:</label>
								</td>
                                <td>
									<input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only" required><font color="red"><sup>*</sup></font>
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="last_name">Last Name:</label>
								</td>
                                <td>
									<input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" pattern="[a-zA-Z0-9\s]{3,}" title="Min 3 characters. Letters, numbers and spaces only">
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="phone_home">Phone (Home):</label>
                                </td>
                                <td>
									<input type="text" name="phone_home" id="phone_home" value="<?php echo $phone_home; ?>" pattern="\d{9,10}" title="Numbers only. 9 or 10 numbers including area code.">
								</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
									<label for="phone_mobile">Phone (Mobile):</label>
								</td>
                                <td>	
									<input type="text" name="phone_mobile" id="phone_mobile" value="<?php echo $phone_mobile; ?>" pattern="\d{10}" title="Numbers only. 10 numbers including prefix.">
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
    <div id="hideDetails">
        <p>Sorry, you do not have permission to view this page.
        <br><br><br>
        <p><a href="../../account/profile.php" class="button">Profile</a></p>
        <p><a href="/" class="button">Home</a></p>
        </p>
    </div>
</div>
</center>

</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>