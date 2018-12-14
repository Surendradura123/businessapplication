<?php
    include '../connection.php';
    include '../extras.php';
    
    if (!($user_type_id == '2')){ //if user is not a Company account, send them to Home page
        header ('Location: /');
    }
    
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <!--<link rel="stylesheet" href="css/smoothness/jquery.ui.css" type="text/css" />-->
    <!--<link rel="stylesheet" type="text/css" href="css/css.css" />-->
    <link rel="stylesheet" href="../css/style.css">


    <title>HybirdWeb</title>
</head>

<body>
       
    
     <?php echo $header_text;?>

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
  <!--  <nav aria-label="breadcrumb">-->
  <!--      <ol class="breadcrumb">-->
  <!--          <li class="breadcrumb-item"><a href="#">Home</a></li>-->
  <!--          <li class="breadcrumb-item"><a href="#">Library</a></li>-->
  <!--          <li class="breadcrumb-item active" aria-current="page">Data</li>-->
  <!--      </ol>-->
  <!--  </nav>-->

    <!--header end-->
    
    
    <!--If not Log in/ Input box hidden-->
    <?php
    
//    // number of results to show per page
//    $per_page = 3;
    
//    // figure out the total pages in the database
//    $sql = "SELECT * FROM Event";
//    $result = $db->query($sql);
//    $total_results = mysqli_num_rows($result);
//    $total_pages = ceil($total_results / $per_page);
    
//    // check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
//    if (isset($_GET['page']) && is_numeric($_GET['page'])){
//         $show_page = $_GET['page'];

//         // make sure the $show_page value is valid
//         if ($show_page > 0 && $show_page <= $total_pages){
//              $start = ($show_page -1) * $per_page;
//              $end = $start + $per_page;
//              }
//         else{
//         // error - show first set of results
//              $start = 0;
//              $end = $per_page;
//              }
//      }
//    else{
//    // if page isn't set, show first set of results
//    $start = 0;
//    $end = $per_page;
//      }
   
//    // display pagination
//    echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";
//       for ($i = 1; $i <= $total_pages; $i++){
//             echo "<a href='view-paginated.php?page=$i'>$i</a> ";
//           }
//    echo "</p>";

    // display data in form
    
    echo"<center>";
    echo"<br>";
    echo"<div class='col-md-8 order-md-1'>";
    echo"<a href='company_add/addEvent.php'><button name='backAdd' class='btn btn-outline-secondary btn-lg btn-block'>Back to Add Page</button></a>";
    echo"<br>";


    $sql  = "SELECT * FROM Company WHERE rep_email = '$email'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $id = $row['company_id'];
    $sql2 = "SELECT * FROM Event WHERE company_id='$id'";
    $result2 = $db->query($sql2);
    
    while($row2 = $result2->fetch_assoc()){
        $id = $row2['company_id'];
        $sql3 ="SELECT * FROM Company WHERE company_id='$id'";
        $result3 =$db->query($sql3);
        if($row3 =$result3->fetch_assoc()){
          
          
          
          //    // loop through results of database query, displaying them in the table
          //    for ($i = $start; $i < $end; $i++){
          //    // make sure that PHP doesn't try to show results that don't exist
          //    if ($i == $total_results) { break; }
                       
                       

                       
                  
//     echo"<div class='accordion' id='accordionExample'>";
//       echo"<div class='card'>";
//           echo"<class='card-header' id='headingOne'>";
//              echo"<h5 class='mb-0'>";
//               echo"<button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>";
//                  echo"<p> {$row3['name']}&nbsp;:&nbsp;{$row2['event_name']}</p>";
//               echo"</button>";
//              echo"</h5>";
//           echo"</div>";

//           echo"<div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordionExample'>";
//              echo"<div class='card-body'>";
//                  echo"<h5 class='card-title'>Date&nbsp;:&nbsp;{$row2['date']}</h5>";
//                     echo"<p class='card-text'>ID&nbsp;:&nbsp;{$row2['event_id']}<br>
//                                   Description&nbsp;:&nbsp;{$row2['description']}<br>
//                                   Address&nbsp;:&nbsp;{$row2['event_address1']},&nbsp;{$row2['event_address2']},&nbsp;{$row2['event_city']},&nbsp;{$row2['event_eircode']}<br>
//                                   Time&nbsp;:&nbsp;{$row2['start_time']}~{$row2['end_time']}</p>";
//                     echo '<a href="company_add/edit.php?event_id=' . $row2['event_id'] . '"><button style="margin-right:10px" class="btn btn-primary">Edit</button></a>'; 
//                     echo '<a href="company_add/delete.php?event_id=' . $row2['event_id'] . '"><button class="btn btn-primary">Delete</button></a>';
//              echo"</div>";
//           echo"</div>";
          echo"</div>";
//      echo"</div>";

                       
                       

                      echo"<div class='card'>";
                          echo"<h5 class='card-header'>{$row3['name']}&nbsp;:&nbsp;{$row2['event_name']}</h5>";
                          echo"<div class='card-body'>";
                              echo"<h5 class='card-title'>Date&nbsp;:&nbsp;{$row2['date']}</h5>";
                              echo"<p class='card-text'>ID&nbsp;:&nbsp;{$row2['event_id']}<br>
                                  Description&nbsp;:&nbsp;{$row2['description']}<br>
                                  Address&nbsp;:&nbsp;{$row2['event_address1']},&nbsp;{$row2['event_address2']},&nbsp;{$row2['event_city']},&nbsp;{$row2['event_eircode']}<br>
                                  Time&nbsp;:&nbsp;{$row2['start_time']}~{$row2['end_time']}</p>";
                              echo '<a href="company_add/edit.php?event_id=' . $row2['event_id'] . '"><button style="margin-right:10px" class="btn btn-primary">Edit</button></a>'; 
                              echo '<a href="company_add/delete.php?event_id=' . $row2['event_id'] . '"><button class="btn btn-primary">Delete</button></a>';
                          echo"</div>";
                      echo"</div>";
                  echo"<hr>";
       }
    }
        
        echo"</div>";
        echo"</center>";
        echo"<br>";
    ?>



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

        <!--<script type="text/javascript" src="js/jquery.js"></script>-->
        <!--<script type="text/javascript" src="js/jquery.ui.js"></script>-->


</body>
  <?php echo $footer_msg ?>
</html>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <!--<script type="text/javascript" src="js/jquery.js"></script>-->
        <!--<script type="text/javascript" src="js/jquery.ui.js"></script>-->


