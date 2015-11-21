<?php
require_once ('settings/config.php');//changed from ./settings/blah
require_once ('settings/sem&year.php');//changed from ./settings/blah


class Database{
    
  private $_db_host =DB_HOST ;   
  private $_db_user =DB_USER;   
  private $_db_pass =DB_PASSWORD;   
  private $_db_name =DB_DATABASE;
  private $_con = false;               // Checks to see if the connection is active
  private $_result = array();          // Results that are returned from the query

  public function connect() {
      if(!$this->_con)  
        {  
            $myconn = mysql_connect($this->_db_host,$this->_db_user,$this->_db_pass);  
            
            if($myconn)  
            {  
                $seldb = mysql_select_db($this->_db_name,$myconn);  
                
                if($seldb)  
                {  
                    $this->_con = true; 
          //echo "connected to database"  ;
                    return true;   
                } 
                
                else  
                {  
                    return false;   
                }  
            }
      
       else  
            {  
                return false;   
            }  
        }
    
     else  
        {  
            return true;   
        } 
    
  }
  
  public function checkLoginDetails ($username, $password){
    
    $qry="SELECT * FROM users WHERE Uid='$username' AND password='".md5($password)."'";
    $result=mysql_query($qry);
    if($result) {
      if(mysql_num_rows($result) == 1) {
        //Login Successful
    
        $user = mysql_fetch_assoc($result);
        return $user;
    
        
      }
        else {
        //Login failed
        header("location:index.php?attempt=incorrect");
        exit();
      }
    }
    else {
      die("Query failed");
    }
  }
    
  //FINAL CONSTRUCTOR FOR USER
  static function getUserDetails($userid){
    $qry = "select * from users where Uid = '$userid'";
    $result = mysql_query($qry);
    if($result) {
      if(mysql_num_rows($result) == 1){
        $user = mysql_fetch_assoc($result);
        return $user;
      }
      
      else {
        header("location:../index.php?query = failed");
        exit();
      }
    }
    else {
      die("Query failed");
    }
    
  }
  
  //FINAL
  static function setUserDetail($uid, $option, $value){
    $qry = mysql_query("update users set $option = '$value' where uid = '$uid'");
    if($qry)
    {
      return TRUE;
    }
    else return FALSE;
  }
  
  //FINAL
   function changePassword($uid, $newpass, $oldpass){
  //check for SQL injection
  // echo "$uid" . "$newpass" . "$oldpass";
  $qry1 = mysql_query("select password from users where uid = '$uid'");
  // echo "hii";
  $var = mysql_fetch_array($qry1);
    // print_r($var);
    if (md5($oldpass) == $var[0])  
    {
      // echo "hii";
      $pass = md5($newpass);
      $qry = mysql_query("update users set password = '$pass' where uid = '$uid'");
      if($qry)
      {
        return "TRUE";
      }
    }
    else
    {
      return "FALSE";
    }
      
      
}
  
  
  
  //FINAL
  static function getStudentDetails($studentid){
    $qry = "select * from student where Uid = '$studentid'";
    $result = mysql_query($qry);
    if($result) {
    if(mysql_num_rows($result) == 1){
      $user = mysql_fetch_assoc($result);
      return $user;
    }
    
    else {
      header("location:../index.php?query = failed");
      exit();
    }
  }
  else {
    die("Query failed");
  }
    
  }
  
  //FINAL
  public function getFacultyDetails($facultyid){
      $qry = "select * from faculty where Uid = '$facultyid'";
    $result = mysql_query($qry);
    if($result) {
    if(mysql_num_rows($result) == 1){
      $user = mysql_fetch_assoc($result);
      return $user;
    }
    
    else {
      header("location:../index.php?query = failed");
      exit();
    }
  }
  else {
    die("Query failed");
  }
    
  }

  //FINAL but not verified
//   static function getRegisteredCourses($studentid, $year, $sem)
// {
//   $studentID = $student->getID();
//   $year = PRESENT_YEAR;
//   $sem = PRESENT_SEM;
//   $qry =" select Course_Id from registered_in where Uid = '$studentID'  and Year = '$year' and Sem_Type = '$sem' ";
//   $result = mysql_query($qry);
//   $courses = NULL;
//   if($result){
//   for ($i = 0; $i <= mysql_num_rows($result) -1; $i++){
//     $course = mysql_fetch_array($result);
//     $courses[$i] = $course[0];
//   }
//   if ($courses != NULL)
//     return $courses;
  
//     }
//   else {
//     die("Query failed");
//   }
  
// }
  
