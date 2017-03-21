<?php
	$time_start = microtime(true);
	try{
		$json = file_get_contents($argv[1]);
		$json = json_decode($json);

		if(json_last_error())
			throw new Exception("Error: Please check the validity of your JSON input.");

		$obj = new stdClass();
		foreach($json AS $key => $value) {
			$obj->{$key} = $value;
		}

		$encode = serialize($obj);
		
		$file = "object.txt";
		$fh = fopen($file, "w");
		if(!$fh)
			throw new Exception("Error: Cannot open file");
		fwrite($fh, $encode);
		fclose($fh);
	}catch(Exception $e){
		echo $e->getMessage() . "\n";
	}
	$time_end = microtime(true);
	$total_time = $time_end - $time_start;
	echo "Script executed in $total_time seconds\n";
?>