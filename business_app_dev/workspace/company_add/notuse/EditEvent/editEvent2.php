<?php
    include 'connect.php';
    include 'db.php';
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>

    <link rel="stylesheet" href="css/smoothness/jquery.ui.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/css.css" />

    <title>HybirdWeb</title>
</head>

<body>
  <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../company_add/index.html">Section Index</a>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!--navbar end-->


    <!--header-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>

    <!--header end-->


    
    <?php
        $id = $_POST['id'];
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
        
        echo "
        <div class='col-md-8 order-md-1'>
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