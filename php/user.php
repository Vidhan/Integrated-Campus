<?php 
require_once('settings/sem&year.php');
require_once ('course.php');
class User{
  
  private $_uid;
  private $_name;  
  private $_email;
  private $_contact_no;
  private $_gender;
  private $_last_access;
  private $_dob;
  private $_role;

  //verified1
  function __construct($userid) {
    
    $database = new Database();
    if($database -> connect())
    {
      $userDetails = $database -> getUserDetails($userid);
      $database -> disconnect();
      unset($database);
      
      if ($userDetails != NULL)
      {
        $this ->_uid = $userDetails['Uid'];
        $this ->_name =  $userDetails['U_Name'];
        $this ->_email = $userDetails['Email_Id'];
        $this ->_password = $userDetails['Password'];
        $this ->_contact_no = $userDetails['Contact_No'];
        $this-> _gender = $userDetails['Gender'];
        $this-> _last_access = $userDetails['Last_Access'];
        $this-> _dob = $userDetails['DOB'];
        $this-> _role = $userDetails['Role'];
              
    }
    
  }

}
  //////////////////////////////////////////////////////////////////////
  
  //verified1
  function getUserDetail($option)
  {
      switch ($option)
          {
        case 'ALL':
            $details = array();
            $details['ID'] = $this->_uid;
            $details['Name'] =$this->_name;
            $details['Email'] = $this->_email;
            $details['ContactNo'] = $this->_contact_no;
            $details['Gender'] =$this->_gender;
            $details['LastAccess'] =$this->_last_access;
            $details['DOB'] =$this->_dob;
            $details['Role'] =$this->_role;
            return $details;
            break;
          
          
        case 'Uid':
            $details = array();
            $details ['ID'] = $this->_uid;
            return $details;
            break;
        case 'Name':
            $details = array();
            $details['Name'] =$this->_name;
            return $details;
            break;
        case 'Email':
            $details = array();
            $details['Email'] = $this->_email;
            return $details;
            break;
        case 'ContactNo':
            $details = array();
            $details['ContactNo'] = $this->_contact_no;
            return $details;
            break;
        case 'Gender':
            $details = array();
            $details['Gender'] =$this->_gender;
            return $details;
            break;
        case 'LastAccess':
            $details = array();
            $details['LastAccess'] =$this->_last_access;
            return $details;
            break;
        case 'DOB':
            $details = array();
            $details['DOB'] =$this->_dob;
            return $details;
            break;
        case 'Role':
            $details = array();
            $details['Role'] =$this->_role;
            return $details;
            break;
            
      }      

  }
  
  //verified1
  function setUserDetail($option, $value){
    $database = new Database();
    if($database -> connect()){
      $details = array();
      $details['UserDetailSetFlag'] = $database -> setUserDetail($this->getUserDetail('Uid'),$option, $value);
      $database -> disconnect();
      unset($database);
      
      if ($details['UserDetailSetFlag'] != NULL)
      {  
        return $details;
      }
      
    }
  }
  
  //completed by ayush
  function changePassword($newpass, $oldpass)
  {
      $database = new Database();
      if($database -> connect())
      {
        $details = array();
        
        $uid1 = $this->getUserDetail('Uid');
        //echo $uid1["ID"];
        $details['PasswordChangeFlag'] = $database -> changePassword($uid1["ID"],$newpass, $oldpass);
        //echo $details['PasswordChangeFlag'];
        $database -> disconnect();
        unset($database);
        
        
        if($details['PasswordChangeFlag'] == 'FALSE')
          return "false";
        else
          return "true";
                  
      
      }
    
  }
}

///end of user class

class Student extends User {
  
  private $_parentContactNumber;
  private $_batch;
  private $_programid;
  // private $_isTA;
  