  function getRegisteredCourses($studentid, $year, $sem)
{
  //$studentID = $student->getID();
  // $year = PRESENT_YEAR;
  // $sem = PRESENT_SEM;
  $qry =" select Course_Id from registered_in where Uid = '$studentid'  and Year = '$year' and Sem_Type = '$sem' ";

  $result = mysql_query($qry);

  $courses = array();
  $coursesid = array();

  if($result){
  for ($i = 0; $i <= mysql_num_rows($result) -1; $i++){
    $course = mysql_fetch_row($result);
    $coursesid["id"] = $course[0];
    $tempCourse=self::getCourseDetails($course[0], $year, $sem, 'cname');
    $coursesid["name"] = $tempCourse[0];
    $courses[$i] = $coursesid;
  }
  if ($courses != NULL)
    //return course;
    return $courses;
    //return $result;
  
    }
  else {
    die("Query failed");
  }
  
  
}


  //verified
  /*public function getCurrentCoursesTaught(Faculty $faculty){
    
    $facultyID = $faculty->getID();
  $year = PRESENT_YEAR;
  $sem = PRESENT_SEM;
  $qry =" select Course_Id from teaches where Uid = '$facultyID'  and Year = '$year' and Sem_Type = '$sem' ";
  $result = mysql_query($qry);
  $courses = NULL;
  if($result){
  for ($i = 0; $i <= mysql_num_rows($result) -1; $i++){
    $course = mysql_fetch_array($result);
    $courses[$i] = $course[0];
    
  }
  if ($courses != NULL)
  return $courses;
    }
  else {
    die("Query failed");
  }
    
  }*/
  
  
  //verified
/*  public function getCourseDetails($courseid){
  $qry = "select * from course where Course_Id = '$courseid'";
    $result = mysql_query($qry);
    if($result) {
    if(mysql_num_rows($result) == 1){
      $courseDetails = mysql_fetch_assoc($result);
      return $courseDetails;
    }
    
    else {
      header("location:login.php?query = failed");
      exit();
    }
  }
  else {
    die("Query failed");
  }  
  }
  
  
  //verified
  /*public function getPresentCourseDetails($courseid){
    $year = PRESENT_YEAR;
    $sem = PRESENT_SEM;
    $qry = "select Uid, Course_Description from teaches where Course_Id = '$courseid' and Year = '$year'and Sem_Type = '$sem'";
    
    $result = mysql_query($qry);
    
    if($result) {
    if(mysql_num_rows($result) == 1){
      $courseDetails = mysql_fetch_assoc($result);
      //print_r($courseDetails); exit();
      $uid = $courseDetails['Uid'];
      
      $qry2 = "Select U_Name from users where Uid = '$uid'" ;
      $result2 = mysql_query($qry2);
      if(mysql_num_rows($result2) == 1)
        $courseDetail = mysql_fetch_assoc($result2) ;
      $courseDetails['U_Name'] = $courseDetail['U_Name'];
      return $courseDetails;
    }
    
    else {
      header("location:login.php?query = failed");
      exit();
    }
  }
  else {
    die("Query failed");
  }  
    
  }*/

  //FINAL
  static function getCoursesBeingTaught($facultyid, $year, $sem)
  {

  $qry = "select * from teaches where uid = '$facultyid'  and year = '$year' and sem_type = '$sem'";

  $result = mysql_query($qry);
  $courses = array();
  $coursesid = array();
   
  
  if($result){
  for ($i = 0; $i <= mysql_num_rows($result) -1; $i++){
    $course = mysql_fetch_row($result);
    $coursesid["id"] = $course[1];
    $tempCourse = self::getCourseDetails($course[1], $year, $sem, 'cname');
    $coursesid["name"] = $tempCourse[0];
    $courses[$i] = $coursesid;
  }
  if ($courses != NULL)
    return $courses;
    }
  else {
    die("Query failed");
  }
  //return $qry ;

}
  

  static function getCourseAttendance($cid, $year, $sem, $type){
    $qry = mysql_query("select * from attends where course_id ='$cid'  and year ='$year' and sem_type ='$sem' and type ='$type'");
  $var = mysql_fetch_array($qry);
  print_r($var);
  return $qry;
  }
  

  static function setCoursesDescription($cid, $year, $sem, $description)
{
  $qry = mysql_query("update teaches set course_description ='$description' where course_id = '$cid' and year = $year and sem_type = '$sem'");
}


//By Vidhan
function getUploadedFiles($cid, $year, $sem)
  {
  //$qry = "select * from file where Uid = '$uid' and Course_Id = '$cid'and Year = '$year'and Sem_Type='$sem' order by Time desc";
  //Removed faculty Id so that students can also retrive file list
  $qry = "select * from file where Course_Id = '$cid'and Year = '$year'and Sem_Type='$sem' order by Time desc";
  $result=mysql_query($qry);
  return $result;
  }



