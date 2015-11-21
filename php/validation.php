<?php
require_once ('settings/config.php');
  //require_once ('./settings/config.php');
require_once('database.php');
class Validator{
  private $_errflag = false; //Validation error flag
  private $_errmsg_arr = array();   //Array to store validation errors
  private $_db_host =DB_HOST ;   
  private $_db_user =DB_USER;   
  private $_db_pass =DB_PASSWORD;   
  private $_db_name =DB_DATABASE;
  
  function clean($str) {
    $str = @trim($str); 
    if(get_magic_quotes_gpc()) {
      $str = stripslashes($str);
    }
    $dbh=mysql_connect($this->_db_host,$this->_db_user,$this->_db_pass);
    return mysql_real_escape_string($str);
  }
  
  function loginFieldsEmpty($username, $password){
    
  if($username == '') {
    $this -> _errmsg_arr[] = 'Username missing';
    $this ->_errflag = true;
  }
  if($password == '') {
    $this -> _errmsg_arr[] = 'Password missing';
    $this -> _errflag = true;
  }
  return $this ->_errflag;
  }
  
  function getErrorMessages(){
    return $this ->_errmsg_arr;
    }
  
  function checkLoginDetails ($clean_username,$clean_password){
    $database = new Database();
  if($database -> connect())
  {
    $userDetails = $database -> checkLoginDetails($clean_username,$clean_password);
    $database -> disconnect();
    unset($database);
    if ($userDetails !=NULL ){
      session_regenerate_id();
      $_SESSION['USERID'] = $userDetails['Uid'];
      $_SESSION['NAME'] = $userDetails['U_Name'];
      $_SESSION['ROLE'] = $userDetails['Role'];
      session_write_close();
      return $userDetails['Role'];
      
    
    }
  }
  
  else{
  die('Failed to connect to server database');}

    
    
  }
  
  function selectPage ($role)
  {
        
  if ($role ==1)
        header("location: ./home_student.html");
  elseif ($role ==2)
        header("location: ./home_faculty.html");
  elseif ($role ==3)
        header("location: ./admin.php");
      exit();
  }

  
  //For forget Password
   function checkIfUserExists($username){
  $database = new Database();
if($database -> connect()){
$existence = $database -> checkExistence($username);
    $database -> disconnect();
    unset($database);
    {
    if ($existence){
   
    return TRUE;
    }
else{ return FALSE;}
    }
}
  }



 function generatePassword($length = 8) {
    $chars1 = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$chars = str_shuffle($chars1);

    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}



function addRandomPassword($username, $randompassword){
   $database = new Database();
      if($database -> connect())
      {
        $details = array();
        $details['PasswordChangeFlag'] = $database -> insertRandomPassword($username,  $randompassword);
        $database -> disconnect();
        unset($database);
        if($details['PasswordChangeFlag'])
          return TRUE;
        else return FALSE;
                  
      
     }
 
  }
}

?>