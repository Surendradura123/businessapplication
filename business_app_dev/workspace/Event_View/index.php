<?php
 include "../extras.php";
 


?>
<!DOCTYPE hmtl>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Events page</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
		<link rel="stylesheet" href="../css/style.css">
		
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
	</head>
	<body>

		<div class="container">
			<br />
			<br />
			<br />
			<h2 align="center">Live data from all the events available here</h2><br />
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search by Events Details" class="form-control" />
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


</html>




