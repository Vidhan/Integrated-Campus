<?php

//require_once ('course.php');
require_once ('user.php');
require_once ('poll.php');
//require_once('user.php');


$value = "An error has occurred";
$result = array();
$msg = " ";
session_start();
if(isset($_SESSION['USERID'])){
	if (isset($_POST["method"])){
		
		switch ($_POST["method"]) {
			
			/****Student Profile APIs*****/
			case "getStudentCurrentCourses":
				//$student1 = new Student($_POST["uid"]);
				//session_start();
				$student1 = new Student($_SESSION['USERID']);
				$courses = $student1 -> getCurrentCourses();
				$result["courses"] = $courses;
				break;

			case "getStudentDetails":
				//session_start();
				$student1 = new Student($_SESSION['USERID']);
				$result["userDetail"]=$student1 -> getUserDetail('ALL');
				$result["studentDetail"]=$student1 -> getStudentDetails('ALL');
				break;

			case "loadStudentAttendance":
				//session_start();
				$student1 = new Student($_SESSION['USERID']);
				$result["Lecture"] = $student1 ->getAttendance($_POST["courseId"],PRESENT_SEM,PRESENT_YEAR,"Lecture");
				$result["Lab"] = $student1 ->getAttendance($_POST["courseId"],PRESENT_SEM,PRESENT_YEAR,"Lab");
				$result["Tutorial"] = $student1 ->getAttendance($_POST["courseId"],PRESENT_SEM,PRESENT_YEAR,"Tutorial");
				//$result["Lecture"] = "none";
				break;

			case "getStudentNotifications":
				//session_start();
				$student1 = new Student($_SESSION['USERID']);
				$result = $student1 -> getNotifications($_POST['limit']);
				break;

			case "getStudentTimetable":
				//@session_start();
				$student1 = new Student($_SESSION['USERID']);
				$result = $student1->getPermanentTimeTable();
				break;

			case "getStudentpreviousCourse":
				//@session_start();
				$student1 = new Student($_SESSION['USERID']);
				//echo($_SESSION['USERID'])
				$courses = $student1 -> getPreviousCourses($_POST["year"], $_POST["sem"]);
				$result["courses"] = $courses;
				//$result["year"] = $_POST["year"];
				break;

			case "checkIfTa":
				$student1 = new Student($_SESSION['USERID']);
				$result = $student1 -> checkIfTa();
				break;

			case "getTACurrentCourses" :
				$ta1 = new TA($_SESSION['USERID']);
				$result = $ta1 -> get_course_of_ta();
				break;

			/****End of Student Profile APIs*****/

			/****Faculty Profile APIs*****/

			case "getFacultypreviousCourse":
				//@session_start();
				$faculty1 = new Faculty($_SESSION['USERID']);
				//echo($_SESSION['USERID'])
				$courses = $faculty1 -> getPreviousCourses($_POST["year"], $_POST["sem"]);
				$result["courses"] = $courses;
				//$result["year"] = $_POST["year"];
				break;

			case "getFacultyCurrentCourses":
				//$student1 = new Student($_POST["uid"]);
				//session_start();
				$faculty1 = new Faculty($_SESSION['USERID']);
				$courses = $faculty1 -> getCurrentCourses();
				$result["courses"] = $courses;
				break;

			case "getFacultyDetails":
				//session_start();
				$faculty1 = new Faculty($_SESSION['USERID']);
				$result["userDetail"]=$faculty1 -> getUserDetail('ALL');
				$result["facultyDetail"]=$faculty1 -> getFacultyDetail('ALL');
				break;

			case "getRegisteredStudentsInCourse":
				//session_start();
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> getRegisteredStudents();
				//$result = [1,2,3,4,5,6,8,9,10,1];
				break;

			case "addAttendance":
				//session_start();
				$attendance = $_POST["attendance"];
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$course1 -> addAttendance($_POST["type"], $_POST["date"], $attendance);

				break;

			case "loadFacultyAttendance":
				//session_start();
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> getDayWiseCourseAttendance($_POST["type"]);
				break;

			case "getFacultyNotifications":
				//session_start();
				$faculty1 = new Faculty($_SESSION['USERID']);
				$result = $faculty1 -> getNotifications($_POST['limit']);
				break;

			case "getAttendanceDetail":
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1->getDetailDayWiseCourseAttendance($_POST["type"], $_POST["date"]);
				break;

			case "getCsv":
				$faculty1 = new Faculty($_SESSION['USERID']);
				$faculty1 -> getCsv($_POST['courseId'], $_POST['date'], $_POST['type']);
				break;

			case "getFacultyTimetable":
				$faculty1 = new Faculty($_SESSION['USERID']);
				$result = $faculty1->getFacultyPermanentTimeTable();
				break;

			/****End of Faculty Profile APIs*****/

			/****Genral APIs*****/
			case "loadCourse":
				// $course1 = new Course($_POST["courseId"], $_POST["year"], $_POST["sem"]);
			$course1 = new course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result["course"] = $course1 -> getDetail('ALL');
				break;
			
			case "logout":
				//session_start();
	 			session_unset(); 
	  
	 			session_destroy(); 
	 			$result["msg"] = "true";
				break;

			

			case "getFiles":
				//session_start();
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> getFiles();
				if(checkIfFacultyOfCourse($_SESSION['USERID'],$_POST["courseId"],PRESENT_YEAR, PRESENT_SEM))
					$result[0]["delete"] = "true";
				else
					$result[0]["delete"] = "false";
				
				break;

			case "deleteFile":
				unlink($_POST['path']);
				$myconn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD); 
				$seldb = mysql_select_db(DB_DATABASE,$myconn);
				$id = $_POST['id'];
				$qry = "delete from file where File_Id = $id";
				$result=mysql_query($qry);
				if ($result)
					echo("true");
				break;

			case "loadUserName":
				//session_start();
				$user1 = new User($_SESSION['USERID']);
				$result = $user1 ->getUserDetail('Name');
				
				break;

			case "changePassword":
				//session_start();
				$user1 = new User($_SESSION['USERID']);
				$result["success"] = $user1 ->changePassword($_POST['newPass'],$_POST['oldPass']);
				
				break;
			/****End of Genral APIs*****/
			
			//Start By Vidhan
			case "createPoll":
			//@session_start();
			$course = new Course($_POST["courseid"], PRESENT_YEAR, PRESENT_SEM);
			$result['poll'] = $course -> createPoll($_POST['question'],$_POST['response']);
			break;

			case "getPoll":
				//@session_start();
				$course = new Course($_POST["courseid"], PRESENT_YEAR, PRESENT_SEM);
				$result1 = $course ->getPolls();
				for($i = 0;$i<= count($result1)-1;$i++){
					$poll = new Poll($result1[$i]);
					$details = $poll->getPollDetails('ALL');
					$result["poll"][$i]=$details;	
					
				}
				break;

			case "respond":
				//@session_start();
				//echo $_POST['pollid']; exit();
				$poll = new Poll($_POST["pollid"]);
				//$result = $poll->getPollDetails('ALL');
				$response = $poll->respond($_POST["option"]);
				$result["responseStatus"] = $response;
				break;

			case "addDiscussionTopic":
				//@session_start();
				$course1 = new course($_POST["courseid"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> addDiscussionTopic($_POST["subject"]);
				break;
		
		
			case "addDiscussionResponse":
				//@session_start();
				$course1 = new Course($_POST["courseid"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> addDiscussionResponse( $_POST["response"],$_POST["topicid"]);
				break;
			
			

		  	case "getDiscussionTopics":
				//@session_start();
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> getDiscussionTopics();
				break;
			
			case "getDiscussionResponse":
				//@session_start();
				$course1 = new Course($_POST["courseId"], PRESENT_YEAR, PRESENT_SEM);
				$result = $course1 -> getDiscussionResponse($_POST["topicid"]);
				break;



			//End By Vidhan

			case "getRole":
				//@session_start();
				$user1 = new User($_SESSION['USERID']);
				$result = $user1 -> getUserDetail('Role');
				break;

			default :
				$result["msg"] = "Function not found";
				$result["login"]="true";
				break;

			
			

		}
	}
}
else{
	$result["login"]="false";
}

exit(json_encode($result));


function checkIfFacultyOfCourse($uid,$cid,$year,$sem)
{
	$database = new Database();
		if($database -> connect())
		{
			$temp = $uid;
			$auth = mysql_query("select * from teaches where Uid = '$uid' and Course_Id = '$cid' and Year = '$year' and Sem_Type = '$sem'");
			if(mysql_num_rows($auth))
			{
				return true;
			}
			else
				return false;
		}
}
?>
