{"filter":false,"title":"delete_company.php","tooltip":"/account/admin/delete_company.php","undoManager":{"mark":8,"position":8,"stack":[[{"start":{"row":0,"column":0},"end":{"row":58,"column":15},"action":"insert","lines":["<?php","include '../../favicon.php';","include '../../footer.php';","// Create connection","include \"../../connection.php\";","    ","    ","    //@ref: https://stackoverflow.com/questions/50875197/php-mysql-if-content-is-not-in-one-table-check-another","    $cookie_name    = 'user';","    $email          = $_COOKIE[$cookie_name]; // Gets the cookie_value from the cookie_name, i.e. the email from the type 'user'.","    $email2         = $email;","    $email3         = $email;","    ","    $query  = \"SELECT * FROM Customer WHERE email = '$email'\";","    $result = $db->query($query);","","    if ($result->num_rows > 0){ // if results are in Customer table, this if will proceed","","        $row             = $result->fetch_assoc(); /* These lines query the database when user enters email */","","        $first_name      = $row['first_name'];//","        $user_type_id    = $row['user_type_id'];","\t    $nav_message\t = \"<a href='../../account/logged_out.php'>Sign out</a>\".\"Hello \".$first_name;","","    }","    else if($result->num_rows == 0){ // if no results in the Customer table, it will search the Company table.","       $query2         = \"SELECT * FROM Company WHERE rep_email = '$email2'\";","       $result2        = $db->query($query2);","           if($result2->num_rows>0){","","                ","                $row2           = $result2->fetch_assoc(); /* These lines query the database when user enters email */","    ","                $rep_first_name = $row2[\"rep_first_name\"];","                $user_type_id   = $row2['user_type_id'];","    \t\t\t$nav_message\t = \"<a href='../../account/logged_out.php'>Sign out</a>\".\"Hello \".$rep_first_name;","             }","             else if($result2->num_rows == 0){","                 $query3     = \"SELECT * FROM Admin WHERE email = '$email3'\";","                 $result3    = $db->query($query3);","                      if($result3->num_rows>0){","                       $row3           = $result3->fetch_assoc(); /* These lines query the database when user enters email */","            ","                       $full_name     = $row3[\"full_name\"];","                       $user_type_id   = $row3['user_type_id'];","            \t\t   $nav_message\t= \"<a href='../../account/logged_out.php'>Sign out</a>\".\"Hello \".$full_name;","                       }","                       ","                       else{","                       $nav_message = \"<a href='../../account/login.php'>Log in</a>\";","                }","        }","    }","    ","    if (!($user_type_id == '3')){ //if user is not an admin, it will rediret them.","         header( 'Location: /' );","    }","?>","<!DOCTYPE html>"],"id":1}],[{"start":{"row":58,"column":0},"end":{"row":58,"column":15},"action":"remove","lines":["<!DOCTYPE html>"],"id":2},{"start":{"row":58,"column":0},"end":{"row":86,"column":6},"action":"insert","lines":["<!DOCTYPE html>","<html>","     <head>","          <title>Hybrid - Admin Main</title>","          <link rel=\"stylesheet\" href=\"../../css/style.css\">","     </head>","","<body>","<div class=\"header\">","  <a href=\"/\" class=\"logo\">Hybrid WebSearch</a>","  &nbsp;","  <?php echo $nav_message?>","  <div class=\"header-right\">","    <a href=\"/\" class=\"active\"><font color=\"white\">Home</font></a>","    <div class=\"dropdown\">","    <button class=\"dropbtn\">Account","","    </button>","    <div class=\"dropdown-content\">","      <a href=\"../../account/register.php\">Register</a>","      <a href=\"../../account/profile.php\">Profile</a>","      <a href=\"../../account/edit.php\">Edit details</a>","      <a href=\"../../account/logged_out.php\">Sign out</a>","    </div>","  </div> ","    <a href=\"#contact\">Contact</a>","    <a href=\"#about\">About</a>","  </div>","</div>"]}],[{"start":{"row":61,"column":32},"end":{"row":61,"column":36},"action":"remove","lines":["Main"],"id":3},{"start":{"row":61,"column":32},"end":{"row":61,"column":33},"action":"insert","lines":["-"]}],[{"start":{"row":61,"column":33},"end":{"row":61,"column":34},"action":"insert","lines":[" "],"id":4},{"start":{"row":61,"column":34},"end":{"row":61,"column":35},"action":"insert","lines":["D"]},{"start":{"row":61,"column":35},"end":{"row":61,"column":36},"action":"insert","lines":["e"]},{"start":{"row":61,"column":36},"end":{"row":61,"column":37},"action":"insert","lines":["l"]},{"start":{"row":61,"column":37},"end":{"row":61,"column":38},"action":"insert","lines":["e"]},{"start":{"row":61,"column":38},"end":{"row":61,"column":39},"action":"insert","lines":["t"]},{"start":{"row":61,"column":39},"end":{"row":61,"column":40},"action":"insert","lines":["e"]}],[{"start":{"row":61,"column":40},"end":{"row":61,"column":41},"action":"insert","lines":[" "],"id":5},{"start":{"row":61,"column":41},"end":{"row":61,"column":42},"action":"insert","lines":["C"]},{"start":{"row":61,"column":42},"end":{"row":61,"column":43},"action":"insert","lines":["o"]},{"start":{"row":61,"column":43},"end":{"row":61,"column":44},"action":"insert","lines":["m"]},{"start":{"row":61,"column":44},"end":{"row":61,"column":45},"action":"insert","lines":["a"]}],[{"start":{"row":61,"column":44},"end":{"row":61,"column":45},"action":"remove","lines":["a"],"id":6}],[{"start":{"row":61,"column":44},"end":{"row":61,"column":45},"action":"insert","lines":["o"],"id":7},{"start":{"row":61,"column":45},"end":{"row":61,"column":46},"action":"insert","lines":["a"]},{"start":{"row":61,"column":46},"end":{"row":61,"column":47},"action":"insert","lines":["n"]}],[{"start":{"row":61,"column":46},"end":{"row":61,"column":47},"action":"remove","lines":["n"],"id":8},{"start":{"row":61,"column":45},"end":{"row":61,"column":46},"action":"remove","lines":["a"]},{"start":{"row":61,"column":44},"end":{"row":61,"column":45},"action":"remove","lines":["o"]}],[{"start":{"row":61,"column":44},"end":{"row":61,"column":45},"action":"insert","lines":["p"],"id":9},{"start":{"row":61,"column":45},"end":{"row":61,"column":46},"action":"insert","lines":["a"]},{"start":{"row":61,"column":46},"end":{"row":61,"column":47},"action":"insert","lines":["n"]},{"start":{"row":61,"column":47},"end":{"row":61,"column":48},"action":"insert","lines":["y"]}]]},"ace":{"folds":[],"scrolltop":509,"scrollleft":0,"selection":{"start":{"row":61,"column":48},"end":{"row":61,"column":48},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":38,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1530094935247,"hash":"32feb3aa5e44468a564344dee783148f849d4508"}