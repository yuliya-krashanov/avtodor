<?php
	header('Content-Type: text/html; charset=utf-8');
	session_start();
// 		Root foulder
	$rootCatalog = $_SERVER['DOCUMENT_ROOT'];
// 		Connect database
	require_once $rootCatalog.'/config.php';
	require_once $rootCatalog.'/engine/lib/database.php';
// 		Function name
	$func = $_POST['func'];
// 		Class name
	$class = $_POST['cl'];
// 		Path to open file
	$filePath = $rootCatalog.'/engine/classes/'.$class.'.class.php';
	
	if (isset($class)) {
// 			Open file 
		require_once $filePath;
// 			Select object
    	$obj = new $class;
//     		Call function

    	$return = $obj->$func();
    	
    	$return = json_encode($return);
    	echo json_encode($return);
	}
?>