<?php
$users = array(
    	"uros" => "uros",
    	"anze" => "admin",);
$username = $_POST["username"];
$password = $_POST["password"];
if(isset($users[$username])==true){
	if($users[$username]==$password){
		echo ("true");
	}
	else{
		echo ("false");
	}
}
?>