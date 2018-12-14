<?php
    include '../connection.php';
    include '../header.php';
    include '../footer.php';
    session_start();
    
    if (!($user_type_id == '2')){
        header ('Location: /');
    }

if(count($_POST)>0){//Check if there are variables passed in $ _POST

    $event_name         = !empty($_POST['event_name']) ? $_POST['event_name'] : ""; /* not null */
    $description        = !empty($_POST['description']) ? $_POST['description'] : "";
    $event_address1     = !empty($_POST['event_address1']) ? $_POST['event_address1'] : ""; /* not null */
    $event_address2     = !empty($_POST['event_address2']) ? $_POST['event_address2'] : "";
    $event_city         = !empty($_POST['event_city']) ? $_POST['event_city'] : "";
    $event_eircode      = !empty($_POST['event_eircode']) ? $_POST['event_eircode'] : "";
    $date               = !empty($_POST['date']) ? $_POST['date'] : "";
    $edit_date          = date("Y-m-d",strtotime($date));
    
    $start_time         = !empty($_POST['start_time']) ? $_POST['start_time'] : "";
    $edit_start_time    = $start_time.":00";
    
    $end_time           = !empty($_POST['end_time']) ? $_POST['end_time'] : "";
    $edit_end_time      = $end_time.":00";
    

 
    /* Field Required */
    $aFieldRequired = [
     $event_name
        
    ];
    /* End */

    /* Check Filled Fields */
    $bFieldRequired = false;
    foreach($aFieldRequired as $aField){
        if(trim($aField) == ""){
            $bFieldRequired = true;
            break;
        }
    }
    /* END */
    

    $successDB = false;
    if(!$bFieldRequired){//Insert in db only if the mandatory fields are filled.
        $sql = "INSERT INTO Event (event_id, company_id, event_name, description, event_address1, event_address2, event_city, event_eircode, date, start_time, end_time) 
        VALUES ('', '$company_id', '$event_name', '$description','$event_address1','$event_address2','$event_city','$event_eircode','$edit_date','$edit_start_time', '$edit_end_time')";

        $successDB = $db->query($sql);
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/css.css" />
    <link rel="stylesheet" href="../css/style.css">

    <title>HybirdWeb</title>
    
    <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 255) {
          val.value = val.value.substring(0, 255);
        } else {
          $('#charNum').text(255 - len);
        }
      };

    // function myFunction() {
    //     alert("Your event is submited sucessfully!");
    // }
    
    // function start_date(){
    //   //alert("");
    //     document.getElementById("start_dt").hidden=false;
    //     document.getElementById("start_ndt").hidden=true;
    // }
    
    // function start_date1(){
    //     d=new Date(document.getElementById("start_dt").value);
    //     dt=d.getDate();
    //     mn=d.getMonth()+1;
    //     yy=d.getFullYear();
    //     document.getElementById("start_ndt").value=yy+"-"+mn+"-"+dt
    //     document.getElementById("start_ndt").hidden=false;
    //     document.getElementById("start_dt").hidden=true;
    // }
    </script>
    
    
</head>

