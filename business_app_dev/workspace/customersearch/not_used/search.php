  <a href="/">Main Index</a>&nbsp;-&nbsp;<a href="../customersearch/index.html">Section Index</a>
  <?php
include "header.php";
?>


<h1>Search Page</h1>

<div class = "article-container">
    
    <?php
    if(isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM users WHERE a_title LIKE '%$search%' OR a_text LIKE '%$search%' OR a_author LIKE '%$search%' OR a_date LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        
        if($queryResult > 0){
             while($row = mysqli_fetch_assoc($result)){
                   echo "<div class = 'article-bos'>
                   <h3>'.$row['sid'].'</h3>'
                    <p>'.$row['text'].'</p>
                   <p>'.$row['description']"</p>


                   </div>";
               
            }
        }else{
            echo "There are no results matching your search!";
        }
        
    }
    ?>
    
</div>
  