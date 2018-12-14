<?php 
include "../../connection.php";
include "../../extras.php";


$cookie_name    = "user";
$email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.


$cookie_name	= "user_id";
$user_type_id	= $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the number of the user_id.

if (!($user_type_id == 2)){ // user_type 2 is Company
	header("Location: ../../account/profile.php");
}
else{

$query  = "SELECT * FROM Customer WHERE email = '$email'";
$result = $db->query($query);
    
    if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
		$query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
		$result2        = $db->query($query2);

		$row2           = $result2->fetch_assoc(); /* These lines query the database when user enters email */

		$company_id     = $row2["company_id"];
		$name           = $row2["name"];//
		$address1       = $row2["address1"];
		$address2       = $row2["address2"];
		$city           = $row2["city"];//
		$eircode        = $row2["eircode"];
		$rep_first_name = $row2["rep_first_name"];
		$rep_last_name  = $row2["rep_last_name"];
		$rep_phone      = $row2["rep_phone"];
		$password_enc   = $row2['password_enc'];
		$created_on     = $row2["created_on"];
		$ip_address     = $row2["ip_address"]; //this sets all the variables to the matching heading in the database where the email matches.
					
		if ($rep_phone == ''){
			$trun_rep_phone = '(not set)'; //if no phone number, will not display anything, if number entered, will show last 3 to 4 digits.
		}
		else{
			$trun_rep_phone = "******".substr($rep_phone, 6);
		}
	 
    }

	$user_type = 'Company';
    $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); //converts MySQL time to readable time -  @ref: http://php.net/manual/en/function.date.php
    
    
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
            <th  class="tableHeading" colspan="2">
                <h4><b><u>Profile</b></u></h4>
            </th>
    
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Rep. Email Address
            </td>
            <td class="tableRight">
                <?php
                echo ($email);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Company ID:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($company_id);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Company Name:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($name);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Address 1</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($address1);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Address 2</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($address2);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>City:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($city);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Eircode</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($eircode);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Rep. First Name:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($rep_first_name);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'>
                <b>Rep. Last Name:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($rep_last_name);
                ?>
            </td>
        </tr>
        <tr>
            <td class='tableLeft'> 
                <b>Rep. Phone:</b>
            </td>
            <td class="tableRight">
                <?php
                echo ($trun_rep_phone);
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
    </table>
    <center>
        <p><a href='../account/company/editCompany.php' class='button'>Edit details</a></p>
        <p>&nbsp;</p>
        <p><a href='../account/logged_out.php' class='button'>Sign out</a></p>
        <p><a href='/' class='button'>Home</a></p>
    </center>
            
</div>
    </center>
</body>
     <?php echo $footer_msg ?> <!-- taken from extras.php -->
</html>