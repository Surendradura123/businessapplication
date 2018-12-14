<?php

function setEvents($conn){
    if(isset($_POST['eventSubmit'])){
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        $des = $_POST['des'];
        $address = $_POST['address'];
        $address2 = $_POST['address2']; 
        $country = $_POST['country'];
        $city = $_POST['city'];
        $eircode = $_POST['eircode'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $sql = "INSERT INTO Event (uid,name,des,address,address2,country,city,eircode,startDate,endDate) 
        VALUES ('$uid','$name','$des','$address','$address2','$country','$city','$eircode','$startDate','$endDate')";
        $result = $conn->query($sql);        
    }
}



function editEvents($conn){
     if(isset($_POST['commentSubmit'])) {
        $name = $_POST['name'];
        $des = $_POST['des'];
        $address = $_POST['address'];
        $address2 = $_POST['address2']; 
        $country = $_POST['country'];
        $city = $_POST['city'];
        $eircode = $_POST['eircode'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $sql = "UPDATE Event SET name='$name',des='$des',address='$address',address2='$address2',
        country='$country',city='$city',eircode='$eircode',startDate='$startDate',endDate='$endDate' WHERE id='$id'";
        $result = $conn->query($sql);
        header("Location:showEvent.php");
    }
    
}





function getLogin($conn){
     if(isset($_POST['loginSubmit'])){
            $uname = $_POST['uname'];
            
            $sql = "SELECT * FROM CompanyLog WHERE uname='$uname'";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result)> 0 ){
                if($row = $result->fetch_assoc()){
                    $_SESSION['id'] = $row['id'];
                    header("Location:addEvent.php?loginsucsess");
                    exit();
               
                  }
            }
            else{
                 header("Location:addEvent.php?loginfailed");
                    exit();
            }
     }
}


function userLogout(){
     if(isset($_POST['logoutSubmit'])){
         session_start();
         
         session_destroy();
          header("Location:addEvent.php");
                    exit();
     }
}






?>
  
  
  <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../company_add/index.html">Section Index</a>

