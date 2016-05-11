 <?php
$file = fopen("meritve.txt", "r");
$ctr = 1;
$json = array();
if(!isset($_POST["ctr"]))
{
	$POSTctr = 0;
}
else
{
	$POSTctr = $_POST["ctr"];
}

if(!isset($_POST["range"]))
{
	$range= false;
}
else
{
	$range = true;
}

<<<<<<< HEAD
=======
if(!isset($_POST["type"]))
{
	$type= false;
}
else
{
	$type = true;
}

>>>>>>> 60ea1cde4a891307e81e8883d6760df74858f3d0
$counter = 1;

if(!$range)
{
	while(!feof($file))
	{
	    $line = fgets($file);
	    $tmp = explode("#",$line);
	    date_default_timezone_set('Europe/Ljubljana');
	    $datetime = str_replace("\r\n",'', $tmp[3]);
		$str = rtrim($datetime);
		if(($counter>$POSTctr) or $POSTctr==0)
		{
<<<<<<< HEAD
			$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$str);
	   		array_push($json, $tmpArray);
=======
			if($type)
			{
					$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$tmp[2]);
	   			    array_push($json, $tmpArray);
			}
			else
			{
				$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$str);
	   			array_push($json, $tmpArray);
			}
			
>>>>>>> 60ea1cde4a891307e81e8883d6760df74858f3d0
		}
	    $ctr++;
	    $counter++;
	}
}
else
{
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
<<<<<<< HEAD
			$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$str);
	   		array_push($json, $tmpArray);
=======
			if($type)
			{
					$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$tmp[2]);
	   			    array_push($json, $tmpArray);
			}
			else
			{
				$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$str);
	   			array_push($json, $tmpArray);
			}
>>>>>>> 60ea1cde4a891307e81e8883d6760df74858f3d0
		}
	    $ctr++;
	    $counter++;
	}
}

fclose($file);
$out = array('Measurements'=>$json);
echo json_encode($out, JSON_PRETTY_PRINT);

?>
