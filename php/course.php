<?php 


require_once ('database.php');
class Course{

  private $_courseId;
  private $_courseName;  
  private $_courseType;
  private $_courseCredit;
  private $_courseDescription;

  private $_year;
  private $_sem;
  private $_fid;
  //verified
  function __construct($courseid,$year, $sem) {
  $uid1= $this->getDetail('Cid');//['CourseID'];        
    
    $database = new Database();
    if($database -> connect())
    {
      $courseDetails = $database -> getCourseDetails($courseid,$year, $sem,"ALL");
      //print_r($courseDetails);
      $database -> disconnect();
      unset($database);
      if ($courseDetails != NULL)
      {
        $this ->_courseId = $courseDetails['cid'];
        $this ->_courseName =  $courseDetails['cname'];
        $this ->_courseType = $courseDetails['ctype'];
        $this ->_courseCredit = $courseDetails['ccredit'];
          $this->_courseDescription= $courseDetails['cdep'];
        $this->_year          = $courseDetails['year'] ;  
        $this->_sem           = $courseDetails['semtype'];
        $this->_fid           = $courseDetails['fid'];
        
              }
    
  }

}
  
  //verified1
  function getDetail($option)
  {
  

      switch ($option)
          {
        case 'ALL':
            $details = array();
            $details['ID'] = $this->_courseId;
            $details['Name'] =$this->_courseName;
            $details['Type'] = $this->_courseType;
            $details['Credit'] = $this->_courseCredit;
            $details['Year'] =$this->_year;
            $details['Sem'] =$this->_sem;
            $details['Cdep'] =$this->_courseDescription;
            $details['fid'] =$this->_fid;
            
            return $details;
            break;
          
          
        case 'Cid':
            $details = array();
            $details ['CourseID'] = $this->_courseId;
            return $details;
            break;
        case 'Name':
            $details = array();
            $details ['CourseName'] = $this->_courseName;
            return $details;
            break;
        case 'Type':
            $details = array();
            $details ['CourseType'] = $this->_courseType;
            return $details;
            break;
        case 'Credit':
            $details = array();
            $details ['CourseCredit'] = $this->_courseCredit;
            return $details;
            break;
        case 'Year':
            $details = array();
            $details ['CourseYear'] = $this->_year;
            return $details;
            break;
        case 'Sem':
            $details = array();
            $details ['CourseSem'] = $this->_sem;
            return $details;
            break;
        case 'Fid':
            $details = array();
            $details ['CourseSem'] = $this->_fid;
            return $details;
            break;
        case 'Cdep':
            $details = array();
            $details ['Cdep'] = $this->_courseDescription;
            return $details;
            break;    
            
      }      
  }
  
  //verified1
  // function getFaculty(){
  //   $database = new Database();
  //   if($database -> connect()){
  //     $details = array();
  //     $details['faculty'] = $database -> getCourseDetails($this->getDetail('Cid'),$this->getDetail('Year'),$this->getDetail('Sem'),"UID" );
  //     $database -> disconnect();
  //     unset($database);
      
  //     if ($details['faculty']!= NULL)
  //     {  
  //       return $details;
                  
  //     }
      
  //   }
    
  // }
  
  //verified1
  // function getDescription(){
  //   $database = new Database();
  //   if($database -> connect()){
  //     $details = array();
  //     $details['description'] = $database -> getCourseDetails($this->getDetail('Cid'),$this->getDetail('Year'),$this->getDetail('Sem'),"CDEP" );
  //     $database -> disconnect();
  //     unset($database);
      
  //     if ($details['description'] != NULL)
  //     {  
  //       return $details;
                  
  //     }
      
  //   }
  // }
   