   static function getCourseDetails($cid, $year, $sem, $option)
  {
      if ($option == 'ALL')
    {
      $qry = mysql_query("SELECT * FROM (
      SELECT a.uid as fid, a.course_id as cid, a.Year as year, a.Course_Description as cdep, a.Sem_type as semtype, b.course_name as cname, b.course_type as ctype, b.course_credit as ccredit
      FROM teaches AS a
      JOIN course AS b
      on a.course_id=b.course_id
      ) AS n where cid = '$cid' and year = '$year' and semtype = '$sem'");
    }  
    else {
      $qry = mysql_query("SELECT $option FROM (
    SELECT a.uid as fid, a.course_id as cid, a.Year as year, a.Course_Description as cdep, a.Sem_type as semtype, b.course_name as cname, b.course_type as ctype, b.course_credit as ccredit
    FROM teaches AS a
    JOIN course AS b
    on a.course_id=b.course_id
    ) AS n where cid = '$cid' and year = '$year' and semtype = '$sem'");
      }  
    if($qry == false){
      die(mysql_error());
    }
    else{
    return mysql_fetch_array($qry);
    }
  }

  public function disconnect() {
    
    if($this->_con)  
    {  
        if(mysql_close())  
        {  
            $this->_con = false;  
            return true;   
        }  
    
        else  
        {  
            return false;   
        }  
    }  
    
  }
  
  function getAttendance($Uid, $Course_Id,$Sem_Type,$Year,$Type)
  {
    $qry=mysql_query("select count(*) from course_activity where Sem_Type='$Sem_Type' and Course_Id='$Course_Id' and Year='$Year' and Type='$Type'");
    $var=mysql_fetch_array($qry);
    $qry1=mysql_query("select count(*) from attends where StudentId='$Uid' and Sem_Type='$Sem_Type' and Year='$Year' and Course_Id='$Course_Id' and present=1 and Type = '$Type'");
    $var1=mysql_fetch_array($qry1);

    $q = array();
    $q['total'] = $var[0];
    $q['student'] = $var1[0];
    return $q;

  }

//   //New 
//   static function addCourse($setCourse)
//   {
//     $tempCourse_Id = $setCourse['Course_Id'];
//     $tempCourse_Name = $setCourse['Course_Name'];
//     $tempCourse_Type = $setCourse['Course_Type'];
//     $tempCourse_Credit = $setCourse['Course_Credit'];

//     $qry = mysql_query("insert into course values ('$tempCourse_Id', '$tempCourse_Name', '$tempCourse_Type', '$tempCourse_Credit')");  
    
//       // print('hii');
//   }





//   static function addStudent($addUser)
//   {
//     $tempUid = $addUser['Uid'];
//     $tempUname = $addUser['U_name'];
//     $tempemailid = $addUser['Email_Id'];
//     $temppassword = md5($addUser['Password']);
//     $tempcontactno = $addUser['Contact_No'];
//     $tempgender = $addUser['Gender'];
//     $templastaccess = $addUser['Last_Access'];
//     $tempdob = $addUser['DOB'];
//     $temprole = $addUser['Role'];
//     $temp_parent_no=$addUser['Parent_Contact_No'];
//     $tempbatch=$addUser['Batch'];
//     $tempprog_id=$addUser['Program_id'];
//     $qry = mysql_query("insert into users values ('$tempUid', '$tempUname', '$tempemailid', '$temppassword', '$tempcontactno', '$tempgender', '$templastaccess', '$tempdob', '$temprole')");
//     $qry1=mysql_query("insert into student values ('$tempUid','$temp_parent_no','$tempbatch','$tempprog_id')");
//     print('student');
//   }
//   static function addFaculty($addUser)
//   {
//     $tempUid = $addUser['Uid'];
//     $tempUname = $addUser['U_name'];
//     $tempemailid = $addUser['Email_Id'];
//     $temppassword = md5($addUser['Password']);
//     $tempcontactno = $addUser['Contact_No'];
//     $tempgender = $addUser['Gender'];
//     $templastaccess = $addUser['Last_Access'];
//     $tempdob = $addUser['DOB'];
//     $temprole = $addUser['Role'];
//     $tempfbroom = $addUser['FB_Room'];
//     $qry = mysql_query("insert into users values ('$tempUid', '$tempUname', '$tempemailid', '$temppassword', '$tempcontactno', '$tempgender', '$templastaccess', '$tempdob', '$temprole')");
//     $qry1=mysql_query("insert into faculty values('$tempUid','$tempfbroom')");
//     print('faculty');


//   }

//   static function addTA($addUser)
//   {
//     $tempUid=$addUser['Uid'];
//     $tempCourse_Id=$addUser['Course_Id'];
//     $tempyear  =$addUser['Year'];
//     $temp_sem_type=$addUser['Sem_Type'];
//     $qry1=mysql_query("insert into ta_of values( '$tempCourse_Id', '$tempUid', '$tempyear', '$temp_sem_type')");
//     print('addta');




//   }

//   static function add_registered_in($addUser)
// {
//   $tempUid=$addUser['Uid'];
//     $tempCourse_Id=$addUser['Course_Id'];
//     $tempyear  =$addUser['Year'];
//     $temp_sem_type=$addUser['Sem_Type'];
//     $qry1=mysql_query("insert into registered_in values(  '$tempUid','$tempCourse_Id', '$tempyear', '$temp_sem_type')");
//     print('reg_in');
    


// }
// static function add_teaches($addUser)
// {
//   $tempUid=$addUser['Uid'];
//     $tempCourse_Id=$addUser['Course_Id'];
//     $tempyear  =$addUser['Year'];
//     $temp_sem_type=$addUser['Sem_Type'];
//     $temp_description=$addUser['Course_Description'];
//     $qry1=mysql_query("insert into teaches values(  '$tempUid','$tempCourse_Id', '$tempyear', '$temp_sem_type','$temp_description')");
//     print('add_teaches');


// }

// static function get_registered_students($Course_Id)
// {
// $tempCid=$Course_Id;
// //echo $tempCid;
// $qry=mysql_query("select Uid from registered_in where Course_Id = '$tempCid' ");
//  $arr=array();
//  $i=0;
//  while($var1 = mysql_fetch_array($qry))
//  {
//     $arr[$i]=$var1['Uid'];
//     $i++;

//   }
//   return $arr;
// }


//admin by Ayush

function addTimeTable($timetable)
{
  // print_r($timetable);
  // exit();

  $tempcid = $timetable['Course_Id'];
  $tempday = $timetable['Day'];
  $tempstart = $timetable['StartTime'];
  $tempend = $timetable['EndTime'];
  $temptype = $timetable['Type'];
  // echo $tempcid;
  // echo $tempday;
  // echo $tempstart;
  // echo $tempend;
  // echo $temptype;
  // exit();
  $qry = mysql_query("insert into permtimetable values ('$tempcid', '$tempstart', '$tempend', '$tempday', '$temptype')");
  // $qry = mysql_query("insert into course values ('$tempCourse_Id', '$tempCourse_Name', '$tempCourse_Type', '$tempCourse_Credit')"); 
}



static function addCourse($setCourse)
  {
    $tempCourse_Id = $setCourse['Course_Id'];
    $tempCourse_Name = $setCourse['Course_Name'];
    $tempCourse_Type = $setCourse['Course_Type'];
    $tempCourse_Credit = $setCourse['Course_Credit'];

    $qry = mysql_query("insert into course values ('$tempCourse_Id', '$tempCourse_Name', '$tempCourse_Type', '$tempCourse_Credit')"); 
   
      // print('hii');
  }





