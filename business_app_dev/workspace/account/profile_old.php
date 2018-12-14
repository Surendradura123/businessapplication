<?php

// ***** Note: This page is not in use, but is an earlier draft of profile.php
// ***** It does not contain the full references or comments as the profile.php page does.
// ***** The difference between this draft and profile.php is that the Profile details of the relevant user would display on this one page. It became problemmatic and decided to seperate them into the respective Customer and Company folders instead.

include "../connection.php";
include "../extras.php";
    
    
    //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another
    $cookie_name    = "user";
    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.
    $email2         = $email;
    $email3         = $email;
    
    $query  = "SELECT * FROM Customer WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed

        $row             = $result->fetch_assoc(); /* These lines query the database when user enters email */

               
        $customer_id     = $row['customer_id']; //
        $first_name      = $row['first_name'];//
        $last_name       = $row['last_name'];//
        $phone_home      = $row['phone_home'];//
        $phone_mobile    = $row['phone_mobile'];//
        $user_type_id    = $row['user_type_id'];
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

    }
    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.
       $query2         = "SELECT * FROM Company WHERE rep_email = '$email2'";
       $result2        = $db->query($query2);
           if($result2->num_rows>0){

                
                $row2           = $result2->fetch_assoc(); /* These lines query the database when user enters email */
    
                $company_id     = $row2["company_id"];//
                $name           = $row2["name"];//
                $address1       = $row2["address1"];//
                $address2       = $row2["address2"];//
                $city           = $row2["city"];//
                $eircode        = $row2["eircode"];//
                $rep_first_name = $row2["rep_first_name"];//
                $rep_last_name  = $row2["rep_last_name"];//
                $rep_phone      = $row2["rep_phone"];
                $user_type_id   = $row2["user_type_id"];
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
    }
   
    $converted_date = date("l, j F, Y - G:i:s (T)",strtotime($created_on)); //converts MySQL time to readable time -  @ref: http://php.net/manual/en/function.date.php

    if ($user_type_id == '1'){
        $user_type = 'Customer';
        $customer = true;
        $company = false; // $customer ands $company are used to show the correct details for the specific user.
    }
    else if ($user_type_id == '2'){
        $user_type = 'Company';
        $company = true;
        $customer = false;
    }
    else if ($user_type_id == '3'){
        $user_type = 'Admin';
    }
    else{
        $user_type = "(not set)";
    }
    
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
    
?>
<html>
<head>
    <title>Hybrid - Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- Header start -->
<div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
  <div class="header-right">
    <a href="/">Home</a>
    <div class="dropdown">
    <button class="active dropbtn">Account

    </button>
    <div class="dropdown-content">
      <a href="../account/register.php">Register</a>
      <a href="../account/profile.php" class="active">Profile</a>
      <a href="../account/edit.php">Edit details</a>
      <a href="../account/logged_out.php">Sign out</a>
    </div>
  </div> 
    <a href="../company_add/addEvent.php">Event</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>
<!-- Header end -->
        <?php // echo "Email: ".$_COOKIE[$cookie_name]; ?>
    <center>

     <table>
        <tr>
            <th colspan="2">
                <h4><b><u>Profile</b></u></h4>
            </th>
    
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("<b>Email Address:");
                }
                else if ($company == true){
                    echo ("<b>Rep. Email Address:");
                }
                else{
                    echo ("You are not logged in or you do not have permission to view this page.");
                }
                ?>
            </td>
            <td>
                <?php
                if (($customer == true) || ($company == true)){
                    echo ($email);
                }
                else{
                    echo "&nbsp;";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("<b>Customer ID:</b>");
                }
                else if ($company == true){
                    echo ("<b>Company ID:</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo ($customer_id);
                }
                else if ($company == true){
                    echo ($company_id);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("<b>First Name:</b>");
                }
                else if ($company == true){
                    echo ("<b>Company Name:</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo ($first_name);
                }
                else if ($company == true){
                    echo ($name);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("<b>Last Name:</b>");
                }
                else if ($company == true){
                    echo ("<b>Address 1</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo ($last_name);
                }
                else if ($company == true){
                    echo ($address1);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("<b>Phone (Home):</b>");
                }
                else if ($company == true){
                    echo ("<b>Address 2</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo ($trun_phone_home);
                }
                else if ($company == true){
                    echo ($address2);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("<b>Phone (Mobile):</b>");
                }
                else if ($company == true){
                    echo ("<b>City:</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo ($trun_phone_mobile);
                }
                else if ($company == true){
                    echo ($city);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("");
                }
                else if ($company == true){
                    echo ("<b>Eircode</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo "";
                }
                else if ($company == true){
                    echo ($eircode);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("");
                }
                else if ($company == true){
                    echo ("<b>Rep. First Name:</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo "";
                }
                else if ($company == true){
                    echo ($rep_first_name);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("");
                }
                else if ($company == true){
                    echo ("<b>Rep. Last Name:</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo "";
                }
                else if ($company == true){
                    echo ($rep_last_name);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if ($customer == true){
                    echo ("");
                }
                else if ($company == true){
                    echo ("<b>Rep. Phone:</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if ($customer == true){
                    echo "";
                }
                else if ($company == true){
                    echo ($trun_rep_phone);
                }
                else{
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ("<b>User Type</b>");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ($user_type);
                }
                else{
                    echo ("");
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ("<b>Account created on: ");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ($converted_date);
                }
                else{
                    echo ("");
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ("<b>Account created with IP: ");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ($ip_address);
                }
                else{
                    echo ("");
                }
                ?>
            </td>
        </tr>
            <tr>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    echo ("<b>Current IP: ");
                }
                else{
                    echo ("");
                }
                ?>
            </td>
            <td>
                <?php
                if (($customer == true) || ($company == true)) {
                    $current_ip = getIP();
                    echo ($current_ip);
                }
                else{
                    echo ("");
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
            <td colspan="2">
                <?php
                if ($customer == true){
                    echo ("<center>
                            <p><a href='../account/customer/editCustomer.php' class='button'>Edit details</a></p>
                            <p>&nbsp;</p>
                            <p><a href='../account/logged_out.php' class='button'>Sign out</a></p>
                            <p><a href='/' class='button'>Home</a></p>
                            </center>
                        ");
                }
                else if ($company == true){
                    echo ("<center>
                            <p><a href='../account/company/editCompany.php' class='button'>Edit details</a></p>
                            <p>&nbsp;</p>
                            <p><a href='../account/logged_out.php' class='button'>Sign out</a></p>
                            <p><a href='/' class='button'>Home</a></p>
                            </center>
                        ");
                }
                else{
                    echo ("<center>
                            <p><a href='../account/login.php' class='button'>Login</a></p>
                            <p>&nbsp;</p>
                            <p><a href='../account/customer/customer_register.php' class='button'>Customer registration</a></p>
                            <p><a href='../account/company/company_register.php' class='button'>Company registration</a></p>
                            <p><a href='/' class='button'>Home</a></p>
                            </center>
                        ");
                }
                
                ?>
            </td>
         </tr>
    </table>
    </center>
</body>
     <?php echo $footer_msg ?>
</html>