   //verified1
  // done by ayush
   function setDescription($description){
     $database = new Database();
    if($database -> connect()){
      $details = array();
      $details['descriptionSetFlag'] = $database -> setCoursesDescription($this->getDetail('Cid')/*['CourseID']*/,$this->getDetail('Year')/*['CourseYear']*/,$this->getDetail('Sem')/*['CourseSem']*/,$description );
      $database -> disconnect();
      unset($database);
      
      if ($details['descriptionSetFlag'] != NULL)
      {  
        return $details;
                  
      }
      
    }
   }

//replaced
// function addAttendance($type, $date, $data = array()){
//   $database = new Database();
//     if($database -> connect()){
//       $details = array();
//       $database -> addAttendance($this->getDetail('Cid'),$this->getDetail('Year'),$this->getDetail('Sem'),$type, $date, $data,$_SESSION ["USERID"] );
//       $database -> disconnect();
//       unset($database);
            
//     }
  
//   }

function addAttendance($type, $date, $data = array())
{
    // echo $this->getDetail('Cid')['CourseID'];
    $database = new Database();
        if($database -> connect())
        {
            // $database -> authenticity_attendance(201002001,$this->getDetail('Cid')['CourseID'],$this->getDetail('Sem')['CourseSem'],$this->getDetail('Year')['CourseYear']);
            $tempcid = $this->getDetail('Cid');
            $tempsem = $this->getDetail('Sem');
            $tempyear = $this->getDetail('Year');
            if($database -> authenticity_attendance($_SESSION['USERID'],$tempcid['CourseID'],$tempsem['CourseSem'],$tempyear['CourseYear']))
            {
                
                $details = array();
                $database -> addAttendance($tempcid['CourseID'],$tempyear['CourseYear'],$tempsem['CourseSem'],$type, $date, $data, $_SESSION['USERID'] );
                $database -> disconnect();
                unset($database);

               
                // if ($details['addAttendanceFlag'] != NULL)
                // {   
                //     return $details;
                                       
                // }
            }
            else
            {
                die("can't addAttendance");
            }
           
           
        }
   
    }

//verified1
  // done by ayush
function getAttendance($type){
  $database = new Database();
    if($database -> connect()){
      $details = array();
      // $var = $this->getDetail('Cid')['CourseID'];
      // echo $var;
      // exit();
      $details['Attendance'] = $database -> getCourseAttendance($this->getDetail('Cid')/*['CourseID']*/,$this->getDetail('Year')/*['CourseYear']*/,$this->getDetail('Sem')/*['CourseSem']*/,$type);
      $database -> disconnect();
      unset($database);
      
      if ($details['Attendance'] != NULL)
      {  
        return $details;
                  
      }
      
    }
  
  }

//verified1
  // no need
function removeAttendance($type,$date){
  $database = new Database();
    if($database -> connect()){
      $details = array();
      $details['AttendanceRemovedFlag'] = $database -> removeAttendance($this->getDetail('Cid'),$this->getDetail('Year'),$this->getDetail('Sem'),$type,$date);
      $database -> disconnect();
      unset($database);
      
      if ($details['AttendanceRemovedFlag'] != NULL)
      {  
        return $details;
                  
      }
      
    }
  
  }

  
//not verified
function uploadFile($time, $name, $file){
  $database = new Database();
    if($database -> connect()){
      $details = array();
      $details['FileUploadedFlag'] = $database -> uploadFile($this->getDetail('Cid'),$this->getDetail('Year'),$this->getDetail('Sem'),$time);
      $database -> disconnect();
      unset($database);
      
      if ($details['FileUploadedFlag'] != NULL)
      {  
        return $details;
                  
      }
      
    }
  
}  


//verified1
// done by jayesh
function deleteFile($fileid){
  $database = new Database();
    if($database -> connect()){
      $details = array();
      $details['FileDeletedFlag'] = $database -> deleteFile($fileid);
      $database -> disconnect();
      unset($database);
      
      if ($details['FileDeletedFlag'] != NULL)
      {  
        return $details;
                  
      }
      
    }
  
  
}
//verified1
// done by ayush
// function getFiles(){
//   $database = new Database();
//     if($database -> connect()){
//       //$details = array();
//       $details = $database -> getUploadedFiles($this->getDetail('Cid')/*['CourseID']*/,$this->getDetail('Year')['CourseYear'],$this->getDetail('Sem')/*['CourseSem']*/);
//       $database -> disconnect();
//       unset($database);
      
//       if ($details['Files'] != NULL)
//       {  
//         return $details;
                  
//       }
      
//     }
  
// }


//By Vidhan
function getFiles()
{
  $database = new Database();
    if($database -> connect()){
      $var = $this->getDetail('ALL');
      $result = array();
      $details = array();
      $result = $database -> getUploadedFiles($var['ID'],$var['Year'],$var['Sem']);
      $database -> disconnect();
      unset($database);
      
      if ($result != NULL)
      { for ($i = 0; $i <= mysql_num_rows($result) -1; $i++)
        {
        $fetchedFile = mysql_fetch_array($result);
        //$temp = explode('/',$course['File_Path']);
        $name = strtolower($fetchedFile['Name']);
        //end($fetchedFile)
        $id = $fetchedFile['File_Id'];
        $path = $fetchedFile['File_Path'];
        $details[$i]['Name'] = $name;
        $details[$i]['ID'] = $id;
        $details[$i]['Path'] = $path;
        $details[$i]['DisplayName'] = $fetchedFile['Display_name'];
        $details[$i]['Time'] = $fetchedFile['Time'];
        //echo $details[$i]['Path'];
        
        }
      }
      
      return $details; 
    }
  
}



// function getPolls(){
//   $database = new Database();
//     if($database -> connect()){
//       $details = array();
//       $details= $database -> getActivePolls($fileid);
//       $database -> disconnect();
//       unset($database);
      
//       if ($details != NULL)
//       {  
//         return $details;
                  
//       }
      
//     }
//   }