  function __construct($studentid) {
  
    $database = new Database();
    if($database -> connect())
    {
      $studentDetails = $database -> getStudentDetails($studentid);
      $database -> disconnect();
      unset($database);
      if ($studentDetails != NULL)
      {
          
        $this ->_parentContactNumber = $studentDetails['Parent_Contact_No'];  
        $this ->_batch = $studentDetails['Batch'];
        $this ->_programid = $studentDetails['Program_Id'];
        // $this ->_isTA = $studentDetails['Is_Ta'];
        parent::__construct($studentid);    
      }
    }
    
  }
  ///////////////////////////////////////////////////////////////////////////////////////////
  


  function getStudentDetails($option){
    switch ($option)
          {
        case 'ALL':
            $details = array();
            $details['parentContactNumber'] = $this->_parentContactNumber;
            $details['batch'] =$this->_batch;
            $details['programid'] = $this->_programid;
          //  $details['isTA'] = $this->_isTA;
            //call the parent constructor
            return $details;
            break;
          
          
        case 'ParentContactNumber':
            $details = array();
            $details['parentContactNumber'] = $this->_parentContactNumber;
            return $details;
            break;
        case 'Batch':
            $details = array();
            $details['batch'] =$this->_batch;
            return $details;
            break;
        case 'ProgramId':
            $details = array();
            $details['programid'] = $this->_programid;
            return $details;
            break;
        //case 'IsTA':
          //  $details = array();
            //$details['isTA'] = $this->_isTA;
          //  return $details;
          //  break;
        default:
            $details = array();          
          $details = $this-> getUserDetail($option);
          return $details  ;
      }      
    
  }

  function getAttendance($Course_Id,$Sem_Type,$Year,$Type)
  {
    $database = new Database();
    if ($database -> connect())
    {

    $var=$database -> getAttendance($_SESSION['USERID'],$Course_Id,$Sem_Type,$Year,$Type);
    return $var;
    } 

  }


  //verified1
function getCurrentCourses()
{
    $database = new Database();
    if ($database -> connect()){
      $details = array();
      $uid1=$this -> getStudentDetails("Uid");
      $details = $database -> getRegisteredCourses($uid1['ID'],PRESENT_YEAR, PRESENT_SEM ); 
      $database -> disconnect();
      unset($database);
      
      if ($details != NULL)
      {
        return $details;
          
      }
        
    }
}
  
  //verified1
  function getPreviousCourses($year, $sem)
{
    $database = new Database();
    if ($database -> connect()){
      $details = array();
      $uid1=$this -> getStudentDetails("Uid");  
      $details = $database -> getRegisteredCourses($uid1['ID'],$year, $sem ); 
      $database -> disconnect();
      unset($database);
      
      if ($details != NULL)
      {
        return $details ;
          
      }
        
    }
  }

  function getPermanentTimeTable()
    {
        $database = new Database();
        if ($database -> connect())
        {
            $uid1=$this -> getStudentDetails("Uid");
            // echo $uid1['ID'];
            $var=$database->getPermanentTimeTable($uid1['ID']);
            return $var;
        }
    }

    function getChanges_TimeTable()
    {
        $database = new Database();
        if ($database -> connect())
        {
            $uid1=$this -> getStudentDetails("Uid");
            // echo $uid1['ID'];
            $var=$database->getChanges_TimeTable($uid1['ID']);
            return $var;
        }
    }

    function getNotifications($limit)
    {
      $database=new Database();
        if ($database -> connect()){
      
      $details = $database -> get_notification_student($_SESSION['USERID'],$limit );
      return $details;
      }
    }

    //TA function by Jayesh
    function checkIfTa()
    {
      $database=new Database();
      if ($database -> connect()){
      $details = $database -> checkIfTa($_SESSION['USERID'],PRESENT_YEAR,PRESENT_SEM);
      return $details;
      }
    }

  
}

class Faculty extends User{
    
  private $_fbRoomNo;
  
  
  
