<?php
include "../../extras.php";
include "../../connection.php";

    if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.
         header( 'Location: /' );
    }

// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $company_email  = !empty($_POST['company_email']) ? $_POST['company_email'] : ""; //gets email from form
    
    $cookie_name    = "admin_edit_company";
    $cookie_value   = $company_email; 
    
    setcookie($cookie_name, $cookie_value, NULL, "/"); //sets cookie: admin_edit_company with entered email

    /* Field Required */
    $aFieldRequired = [
        $company_email   //without these fields, the form will not be processed
        
    ];
    /* End */

    /* Check Filled Fields */
    $bFieldRequired = false;
    foreach($aFieldRequired as $aField){
        if(trim($aField) == ""){
            $bFieldRequired = true;
            break;
        }
    
    /* END */
    /*@reference: https://www.w3schools.com/PhP/showphpfile.asp?filename=demo_db_select_oo */
    $query  = "SELECT * FROM Company WHERE rep_email = '$company_email'";
    $result = $db->query($query); //queries db for rows matching entered email.

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed
        $message = "";
        $q_result = true;

        $row             = $result->fetch_assoc(); // These lines query the database with the email the admin has entered.
        $company_id     = $row["company_id"];//
        $name           = $row["name"];//
        $address1       = $row["address1"];//
        $address2       = $row["address2"];//
        $city           = $row["city"];//
        $eircode        = $row["eircode"];//
        $rep_first_name = $row["rep_first_name"];//
        $rep_last_name  = $row["rep_last_name"];//
        $rep_phone      = $row["rep_phone"];
        $company_user_type_id   = $row["user_type_id"]; //must be $company_user_type_id as $user_type_id is already set from the header. Will result in not allowing Admin to view page if reverted.
        $created_on     = $row["created_on"];
        $ip_address     = $row["ip_address"]; //these get the information from the db and assigns them a PHP variable.
        $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); //converts MySQL datetime format to readable date and time.

    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
        
        $q_result = false;
        $message = "<br><br><font color='red'>No result for $company_email in Customer table.</font><br><br>Would you like to load a Customer account?<br><a href='../../account/admin/customer_details.php' class='button'>Yes</a>";
        
        $cookie_name    = "admin_edit_company";
        $cookie_value   = "";
        setcookie($cookie_name, $cookie_value, 0, "/"); //removes cookie
    }
    }
    $successDB = true;
    
    
}
?>
<!DOCTYPE html>
<html>
     <head>
          <title>Hybrid - Admin - Company Details</title>
          <link rel="stylesheet" href="../../css/style.css">
     </head>
     
     <style>
        .tableHeading{
             background-color: #db9058;
        }
        
        .tableLeft{
             background-color: #e3a67a;
             text-align: right;
        }
        
        .tableRight{
             background-color: #ffba87;
        } 
 </style>


<body>
    
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
    <h2>Load Company account</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
    <form action="" method="post">
        <p>
            <label for="company_email">Company Email:</label>
            <input type="email" name="company_email" id="company_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please ensure the email address is valid. Example: email@address.com" required><font color="red"><sup>*</sup></font>
        </p>
        <p>
            <input type="submit" value="Load details">
        </p>
    </form>

    
    
<?php
if($q_result == true){ //if there is a result, the results will display, otherwise an error message will display.
    echo ("
    <center>
    
         <table>
            <tr>
                <th class='tableHeading' colspan='2'>
                    <h4><b><u>Company Details</b></u></h4>
                </th>
        
            </tr>
            <tr>
                <td class='tableLeft'>
                   <b>Reps email address:</b>
                </td>
                <td class='tableRight'>

                    $company_email

                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Company ID:</b>
                </td>
                <td class='tableRight'>

                     $company_id
                    
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Company Name:</b>
                </td>
                <td class='tableRight'>
                    $name
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Address 1</b>
                </td>
                <td class='tableRight'>

                    $address1

                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    
                    <b>Address 2</b>
                </td>
                <td class='tableRight'>
                    $address2
                    
                    
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>City:</b>
                </td>
                <td class='tableRight'>
                    $city
                    
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Eircode:</b>
                </td>
                <td class='tableRight'>
                    $eircode
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Rep. First Name:</b>
                </td>
                <td class='tableRight'>
                    $rep_first_name
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Rep. Last Name:</b>
                </td>
                <td class='tableRight'>
                  $rep_last_name
               
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Rep. Phone:</b>
                </td>
                <td class='tableRight'>
                    $rep_phone
                    
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>User Type</b>
                </td>
                <td class='tableRight'>
                    $company_user_type_id
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Account created on:</b>
                </td>
                <td class='tableRight'>
                    $converted_date
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Account created with IP:</b>
                </td>
                <td class='tableRight'>
                    $ip_address
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                    <p><a href='../../account/admin/company_edit.php' class='button'>Edit details</a></p>
                    </center>
                </td>
                <td>
                    <center>
                    <p><a href='../../account/admin/company_delete.php' class='button'>Delete Company account</a></p>
                    </center>
                </td>
        </table>
    </center> 
    ");
}
else{ 
    echo ("
    <center>
        $message
    </center>
    ");
}
?>
<p>&nbsp;</p>
<hr/>
<a href="javascript:history.back()" class="button">< Back</a><br>
<p><a href="../../account/admin/index.php" class="button">Return to Admin Index</a></p>
</center>
</div>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>