  function getRegisteredStudents()
    {
        $tempcid = $this->getDetail('Cid');
        $tempsem = $this->getDetail('Sem');
        $tempyear = $this->getDetail('Year');

        $database = new Database();
        if($database -> connect())
        {   
            $t = $database -> getRegisteredStudents($tempcid['CourseID'], $tempsem['CourseSem'], $tempyear['CourseYear']);
            return $t;
        }

    }

//Poll
function createPoll($question, $options = array()){
  $database = new Database();
    if($database -> connect()){
          $var = $this->getDetail('ALL');
          $result = $database -> createPoll($var['ID'], $question, $options);
          $database -> disconnect();
          unset($database);
          }
}
function getPolls () {
  $database = new Database();
    if($database -> connect()){
      $details = array();
      $var = $this->getDetail('ALL');
      $details= $database -> getPollIDs($var['ID'], $var['Year'], $var['Sem']);
      $database -> disconnect();
      unset($database);
      
      if ($details != "No Polls")
      { return $details;
      }
    }
  }

  function getDetailDayWiseCourseAttendance($type, $Date)
  {
    $tempcid = $this->getDetail('Cid');
    $tempsem = $this->getDetail('Sem');
    $tempyear = $this->getDetail('Year');
    $database = new Database();

    if($database -> connect())
    { 
      $t = $database -> getDetailDayWiseCourseAttendance($tempcid['CourseID'], $tempsem['CourseSem'], $tempyear['CourseYear'], $type, $Date);
      return $t;
    }
  }

  function getDayWiseCourseAttendance($type)
  {
    $tempcid = $this->getDetail('Cid');
    $tempsem = $this->getDetail('Sem');
    $tempyear = $this->getDetail('Year');
    $database = new Database();

    if($database -> connect())
    { 
      $t = $database -> getDayWiseCourseAttendance($tempcid['CourseID'], $tempsem['CourseSem'], $tempyear['CourseYear'], $type);
      return $t;
    }
  }

  //Disscusion Forum By Vidhan
  function addDiscussionTopic($subject)
  {
    $userid = $_SESSION['USERID'];
    $var = $this -> getDetail('ALL');
    $courseid = $var['ID'];
    $sem = $var['Sem'];
    $year = $var['Year'];
    $database = new Database();
    if ($database -> connect())
    {
      $details["topicAddStatus"] = $database -> addTopic($userid, $courseid ,$sem,$year, $subject);
      $database -> disconnect();
            unset($database);
      return $details;
    }
  }
  
 function addDiscussionResponse($response, $topicid)
  {
    $database = new Database();
    if($database -> connect())
    {
      $userid = $_SESSION['USERID'];
      $var = $this -> getDetail('ALL');
      $courseid = $var['ID'];
      $sem = $var['Sem'];
      $year = $var['Year'];
      $details['responseAddStatus'] = $database -> addDiscussionResponse($response, $userid, $sem, $year, $courseid, $topicid);
      $database->disconnect();
      unset($database);
      return $details;
    }
  else{
    $details['responseAddStatus'] = "Connection could not be established";
    return $details;
  } 
  }

  
  function getDiscussionTopics()
{
        $var = $this -> getDetail('ALL');
      $courseid = $var['ID'];
      $sem = $var['Sem'];
      $year = $var['Year'];
      $database = new Database();
      if($database -> connect())
      {
      $details['topicList'] = $database->getDiscussionTopics($courseid, $sem, $year);
      $database->disconnect();
      unset($database);
      return $details;
    }
}


   function getDiscussionResponse($topicid)
{
  $database = new Database();
  if ($database->connect()){
    $details['response'] = $database->getDiscussionResponse($topicid);
    $database->disconnect();
    unset($database);
    return $details;
  }
  else {
    $details['response'] = "Could not connect to the database";
  }
}



}

?>