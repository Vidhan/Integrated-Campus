<?php
	require_once ('php/course.php');
	require_once('php/settings/config.php');
	require_once('php/settings/sem&year.php');

	session_start();
	

if (isset ($_FILES['files'])) {
	$errors = array();
	$allowed_extensions = array('jpg','jpeg','png','gif','pdf', 'rar');
	$file_name= $_FILES['files']['name'];
	$file_ext =explode('.',$file_name);
	$file_extension=strtolower(end(($file_ext)));
	
	$file_size = $_FILES['files']['size'];
	$file_temp = $_FILES['files']['tmp_name'];
	
	if (!in_array($file_extension,$allowed_extensions)){
		$errors[] = 'Extension not allowed';
	}
	
	if ($file_size>2097152){
		$errors[] = 'File size must be under 2MB';
	}
	
	if(empty($errors)) {
		
		///////////getDetail is a method of course class///////////
		$course = new Course($_POST['courseId'],PRESENT_YEAR,PRESENT_SEM);
		$displayName = $_POST['displayName'];
		$var = $course -> getDetail('ALL');
		$courseid = $var['ID'];
		$coursename = $var['Name'];
		$year = $var['Year'];
		$sem = $var['Sem'];
		$dirname = "files/".$courseid."-".$coursename;
		$subdirname ="/".$sem."-".$year; //removing proffesor's name from the subdir name, otherwise an additional query would be reqd.
		//////////////////////////////////////////////////////////
		
		//$dirname = "files/EL-200-DSA";
		if ( !is_dir($dirname) ) {
			mkdir($dirname, 0777);
			//mkdir($dirname."/Winter-2013_Asim Banerjee", 0777);
			
	    ////////////////////////////////////////////////////////////////////
	    	$dirname = $dirname.$subdirname;
	    	mkdir($dirname, 0777);
	    ///////////////////////////////////////////////////////////////////
   
   
} else{
	
	//$dirname = "files/EL-200-DSA/Winter-2013_Asim Banerjee";
	 ////////////////////////////////////////////////////////////////////
	    	$dirname = $dirname.$subdirname;
	 ///////////////////////////////////////////////////////////////////
	if ( !is_dir($dirname) ) 
			mkdir($dirname, 0777);
}

	$myconn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD); 
	$seldb = mysql_select_db(DB_DATABASE,$myconn);
	//$path = 'files/EL-200-DSA/Winter-2013_Asim Banerjee/'.$file_name;	
	//$qry = "select File_Path from file where Uid = '201091001' and Course_Id = 'EL-200' and Year = '2013' and Sem_Type = 'Winter'";
	
	////////////////////////////////////////////////////////////////////////////
	$path = $dirname.'/'.$file_name;	
	$proffid = $_SESSION['USERID'];
	
	//$qry = "select File_Path from file where Uid = '$proffid' and Course_Id = '$courseid' and Year = '$year' and Sem_Type = '$sem'";
	$qry = "select File_Path from file where Course_Id = '$courseid' and Year = '$year' and Sem_Type = '$sem'";
	
	///////////////////////////////////////////////////////////////////////////////
	$result = mysql_query($qry);
	$files = array();
	if($result){
			for ($i = 0; $i <= mysql_num_rows($result) -1; $i++){
				$file = mysql_fetch_array($result);
				$files[$i] = $file[0];
			}
	}
	if(in_array ($path, $files)){
		echo "FILE ALREADY EXISTS"."<br/>"; 
	}
	else{			
		//if (move_uploaded_file($file_temp, 'files/EL-200-DSA/Winter-2013_Asim Banerjee/'.$file_name))
		
		//////////////////////////////////////////////////////////////////////////////
		if (move_uploaded_file($file_temp, $dirname.'/'.$file_name))
		//////////////////////////////////////////////////////////////////////////////
		
		{			
	$myconn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD); 
	$seldb = mysql_select_db(DB_DATABASE,$myconn);
	//$path = "'".'files/EL-200-DSA/Winter-2013_Asim Banerjee/'.$file_name."'";
	//$qry = "insert into file (File_Path, Time, Uid, Course_Id,Year, Sem_Type) values ($path,now(), '201091001', 'EL-200','2013', 'Winter')";
	
	/////////////////////////////////////////////////////////////////////////////
	$path = $dirname.'/'.$file_name;
	$qry = "insert into file (File_Path, Time, Uid, Course_Id,Year, Sem_Type, Name, Display_name) values ('$path',now(), '$proffid' , '$courseid','$year', '$sem', '$file_name','$displayName')";
	//////////////////////////////////////////////////////////////////////////////
	$result=mysql_query($qry);
	
	if ($result)
		echo 'File '.$file_name.' uploaded successfully'."<br/>";
		}
		}
	} 
	
	else {
		foreach ($errors as $error) {
			echo $error, '<br/>';
		}
		}
		
		}

?>

<!-- the changes have been enclosed between comments for easy referral-->
<html>
<head>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/logo16.png" />
    <link rel="stylesheet" href="css/bootstrap_css/bootstrap.css" type="text/css" media="screen" />
    <label id = "test"></label>
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/functions.js"></script>
	<script type="text/javascript" src="scripts/api.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
			checkForLogin();
			var courseId = getURLParameter("id");
			document.getElementById('fmCourseId').value=courseId;
		});
	    window.onunload = refreshParent();
	    function refreshParent() {
	    	var courseId = getURLParameter("id");
	     	window.opener.getFiles(courseId);
	    }
</script>

</head>
<body>
 	
<div class="row-fluid">
	<form action="" method="POST" enctype = "multipart/form-data">
		<div class="well span12"  style:"text-align:center">
			Choose a File :<input id="fmCourseId" type = "hidden" name="courseId"/><br>
			<input type = "file" name="files"/><br>
			Display name of File:<br><input type = "text" name="displayName"/><br>
			<input class="btn btn-primary" type = "submit" value="Upload"/>
			<a class="btn btn-danger" href="JavaScript:window.close()">Close</a>
		</div>
	</form>
</div>


</body>
</html>