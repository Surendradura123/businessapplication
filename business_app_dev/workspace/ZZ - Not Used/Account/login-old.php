<?php 
// Create connection
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "hybrid";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        //die('Could not connect: ' . mysql_error());
        header( 'Location: ../error.html' ) ;
    }
    


if(count($_POST)>0){//Check if there are variables passed in $ _POST
    $email              = !empty($_POST ['email']) ? $_POST['email'] : "";
    $entered_password   = !empty($_POST['entered_password']) ? $_POST['entered_password'] : "";
    $email2             = $email;
    
    // @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c 
    $key    = '3sc3RLrpd17'; /* random */
    $method = 'aes-256-cbc';
    $iv     = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    
    $enc_entered_password = base64_encode(openssl_encrypt($entered_password , $method, $key, OPENSSL_RAW_DATA, $iv));

    /* */
    
    
        /* Field Required */
    $aFieldRequired = [
        $email,
        $entered_password
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
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);
    
    if ($result->num_rows > 0){
       $row            = $result->fetch_assoc(); /* These lines query the dataabse when user enters email */
       $password_enc   = $row['password_enc'];
    }
    else
    {
       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result2        = $db->query($query2);
       if($result2->num_rows>0){
          $row2           = $result2->fetch_assoc(); /* These lines query the dataabse when user enters email */
          $password_enc   = $row2['password_enc'];
       }
    }

    
    /*$query  = "SELECT IFNULL(password_enc, (IFNULL(SELECT * FROM Company WHERE rep_email = '$email2'), NULL)) FROM Customer WHERE email = '$email'";
    $result = $db->query($query);
    $password_enc   = $row['password_enc'];*/
    
    /*if ($result){
        $row            = $result->fetch_assoc(); /* These lines query the dataabse when user enters email 
        $password_enc   = $row['password_enc'];
    }
    elseif(!$result){
        $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
        $result2        = $db->query($query2);
        $row2           = $result2->fetch_assoc(); /* These lines query the dataabse when user enters email 
        $password_enc   = $row2['password_enc'];
    }*/
    
    
    
    
    
   /* $row = $result->fetch_assoc(); /* These lines query the dataabse when user enters email 
    
    if (!$result){
        $query2 = "SELECT * FROM Company WHERE rep_email = '$email'";
        $result2 = $db->query($query2);
        $row = $result2->fetch_assoc(); /* These lines query the dataabse when user enters email */
    
    //}*/

    $successDB = false;

    
    //if ($entered_password == $password_enc) {
        
        /*$customer_id    = $row["customer_id"];
        $first_name     = $row["first_name"];
        $last_name      = $row["last_name"];
        $phone_home     = $row["phone_home"];
        $phone_mobile   = $row["phone_mobile"];
        $user_type_id   = $row["user_type_id"]; */
        
        $cookie_name = "user";
        $cookie_value = $email;
    
        
        if($enc_entered_password == $password_enc){ //Will only show user's details if password entered is matched with the password in the database.
        
            /*$correct_password="";
    
            $full_name      = $first_name." ".$last_name;
            
            $cust_id        = $customer_id;
            
            $trun_phone_home = "******".substr($phone_home, 6);
            $trun_phone_mobile = "******".substr($phone_mobile, 6);
            
            if($user_type_id = ""){
                $user_type_name = "";
            }
            else if($user_type_id = "1"){
                $user_type_name = "Customer";
            }
            else if ($user_type_id = "2"){
                $user_type_name = "Company";
            }
            else if ($user_type_id = "3"){
                $user_type_name = "Admin";
            }
            else{
                $user_type_name = NULL;
            }
            
            $user_type = $user_type_id." - (".$user_type_name.")";
            
            $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); //converts MySQL time to readable time -  @ref: http://php.net/manual/en/function.date.php 

            // @ref: https://www.w3schools.com/php/php_cookies.asp*/
            
            setcookie($cookie_name, $cookie_value, time() + (2592000), "/"); // 86400 = 1 day, 2592000 = 30 days

            
        
        }
        else{
            $correct_password="<font color='red'>Your email address and/or password is not valid</font>";
            setcookie($cookie_name, $cookie_value, time() - 3600); // minus 60 minutes. Will remove the cookie
        }
        $successDB = true;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hybrid - Customer Login</title>
    
    <script src= ../js/javascript.js></script>
    <!-- <script>
        var phone_home_edit = "";
        var phone_home = document.getElementById('phone_home');
        phone_home = phone_home.toString().slice(-4) + '****';
        phone_home_edit = phone_home;
    </script> -->

</head>

<body>
      <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../user_register_login/index.html">Section Index</a>
    <?php /*
        echo ("entered_password: ".$entered_password."<br>enc_entered_password: ".$enc_entered_password."<br>password_enc (from db): ".$password_enc."<br> Last login date: ".$converted_date."<br><br>"); */
       // echo ("The value of ".$cookie_name. " is " $_COOKIE[$cookie_name]);
        
        //$cookie_name = 'user';
        //$email = $_COOKIE[$cookie_name];
        
    if(isset($password_enc)){
       echo "password_enc: ".$password_enc;
    }else{
       echo "Password Not Available";
    }
        

    
    ?> <!-- testing only -->
<center>
<div>

    <table width="20%">
        <tr>
            <td colspan="2">
                <center>
                    <h2>Register</h2>
                    
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
                    <h2>Login to your account</h2> <!-- Form validation: @ref: https://www.w3schools.com/tags/att_input_pattern.asp -->
                    <form action="" method="post">
                        <p>
                            <label for="email">Your Email:</label>
                            <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please ensure your email address is valid. Example: email@address.com" required><font color="red"><sup>*</sup></font>
                        </p>
                        <p>
                            <label for="entered_password">Enter Password</label>
                            <input type="password" name="entered_password" id="entered_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Please enter the password you previously registered with" required><font color="red"><sup>*</sup></font> <!-- type is 'text' for testing only -->
                        </p>
                        </p>
                            <?php echo ($correct_password) ?>
                        </p>
                        <p>
                            <input type="submit" value="Login">
                        </p>
                    </form>
                    
                    <?php
                    
                    /*if(!isset($bFieldRequired)){
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
                        echo ("<font color='#3eb740'>Thank you. You are logged in</font>");
                    }*/
                    ?>
                    <br><br>
                    <table>
                    <tr>
                        <td colspan="2">
                            <h4><b><u>Your Details:</b></u></h4>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <h4>Name:</h4>
                        </td>
                        <td>
                            <?php echo ($full_name)?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <h4>Your ID:</h4>
                        </td>
                        <td>
                            <?php echo ($cust_id)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Phone (Home):</h4>
                        </td>
                        <td>
                           <?php echo ($trun_phone_home)?>
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <h4>Phone (Mobile)</h4>
                        </td>
                        <td>
                            <?php echo ($trun_phone_mobile)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>User Type:</h4>
                        </td>
                        <td>
                            <?php echo ($user_type)?>
                        </td>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Account created on:</h4>
                        </td>
                        <td>
                            <?php echo ($converted_date)?>
                        </td>
                    </td>
                    </tr>

                </table>
                    
                    
                    
                    
                    
                    
                    
                    <?php
                    /*if(!isset($bFieldRequired)){
                        echo ("");
                    }
                    else if(isset($bFieldRequired) && $bFieldRequired){
                        echo ("Required fields not completed");
                    }
                    else if (isset($successDB) && !$successDB){
                        echo ("Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error);
                        //header( 'Location: ../../error.html' ) ;
                    }
                    else if (isset($successDB) && $successDB){
                        echo ("Thank you. You're account needs to be activated. Please check your email<br><br><small>An email would be sent to the user, and the link would send them here: <a href='../user_register_login/create_password.php'>/user_register_login/create_password.php</a>.<br />In this demonstration, this is not active</small>");
                    }*/
                    ?>
                

                </center>
            </td>
        </tr>
    </table>
</div>