  static function addStudent($addUser)
  {
    //echo("hii");

    $tempUid = $addUser['Uid'];
    $tempUname = $addUser['U_name'];
    $tempemailid = $addUser['Email_Id'];
    $temppassword = md5($addUser['Password']);
    $tempcontactno = $addUser['Contact_No'];
    $tempgender = $addUser['Gender'];
    // $templastaccess = $addUser['Last_Access'];
    $tempdob = $addUser['DOB'];
    // $temprole = $addUser['Role'];
    $temp_parent_no=$addUser['Parent_Contact_No'];
    $tempbatch=$addUser['Batch'];
    $tempprog_id=$addUser['Program_id'];
    // echo $tempprog_id;
    // echo $tempbatch;
    // echo $temp_parent_no;
    //   echo $tempUid;
 
    $qry = mysql_query("insert into users values ('$tempUid', '$tempUname', '$tempemailid', '$temppassword', '$tempcontactno', '$tempgender','', '$tempdob', 1)");
    $qry1=mysql_query("insert into student values ('$tempUid','$temp_parent_no','$tempbatch','$tempprog_id','0')");
    // print('student');
  //  exit();
  }
  static function addFaculty($addUser)
  {
    $tempUid = $addUser['Uid'];
    $tempUname = $addUser['U_name'];
    $tempemailid = $addUser['Email_Id'];
    $temppassword = md5($addUser['Password']);
    $tempcontactno = $addUser['Contact_No'];
    $tempgender = $addUser['Gender'];
    // $templastaccess = $addUser['Last_Access'];
    $tempdob = $addUser['DOB'];
    // $temprole = $addUser['Role'];
    $tempfbroom = $addUser['FB_Room'];
    $qry = mysql_query("insert into users values ('$tempUid', '$tempUname', '$tempemailid', '$temppassword', '$tempcontactno', '$tempgender', '', '$tempdob', '2')");
    $qry1=mysql_query("insert into faculty values('$tempUid','$tempfbroom')");
    // print('faculty');


  }

