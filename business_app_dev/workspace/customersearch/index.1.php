<?php
 include "../extras.php";
 


?>

     <!DOCTYPE hmtl>
<html>
          $header_text = "

     <head>
     	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Events page</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
          <link rel='stylesheet' type='text/css' href='/css/style.css'>
          <link rel='shortcut icon' href='img/fav_icon.ico'>

     </head>
     <body>
         <div class='header'>
      <a href='/' class='logo'>Hybrid WebSearch</a>
      &nbsp;
     <div class='header-right'>
     <a href='/'>Home</a>
     <a href='../customersaveevent/home.php'>All Events</a>
         <div class='dropdown'>
             <button class='dropbtn'>Account</button>
             <div class='dropdown-content'>
             <a href='account/register.php'>Register</a>
             <a href='account/profile.php'>Profile</a>
             <a href='account/edit.php'>Edit details</a>
             <a href='account/logged_out.php'>Sign out</a>
             </div>
         </div>
           
          
         <div class='dropdown'>
         <button class='dropbtn'>Company</button>
             <div class='dropdown-content'>
                 <a href='#'>Show Event</a>
                 <a href='company_add/addEvent.php'>Add Event</a>
                 <a href='company_add/showEvent.php'>Edit Event</a>
                 <a href='../customersaveevent/approveevents.php'>Approve Event</a>
                 <a href='company_add/showEvent.php'>Delete Event</a>
             </div>
         </div>
         
         <div class='dropdown'>
         <button class='dropbtn'>Customer</button>
             <div class='dropdown-content'>
                 <a href='../customersaveevent/myevents.php'>Saved Events</a>
                 <a href='#'>Item 2</a>
                 <a href='#'>Item 3</a>
                 <a href='#'>Item 4</a>
             </div>
         </div>
             
             <a href='customersearch/search.php'>Search</a>
             <a href='#contact'>Contact</a>
             <a href='#about'>About</a>
         </div>
     </div>
     ";

	<body>
	     
	     
	     
		<div class="container">
			<br />
			<br />
			<br />
			<h2 align="center">Live data from all the events available here</h2><br />
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search by Specific Events..............." class="form-control" />
				</div>
			</div>
			<br />
			<div id="result"></div>
		</div>
		<div style="clear:both"></div>
		<br />
		
		<br />
		<br />
		<br />

     </body>




<script>
		$(document).ready(function(){
			load_data();
			function load_data(query)
			{
				$.ajax({
					url:"fetch.php",
					method:"post",
					data:{query:query},
					success:function(data)
					{
						$('#result').html(data);
					}
				});
			}
			
			$('#search_text').keyup(function(){
				var search = $(this).val();
				if(search != '')
				{
					load_data(search);
				}
				else
				{
					load_data();			
				}
			});
		});
</script>




     
          <style>
               footer {
                   position: fixed;
                   left: 0;
                   bottom: 0;
                   width: 100%;
                   background-color: #ca97e5;
                   color: #7d24ad;
                   text-align: center;
               }
          </style>
     
     
     
     <footer><p>&copy; 2018 HybridWebSearch.com</p></footer>
     
     ";
    
</html>


