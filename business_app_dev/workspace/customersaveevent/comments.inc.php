<?php
$cookie_name = "user";
$email          = $_COOKIE[$cookie_name];
setcookie($cookie_name, $email, time() + (86400 * 30), "/"); // 86400 = 1 day



    
function getRealIpAddr() {
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
 
    return $ip;
}





function editComments($conn){
     if(isset($_POST['commentSubmit'])) {
        
        $cid = $POST['cid'];
        $email = $_POST['customer_id'];
        $date = $_POST['date'];
        $comments = $_POST['comments'];
        $ip_add = getRealIpAddr();
        
         $sql = "UPDATE Comments SET comments='$comments' WHERE customer_id='$email'";
        $result = $conn->query($sql);
        header("Location:index2.php");
    }
    
}

function deleteComments($conn){
    if(isset($_POST['commentDelete'])) {
        
        $cid = $POST['cid'];
        $email = $POST['customer_id'];
        
         $sql = "DELETE FROM Comments WHERE cid='$cid' AND customer_id='$email' ";
        $result = $conn->query($sql);
        header("Location:index2.php");
    }
    
}



?>