  static function addTA($addUser)
  {
    $tempUid=$addUser['Uid'];
    $tempCourse_Id=$addUser['Course_Id'];
    $tempyear  =$addUser['Year'];
    $temp_sem_type=$addUser['Sem_Type'];
    $qry1=mysql_query("insert into ta_of values( '$tempCourse_Id', '$tempUid', '$tempyear', '$temp_sem_type')");
    print('addta');




  }

  static function add_registered_in($addUser)
{
  $tempUid=$addUser['Uid'];
    $tempCourse_Id=$addUser['Course_Id'];
    $tempyear  =$addUser['Year'];
    $temp_sem_type=$addUser['Sem_Type'];
    $qry1=mysql_query("insert into registered_in values(  '$tempUid','$tempCourse_Id', '$tempyear', '$temp_sem_type')");
    print('reg_in');
   


}
static function add_teaches($addUser)
{
  $tempUid=$addUser['Uid'];
    $tempCourse_Id=$addUser['Course_Id'];
    $tempyear  =$addUser['Year'];
    $temp_sem_type=$addUser['Sem_Type'];
    // $temp_description=$addUser['Course_Description'];
    $qry1=mysql_query("insert into teaches values(  '$tempUid','$tempCourse_Id', '$tempyear', '$temp_sem_type','')");
    print('add_teaches');


}

//admin end

static function addAttendance($Course_Id, $Year, $Sem, $type, $date, $data = array(), $UserId)
  {
      $ids = array_keys($data);
      //echo $Year;echo $Course_Id;echo $Sem;echo $type;echo $data[201001049];echo $UserId;
      $qry = mysql_query("insert into course_activity values ('$date', '$UserId', '$Sem', '$Course_Id', '$Year', '$type')");
      //echo 'Hii';
      $i = 0;
 
      // $qry2 = mysql_query("select count(*) from registered_in where Course_Id='$Course_Id'");
      // $t = mysql_fetch_array($qry2);
      $t = count($ids);
      //echo $t;
      //print_r($data[$ids[0]]);
      while($i<$t)
      {
          //echo 'Hii';
          $id = $ids[$i];
          $present = $data[$id];
          $qry1 = mysql_query("insert into attends values ('$Course_Id', '$Year', '$Sem', '$UserId', '$id', '$date', '$present', '$type')");
          $i++;
      }

  }

  static function authenticity_attendance($uid,$courseid,$semtype,$year)
{

  // echo $uid;
  // echo $courseid;
  // echo $semtype;
  // echo $year;
  $qry=mysql_query("select count(*) from teaches where uid='$uid' and course_id='$courseid' and Sem_Type='$semtype' and Year='$year'");
  $qry1=mysql_query("select count(*) from ta_of where uid ='$uid' and course_id='$courseid' and Sem_Type='$semtype' and Year='$year'");
  $var=mysql_fetch_array($qry);
  $var1=mysql_fetch_array($qry1);
  return ($var[0]+$var1[0]);
}

static function getRegisteredStudents($cid, $sem, $year)
{
    $qry = mysql_query("select Uid from registered_in where Course_Id = '$cid' and Sem_Type = '$sem' and Year = '$year'");
    $count = mysql_num_rows($qry);


    $i = 0;
    while($i<$count)
    {
        $temp[$i] = mysql_fetch_array($qry);
        $result[$i] = $temp[$i]['Uid'];
        // print_r($result[$i]);
        $i++;
    }
    return $result;
}


function createPoll($course,$question, $options = array()){ 
    $id = $_SESSION['USERID'];
    $year = PRESENT_YEAR;
    $sem = PRESENT_SEM;
    $qry1 = "insert into poll (Uid, Course_Id,Year, Sem_Type,Questions,Is_Active) values ('$id', '$course', '$year','$sem','$question','1') ";
    
    $result = mysql_query($qry1);
    $qry2 = "select Poll_Id from poll where Uid = '$id'and Course_Id = '$course' and Year =  '$year' and Sem_Type = '$sem' and Questions = '$question' and Is_Active = '1'";
  
    $result = mysql_query($qry2);
    for ($i =0; $i<=mysql_num_rows($result)-1;$i++){
      $poll = mysql_fetch_assoc($result);
    }
    
      $pollid = $poll['Poll_Id'];
      for ($i = 0; $i<= count($options)-1 ;$i++)
      {
        $optionid = $i;
        $optiondata = $options[$i];
        $qry3 = "insert into answers (Option_Id, Responses, Options_Data,Poll_Id) values ('$optionid', '0', '$optiondata', '$pollid')";
        mysql_query($qry3);
        
      }
  
      $details['pollid'] =  $pollid;
      return $details;
    
  }
  
  
  function getPollIDs($courseid, $year, $sem){
    $qry = "select Poll_Id from poll where Course_Id = '$courseid' and Year = '$year' and Sem_Type = '$sem'";
    $result = mysql_query($qry);
    $details = array();
    for ($i = 0; $i <= mysql_num_rows($result)-1; $i++)
    {
      $detail = mysql_fetch_assoc($result);
      $details[$i]=$detail['Poll_Id'];
    }
    if($details != NULL){
      return $details;
    }
    else return "No Polls";
  }
  
  
  
