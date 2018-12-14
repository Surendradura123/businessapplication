<?php
include "../../extras.php";
include "../../connection.php";

    
$cookie_name    = 'admin_edit_customer';
$customer_email  = $_COOKIE[$cookie_name]; //this gets the saved email address saved in the cookie "admin_edit_company".


if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.
    header( 'Location: /' );
}

if ($customer_email == '') {
     $no_email = true; //this if runs if there is NO email in the cookie.
} 
else{
     $no_email = false;  //this else runs if there is an email is the cookie.
     $query  = "SELECT * FROM Customer WHERE email = '$customer_email'";
     $result = $db->query($query);
    
    if ($result->num_rows > 0){
        
        $customer = true;
        $company  = false;
       
        $row             = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */
       
        $customer_id     = $row['customer_id']; //
        $first_name      = $row['first_name'];//
        $last_name       = $row['last_name'];//
        $phone_home      = $row['phone_home'];//
        $phone_mobile    = $row['phone_mobile'];//
        $user_type_id   = $row["user_type_id"];
        $created_on     = $row["created_on"];
        $ip_address     = $row["ip_address"]; //this gets the values for the email address in the cookie.
        
            
    }  
}
    
// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
if(count($_POST)>0){//Check if there are variables passed in $ _POST

    $first_name_new     = !empty($_POST['first_name']) ? $_POST['first_name'] : ""; /* not null */
    $last_name_new      = !empty($_POST['last_name']) ? $_POST['last_name'] : ""; /* not null */
    $phone_home_new     = !empty($_POST['phone_home']) ? $_POST['phone_home'] : ""; 
    $phone_mobile_new   = !empty($_POST['phone_mobile']) ? $_POST['phone_mobile'] : "";
                    //this gets the new edited information from the form below

    
    /* Field Required */
    $aFieldRequired = [
        $first_name,
        $last_name //without these fields, the form will not be processed
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
                email           = '$customer_email'"; //this sets the new values to the Company table where the email matches. The values were set above.

        $successDB = $db->query($sql);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Admin - Customer Edit</title>
    
    <script src= ../js/javascript.js></script>
        <link rel='stylesheet' href='../../css/style.css'>
    
    <script src='../js/javascript.js'></script>


</head>

<body>

<?php echo $header_text;?> <!-- taken from extras.php -->

    <?php
       
    if(isset($password_enc)){
       echo "";
    }else{
       echo "";
    
    /* TESTING ONLY -- is required for some reason, page will not load if not included*/
    
    } 
        

    
    ?>
<center>
<div class="bodyContainer"> 
<?php 
     if($no_email == true){ //if an email address is NOT present in the cookie, this if will run.
          echo 
          ("<center>
               <br>A customer account has not been loaded.<br><br><a href='../../account/admin/customer_details.php' class='button'>Customer Details</a>
          ");
     }
     elseif($no_email == false){ //if an email address is present in the cookie, this else will run. // Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp 
          echo
               ("
<center>

    <table width='50%'>
        <tr>
            <td>
            </td>
            <td>
                <center>
                    <h2>Edit your details:</h2>
                    <form action='' method='post'>
                    <table>
						<tr>
							<td>    
								<label for='email'>Customer Email:</label>
							</td>
							<td>
								<input type='text' name='email' id='email' value='$customer_email' readonly='true'><br><small>You cannot change the email address.</small>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='customer_id'>Customer ID:</label>
							</td>
							<td>
								<input type='text' name='customer_id' id='customer_id' value='$customer_id' readonly='true'><br><small>You cannot change the customer ID.</small>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td> 
								<label for='first_name'>First Name:</label>
                            </td>
							<td>
								<input type='text' name='first_name' id='first_name' value='$first_name' pattern='[a-zA-Z0-9\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only' required><font color='red'><sup>*</sup></font>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='last_name'>Last Name:</label>
                            </td>
							<td>
								<input type='text' name='last_name' id='last_name' value='$last_name' pattern='[a-zA-Z0-9\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only'>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>                            
								<label for='phone_home'>Phone (Home):</label>
							</td>
							<td>
								<input type='text' name='phone_home' id='phone_home' value='$phone_home' pattern='\d{0,10}' title='Numbers only. 9 or 10 numbers including area code.'>
                            </td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
                                <label for='phone_mobile'>Phone (Mobile):</label>
                            </td>
							<td>
                                <input type='text' name='phone_mobile' id='phone_mobile' value='$phone_mobile' pattern='\d{0,10}' title='Numbers only. 10 numbers including prefix.'>
                            </td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td colspan='2'>
                            <p style='text-align:center'><input type='submit' value='Submit'></p>
							</td>
						</tr>
							");
                        ?>
                         </form>
                        <tr>
							<td colspan='2'>
                            <?php // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
                                if(!isset($bFieldRequired)){
                                    echo ('');
                                }
                                else if(isset($bFieldRequired) && $bFieldRequired){
                                    echo ('');
                                }
                                else if (isset($successDB) && !$successDB){
                                    echo ("<font color='red'style='background-color: #FFFF00'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
                                    //header( 'Location: ../../error.html' ) ;
                                }
                                else if (isset($successDB) && $successDB){
                                    echo ("<font color='#3eb740' style='background-color: #FFFF00'>Thank you. The account details have been changed.</font>");

                                }
    }
?>
							</td>
                        </tr>
					</table>
                   
                
            </td>
        </tr>
    </table>



<p>&nbsp;</p>
<hr/>
<a href="javascript:history.back()" class="button">< Back</a><br>
<p><a href="../../account/admin/index.php" class="button">Return to Admin Index</a></p>
</center>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>