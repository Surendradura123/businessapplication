<?php
include "../../extras.php";
include "../../connection.php";
    
$cookie_name    = "admin_edit_customer";
$customer_email  = $_COOKIE[$cookie_name]; //this gets the saved email address saved in the cookie "admin_edit_customer".

if ($customer_email == "") {
     $no_email = true; //this if runs if there is NO email in the cookie.
}
else{ //this else runs if there is an email is the cookie.
     $no_email = false; 
     if(count($_POST)>0){//Check if there are variables passed in $ _POST
         $delete = !empty($_POST ['delete']) ? $_POST['delete'] : ""; //this is just to confirm that the admin wants to delete the account.
     
     
             /* Field Required */
         $aFieldRequired = [
             $delete  //without these fields, the form will not be processed
         ];
         /* End */
     
         /* Check Filled Fields */
         $bFieldRequired = false;
         foreach($aFieldRequired as $aField){
             if(trim($aField) == ""){
                 $bFieldRequired = true;
                 break;
             }
         
             //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another/50875462#50875462
             $query  = "DELETE FROM Customer WHERE email = '$customer_email'";
             $db->query($query); //this deletes the account.
             
             $query2  = "SELECT * FROM Customer WHERE email = '$customer_email'";
             $result2 = $db->query($query2); //this checks to make sure the account was actually deleted.
             
             if ($result2->num_rows == 0){
               $cookie_name    = "admin_edit_customer";
               setcookie($cookie_name, $cookie_value, -3600, "/"); //if the account was sucessfully deleted, the cookie info for "account_edit_company" is deleted. setting the time to -3600 is setting it to one hour in the past.
               $customer_email = "";
               $message        = "<font color='#3eb740' style='background-color: #FFFF00'>Account deleted.</font>";
               
     
             }
             else //if num_rows > 0, account would not be deleted as it's still present in the db, this is just included incase something wrong happens.
             {
                $message = "<font color='red' style='background-color: #FFFF00'>The account was not deleted.</font>";
             }
           
                 
         }
     }
     
}

    if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.
         header( 'Location: /' );
    }
?>
<!DOCTYPE html>
<html>
     <head>
          <title>Hybrid - Admin - Delete Customer</title>
          <link rel="stylesheet" href="../../css/style.css">
     </head>

<body>

<?php echo $header_text;?>

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
<?php 
     if($no_email == true){
          echo 
          ("<center>
               <br>A customer account has not been loaded.<br><br><a href='../../account/admin/customer_details.php' class='button'>Customer Details</a>
          ");
     }
     elseif($no_email == false){
          echo
               ("<center>   
                   <h2>Delete Customer account</h2>
                   <form action='' method='post'>
                       <p>
                           Are you sure you want to delete the account with email address <b>$customer_email</b>?
                           <p>
                           <label for='delete'>Type delete to confirm</label>
                           <br>
                           <input type='text' name='delete' id='delete' pattern='delete' title='Please type delete to continue.' required><font color='red'><sup>*</sup></font>
                           </p>
                       </p>
                       <p>
                           <input type='submit' value='DELETE'>
                           <br><br>
                           <a href='../../account/admin/customer_details.php' class='button'>&lt; Back</a>
                           <br><br>
                           $message
                          
                       </p>
                   </form>
               </center>");
}
?>
<p>&nbsp;</p>
<hr/>
<a href="javascript:history.back()" class="button">< Back</a><br>
<p><a href="../../account/admin/index.php" class="button">Return to Admin Index</a></p>
</center>
</body>
     <?php echo $footer_msg ?>
</html>