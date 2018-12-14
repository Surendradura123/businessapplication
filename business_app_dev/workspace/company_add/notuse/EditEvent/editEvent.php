<?php
    include '../connection.php';
    include '../extras.php';
    session_start();
    
    if (!($user_type_id == '2')){
        header ('Location: /');
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

    <!--<link rel="stylesheet" type="text/css" href="css/css.css" />-->
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
    </script>
</head>

<body>
  <?php echo $header_text;?>
    <?php
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $description = $_POST['description'];
        $event_address1 = $_POST['event_address1'];
        $event_address2 = $_POST['event_address2'];
        $event_city = $_POST['event_city'];
        $event_eircode = $_POST['event_eircode'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        
        

        echo "
        <center>
        <div class='col-md-8 order-md-1'>
        <br>
           <h4 class='mb-3'>Event Edit Page</h4>
             <form method='POST' action='".editEvents($conn)."'>
                <input name='uid' type='hidden' class='form-control' value='".$uid."'>
                
            <!--Name of Event-->
            <div class='form-group'>
                <label for='Name' class='control-label'>Name of Event</label>
                <input name='name' value='".$name."' pattern='[a-zA-Z0-9\s]{1,20}' title='Only letter and number and no more than 20 letters' type='text' class='form-control' id='Name' placeholder='' required>
            </div>

            <!--Description-->
            <div class='form-group'>
                <label for='des' class='control-label'>Description</label>
                <textarea name='des' pattern='{1,20}' class='form-control' rows='5' id='des' maxlength='2000' placeholder='' required>".$des."</textarea>
            </div>

            <!--Address-->
            <div class='form-group'>
                <label for='address' class='control-label'>Address 1</label>
                <input name='address' value='".$address."' pattern='^[a-zA-Z0-9\s,]*$' title='Only letter and number' type='text' placeholder='Apartment or suite, 1234 Main St' required class='form-control'>
            </div>

            <!--Address2-->
            <div class='form-group'>
                <label for='address2' class='control-label'>Address 2</label>
                <input name='address2' value='".$address2."' pattern='^[a-zA-Z0-9\s,.]*$'  title='Only letter and number' type='text' placeholder='County' required class='form-control'>
            </div>

            <!--Row Start Selecter Country/City-->
            <div class='form-group'>
                <div class='row'>
                    <!--Selecter Country-->
                    <div class='col-md-5 mb-3'>
                        <label for='country' class='control-label'>Country</label>
                        <input name='country'  value='".$country."' pattern='^[a-zA-Z\s,]*$' title='Only letter' type='text' placeholder='Ireland' required class='form-control'>

                    </div>

                    <!--Selecter City-->
                    <div class='col-md-4 mb-3'>
                        <label for='state' class='control-label'>City</label>
                        <input name='city' value='".$city."' pattern='^[a-zA-Z\s,]*$' title='Only letter' type='text' placeholder='Dublin' required class='form-control'>
                    </div>

                    <!--Eircode-->
                    <div class='col-md-3 mb-3'>
                        <label for='eircode' class='control-label'>Eircode</label>
                        <input name='eircode' value='".$eircode."' pattern='[a-zA-Z0-9\s]{7}' title='Only letter and number' type='text' placeholder='' required maxlength='20' class='form-control'>
                    </div>
                    
                </div>
                <!--Row Finish-->
            
            
                <div class='webIndex'>
                    <div class='stay-list clearFloat'>
                        <div class='stay-list-left'>
                            <form>
                                <div class='sea-div'>
                                    <label class='search-lab'>Start Date</label><input type='text' name='startDate' value='".$startDate."'  readonly id='startDate' required/>
                                </div>
                                <div class='sea-div'>
                                    <label class='search-lab'>End Date</label><input type='text' readonly name='endDate' value='".$endDate."'  id='endDate' required/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
            <div class='form-group'>
                <button name='eventEdit' class='btn btn-primary' >Edit</button>
            </div>
            
        </div> 
        
        </form>
        </div>
        ";
    ?>
        
<footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2018 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.ui.js"></script>
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/hotel/hotel.search.js"></script>
        <script type="text/javascript" src="js/datetime.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>

</body>

</html>