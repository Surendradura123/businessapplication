<?php
include "../../extras.php";
include "../../connection.php";

    
$cookie_name    = "admin_edit_company";
$company_email  = $_COOKIE[$cookie_name]; //this gets the working email from the cookie.

if ($company_email == "") {
     $no_email = true;  // This is to check whther the admin has loaded an account. If not an error message is displayed.
}
else{ 
     $no_email = false;
     
     // @ref: "Golden Years" - 3rd Year Team Project (Semester 1 2017/2018) - By: Darel, A.; Bankole, J.; Feeney, K.; Moore, C.; National College of Ireland -->
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
             $query  = "DELETE FROM Company WHERE rep_email = '$company_email'";
             $db->query($query); //this deletes the account.
             
             $query2  = "SELECT * FROM Company WHERE rep_email = '$company_email'";
             $result2 = $db->query($query2); //this checks to make sure the account was actually deleted.
             
             if ($result2->num_rows == 0){
               $cookie_name    = "admin_edit_company";
               setcookie($cookie_name, $cookie_value, -3600, "/"); //if the account was sucessfully deleted, the cookie info for "account_edit_company" is deleted. setting the time to -3600 is setting it to one hour in the past.
               $company_email = "";
               $message        = "Account deleted<br><a href='../../account/admin/index.php' class='button'>Admin Main</a>";
               
     
             }
             else //if num_rows > 0, account would not be deleted as it's still present in the db, this is just included incase something wrong happens.
             {
                $message = "Account NOT deleted";
             }
           
                 
         }
     }
     
}

    if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them to the home page..
         header( 'Location: /' );
    }
?>
<!DOCTYPE html>
<html>
     <head>
          <title>Hybrid - Admin - Delete Company</title>
          <link rel="stylesheet" href="../../css/style.css">
     </head>

<body>
<?php echo $header_text;?> <!-- taken from extras.php -->

    <?php
       
    if(isset($password_enc)){
       echo "";
    }else{
       echo "";
    
    /* TESTING ONLY -- is required for some reason, page will not load if not included */
    
    } 

    ?> <!-- testing only -->
<center>
<div class="bodyContainer">
<?php 
     if($no_email == true){ // if there was no email in the cookie (i.e. no account was loaded), this runs.
          echo 
          ("<center>
               <br>A company account has not been loaded.<br><br><a href='../../account/admin/company_details.php' class='button'>Company Details</a>
          </center>
          ");
     }
     elseif($no_email == false){ //A simple form that asks the admin to confirm they wish to delete the account
          echo
               ("<center>   
                   <h2>Delete Company account</h2>
                   <form action='' method='post'>
                       <p>
                           Are you sure you want to delete the account with email address <b>$company_email</b>?
                           <br><br>
                           <label for='delete'>Type delete to confirm</label>
                           
                           <input type='text' name='delete' id='delete' pattern='delete' title='Please type delete to continue.' required><font color='red'><sup>*</sup></font>
                       </p>
                       <p>
                           <input type='submit' value='DELETE'>
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

</div>
</center>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>