  function getPollDetails($pollid){
    $qry = "select * from poll where Poll_Id = '$pollid' ";
    $result = mysql_query($qry);
    $details = array();
    if (mysql_num_rows($result)==1){
        $details = mysql_fetch_assoc($result);    
    }
    $qry = "select * from answers where Poll_Id = '$pollid'";
    $result = mysql_query($qry);
    $options = array();
    $responses = array();
    
    for ($i = 0; $i<= mysql_num_rows($result)-1;$i++){
      $var = mysql_fetch_assoc($result);
      $options[$i] = $var['Options_Data']; 
      $responses[$i]=$var['Responses'];
      }
    $details['options']=$options;
    $details['responses']=$responses;
    
    return $details;
  }



function addResponse($pollid, $optionid,$courseid,$sem,$year){
    $studentid = $_SESSION['USERID'];
    $qry = "select * from responds where UID = '$studentid' and Course_Id = '$courseid' and Sem_Type = '$sem' and year = '$year' and Poll_Id = '$pollid'";
    $result = mysql_query($qry);
    if (mysql_num_rows($result)==0)
    {
    $qry1 = "update answers set Responses = Responses + 1 where Option_Id = '$optionid' and Poll_Id = '$pollid' ";
    mysql_query($qry1);
    $qry2 = "insert into responds (UID,Course_Id,Sem_Type,year,Poll_Id) values ('$studentid','$courseid','$sem','$year','$pollid')";  
    mysql_query($qry2); 
    return "The answer was successfully recorded";
    }
    else return "You have already answered the poll";
  }
  
  
  function closePoll($pollid){
    $qry ="select Is_Active from poll where Poll_Id = '$pollid'";
    $result = mysql_query($qry);
    if (mysql_num_rows($result) == 1){
      $row = mysql_fetch_assoc($result);
      $active = $row['Is_Active'];
    }
    
    if ($active == 0){
      return "The poll is already closed";
    }
    
    else{
      $qry = "update poll set Is_Active = '0' where Poll_Id = '$pollid'";
      $result = mysql_query($qry);
      return "The poll has been closed successfully";
  }
  }
  
  function deletePoll($pollid){
    $qry = "delete from poll where Poll_Id = '$pollid'";
    $result = mysql_query($qry);
    return "The poll has been deleted successfully";
  }

  function getDetailDayWiseCourseAttendance($cid, $sem, $year, $type, $Date)
  {
    $qry = mysql_query("select Studentid from attends where Course_Id = '$cid' and Sem_Type = '$sem' and year = '$year' and Type = '$type' and Date = '$Date' and Present = 1");
    $presentstudent = mysql_num_rows($qry);
    //echo $presentstudent;
    // $t = mysql_fetch_array($qry);
    // print_r($t);
    $qry1 = mysql_query("select Studentid from attends where Course_Id = '$cid' and Sem_Type = '$sem' and year = '$year' and Type = '$type' and Date = '$Date' and Present = 0");
    $absentstudent = mysql_num_rows($qry1);

    $i = 0;
    $j = 0;

    while($i<$presentstudent)
    {
      $t = mysql_fetch_array($qry);
      $result['present'][$i] = $t[0];
      $i++;
    }

    while($j<$absentstudent)
    {
      $t = mysql_fetch_array($qry1);
      $result['absent'][$j] = $t[0];
      $j++;
    }
    return $result;
  }

