<?php

session_start();
  //$filename =glob("php/validation.php");
  //include $filename;
require_once ('php/validation.php');
//require_once ('php\validation.php');
require_once ('php/mail2.php');
require_once ('php/user.php');
if(isset($_SESSION['USERID'])){
  $user1 = new User($_SESSION['USERID']);
  $role = $user1 ->  getUserDetail('Role');
  if($role['Role'] == 1){
    header("location: home_student.html");
  }
  else if($role['Role'] == 2){
    header("location: home_faculty.html");
  }
  else if($role['Role'] == 3){
    header("location: admin.php");
  }
}

if (isset ($_POST['forget']))
{ 
  $username = $_POST['usernamef'];
  $validator = new Validator();
  $cleanUser = $validator -> clean ($username); 
  $existence = $validator -> checkIfUserExists($cleanUser);
  if ($existence){
    $newPass = $validator->generatePassword() ;
    if ($validator->addRandomPassword($cleanUser, $newPass))
    { 
      sendMail($cleanUser,$newPass);
      echo "Login in to your webmail account to get the new password";
    }
    else "Recovery mechanism failed. Try again ";

  }
  else echo "Username doesn't exists ";
}

if(isset($_POST['submit'])){

$username = $_POST['username'];
$password = $_POST['password'];


$validator = new Validator();
$emptyFields = $validator -> loginFieldsEmpty($username, $password);

  

if (!$emptyFields){
  
  
$clean_username = $validator -> clean($username);
$clean_password = $validator -> clean ($password);
$role = $validator -> checkLoginDetails ($clean_username,$clean_password);
if ( $role != NULL)
{
  $validator -> selectPage($role);
}

}

else {
  $errmsg_arr = $validator -> getErrorMessages();
  $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
  session_write_close();
  unset($validator);
  header("Location: index.php");
  exit();
}

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login: Integrated Campus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/logo16.png" />



    <!-- Le styles -->
    <link href="css/bootstrap_css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap_css/bootstrap.css" rel="stylesheet">
    <!-- jQuery -->
    <script type="text/javascript" src="scripts/jquery.js"></script>       
    <!-- Bootstrap Javascript -->
    <script type="text/javascript" src="scripts/bootstrap_js/bootstrap.js"></script>
    <!-- Ajax Api php -->
    <script type="text/javascript" src="scripts/api.js"></script>
     


  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">Integrated Campus</a>
                <div class="nav-collapse collapse">
                    <form action="index.php" class="navbar-form pull-right" method="post">
                      <input class="text-input" name = "username" type="text" maxlength = "9"required placeholder="Username"/>
                      <input class="text-input" type="password" name = "password" maxlength = "15"required placeholder="Password"/>
                      <input class="button btn btn-info" type="submit" value="Sign In" name = 'submit' />
                      <a class="btn btn-danger" href="#forgetPassModal" data-toggle="modal">Forgot Password</a>
                    </form>

              </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

  

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1><img src="img/logo.png"><span style="margin-left:-150px">integrated Campus</span></h1>
        <p>A platform which integrates all the essential requirements of an academic institutes from both the student's and the faculty's perspective.</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Attendance</h2>
          <p>Students can view their attendance any time in a clean format and can recieve notifications when the attendance goes low. On the faculty side the platform provide a very easy interface to upload the attendance information.</p>
        </div>
        <div class="span4">
          <h2>Polls</h2>
          <p>Now any faculty can quickly take feedback or ask some quick question to the students through poll and act accordingly during the course. Polls are completely anonymous so students you dont need to worry.</p>
       </div>
        <div class="span4">
          <h2>Files</h2>
          <p>All the course related material can be accessed by the students in a clean weekly sorted format.</p>
        </div>
      </div>

      <hr>

      <footer>
        &copy Team-2 SEN Winter 2013, DA-IICT Gandhinagar<br>
          <a href="http://www.freedomain.co.nr/" target="_blank" title="Free Domain Name"><img src="http://osorzna.imdrv.net/nrlink.gif" width="88" height="31" border="0" alt="Free Domain Name" /></a>
      </footer>

    </div> <!-- /container -->

    <!-- Forget Pass Modal -->
        <div id="forgetPassModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 id="myModalLabel">Forget Password</h4>
            </div>
            <div class="modal-body" align="center">
                <div id="changePassDiv">
                    <form action="index.php" method="post">
                        <input id="username" type="text" name="usernamef" placeholder="Enter Username" required><br>
                        <input class="button btn btn-info" type="submit" value="Submit" name = 'forget' />
                    </form>
                </div>
                <div   id="changingPass" style="text-align:center;display:none">
                    <img src="img/loading.gif">
                </div>
                <span id="passMsg"></span>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>

  </body>
</html>

