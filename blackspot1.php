<?php 
	$server		= "localhost"; // adjust the server name
	$user		= "yenii"; // adjust the username
	$password	= "Skripsi"; // adjust the password
	$database	= "skripsi_yeni"; // adjust the target databese
	
	$con = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Failed to connect MySQL: " . mysqli_connect_error();
	}

	$query = mysqli_query($con, "SELECT * FROM blackspot ORDER BY FID ASC");
	
	$json = '{"Blackspot": [';

	
	// create looping dech array in fetch
	while ($row = mysqli_fetch_array($query)){

	// quotation marks (") are not allowed by the json string, we will replace it with the` character
	// strip_tag serves to remove html tags on strings
		$char ='"';

		$json .= 
		'{
            "FID":"'.str_replace($char,'`',strip_tags($row['FID'])).'",
			"id":"'.str_replace($char,'`',strip_tags($row['id'])).'", 
			"rasterValue":"'.str_replace($char,'`',strip_tags($row['RASTERVALU'])).'",
			"x":"'.str_replace($char,'`',strip_tags($row['x'])).'",
			"y":"'.str_replace($char,'`',strip_tags($row['y'])).'"
		},';
	}

	// omitted commas at the end of the array
	$json = substr($json,0,strlen($json)-1);

	$json .= ']}';

	// print json
	echo $json;
	
	mysqli_close($con);
	
?>