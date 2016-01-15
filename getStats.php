 <?php
$file = fopen("meritve.txt", "r");
$ctr = 1;
$json = array();
$maxW = 0;
$minW = 1000;
$maxB = 0;
$minB = 1000;
$maxWT = 0;
$minWT = 1000;
$maxBT = 0;
$minBT = 1000;

	while(!feof($file))
	{
	    $line = fgets($file);
	    $tmp = explode("#",$line);
	    date_default_timezone_set('Europe/Ljubljana');
	    $datetime = str_replace("\r\n",'', $tmp[3]);
		$str = rtrim($datetime);
		$measureTS = strtotime($str);
		$hour = 12;
		$today = strtotime($hour . ':00:00');
		$yesterday= strtotime('-1 day', $today);
		if($measureTS>$yesterday)
		{
			if($tmp[0]>$maxWT)
			{
				$maxWT=$tmp[0];
			}

			if($tmp[1]>$maxBT)
			{
				$maxBT=$tmp[1];
			}

			if($tmp[0]<$minWT)
			{
				$minWT=$tmp[0];
			}

			if($tmp[1]<$minBT)
			{
				$minBT=$tmp[1];
			}
		}

		if($tmp[0]>$maxW)
			{
				$maxW=$tmp[0];
			}

			if($tmp[1]>$maxB)
			{
				$maxB=$tmp[1];
			}

			if($tmp[0]<$minW)
			{
				$minW=$tmp[0];
			}

			if($tmp[1]<$minB)
			{
				$minB=$tmp[1];
			}


	}
$tmpArray = array('maxWT'=>$maxWT,'minWT'=>$minWT,'maxBT'=>$maxBT,'minBT'=>$minBT,'maxW'=>$maxW,'minW'=>$minW,'maxB'=>$maxB,'minB'=>$minB);
	   			    array_push($json, $tmpArray);
fclose($file);
$out = array('Stats'=>$json);
echo json_encode($out, JSON_PRETTY_PRINT);

?>