  function getDayWiseCourseAttendance($cid, $sem, $year, $type)
  {
    $qry = mysql_query("select sum(present) as studentattends, Date from attends where Course_Id = '$cid' and Sem_Type = '$sem' and year = '$year' and Type = '$type' group by Date");
    $qry1 = mysql_query("select count(*) from registered_in where Course_Id = '$cid' and Sem_Type = '$sem' and Year = '$year'");

    $totalStudent = mysql_fetch_array($qry1);
    // echo $totalStudent[0];

    $count = mysql_num_rows($qry);
    // echo $count;
    $i = 0;
    while($i<$count)
    {
      $t = mysql_fetch_array($qry);
      $result[$i]['studentattends'] = $t['studentattends'];
      $result[$i]['totalstudents'] = $totalStudent[0];
      $result[$i]['Date'] = $t['Date'];
      // print_r($t);
      $i++;
    }
    
    // $t = mysql_fetch_array($qry);
    return $result;
  }

static function get_notification_student($userid,$limit)
{
  $qry=mysql_query("select course_id,type,id from noticeboard where course_id in  (SELECT course_Id from registered_in where uid=$userid) ORDER BY timestamp ASC limit $limit"); 
  $result[0]['notification']= "false";
  $i=0;
  while ($row = mysql_fetch_array($qry)) {
    $result[$i]=$row;
    $i++;
    $result[0]['notification']= "true";
  }
  return $result;

}

static function get_notification_faculty($userid,$limit)
  {

    $year = PRESENT_YEAR;
    $sem = PRESENT_SEM;
    $qry=mysql_query("select * from noticeboard where course_id in (SELECT course_id FROM teaches where uid=$userid and sem_type='$sem' and year='$year') and type='Response' ORDER BY timestamp ASC limit $limit");
    $result[0]['notification']= "false";  
    $i=0;
    while ($row = mysql_fetch_array($qry)) {
      $result[$i]=$row;
      $i++;
      $result[0]['notification']= "true";
    }
    return $result;
    

  }

//Forget Password Functions
   function insertRandomPassword($username,  $randompassword){
    $newpass = md5($randompassword);
    $qry = mysql_query("update users set password = '$newpass' where Uid = '$username'");
    if ($qry)
    return TRUE;
    else return FALSE;
}


 function checkExistence($username){
    $qry = mysql_query("select * from users where Uid ='$username'");
    $qry1 = mysql_fetch_assoc($qry);
    if ($qry){
    if (mysql_num_rows($qry)==1){
    return TRUE;
    }
    else return FALSE;
    }
    else return FALSE;
  }

//Start Timetable (Ayush)
  function getPermanentTimeTable($uid)
{
    $courses = $this -> getRegisteredCourses($uid, PRESENT_YEAR, PRESENT_SEM);
    $count = count($courses);
    $qry1 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Monday' and Type = 'Lecture'");
    $qry2 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Tuesday' and Type = 'Lecture'");
    $qry3 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Wednesday' and Type = 'Lecture'");
    $qry4 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Thursday' and Type = 'Lecture'");
    $qry5 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Friday' and Type = 'Lecture'");

    $count1 = mysql_num_rows($qry1);
    $count2 = mysql_num_rows($qry2);
    $count3 = mysql_num_rows($qry3);
    $count4 = mysql_num_rows($qry4);
    $count5 = mysql_num_rows($qry5);
    $k = 0;
    for ($i=0; $i < $count1 ; $i++) {
      $temp = mysql_fetch_array($qry1);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecMonday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count2 ; $i++) { 
      $temp = mysql_fetch_array($qry2);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecTuesday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count3 ; $i++) { 
      $temp = mysql_fetch_array($qry3);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecWednesday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count4 ; $i++) { 
      $temp = mysql_fetch_array($qry4);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecThursday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count5 ; $i++) { 
      $temp = mysql_fetch_array($qry5);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecFriday'][$k]= $temp;
          $k++;
        }
      }
    }
  return $result;
}

function getFacultyPermanentTimeTable($uid)
{
    $courses = $this -> getCoursesBeingTaught($uid, PRESENT_YEAR, PRESENT_SEM);
    $count = count($courses);
    $qry1 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Monday' and Type = 'Lecture'");
    $qry2 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Tuesday' and Type = 'Lecture'");
    $qry3 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Wednesday' and Type = 'Lecture'");
    $qry4 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Thursday' and Type = 'Lecture'");
    $qry5 = mysql_query("select StartTime, EndTime, Course_Id from permtimetable where Day = 'Friday' and Type = 'Lecture'");

    $count1 = mysql_num_rows($qry1);
    $count2 = mysql_num_rows($qry2);
    $count3 = mysql_num_rows($qry3);
    $count4 = mysql_num_rows($qry4);
    $count5 = mysql_num_rows($qry5);
    $k = 0;
    for ($i=0; $i < $count1 ; $i++) {
      $temp = mysql_fetch_array($qry1);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecMonday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count2 ; $i++) { 
      $temp = mysql_fetch_array($qry2);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecTuesday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count3 ; $i++) { 
      $temp = mysql_fetch_array($qry3);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecWednesday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count4 ; $i++) { 
      $temp = mysql_fetch_array($qry4);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecThursday'][$k]= $temp;
          $k++;
        }
      }
    }
    $k = 0;
    for ($i=0; $i < $count5 ; $i++) { 
      $temp = mysql_fetch_array($qry5);
      for ($j=0; $j < $count ; $j++) {
        if($temp['Course_Id']===$courses[$j]['id']){
          $result['LecFriday'][$k]= $temp;
          $k++;
        }
      }
    }
  return $result;
}
//End Timetable

