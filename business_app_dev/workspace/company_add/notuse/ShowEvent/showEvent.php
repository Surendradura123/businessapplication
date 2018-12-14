<?php
    include 'connect.php';
    include 'db.php';
    session_start();
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
    
    
    <!--If not Log in/ Input box hidden-->
    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM Event WHERE uid='$id'";
    
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $count=1;
        $id = $row['uid'];
        $sql2 ="SELECT * FROM CompanyLog WHERE id='$id' ORDER BY id desc";
        $result2 =$conn->query($sql2);
        if($row2 =$result2->fetch_assoc()){
                       echo"<div class='col-md-8 order-md-1'>";
                        echo"<div class='panel panel-default'>";
                             echo"<div class='panel-heading'>";
                               echo"<h3 class='panel-title'>{$row2['uname']}&nbsp;:&nbsp;{$row['name']}</h3>";
                             echo"</div>";
                             echo"<div class='panel-body'>";
                               echo"<p>
                                  ID&nbsp;:&nbsp;{$row['id']}<br>
                                  Description&nbsp;:&nbsp;{$row['des']}<br>
                                  Address&nbsp;:&nbsp;{$row['address']},&nbsp;{$row['address2']},&nbsp;{$row['country']},&nbsp;{$row['city']},&nbsp;{$row['eircode']}<br>
                                  Date&nbsp;:&nbsp;{$row['startDate']}~{$row['endDate']}";
                               echo"</p>";
                               
                               if($_POST['id']){
                    echo " <form class='edit-form' method=' '>
                <input type='hidden' name='name' pattern='[a-zA-Z0-9\s]{1,20}' title='Only letter and number and no more than 20 letters' type='text' class='form-control' id='Name' placeholder='' required>
                <textarea type='hidden' name='des' pattern='{1,20}' class='form-control' rows='5' id='des' maxlength='2000' placeholder='' required></textarea>
                <input type='hidden' name='address' pattern='^[a-zA-Z0-9\s,]*$' title='Only letter and number' type='text' placeholder='Apartment or suite, 1234 Main St' required class='form-control'><input name='address2' pattern='^[a-zA-Z0-9\s,.]*$'  title='Only letter and number' type='text' placeholder='County' required class='form-control'>
                <input type='hidden' name='country' pattern='^[a-zA-Z\s,]*$' title='Only letter' type='text' placeholder='Ireland' required class='form-control'>
                <input type='hidden' name='city' pattern='^[a-zA-Z\s,]*$' title='Only letter' type='text' placeholder='Dublin' required class='form-control'>
                <input type='hidden' name='eircode' pattern='[a-zA-Z0-9\s]{7}' title='Only letter and number' type='text' placeholder='' required maxlength='20' class='form-control'>
                <input type='hidden' type='text' name='startDate' value='start' readonly id='startDate' required/>
                <input type='hidden' type='text' readonly name='endDate' value='end' id='endDate' required/>";
                echo '<a href="editEvent.php?id=' . $row['id'] . '"><button style="margin-right:10px" class="btn btn-primary">Edit</button></a>';          
                    echo " </form>";
                } 
                               
                               echo '<a href="delete.php?id=' . $row['id'] . '"><button class="btn btn-primary">Delete</button></a>';
                             echo" </div>";
                        echo"</div>";
                      echo"</div>";  
                  echo"</div>";
                  
                  echo"<hr>";
       }
    }
        echo"<div class='col-md-8 order-md-1'>";
        echo"<a href='addEvent.php'><button name='backAdd' class='btn btn-primary'>Back to Add Page</button></a>";
        echo"</div>";

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

</body>

</html>
