<?php
require_once ('user.php');
session_start();
if(isset($_POST['export'])){
	$faculty1 = new Faculty($_SESSION['USERID']);
	$faculty1 -> getCsv($_POST['courseId'], $_POST['date'], $_POST['type']);
}
?>