//Disscusion Forum By Vidhan
function addTopic($uid, $Course_Id, $Sem_Type, $Year, $Subject)
{
$qry1 = mysql_query("select * from topic where Topic_Subject = '$Subject' and course_id = '$Course_Id' and sem_type = '$Sem_Type' and year = '$Year'");
if (mysql_num_rows($qry1)==1){
  return "The topic already exists";}
else {
  $qry2 = mysql_query("insert into topic (Topic_Subject, Uid, Course_Id, Sem_Type, Year) values ('$Subject', '$uid', '$Course_Id', '$Sem_Type', '$Year')");
  if ($qry2)
  {   return "The topic has been added";
  }}
}

 function addDiscussionResponse($Respcontent, $uid, $semtype, $year, $courseid, $TopicId)
{
  $qry = mysql_query("insert into responses (Resp_Content, Uid, Sem_Type, year, Course_Id, Topic_Id) values ('$Respcontent', '$uid', '$semtype', '$year', '$courseid', '$TopicId')");
  if ($qry){
    return "The response has been added";
  }
  else return "There was some error in inserting the response";
}


   function getDiscussionTopics($tempcid, $tempsem, $tempyear)
{

  $qry = mysql_query("select Topic_Id,Topic_Date, Topic_Subject,Uid from topic where Course_Id = '$tempcid' and Sem_Type = '$tempsem' and Year = '$tempyear'");
  $t = mysql_num_rows($qry);
  $i = 0;

  while($i < $t)
  {
    $array[$i] = mysql_fetch_array($qry);
    $i++;
  }

  return $array;

}

function getDiscussionResponse($topicid)
{
    $qry = mysql_query("select * from responses where Topic_Id = '$topicid'");
    $i = 0;
    if($qry){
      $numberOfRows = mysql_num_rows($qry);
      if ($numberOfRows == 0){
        return "No responses yet";
      }
    else 
    {
      for($i=0;$i<=$numberOfRows-1;$i++){
        $details[$i] = mysql_fetch_assoc($qry);
      }
      return $details;
    }
      
    
  }
}

static function checkIfTa($uid,$year,$sem_type)
{
$qry=mysql_query("SELECT * FROM ta_of where uid='$uid' and year='$year' and sem_type='$sem_type'");
$num_rows = mysql_num_rows($qry);
if($num_rows>0){
  $result['isTa'] = "true";
}
else{
  $result['isTa'] = "false";
}
return $result;
}


//TA functions by Jayesh
static function get_course_of_ta($uid,$year,$sem)
{
  $qry=mysql_query("SELECT course_id FROM ta_of where uid='$uid' and year='$year' and sem_type='$sem'");
  $result = $qry;

  $courses = array();
  $coursesid = array();

  if($result){
  for ($i = 0; $i <= mysql_num_rows($result) -1; $i++){
    $course = mysql_fetch_row($result);
    $coursesid["id"] = $course[0];
    $tempCourse=self::getCourseDetails($course[0], $year, $sem, 'cname');
    $coursesid["name"] = $tempCourse[0];
    $courses[$i] = $coursesid;
  }
  if ($courses != NULL)
    //return course;
    return $courses;
    //return $result;
  
    }
  else {
    die("Query failed");
  }
}


//For exporting to csv
function get_csv($courseid,$date,$type)
{ 
  //$filename="c:/mydata7.xls";
  //$filename="d:/".$courseid."_".$date."_".$type.".csv";
  //$filename="../../htdocs/my_sen/files/exported/".$courseid."_".$date."_".$type.".csv";
  $filename="/".$courseid."_".$date."_".$type.".csv";
  //echo $filename; exit();
  //echo $temp;
  $var=mysql_query("SELECT StudentId,present INTO OUTFILE '$filename' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY \"\n\" FROM attends where course_id='$courseid' and date='$date' and type='$type'") or die(mysql_error());
  header("Content-type:  text/plain");
  header("Content-Disposition: attachment; filename=$filename");
  header("Content-Transfer-Encoding: binary");
  header("Pragma: no-cache");
  header("Expires: 0");
  ob_clean();
  flush();
  readfile($filename);
  //sleep(10000);
  unlink($filename);
  return 0;
}



}


?>
