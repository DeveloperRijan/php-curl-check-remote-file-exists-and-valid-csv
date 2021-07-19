<!DOCTYPE html>
<html>
<head>
	<title>Check Remote File is exists & valid CSV in PHP CURL</title>
	<style type="text/css">
		div.wrapper{
			max-width: 500px;
    		margin: 0 auto;
			border: 1px solid #ddd;
		    padding: 20px;
		    margin-top: 30px;
		    border-radius: 3px;
		}
		div.wrapper h3{
			text-align: center;
		}


		div.wrapper form{
			display: flex;
			justify-content: space-between;	
		}
		div.wrapper form div:nth-child(1){
			width: 70%
		}
		div.wrapper form div:nth-child(2){
			width: 30%
		}
		div.wrapper input{
			width: 100%;
			outline: none;
			border: 1px solid #ddd;
			border-radius: 3px;
			padding: 10px 5px
		}
		div.wrapper input[type=submit]{
			background: blue;
			color: #fff;
			border: none;
			cursor: pointer;
		}

	</style>
</head>
<body>

	<?php
		$response = false;

		if (isset($_POST['url']) && $_POST['url'] != '') {

			$curl = curl_init();
	            curl_setopt_array( $curl, array(
	                CURLOPT_HEADER => true,
	                CURLOPT_NOBODY => true,
	                CURLOPT_RETURNTRANSFER => true,
	                CURLOPT_FOLLOWLOCATION => true,
	                CURLOPT_URL => $_POST['url'] 
	            ) 
	        );

	        curl_exec( $curl ); //execute
	        $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);  //get content type
	        curl_close( $curl );
	        

	        $valide_mimes = ['text/csv'];
	        if (in_array(strtolower($contentType), $valide_mimes)) {
	            $response = "File is valid CSV";
	        }else{
	            $response = "No valid CSV file found";
	        }
		}
	?>


	<div class="wrapper">
		<h3>Check Remote File is exists & valid CSV in PHP CURL</h3>
		<div>
			<?php
				if ($response !== false) {
					echo $response;
					$response = false;
				}
			?>
		</div>
		<form method="POST" action="">
			<div>
				<input type="url" name="url" placeholder="Enter Remote File URL">
			</div>
			<div>
				<input type="submit" name="Submit">
			</div>
		</form>
	</div>
</body>
</html>