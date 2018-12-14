<?php

function setEvents($conn){
    if(isset($_POST['eventSubmit'])){
        $uid = $_POST['company_id'];
        $name = $_POST['name'];
        $des = $_POST['des'];
        $address = $_POST['address'];
        $address2 = $_POST['address2']; 
        $country = $_POST['country'];
        $city = $_POST['city'];
        $eircode = $_POST['eircode'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        
        $sql = "INSERT INTO companyEventAdd (company_id,name,des,address,address2,country,city,eircode,startDate,endDate) 
        VALUES ('$company_id','$name','$des','$address','$address2','$country','$city','$eircode','$startDate','$endDate')";
        $result = $conn->query($sql);        
    }
}

function showEvents($conn){
  
    $sql = "SELECT * FROM Event WHERE company_id='$id'";
    
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $id = $row['company_id'];
        $sql2 ="SELECT * FROM CompanyLog WHERE company_id='$id'";
        $result2 =$conn->query($sql2);
        if($row2 =$result2->fetch_assoc()){
            
         
                       echo"
                        <div class='col-md-8 order-md-1'>
                          <div class='panel panel-default'>
                             <div class='panel-heading'>
                               <h3 class='panel-title'>{$row2['name']}&nbsp;:&nbsp;{$row['name']}</h3>
                             </div>
                             <div class='panel-body'>
                               <p>
                                  Description&nbsp;:&nbsp;{$row['des']}<br>
                                  Address&nbsp;:&nbsp;{$row['address']},&nbsp;{$row['address2']},&nbsp;{$row['country']},&nbsp;{$row['city']},&nbsp;{$row['eircode']}<br>
                                  Date&nbsp;:&nbsp;{$row['startDate']}~{$row['endDate']}
                              </p>
                                  <a href='hybirdweb.php'><button name='backAdd' class='btn btn-primary'>Back to Add Page</button></a>
                                  <button name='AddtoCustomer' class='btn btn-primary'> Add To Me</button>
                                  <hr>
                             </div>
                           </div>
                        </div>";
                
            
       }
    }
}

?>

