<?php
	define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'hello');
    define('DB_DATABASE', 'integreted_campus');
	
	unlink($_GET['path']);
	$myconn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD); 
	$seldb = mysql_select_db(DB_DATABASE,$myconn);
	$id = $_GET['id'];
	$qry = "delete from file where File_Id = $id";
	$result=mysql_query($qry);
	if ($result)
		echo "file removed successfully";	
	
	

?>
