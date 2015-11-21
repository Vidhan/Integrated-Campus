<?php


require_once("php/user.php");

@session_start();
    if(!isset($_SESSION['USERID'])){
        header("location: index.php");
    }
    else{
        $user1 = new User($_SESSION['USERID']);
        $role = $user1 ->  getUserDetail('Role');
        if($role['Role'] == 1){
            header("location: home_student.html");
        }
        else if($role['Role'] == 2){
            header("location: home_faculty.html");
        }
        // else{
        //     header("location: index.php");
        // }
    }
    if(isset($_POST['course']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // echo $_POST[4];
        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo $i;
            $setCourse['Course_Id']= $_POST[$i];
            $i++;
            $setCourse['Course_Name'] = $_POST[$i];
            $i++;
            $setCourse['Course_Type'] = $_POST[$i];
            $i++;
            $setCourse['Course_Credit'] = $_POST[$i];
            $i++;
            
            $admin = new Admin($_SESSION['USERID']);
                $admin -> addCourse($setCourse);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        header('location:admin.php');
    }


    if(isset($_POST['addstud']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // exit();
        // echo $_POST[4];

        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo "hii";
            $addUser['Uid']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['U_name'] = $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Email_Id'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Password'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Contact_No'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Gender'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['DOB'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Parent_Contact_No'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Batch'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Program_id'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            @session_start();
            // echo $_SESSION['USERID'];
            // exit();
            $admin = new Admin($_SESSION['USERID']);
                $admin -> addStudent($addUser);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        // exit();
        header('location:admin.php');
    }



if(isset($_POST['addfaculty']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // exit();
        // echo $_POST[4];

        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo "hii";
            $addUser['Uid']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['U_name'] = $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Email_Id'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Password'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Contact_No'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Gender'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['DOB'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
        
            $addUser['FB_Room'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            @session_start();
            // echo $_SESSION['USERID'];
            // exit();
            $admin = new Admin($_SESSION['USERID']);
                $admin -> addFaculty($addUser);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        // exit();
        header('location:admin.php');
    }




if(isset($_POST['addta']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // exit();
        // echo $_POST[4];

        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo "hii";
            $addUser['Course_Id']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Uid'] = $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Year'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Sem_Type'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
             @session_start();
            // echo $_SESSION['USERID'];
            // exit();
            $admin = new Admin($_SESSION['USERID']);
            $admin -> addTA($addUser);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        // exit();
        header('location:admin.php');
    }


    if(isset($_POST['addregisterstudent']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // exit();
        // echo $_POST[4];

        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo "hii";
            $addUser['Uid']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Course_Id'] = $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Year'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Sem_Type'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
             @session_start();
            // echo $_SESSION['USERID'];
            // exit();
            $admin = new Admin($_SESSION['USERID']);
            $admin -> add_registered_in($addUser);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        // exit();
        header('location:admin.php');
    }


    if(isset($_POST['courseoffer']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // exit();
        // echo $_POST[4];

        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo "hii";
            $addUser['Course_Id']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Year'] = $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['Sem_Type'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Uid'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
             @session_start();
            // echo $_SESSION['USERID'];
            // exit();
            $admin = new Admin($_SESSION['USERID']);
            $admin -> add_teaches($addUser);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        // exit();
        header('location:admin.php');
    }

    if(isset($_POST['addtimetable']))
    {
        $i=0;
        // echo "hii";
        // exit();
        // print_r($_POST['h']);
        $t = count($_POST);
        // echo $t;
        // echo $_POST[4];
        // exit();
        

        while($i<$t-1)
        {
             // print_r($_POST['h']);
            // echo "hii";
            $addUser['Course_Id']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;

            $addUser['Day']= $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            
            $addUser['StartTime'] = $_POST[$i];
            // echo $_POST[$i]; 
            $i++;
            $addUser['EndTime'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
            $addUser['Type'] = $_POST[$i];
            // echo $_POST[$i];
            $i++;
             @session_start();
            // echo $_SESSION['USERID'];
            // exit();
            $admin = new Admin($_SESSION['USERID']);
            $admin -> addTimeTable($addUser);
            // $i = $i+1;
            // echo $tempCoursecredit; 
            // exit();
        }
        // exit();
        header('location:admin.php');
    }

?>

<!DOCTYPE html>

<html style="height:100%">
 
  <head>
 
<script type="text/javascript">
    var i=4;
    var j=10;
    var k=8;
    var l = 4;
    var m = 4;
    var n = 4;
    var o = 5;  

    function createCourse()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addcourserow");
            // alert(i);
            // ele.innerHTML = 4;
            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + i + " placeholder=\'CourseId\' required> ";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (i+1) + " placeholder=\'CourseName\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (i+2) + " placeholder=\'CourseType\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (i+3) + " placeholder=\'Credit\' required><br><br>";
            i = i+4;
             //alert(i);
            
    }

    function addStudent()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addstudentrow");
            // alert(i);
            // ele.innerHTML = 4;

            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + j + " placeholder=\'StudentId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+1) + " placeholder=\'StudentName\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+2) + " placeholder=\'Email_id\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+3) + " placeholder=\'Password\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+4) + " placeholder=\'ContactNo.\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+5) + " placeholder=\'Gender\' required><br><br>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+6) + " placeholder=\'DOB\' required>";
            // ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (i+7) + " placeholder=\'Role\' value = \'1\'>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+7) + " placeholder=\'ParentContact\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+8) + " placeholder=\'Batch\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (j+9) + " placeholder=\'ProgId\' required><br><br><br><br>";
    
            j = j+10;
             //alert(i);
            
    }


    function addFaculty()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addfacultyrow");
            // alert(i);
            // ele.innerHTML = 4;
            // alert("hi");
            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + k + " placeholder=\'FacultyId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+1) + " placeholder=\'FacultyName\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+2) + " placeholder=\'Email_id\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+3) + " placeholder=\'Password\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+4) + " placeholder=\'ContactNo.\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+5) + " placeholder=\'Gender\' required><br><br>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+6) + " placeholder=\'DOB\' required>";
            // ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (i+7) + " placeholder=\'Role\' value = \'1\'>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (k+7) + " placeholder=\'FB_Room\' required><br><br><br><br>";
    
            k = k+8;
             //alert(i);
            
    }


    function addTa()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addtarow");
            // alert(i);
            // ele.innerHTML = 4;
            // alert("hi");
            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + l + " placeholder=\'CourseId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (l+1) + " placeholder=\'UserId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (l+2) + " placeholder=\'Year\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (l+3) + " placeholder=\'Sem_Type\' required><br><br><br><br>";
    
            l = l+4;
             //alert(i);
            
    }


    function addRegisterStudent()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addregisterstudentrow");
            // alert(i);
            // ele.innerHTML = 4;
            // alert("hi");
            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + m + " placeholder=\'UserId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (m+1) + " placeholder=\'CourseId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (m+2) + " placeholder=\'Year\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (m+3) + " placeholder=\'Sem_Type\' required><br><br>";
    
            m = m+4;
             //alert(i);
            
    }


    function addCourseOffered()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addcourseoffer");
            // alert(i);
            // ele.innerHTML = 4;
            // alert("hi");
            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + n + " placeholder=\'CourseId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (n+1) + " placeholder=\'Year\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (n+2) + " placeholder=\'Sem_Type\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (n+3) + " placeholder=\'FacultyId  \' required><br><br>";
    
            n = n+4;
             //alert(i);
            
    }


    function addTimeTable()
    {
            //console.info("ADD");
            

            var ele = document.getElementById("addtimetablerow");
            // alert(i);
            // ele.innerHTML = 4;
            // alert("hi");
            ele.innerHTML = ele.innerHTML + "<input  style=\'display:inline;\' type=\'text\' name=" + o + " placeholder=\'CourseId\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (o+1) + " placeholder=\'Day\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (o+2) + " placeholder=\'StartTime\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (o+3) + " placeholder=\'EndTime\' required>";
            ele.innerHTML = ele.innerHTML + ' ' + "<input type=\'text\' name=" + (o+4) + " placeholder=\'Type\' required><br><br>";
    
            o = o+5;
             //alert(i);
            
    }
</script>



    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrated Campus</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/logo16.png" />
    
    <!--                       CSS                       -->
         
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap_css/bootstrap.css" type="text/css" media="screen" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"> -->
            
    
  </head>

    <body>
        <div class="row-fluid">
            <div class="navbar  navbar-inverse">
                <div class="navbar-inner" id="collapse" style="padding-left:10px">
                    <a class="brand" href="#">Integrated Campus</a>
                    <a class="brand" href="#">
                    
                    </a>
                    <ul class="nav">
                        <li class="divider-vertical"></li>
                        
                        
                        <li class="divider-vertical"></li>
                    </ul>
                    <ul class="nav pull-right" style="padding-right:50px">
                        <li class="dropdown">
                            <a class="dropdown-toggle" id="navName" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                ---<b class="caret"></b>
                            </a>

                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <!-- <li><a href="home_faculty.html">Home</a></li> -->
                                <!-- <li><a href="#">Edit Profile</a></li> -->
                                <li><a href="#changePassModal" data-toggle="modal">Change Password</a></li>
                                <li><a href="javascript:logout()">Logout</a></li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>
        </div>


            <div class="tabbable">
                    <ul id="myTab" class="nav nav-tabs nav-pills">
                      <li class="active"><a href="#add_course" data-toggle="tab">Add Course</a></li>
                      <li class=""><a href="#add_student" data-toggle="tab">Add Student</a></li>
                      <li class=""><a href="#add_faculty" data-toggle="tab">Add Faculty</a></li>
                      <li class=""><a href="#add_ta" data-toggle="tab">Add TA</a></li>
                      <li class=""><a href="#add_courseoffer" data-toggle="tab">Course Offered</a></li>
                      <li class=""><a href="#registerstudents" data-toggle="tab">Register Students</a></li>
                      <li class=""><a href="#timetable" data-toggle="tab">Add TimeTable</a></li>

                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <!-- Attendance Tab -->
                      <div class="tab-pane fade in" id="add_student">
                        <!-- Content Tab 1 -->
                        <div>
                            <form class="form-inline" method = "Post" >

                                    <input class = "btn btn-primary" type="submit" name="addstud"><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="StudentId" required>
                                    <input type="text" name="1" placeholder="StudentName" required>
                                    <input type="text" name="2" placeholder="Email_id" required>
                                    <input type="text" name="3" placeholder="Password" required>
                                    <input type="text" name="4" placeholder="ContactNo." required>
                                    <input type="text" name="5" placeholder="Gender"><br><br required>
                                    <input type="text" name="6" placeholder="DOB" required>
                                    <!-- <input type="text" name="7" placeholder="Role" value = "1" > -->
                                    <input type="text" name="7" placeholder="ParentContact" required>
                                    <input type="text" name="8" placeholder="Batch" required>
                                    <input type="text" name="9" placeholder="ProgId" required><br><br><br><br>
                                    <div id = "addstudentrow"></div>

                                    
                            </form>
                            <button class="btn btn-info" onClick="addStudent()">One more...</button><br><br>
                        </div>
                      </div>
                      <!-- Course Material -->
                      <div class="tab-pane fade active in" id="add_course">
                        <!-- Generated by javascript -->
                        <!-- Content Tab 2 -->
                        <form class="form-inline" method = "Post" >
                                    <input class = "btn btn-primary" type="submit" name="course"><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="CourseId" required>
                                    <input type="text" name="1" placeholder="CourseName" required>
                                    <input type="text" name="2" placeholder="CourseType" required>
                                    <input type="text" name="3" placeholder="Credit" required><br><br>
                                    <div id = "addcourserow"></div>

                                    
                            </form>
                        <button class="btn btn-info" onClick="createCourse()">One more...</button><br><br>

                      </div>
                      <div class="tab-pane fade" id="add_faculty">
                         <form class="form-inline" method = "Post" >

                                    <input class = "btn btn-primary" type="submit" name="addfaculty"><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="FacultyId" required>
                                    <input type="text" name="1" placeholder="FacultyName" required>
                                    <input type="text" name="2" placeholder="Email_id" required>
                                    <input type="text" name="3" placeholder="Password" required>
                                    <input type="text" name="4" placeholder="ContactNo." required>
                                    <input type="text" name="5" placeholder="Gender" required><br><br>
                                    <input type="text" name="6" placeholder="DOB"required>
                                    <!-- <input type="text" name="7" placeholder="Role" value = "1" > -->
                                    <input type="text" name="7" placeholder="FblockNo." required><br><br><br><br>
                                    <div id = "addfacultyrow"></div>

                                    
                            </form>                       
                        <button class="btn btn-info" onClick="addFaculty()">One more...</button><br><br>
                        <!-- Tab 3 -->
                      </div>
                      <div class="tab-pane fade" id="add_ta">
                        <!-- Tab 4 -->
                        <form class="form-inline" method = "Post" >

                                    <input class = "btn btn-primary" type="submit" name="addta" required><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="CourseId" required>
                                    <input type="text" name="1" placeholder="UserId" required>
                                    <input type="text" name="2" placeholder="Year" required>
                                    <input type="text" name="3" placeholder="Sem_Type" required><br><br><br><br>
                                    <div id = "addtarow"></div>

                                    
                            </form>                       
                        <button class="btn btn-info" onClick="addTa()">One more...</button><br><br>

                      </div>

                      <div class="tab-pane fade" id="add_courseoffer">
                        <!-- Tab 4 -->

                        <form class="form-inline" method = "Post" >

                                    <input class = "btn btn-primary" type="submit" name="courseoffer" required><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="CourseId" required>
                                    <input type="text" name="1" placeholder="Year" required>
                                    <input type="text" name="2" placeholder="Sem_Type" required>
                                    <input type="text" name="3" placeholder="FacultyId" required><br><br>
                                    <div id = "addcourseoffer"></div>

                                    
                            </form>                       
                        <button class="btn btn-info" onClick="addCourseOffered()">One more...</button><br><br>
                      </div>


                      <div class="tab-pane fade" id="registerstudents">
                        <!-- Tab 4 -->
                        <form class="form-inline" method = "Post" >

                                    <input class = "btn btn-primary" type="submit" name="addregisterstudent"><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="UserId" required>
                                    <input type="text" name="1" placeholder="CourseId" required>
                                    <input type="text" name="2" placeholder="Year" required>
                                    <input type="text" name="3" placeholder="Sem_Type" required><br><br>
                                    <div id = "addregisterstudentrow"></div>

                                    
                            </form>                       
                        <button class="btn btn-info" onClick="addRegisterStudent()">One more...</button><br><br>
                      </div>


                      <div class="tab-pane fade" id="timetable">
                        <!-- Tab 4 -->
                        <form class="form-inline" method = "Post" >

                                    <input class = "btn btn-primary" type="submit" name="addtimetable"><br><br>
                                    <input style='display:inline;' type="text" name="0" placeholder="CourseId" required>
                                    <input type="text" name="1" placeholder="Day" required>
                                    <input type="text" name="2" placeholder="StartTime" required>
                                    <input type="text" name="3" placeholder="EndTime" required>
                                    <input type="text" name="4" placeholder="Type" required><br><br>
                                    <div id = "addtimetablerow"></div>

                                    
                            </form>                       
                        <button class="btn btn-info" onClick="addTimeTable()">One more...</button><br><br>
                      </div>
                    </div>
                  </div>

                  <!-- Change Pass Modal -->
        <div id="changePassModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body" align="center">
                <div id="changePassDiv">
                    <form>
                        <input id="oldPass" type="password" name="oldPassword" placeholder="Old Password"><br>
                        <input id="newPass1" type="password" name="newPassword" placeholder="New Password"><br>
                        <input id="newPass2" type="password" name="confPassword" placeholder="Confirm Password">
                    </form>
                </div>
                <div   id="changingPass" style="text-align:center;display:none">
                    <img src="img/loading.gif">
                </div>
                <span id="passMsg"></span>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <a class="btn btn-primary" href="javascript:changePassword()">Change</a>
            </div>
        </div>




        <script type="text/javascript" src="scripts/jquery.js"></script>
    <!-- Functions -->
        <script type="text/javascript" src="scripts/functions.js"></script>       
    <!-- Bootstrap Javascript -->
    <script type="text/javascript" src="scripts/bootstrap_js/bootstrap.js"></script>
    <!-- Ajax Api php -->
    <script type="text/javascript" src="scripts/api.js"></script> 


      <script type="text/javascript">
        $('.dropdown-toggle').dropdown();
        $(window).load(function(){
          loadUserName();
          loadResp();
        });
        </script>
        
  </body>
  
</html>