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
			$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$str);
	   		array_push($json, $tmpArray);
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
			$tmpArray = array('waterLevel'=>$tmp[0],'battery'=>$tmp[1],'datetime'=>$str);
	   		array_push($json, $tmpArray);
		}
	    $ctr++;
	    $counter++;
	}
}

fclose($file);
$out = array('Measurements'=>$json);
echo json_encode($out, JSON_PRETTY_PRINT);

?>
