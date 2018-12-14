<?php
include "../../extras.php";
include "../../connection.php";
    
$cookie_name    = 'admin_edit_company';
$company_email  = $_COOKIE[$cookie_name]; //this gets the saved email address saved in the cookie "admin_edit_company".

if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.
    header( 'Location: /' );
}

if ($company_email == '') {
     $no_email = true; //this if runs if there is NO email in the cookie.
}
else{
     $no_email = false; //this else runs if there is an email is the cookie.
    
    $query  = "SELECT * FROM Company WHERE rep_email = '$company_email'";
    $result = $db->query($query);
    
    if($result->num_rows>0){

        $row2           = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */

        $company_id     = $row2['company_id'];//
        $name           = $row2['name'];//
        $address1       = $row2['address1'];//
        $address2       = $row2['address2'];//
        $city           = $row2['city'];//
        $eircode        = $row2['eircode'];//
        $rep_first_name = $row2['rep_first_name'];//
        $rep_last_name  = $row2['rep_last_name'];//
        $rep_phone      = $row2['rep_phone'];

        $comp_user_type_id   = $row2['user_type_id'];
        $password_enc   = $row2['password_enc'];
        $created_on     = $row2['created_on'];
        $ip_address     = $row2['ip_address']; //this gets the values for the email address in the cookie.
        
            
    }  
    
if(count($_POST)>0){//Check if there are variables passed in $ _POST
    
    $name_new           = !empty($_POST['name']) ? $_POST['name'] : ''; /* not null */
    $address1_new       = !empty($_POST['address1']) ? $_POST['address1'] : ''; /* not null */
    $address2_new       = !empty($_POST['address2']) ? $_POST['address2'] : '';
    $city_new           = !empty($_POST['city']) ? $_POST['city'] : ''; /* not null */
    $eircode_new        = !empty($_POST['eircode']) ? $_POST['eircode'] : '';
    $rep_first_name_new = !empty($_POST['rep_first_name']) ? $_POST['rep_first_name'] : '';
    $rep_last_name_new  = !empty($_POST['rep_last_name']) ? $_POST['rep_last_name'] : '';
    $rep_phone_new      = !empty($_POST['rep_phone']) ? $_POST['rep_phone'] : ''; 
                //this gets the new edited information from the form below

    }
    
    /* Field Required */
    $aFieldRequired = [
        $name_new,
        $address1_new,
        $city_new,
        $rep_first_name_new,
        $rep_last_name_new //without these fields, the form will not be processed
        
    ];
    /* End */

    /* Check Filled Fields */
    $bFieldRequired = false;
    foreach($aFieldRequired as $aField){
        if(trim($aField) == ''){
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
                rep_email       = '$company_email'"; //this sets the new values to the Company table where the email matches. The values were set above.

        $successDB = $db->query($sql);
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Admin - Company Edit</title>
    
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
               <br>A company account has not been loaded.<br><br><a href='../../account/admin/company_details.php' class='button'>Company Details</a>
          ");
     }
     elseif($no_email == false){ //if an email address is present in the cookie, this else will run. // Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp
          echo
               ("
<center>


    <table width='50%'>
        <tr>
            <td>
                <center>
                    <h2>Edit Company details:</h2>
                    <form action='' method='post'>
					<table>
						<tr>
							<td>
								<label for='email'>Rep Email:</label>
							</td>
							<td>
								<input type='text' name='email' id='email' value='$company_email' readonly='true'><br><small>You cannot change the email address.</small>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='company_id'>Company ID:</label>
							</td>
							<td>
								<input type='text' name='company_id' id='company_id' value='$company_id' readonly='true'><br><small>You cannot change the company ID.</small>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='name'>Company Name:</label>
							</td>
							<td>	
								<input type='text' name='name' id='name' value='$name' pattern='[a-zA-Z0-9\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only' required><font color='red'><sup>*</sup></font>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='address1'>Address 1:</label>
							</td>
							<td>
								<input type='text' name='address1' id='address1' value='$address1' pattern='[a-zA-Z0-9\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only'>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='address2'>Address 2:</label>
							</td>
							<td>
								<input type='text' name='address2' id='address2' value='$address2' pattern='[a-zA-Z0-9\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only'>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='city'>City:</label>
                            </td>
							<td>
								<input type='text' name='city' id='city' value='$city' pattern='[a-zA-Z0-9\s]{3,}' title='Min 3 characters. Letters, numbers and spaces only' required><font color='red'><sup>*</sup></font>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='eircode'>Eircode:</label>
							</td>
							<td>
								<input type='text' name='eircode' id='eircode' value='$eircode' pattern='[a-zA-Z0-9-]{6)' title='Format: D01AB2C, no spaces'>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='rep_first_name'>Rep first name:</label>
							</td>
							<td>
								<input type='text' name='rep_first_name' id='rep_first_name' value='$rep_first_name' pattern='[a-zA-Z0-9\s]+{3,}' title='Min 3 characters. Letters, numbers and spaces only' required><font color='red'><sup>*</sup></font>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='rep_last_name'>Rep last name:</label>
							</td>
							<td>
								<input type='text' name='rep_last_name' id='rep_last_name' value='$rep_last_name' pattern='[a-zA-Z0-9\s]+{3,}' tiitle='Min 3 characters. Letters, numbers and spaces onlys' required><font color='red'><sup>*</sup></font>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>
								<label for='rep_phone'>Rep phone number:</label>
							</td>
							<td>
								<input type='text' name='rep_phone' id='rep_phone' value='$rep_phone' pattern='\d{9,10}' title='Not your personal phone number. Numbers only. 9 or 10 numbers including area code.'>
							</td>
                        </tr>
						<tr>
							<td colspan='2'>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td colspan='2'>
                            <p style='text-align:center;'><input type='submit' value='Submit'></p>
							</td>");
                        ?>
                        </form>

                        </tr>
						<tr>
							<td>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td colspan="2">
                            <?php // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
                                if(!isset($bFieldRequired)){
                                    echo (''); 
                                }
                                else if(isset($bFieldRequired) && $bFieldRequired){
                                    echo ('');
                                }
                                else if (isset($successDB) && !$successDB){
                                    echo ("<font color='red' style='background-color: #FFFF00'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
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



</center>

<p>&nbsp;</p>
<hr/>
<a href="javascript:history.back()" class="button">< Back</a><br>
<p><a href="../../account/admin/index.php" class="button">Return to Admin Index</a></p>
</div>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>