{"filter":false,"title":"comments.inc.php","tooltip":"/admin_main/comments.inc.php","undoManager":{"mark":36,"position":36,"stack":[[{"start":{"row":25,"column":0},"end":{"row":37,"column":1},"action":"remove","lines":["function setComments($conn){","    if(isset($_POST['commentSubmit'])){","        $email = $_POST['customer_id'];","        $date = $_POST['date'];","        $comments = $_POST['comments'];","        $ip_add = getRealIpAddr();","        ","        $sql = \"INSERT INTO Comments (customer_id,date,comments,ip_add) VALUES ('$email ','$date','$comments','$ip_add')\";","        $result = $conn->query($sql);","    }","    ","    ","}"],"id":2}],[{"start":{"row":61,"column":0},"end":{"row":89,"column":0},"action":"remove","lines":["function editComments($conn){","     if(isset($_POST['commentSubmit'])) {","        ","        $cid = $POST['cid'];","        $email = $_POST['customer_id'];","        $date = $_POST['date'];","        $comments = $_POST['comments'];","        $ip_add = getRealIpAddr();","        ","         $sql = \"UPDATE Comments SET comments='$comments' WHERE customer_id='$email'\";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}","","function deleteComments($conn){","    if(isset($_POST['commentDelete'])) {","        ","        $cid = $POST['cid'];","        $email = $POST['customer_id'];","        ","         $sql = \"DELETE FROM Comments WHERE cid='$cid' AND customer_id='$email' \";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}",""],"id":3}],[{"start":{"row":27,"column":0},"end":{"row":64,"column":2},"action":"remove","lines":["function getComments($conn){","    $sql = \"SELECT * FROM Comments\";","    $result = $conn->query($sql);","    while($row = $result->fetch_assoc()){","            ","             echo \"<div class='comment-box'><p>\";","             echo $row['customer_id'].\"<br>\";","            echo $row['date'].\"<br>\";","            echo nl2br($row['comments'].\"<br>\");","             ","            echo \"</p>\";","            ","                    ","                     echo \" <form class='edit-form' method='POST' action='editComment.php'>","                    <input type='hidden'name='cid' value='\".$row['cid'].\"'>","                    <input type='hidden'name='uid' value='\".$row['customer_id'].\"'>","                    <input type='hidden'name='date' value='\".$row['date'].\"'>","                    <input type='hidden'name='comments' value='\".$row['comments'].\"'>","                    <button>Edit</button>","            </form>\";","            ","           echo \"  <form class='delete-form' method='POST' action='\".deleteComments($conn).\"'>","                    <input type='hidden'name='cid' value='\".$row['cid'].\"'>","                    <input type='hidden' name='uid' value='\".$row['customer_id'].\"'>","                    <button type='submit' name='commentDelete'>Delete</button>","            </form>\";","           ","                ","            ","            echo \"</div>\";","       }","    ","}","","","","","?>"],"id":4}],[{"start":{"row":27,"column":0},"end":{"row":55,"column":0},"action":"insert","lines":["function editComments($conn){","     if(isset($_POST['commentSubmit'])) {","        ","        $cid = $POST['cid'];","        $email = $_POST['customer_id'];","        $date = $_POST['date'];","        $comments = $_POST['comments'];","        $ip_add = getRealIpAddr();","        ","         $sql = \"UPDATE Comments SET comments='$comments' WHERE customer_id='$email'\";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}","","function deleteComments($conn){","    if(isset($_POST['commentDelete'])) {","        ","        $cid = $POST['cid'];","        $email = $POST['customer_id'];","        ","         $sql = \"DELETE FROM Comments WHERE cid='$cid' AND customer_id='$email' \";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}",""],"id":5}],[{"start":{"row":27,"column":0},"end":{"row":55,"column":0},"action":"remove","lines":["function editComments($conn){","     if(isset($_POST['commentSubmit'])) {","        ","        $cid = $POST['cid'];","        $email = $_POST['customer_id'];","        $date = $_POST['date'];","        $comments = $_POST['comments'];","        $ip_add = getRealIpAddr();","        ","         $sql = \"UPDATE Comments SET comments='$comments' WHERE customer_id='$email'\";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}","","function deleteComments($conn){","    if(isset($_POST['commentDelete'])) {","        ","        $cid = $POST['cid'];","        $email = $POST['customer_id'];","        ","         $sql = \"DELETE FROM Comments WHERE cid='$cid' AND customer_id='$email' \";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}",""],"id":6}],[{"start":{"row":27,"column":0},"end":{"row":55,"column":1},"action":"insert","lines":["function editComments($conn){","     if(isset($_POST['commentSubmit'])) {","        ","        $cid = $POST['cid'];","        $email = $_POST['email'];","        $event_id=$_POST['event_id'];","        $date = $_POST['date'];","        $comments = $_POST['comments'];","        $ip_add = getRealIpAddr();","        ","         $sql = \"UPDATE Comments SET comments='$comments' WHERE email ='$email'\";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}","","function deleteComments($conn){","    if(isset($_POST['commentDelete'])) {","        ","        $cid = $POST['cid'];","        $email = $POST['email'];","        ","         $sql = \"DELETE FROM Comments WHERE cid='$cid' AND email='$email' \";","        $result = $conn->query($sql);","        header(\"Location:index2.php\");","    }","    ","}"],"id":7}],[{"start":{"row":55,"column":1},"end":{"row":56,"column":0},"action":"insert","lines":["",""],"id":8}],[{"start":{"row":56,"column":0},"end":{"row":56,"column":1},"action":"insert","lines":["?"],"id":9}],[{"start":{"row":56,"column":1},"end":{"row":56,"column":2},"action":"insert","lines":[">"],"id":10}],[{"start":{"row":55,"column":1},"end":{"row":56,"column":0},"action":"insert","lines":["",""],"id":11}],[{"start":{"row":56,"column":0},"end":{"row":57,"column":0},"action":"insert","lines":["",""],"id":12}],[{"start":{"row":39,"column":30},"end":{"row":39,"column":31},"action":"remove","lines":["2"],"id":13}],[{"start":{"row":39,"column":29},"end":{"row":39,"column":30},"action":"remove","lines":["x"],"id":14}],[{"start":{"row":39,"column":28},"end":{"row":39,"column":29},"action":"remove","lines":["e"],"id":15}],[{"start":{"row":39,"column":27},"end":{"row":39,"column":28},"action":"remove","lines":["d"],"id":16}],[{"start":{"row":39,"column":26},"end":{"row":39,"column":27},"action":"remove","lines":["n"],"id":17}],[{"start":{"row":39,"column":25},"end":{"row":39,"column":26},"action":"remove","lines":["i"],"id":18}],[{"start":{"row":39,"column":25},"end":{"row":39,"column":68},"action":"insert","lines":["../admin_main/index2.php?event_id=$event_id"],"id":19}],[{"start":{"row":52,"column":30},"end":{"row":52,"column":31},"action":"remove","lines":["2"],"id":20}],[{"start":{"row":52,"column":29},"end":{"row":52,"column":30},"action":"remove","lines":["x"],"id":21}],[{"start":{"row":52,"column":28},"end":{"row":52,"column":29},"action":"remove","lines":["e"],"id":22}],[{"start":{"row":52,"column":27},"end":{"row":52,"column":28},"action":"remove","lines":["d"],"id":23}],[{"start":{"row":52,"column":26},"end":{"row":52,"column":27},"action":"remove","lines":["n"],"id":24}],[{"start":{"row":52,"column":25},"end":{"row":52,"column":26},"action":"remove","lines":["i"],"id":25}],[{"start":{"row":52,"column":25},"end":{"row":52,"column":68},"action":"insert","lines":["../admin_main/index2.php?event_id=$event_id"],"id":26}],[{"start":{"row":44,"column":0},"end":{"row":56,"column":0},"action":"remove","lines":["function deleteComments($conn){","    if(isset($_POST['commentDelete'])) {","        ","        $cid = $POST['cid'];","        $email = $POST['email'];","        ","         $sql = \"DELETE FROM Comments WHERE cid='$cid' AND email='$email' \";","        $result = $conn->query($sql);","        header(\"Location:../admin_main/index2.php?event_id=$event_id.php\");","    }","    ","}",""],"id":27}],[{"start":{"row":8,"column":0},"end":{"row":23,"column":1},"action":"remove","lines":["function getRealIpAddr() {"," ","    if (!empty($_SERVER['HTTP_CLIENT_IP'])) ","    {","        $ip = $_SERVER['HTTP_CLIENT_IP'];","    }","    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ","    {","        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];","    }","    else{","        $ip = $_SERVER['REMOTE_ADDR'];","    }"," ","    return $ip;","}"],"id":28}],[{"start":{"row":1,"column":0},"end":{"row":3,"column":76},"action":"remove","lines":["$cookie_name = \"user\";","$email          = $_COOKIE[$cookie_name];","setcookie($cookie_name, $email, time() + (86400 * 30), \"/\"); // 86400 = 1 da"],"id":29}],[{"start":{"row":1,"column":0},"end":{"row":1,"column":1},"action":"remove","lines":["y"],"id":30}],[{"start":{"row":7,"column":0},"end":{"row":8,"column":0},"action":"remove","lines":["",""],"id":31}],[{"start":{"row":6,"column":0},"end":{"row":7,"column":0},"action":"remove","lines":["",""],"id":32}],[{"start":{"row":5,"column":4},"end":{"row":6,"column":0},"action":"remove","lines":["",""],"id":33}],[{"start":{"row":5,"column":0},"end":{"row":5,"column":4},"action":"remove","lines":["    "],"id":34}],[{"start":{"row":4,"column":0},"end":{"row":5,"column":0},"action":"remove","lines":["",""],"id":35}],[{"start":{"row":3,"column":0},"end":{"row":4,"column":0},"action":"remove","lines":["",""],"id":36}],[{"start":{"row":2,"column":0},"end":{"row":3,"column":0},"action":"remove","lines":["",""],"id":37}],[{"start":{"row":4,"column":0},"end":{"row":19,"column":1},"action":"remove","lines":["function editComments($conn){","     if(isset($_POST['commentSubmit'])) {","        ","        $cid = $POST['cid'];","        $email = $_POST['email'];","        $event_id=$_POST['event_id'];","        $date = $_POST['date'];","        $comments = $_POST['comments'];","        $ip_add = getRealIpAddr();","        ","         $sql = \"UPDATE Comments SET comments='$comments' WHERE email ='$email'\";","        $result = $conn->query($sql);","        header(\"Location:../admin_main/index2.php?event_id=$event_id.php\");","    }","    ","}"],"id":38}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":4,"column":0},"end":{"row":4,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1531748168308,"hash":"bd358bba85d52d5700cd5e6d13facbb4e1fe8529"}