  function __construct($facultyid) {
  
    $database = new Database();
    if($database -> connect())
    {
      $facultyDetails = $database -> getFacultyDetails($facultyid);
      $database -> disconnect();
      unset($database);
      if ($facultyDetails != NULL)
      {
          
        $this ->_fbRoomNo = $facultyDetails['FB_Room_No'];  
        parent::__construct($facultyid);    
      }
    }
    
  }
  ////////////////////////////////////////////////////////////////////////////////////
  //accessor methods
  
  
    function getCurrentCourses()
{
    $database = new Database();
    if ($database -> connect()){
      $details = array();
      //Added later by Vipul
      $temp = array();
      $temp = $this -> getFacultyDetail("Uid");
      //End of new
      $details = $database -> getCoursesBeingTaught($temp['ID']/*$this -> getFacultyDetail("Uid")['ID']*/,PRESENT_YEAR, PRESENT_SEM); 
      $database -> disconnect();
      unset($database);
      
      if ($details != NULL)
      {
        return $details;
          
      }
        
    }
}
  
  
      function getPreviousCourses($year, $sem)
{
    $database = new Database();
    if ($database -> connect()){
      $details = array();
      //Added later by Vipul
      $temp = array();
      $temp = $this -> getFacultyDetail("Uid");
      //End of new
      $details = $database -> getCoursesBeingTaught($temp['ID']/*$this -> getFacultyDetail("Uid")['ID']*/,$year, $sem ); 
      $database -> disconnect();
      unset($database);
      
      if ($details != NULL)
      {
        return $details;
          
      }
        
    }
}
  
  function getFacultyDetail ($option){
    switch ($option)
          {
        case 'ALL':
            $details = array();
            $details['FBRoomNo'] = $this ->_fbRoomNo ;
            //call the parent constructor
            return $details;
            break;
          
          
        case 'FBRoomNo':
            $details = array();
            $details['FBRoomNo'] = $this->_fbRoomNo ;
            return $details;
            break;
        
        default:
          $details = array();

          $details = $this->getUserDetail($option);
          return $details;
            
      }      
  }
  
  function getCsv($courseId, $date, $type)
  {
    $database = new Database();
    if ($database -> connect()){
    $details = $database -> get_csv($courseId,$date,$type );
    }
  }

function getNotifications($limit)
  {
    $database=new Database();
      if ($database -> connect()){
    
    $details = $database -> get_notification_faculty($_SESSION['USERID'],$limit );
    return $details;
    }
  }

function getFacultyPermanentTimeTable()
    {
        $database = new Database();
        if ($database -> connect())
        {
            // $uid1=$this -> getFacultyDetail("Uid");
            // echo $uid1['ID'];
          @session_start();
            $var=$database->getFacultyPermanentTimeTable($_SESSION['USERID']);
            // echo $_SESSION['USERID'];
            return $var;
        }
    }

  
}

class TA extends Student{
  function __construct($studentid) {
  
    $database = new Database();
    if($database -> connect())
    {
      $studentDetails = $database -> getStudentDetails($studentid);
      $database -> disconnect();
      unset($database);
      if ($studentDetails != NULL)
      {
        parent::__construct($studentid);    
      }
    }
    
  }

  function get_course_of_ta()
    {
      $database=new Database();
      if ($database -> connect()){
      $details = $database -> get_course_of_ta($_SESSION['USERID'],PRESENT_YEAR,PRESENT_SEM );
      return $details;
      } 
    }
}

//admin by Ayush
class Admin extends User
{
  function __construct($userid)
  {
    $database = new Database();
    if($database -> connect())
    {
      $userDetails = $database -> getUserDetails($userid);
        $database -> disconnect();
      unset($database);
     
      if ($userDetails != NULL)
      {
        $this ->_uid = $userDetails['Uid'];
        $this ->_name =  $userDetails['U_Name'];
        $this ->_email = $userDetails['Email_Id'];
        $this ->_password = $userDetails['Password'];
        $this ->_contact_no = $userDetails['Contact_No'];
        $this-> _gender = $userDetails['Gender'];
        $this-> _last_access = $userDetails['Last_Access'];
        $this-> _dob = $userDetails['DOB'];
        $this-> _role = $userDetails['Role'];
      }
    }
  }
   
  function addCourse($course)
  {
    $database = new Database();

    if ($database -> connect())
    {
      $database -> addCourse($course);
    }

    else
    {
      die('Database connection error');
    }

  }




