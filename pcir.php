<?php include_once("php_includes/check_login_status.php");

	$str = file_get_contents('php://input');
	$filename = md5(time()).'.jpg';

	$path = 'user/'.$log_username.'/'.$filename;
	file_put_contents($path,$str);
	echo $path;

?>