<body>
    <div class="header">
  <a href="/" class="logo">Hybrid WebSearch</a>
  &nbsp;
  <?php echo $nav_message?>
  <div class="header-right">
    <a href="/" class="active"><font color="white">Home</font></a>
    <div class="dropdown">
    <button class="dropbtn">Account

    </button>
    <div class="dropdown-content">
      <a href="../../account/register.php" class="active">Register</a>
      <a href="../../account/profile.php">Profile</a>
      <a href="../../account/edit.php">Edit details</a>
      <a href="../../account/logged_out.php">Sign out</a>
    </div>
  </div> 
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>
<!-- Header end -->
  <!--<a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../company_add/index.html">Section Index</a>-->
    <!--navbar-->
  <!--  <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
  <!--      <a class="navbar-brand" href="#">Navbar</a>-->
  <!--      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
  <!--  <span class="navbar-toggler-icon"></span>-->
  <!--</button>-->

  <!--      <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
  <!--          <ul class="navbar-nav mr-auto">-->
  <!--              <li class="nav-item active">-->
  <!--                  <a class="nav-link" href="../index.html">Home <span class="sr-only">(current)</span></a>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                  <a class="nav-link" href="#">Link</a>-->
  <!--              </li>-->
  <!--              <li class="nav-item dropdown">-->
  <!--                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
  <!--        Dropdown-->
  <!--      </a>-->
  <!--                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
  <!--                      <a class="dropdown-item" href="#">Action</a>-->
  <!--                      <a class="dropdown-item" href="#">Another action</a>-->
  <!--                      <div class="dropdown-divider"></div>-->
  <!--                      <a class="dropdown-item" href="#">Something else here</a>-->
  <!--                  </div>-->
  <!--              </li>-->
  <!--              <li class="nav-item">-->
  <!--                  <a class="nav-link disabled" href="#">Disabled</a>-->
  <!--              </li>-->
  <!--          </ul>-->
  <!--          <form class="form-inline my-2 my-lg-0">-->
  <!--              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
  <!--              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
  <!--          </form>-->
  <!--      </div>-->
  <!--  </nav>-->
    <!--navbar end-->


    <!--header-->


    <!--header end-->



    <!--Log in-->
    
    <?php
        // echo "
        // <div class='col-md-8 order-md-1'>
        // <form method='POST' action='".getLogin($db)."'>
        //     <div class='form-group'>
        //     Email&nbsp;:&nbsp;<input type='text' name='rep_email' id='rep_email'>
        //     </div>
        //     <div class='form-group'>
        //     <button type='submit' name='loginSubmit' class='btn btn-primary'>Login</button>
        //     </div>
        // </form>";
        
        // echo "
        // <form method='POST' action='".userLogout($db)."'>
        //     <div class='form-group'>
        //     <button type='submit' name='logoutSubmit' class='btn btn-primary'>Logout</button>
        //     </div>
        // </form>
        // </div>";
        
        // if(isset($_SESSION['company_id'])){
        //     echo "
        //     <div class='col-md-8 order-md-1'>
        //     <p>You are Login.</p>
        //     </div>";
        // } else{
        //     echo "
        //     <div class='col-md-8 order-md-1'>
        //     <p>You not Login.</p>
        //     </div>";
        // }
        
    ?>
    <!--Log in end-->
    
    <!--If not Log in/ Input box hidden-->
            <div class='col-md-8 order-md-1'>
            <a href='showEvent.php'><button class='btn btn-primary' >View Event</button></a>
            <br>
            <br>
        <h4 class='mb-3'>Event Add Page</h4>
        
        
        <form action="" method="post">
         
         <!--userid-->
            <div class='form-group'>
                <input name='company_id' type='text' class='form-control' value='<?php echo $company_id ?>' hidden='true'> <!-- $company_id is defined in the header.php -->
            </div>
            
             
            <!--Name of Event-->
            <div class='form-group'>
                <label for='event_name' class='control-label'>Name of Event</label>
                <input name='event_name' id='event_name' class='form-control' pattern='[a-zA-Z0-9\s]{1,20}' title='Letters and numbers only, max 20 characters.' type='text' class='form-control' placeholder='' required><font color="red"><sup>*</sup></font>
            </div>

            <!--Description-->
            <div class='form-group'>
                <label for='description' class='control-label'>Description</label>
                <textarea name='description' id='description' class='form-control' pattern='[a-zA-Z0-9\s]{50,255}' onkeyup="countChar(this)" placeholder="Minimun of 50 characters" title='Letters and numbers only.' class='form-control' rows='5'  maxlength='255'required></textarea><font color="red"><sup>*</sup></font>
                Characters left: <qqq id="charNum">255</qqq>/255
            </div>

            <!--Address-->
            <div class='form-group'>
                <label for='event_address1' class='control-label'>Address Line 1</label>
                <input name='event_address1' id='event_address1' class='form-control' pattern='^[a-zA-Z0-9\s,]*$' title='Letters and numbers only.' placeholder='Where is the event being held?' type='text' required class='form-control'><font color="red"><sup>*</sup></font>
            </div>

            <!--Address2-->
            <div class='form-group'>
                <label for='event_address2' class='control-label'>Address Line 2</label>
                <input name='event_address2' id='event_address2' class='form-control' pattern='^[a-zA-Z0-9\s,.]*$'  title='Letters and numbers only.' type='text' class='form-control'>
            </div>

            <!--Row Start Selecter Country/City-->
            <div class='form-group'>
                <div class='row'>

                    <!--Selecter City-->
                    <div class='col-md-4 mb-3'>
                        <label for='event_city' class='control-label'>City</label>
                        <input name='event_city' id='event_city' class='form-control' pattern='[a-zA-Z0-9\s]{1,100}' title='Letters and numbers only.' type='text' class='form-control'>

                    </div>

                    <!--Eircode-->
                    <div class='col-md-3 mb-3'>
                        <label for='event_eircode' class='control-label'>Eircode</label>
                        <input name='event_eircode' id='event_eircode' class='form-control' pattern='[a-zA-Z0-9\s]{7}' title='Letters and numbers only.' type='text' placeholder='' maxlength='7' class='form-control'>
                    </div>
                </div>
                <!--Row Finish-->
            
                <div class='webIndex'>
                    <div class='stay-list clearFloat'>
                        <div class='stay-list-left'>
                            <form>
                                <div class='sea-div'>
                                <label class='search-lab'>Date</label>
                                    <input type='date' name='date' id='date' placeholder='YYYY-MM-DD' required pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' title='Enter a date in this format YYYY-MM-DD'/><font color="red"><sup>*</sup></font>
                                    
                                </div>
                                <div class='sea-div'>
                                <label class='search-lab'>Start Time</label>
                                    <input type='time' name='start_time' required  pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/><font color="red"><sup>*</sup></font>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                <label class='search-lab'>End Time</label>
                                    <input type='time' name='end_time' pattern='[0-9]{2}:[0-9]{2}' title='Enter a time in the 24-hour format HH:MM'/>
                                </div>
                                
                                
                                  <input type="submit" value="Submit">
                                
                            </form>
                        </div>
                    </div>
                </div>

      <?php
                    if(!isset($bFieldRequired)){
                        echo ("");
                    }
                    else if(isset($bFieldRequired) && $bFieldRequired){
                        echo ("Required fields not completed");
                    }
                    else if (isset($successDB) && !$successDB){
                        echo ("<font color='red'>Sorry, an error occured. We are aware of this issue and working to fix it. <br><br> Technical information: ".$db->error."</font>");
                        //header( 'Location: ../../error.html' ) ;
                    }
                    else if (isset($successDB) && $successDB){
                        echo ("<font color='#3eb740'>Thank you. Your event has been created and is queued for approvial.</font>");
                    }
                    ?>
        </div>

    
    




        <!--<footer class="my-5 pt-5 text-muted text-center text-small">-->
        <!--    <p class="mb-1">&copy; 2017-2018 Company Name</p>-->
        <!--    <ul class="list-inline">-->
        <!--        <li class="list-inline-item"><a href="#">Privacy</a></li>-->
        <!--        <li class="list-inline-item"><a href="#">Terms</a></li>-->
        <!--        <li class="list-inline-item"><a href="#">Support</a></li>-->
        <!--    </ul>-->
        <!--</footer>-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.ui.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>

</body>
  <?php echo $footer_msg ?>
</html>
