<?php 
include "../../connection.php";
include "../../extras.php";
    

$cookie_name    = "user";
$email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.

$cookie_name	= "user_id";
$user_type_id	= $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the number of the user_id.

if (!($user_type_id == '1')){ // if user type is not Customer
	header("Location: ../../account/profile.php");
}
else{
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);
	$row             = $result->fetch_assoc(); /* These lines query the database when user enters email */

	$customer_id     = $row['customer_id']; //
	$first_name      = $row['first_name'];//
	$last_name       = $row['last_name'];//
	$phone_home      = $row['phone_home'];//
	$phone_mobile    = $row['phone_mobile'];//
	$password_enc    = $row['password_enc'];
	$created_on      = $row['created_on'];
	$ip_address      = $row['ip_address']; //this sets all the variables to the matching heading in the database where the email matches.
	if ($phone_home == ''){
		$trun_phone_home = '(not set)'; //if no phone number, will not display anything, if number entered, will show last 3 to 4 digits.
	}
	else{
		$trun_phone_home = "******".substr($phone_home, 6);
	}
	
	if ($phone_mobile == '(not set)'){
				$trun_phone_mobile = ''; //if no phone number, will not display anything, if number entered, will show last 3 to 4 digits.
	}
	else{
				$trun_phone_mobile = "******".substr($phone_mobile, 6);
	}


     $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); //converts MySQL time to readable time -  @ref: http://php.net/manual/en/function.date.php
     $user_type = "Customer";
    
    // @ref: https://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
    function getIP() { //sets the current IP address
 
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if(!empty($_SERVER['REMOTE_ADDR']))
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        else{
            $ip = "Unavailable";
        }
 
    return $ip;
    }
}
?>
<html>
<head>
    <title>Hybrid - Profile</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php echo $header_text;?> <!-- taken from extras.php -->

        <?php // echo "Email: ".$_COOKIE[$cookie_name]; ?>
        
    <center>
<div class="bodyContainer"> 
     <table>
        <tr>
            <th class="tableHeading" colspan="2">
                <h4><b><u>Profile</b></u></h4>
            </th>
    
        </tr>
        <tr>
            <td class='tableLeft'>

                <b>Email Address:</b>

            </td>
            <td class="tableRight">
                <?php
                    echo ($email);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Customer ID:</b>
            </td>
            <td class="tableRight">
                <?php
                    echo ($customer_id);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>First Name:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($first_name);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
				<b>Last Name:</b>
            </td>
            <td class="tableRight">
                <?php
                    echo ($last_name);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Phone (Home):</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($trun_phone_home);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Phone (Mobile):</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($trun_phone_mobile);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>User Type</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($user_type);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Account created on:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($converted_date);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Account created with IP:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($ip_address);
                ?>
            </td>
        </tr>
            <tr>
            <td class='tableLeft'>
                <b>Current IP:</b>
            </td>
            <td class="tableRight">
                <?php
                $current_ip = getIP();
                echo ($current_ip);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                &nbsp;
            </td>
    
        </tr>
        <tr>
            <td colspan="2">

               <center>
                            <p><a href='../account/customer/editCustomer.php' class='button'>Edit details</a></p>
                            <p>&nbsp;</p>
                            <p><a href='../account/logged_out.php' class='button'>Sign out</a></p>
                            <p><a href='/' class='button'>Home</a></p>
                            </center>
            </td>
         </tr>
    </table>
</div>
    </center>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>