  function addStudent($addUser)
  {
    $database = new Database();

    if ($database -> connect())
    {
      $database -> addStudent($addUser);
    }

    else
    {
      die('Database connection error');
    }

  }

 function addFaculty($addUser)
  {
    $database = new Database();

    if ($database -> connect())
    {
      $database -> addFaculty($addUser);
    }

    else
    {
      die('Database connection error');
    }

  }

function addTA($addUser)
  {
    $database = new Database();

    if ($database -> connect())
    {
      $database -> addTA($addUser);
    }

    else
    {
      die('Database connection error');
    }

  }


  function add_registered_in($addUser)
  {
    $database = new Database();

    if ($database -> connect())
    {
      $database -> add_registered_in($addUser);
    }

    else
    {
      die('Database connection error');
    }

  }


 function add_teaches($addUser)
  {
    $database = new Database();

    if ($database -> connect())
    {
      $database -> add_teaches($addUser);
    }

    else
    {
      die('Database connection error');
    }

  }
 function get_registered_students($Course_Id)
{

 $database = new Database();

    if ($database -> connect())
    {
      $var = $database ->get_registered_students($Course_Id);
      return $var;
    }

    else
    {
      die('Database connection error');
    }

}


function addTimeTable($timetable)
{

  // print_r($timetable);
  // exit();
 $database = new Database();

    if ($database -> connect())
    {
      $var = $database ->addTimeTable($timetable);

      return $var;
    }

    else
    {
      die('Database connection error');
    }

}

}

//end
 
 
// class Admin extends User
// {
//   function __construct($userid) 
//   {
//     $database = new Database();
//     if($database -> connect())
//     {
//       $userDetails = $database -> getUserDetails($userid);
//         $database -> disconnect();
//       unset($database);
      
//       if ($userDetails != NULL)
//       {
//         $this ->_uid = $userDetails['Uid'];
//         $this ->_name =  $userDetails['U_Name'];
//         $this ->_email = $userDetails['Email_Id'];
//         $this ->_password = $userDetails['Password'];
//         $this ->_contact_no = $userDetails['Contact_No'];
//         $this-> _gender = $userDetails['Gender'];
//         $this-> _last_access = $userDetails['Last_Access'];
//         $this-> _dob = $userDetails['DOB'];
//         $this-> _role = $userDetails['Role'];
//       }
//     }
//   }
    
//   function addCourse($course)
//   {
//     $database = new Database();

//     if ($database -> connect())
//     {
//       $database -> addCourse($course);
//     }

//     else
//     {
//       die('Database connection error');
//     }

//   }




//   function addStudent($addUser)
//   {
//     $database = new Database();

//     if ($database -> connect())
//     {
//       $database -> addStudent($addUser);
//     }

//     else
//     {
//       die('Database connection error');
//     }

//   }

//  function addFaculty($addUser)
//   {
//     $database = new Database();

//     if ($database -> connect())
//     {
//       $database -> addFaculty($addUser);
//     }

//     else
//     {
//       die('Database connection error');
//     }

//   }

// function addTA($addUser)
//   {
//     $database = new Database();

//     if ($database -> connect())
//     {
//       $database -> addTA($addUser);
//     }

//     else
//     {
//       die('Database connection error');
//     }

//   }


//   function add_registered_in($addUser)
//   {
//     $database = new Database();

//     if ($database -> connect())
//     {
//       $database -> add_registered_in($addUser);
//     }

//     else
//     {
//       die('Database connection error');
//     }

//   }


//  function add_teaches($addUser)
//   {
//     $database = new Database();

//     if ($database -> connect())
//     {
//       $database -> add_teaches($addUser);
//     }

//     else
//     {
//       die('Database connection error');
//     }

//   }
//  function get_registered_students($Course_Id)
// {

//  $database = new Database();

//     if ($database -> connect())
//     {
//       $var = $database ->get_registered_students($Course_Id);
//       return $var;
//     }

//     else
//     {
//       die('Database connection error');
//     }

// }


// }

// class TA extends Student{
  
//   function getTAcourses()
//   {
    
//   }
// }
 
 
 
?>
