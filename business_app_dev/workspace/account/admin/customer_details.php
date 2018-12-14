<?php
include "../../extras.php";
include "../../connection.php";
    
    if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.
         header( 'Location: /' );
    }
    
// @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $customer_email  = !empty($_POST['customer_email']) ? $_POST['customer_email'] : "";
    
    $cookie_name    = "admin_edit_customer";
    $cookie_value   = $customer_email;
    
    setcookie($cookie_name, $cookie_value, NULL, "/");

    /* Field Required */
    $aFieldRequired = [
        $customer_email   //without these fields, the form will not be processed
        
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
    $query  = "SELECT * FROM Customer WHERE email = '$customer_email'";
    $result = $db->query($query);

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed
        $message = "";
        $q_result = true;

        $row             = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */
       
        $customer_id     = $row['customer_id']; //
        $first_name      = $row['first_name'];//
        $last_name       = $row['last_name'];//
        $phone_home      = $row['phone_home'];//
        $phone_mobile    = $row['phone_mobile'];//
        $cust_user_type_id   = $row["user_type_id"];
        $created_on     = $row["created_on"];
        $ip_address     = $row["ip_address"];
       $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); 

    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
        
        $q_result = false;
        $message = "<br><br><font color='red'>No result for $customer_email in Customer table.</font><br><br>Would you like to load a Compamny account?<br><a href='../../account/admin/company_details.php' class='button'>Yes</a>";
        
        $cookie_name    = "admin_edit_customer";
        $cookie_value   = "";
        setcookie($cookie_name, $cookie_value, 0, "/");
    }
    }
    $successDB = true;
    
    
}
?>
<!DOCTYPE html>
<html>
     <head>
          <title>Hybrid - Admin - Customer Details</title>
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
    <h2>Load Customer account</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
    <form action="" method="post">
        <p>
            <label for="customer_email">Customer Email:</label>
            <input type="email" name="customer_email" id="customer_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please ensure the email address is valid. Example: email@address.com" required><font color="red"><sup>*</sup></font>
        </p>
        <p>
            <input type="submit" value="Load details">
        </p>
    </form>
  
    
    
<?php
if($q_result == true){
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
                   <b>Email address:</b>
                </td>
                <td class='tableRight'>

                    $customer_email

                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Customer ID:</b>
                </td>
                <td class='tableRight'>

                     $customer_id
                    
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>First Name:</b>
                </td>
                <td class='tableRight'>
                    $first_name
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Last Name:</b>
                </td>
                <td class='tableRight'>

                    $last_name

                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    
                    <b>Phone (Home):</b>
                </td>
                <td class='tableRight'>
                    $phone_home
                    
                    
                </td>
            </tr>
            <tr>
                <td class='tableLeft'>
                    <b>Phone (Mobile)</b>
                </td>
                <td class='tableRight'>
                    $phone_mobile
                    
                </td>
            </tr>
          <tr>
                <td class='tableLeft'>
                    <b>User Type:</b>
                </td>
                <td class='tableRight'>
                    $cust_user_type_id
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
                    <p><a href='../../account/admin/customer_edit.php' class='button'>Edit details</a></p>
                    </center>
                </td>
                <td>
                    <center>
                    <p><a href='../../account/admin/customer_delete.php' class='button'>Delete Customer account</a></p>
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
