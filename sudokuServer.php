<?php
	if (array_key_exists('gameNum', $_GET)) 
	{
		$gameNum = $_GET['gameNum'];
		$default = '{"initialConfig":"100000002010200300050062010500005004"}';
		$fileText = file_get_contents('/home/geralab/pass.txt', FILE_USE_INCLUDE_PATH);
	        $password = trim($fileText);
		$user = 'geralab';
		$dbName = $user; 
		$database = new mysqli("cs.okstate.edu", $user, $password, $dbName);
		if (mysqli_connect_errno())
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$query = "SELECT initialConfig FROM MiniSudoku WHERE gameNum = '$gameNum';";
		$result = $database->query($query);
		if(!is_object($result))
		{
			echo json_encode($default);
		}
		else 
		{
			$row = $result->fetch_array(MYSQLI_ASSOC);
			if(!$row) 
			{
				echo $default;
			}
			else 
			{
				echo json_encode($row);
			}
		}
	}  
?>
