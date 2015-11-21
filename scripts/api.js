  var CourseID = "";
  
  /**********Student Profile APIs**********/

  function loadStudentAttendance(courseId){
    $('#attendanceContent').hide();
    $('#loadingAttendanceContent').show();
    $.post("php/api.php", {method : 'loadStudentAttendance', courseId : courseId},function(retData){
            document.getElementById('cLecturePresence').innerHTML=retData.Lecture.student;
            document.getElementById('cLectureTotal').innerHTML=retData.Lecture.total;
            document.getElementById('cLabPresence').innerHTML=retData.Lab.student;
            document.getElementById('cLabTotal').innerHTML=retData.Lab.total;
            document.getElementById('cTutorialPresence').innerHTML=retData.Tutorial.student;
            document.getElementById('cTutorialTotal').innerHTML=retData.Tutorial.total;

            $('#attendanceContent').show();
            $('#loadingAttendanceContent').hide();
    }, "json");  
  }

  function loadStudentDetails(){
    $('#homeContent').hide();
    $('#loadingHomeContent').show();
    $.post("php/api.php", {method : 'getStudentDetails'},function(retData){
      //alert();
      document.getElementById('navName').innerHTML=retData.userDetail.Name +"<b class=\"caret\"></b>";
      document.getElementById('uName').innerHTML="<h4>Welcome</h4><h2>"+retData.userDetail.Name+"</h2>";
      document.getElementById('uID').innerHTML=retData.userDetail.ID;
      document.getElementById('uProgram').innerHTML=retData.studentDetail.programid;
      document.getElementById('uBatch').innerHTML=retData.studentDetail.batch;
      document.getElementById('uEmail').innerHTML=retData.userDetail.Email;
      document.getElementById('uContact').innerHTML=retData.userDetail.ContactNo;
      document.getElementById('uDOB').innerHTML=retData.userDetail.DOB;
      document.getElementById('uPConNo').innerHTML=retData.studentDetail.parentContactNumber;

      $('#homeContent').show();
      $('#loadingHomeContent').hide();

    }, "json");  
  }

  function getStudentCurrentCourses(page){
    var loading = "<li id=\"loadingCourses\"><img width = \"100%\" src=\"img/loading.gif\"></li>";
    document.getElementById('courseList').innerHTML= loading;
    $.post("php/api.php", {method : 'getStudentCurrentCourses'},function(retData){
      //alert("Got message frm server");
      //alert(retData.courses[0].id+": " +retData.courses[0].name[0]);
      var courses = retData.courses;
      //alert(courses.length);
      var list = "";
      for (var i=0; i<courses.length; i++){
        // for switching in different page formats
        switch(page){
          case "home":
            list = list +"<li><a href= \"course_student.html?id="+courses[i].id+"\">"+courses[i].name+" ("+courses[i].id+")</a></li>";
            break;
          case "tt":
            list = list +"<li><a href= \"course_student.html?id="+courses[i].id+"\">"+courses[i].name+" ("+courses[i].id+")</a></li>";
            
            var tmp = document.getElementsByClassName(courses[i].id);

            [].slice.call(tmp).forEach(function (tmp) {
                tmp.innerHTML = courses[i].name+" ("+courses[i].id+")";
            });      
            $('#loadingTimetable').hide();
            $('#studentTimetable').show();
            break;

          case "courses":
            list = list +"<li><a href= \"javascript:loadStudentCourse(\'"+courses[i].id+"\')\">"+courses[i].name+"</a></li>";
            break;
        }  
      }
      document.getElementById('courseList').innerHTML=list;
      
    }, "json");

  }

  function loadStudentCourse(courseId){
    $('#loading').show();
    $('#main-content').hide();
    $.post("php/api.php", {method : 'loadCourse', courseId : courseId},function(retData){
      document.getElementById('cName').innerHTML=retData.course.Name;
      document.getElementById('cCredit').innerHTML=retData.course.Credit;
      document.getElementById('cDescription').innerHTML=retData.course.Cdep;
      document.getElementById('cCode').innerHTML=retData.course.ID;
      //alert("Course Loaded");
      $('#main-content').show();
      $('#loading').hide();

      path = '?id='+courseId;
      window.history.pushState( {} , courseId, path );

      
    }, "json");
    loadStudentAttendance(courseId);
    getFiles(courseId);
    //Start By Vidhan
    getPollStudent(courseId);
    loadDiscussionTopics(courseId);
    //End By Vidhan
  }

  function getStudentNotifications(){
    $.post("php/api.php", {method : 'getStudentNotifications', limit : 10},function(retData){
            var notifications = "<br>";
            if(retData[0].notification === "true"){
              var type = "none";
              for (var i = 0; i < retData.length; i++) {
                type = retData[i].type;
                switch(type){
                  case 'Response':
                    notifications += '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert"><span class="label label-success">'+(i+1)+'</span>&times;</button><strong><a style="text-decoration:none" target="_blank" href="course_faculty.html?id='+retData[i].course_id+'">New Interaction in: '+retData[0].course_id+'</a></strong></div>';
                    break;
                  case 'File':
                    notifications += '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span class="label label-success">'+(i+1)+'</span>&times;</button><strong><a style="text-decoration:none" target="_blank" href="course_faculty.html?id='+retData[i].course_id+'">New File in: '+retData[0].course_id+'</a></strong></div>';
                    break;
                  case 'Poll':
                    notifications += '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert"><span class="label label-success">'+(i+1)+'</span>&times;</button><strong><a style="text-decoration:none" target="_blank" href="course_faculty.html?id='+retData[i].course_id+'">New Poll in: '+retData[0].course_id+'</a></strong></div>';
                    break;
                  case 'Topic':
                    notifications += '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert"><span class="label label-success">'+(i+1)+'</span>&times;</button><strong><a style="text-decoration:none" target="_blank" href="course_faculty.html?id='+retData[i].course_id+'">New Topic in: '+retData[0].course_id+'</a></strong></div>';
                    break;
                }
                
              };
            }
            else{
              notifications = "No Recent Notifications";
            }
            document.getElementById('notifications').innerHTML= notifications;
    }, "json");
  }

  function getStudentTimetable(){
    $.post("php/api.php", {method : 'getStudentTimetable'},function(retData){

    if(retData.LecMonday!==undefined){      
      for (var i = 0; i < retData.LecMonday.length; i++) {
        if(retData.LecMonday[i].StartTime==='08:30:00'){
          document.getElementById('mon1').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon1').className = retData.LecMonday[i].Course_Id;
        }
        else if(retData.LecMonday[i].StartTime==='09:30:00'){
          document.getElementById('mon2').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon2').className = retData.LecMonday[i].Course_Id;
        }
        else if(retData.LecMonday[i].StartTime==='11:00:00'){
          document.getElementById('mon3').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon3').className = retData.LecMonday[i].Course_Id;
        }
        else if(retData.LecMonday[i].StartTime==='12:00:00'){
          document.getElementById('mon4').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon4').className = retData.LecMonday[i].Course_Id;
        }
      }
    }

    if(retData.LecTuesday!==undefined){
      for (var i = 0; i < retData.LecTuesday.length; i++) {
        if(retData.LecTuesday[i].StartTime==='08:30:00'){
          document.getElementById('tue1').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue1').className = retData.LecTuesday[i].Course_Id;
        }
        else if(retData.LecTuesday[i].StartTime==='09:30:00'){
          document.getElementById('tue2').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue2').className = retData.LecTuesday[i].Course_Id;
        }
        else if(retData.LecTuesday[i].StartTime==='11:00:00'){
          document.getElementById('tue3').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue3').className = retData.LecTuesday[i].Course_Id;
        }
        else if(retData.LecTuesday[i].StartTime==='12:00:00'){
          document.getElementById('tue4').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue4').className = retData.LecTuesday[i].Course_Id;
        }
      }
    }

    if(retData.LecWednesday!==undefined){
      for (var i = 0; i < retData.LecWednesday.length; i++) {
        if(retData.LecWednesday[i].StartTime==='08:30:00'){
          document.getElementById('wed1').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed1').className = retData.LecWednesday[i].Course_Id;
        }
        else if(retData.LecWednesday[i].StartTime==='09:30:00'){
          document.getElementById('wed2').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed2').className = retData.LecWednesday[i].Course_Id;
        }
        else if(retData.LecWednesday[i].StartTime==='11:00:00'){
          document.getElementById('wed3').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed3').className = retData.LecWednesday[i].Course_Id;
        }
        else if(retData.LecWednesday[i].StartTime==='12:00:00'){
          document.getElementById('wed4').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed4').className = retData.LecWednesday[i].Course_Id;
        }
      }
    }

    if(retData.LecThursday!==undefined){
      for (var i = 0; i < retData.LecThursday.length; i++) {
        if(retData.LecThursday[i].StartTime==='08:30:00'){
          document.getElementById('thu1').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu1').className = retData.LecThursday[i].Course_Id;
        }
        else if(retData.LecThursday[i].StartTime==='09:30:00'){
          document.getElementById('thu2').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu2').className = retData.LecThursday[i].Course_Id;
        }
        else if(retData.LecThursday[i].StartTime==='11:00:00'){
          document.getElementById('thu3').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu3').className = retData.LecThursday[i].Course_Id;
        }
        else if(retData.LecThursday[i].StartTime==='12:00:00'){
          document.getElementById('thu4').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu4').className = retData.LecThursday[i].Course_Id;
        }
      }
    }

    if(retData.LecFriday!==undefined){      
      for (var i = 0; i < retData.LecFriday.length; i++) {
        if(retData.LecFriday[i].StartTime==='08:30:00'){
          document.getElementById('fri1').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri1').className = retData.LecFriday[i].Course_Id;
        }
        else if(retData.LecFriday[i].StartTime==='09:30:00'){
          document.getElementById('fri2').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri2').className = retData.LecFriday[i].Course_Id;
        }
        else if(retData.LecFriday[i].StartTime==='11:00:00'){
          document.getElementById('fri3').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri3').className = retData.LecFriday[i].Course_Id;
        }
        else if(retData.LecFriday[i].StartTime==='12:00:00'){
          document.getElementById('fri4').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri4').className = retData.LecFriday[i].Course_Id;
        }
      }
    }

    //alert(retData[(retData['courseId'][1].id)].Lecture[0].EndTime);      
    }, "json");  
  }






  /**********End of Student APIs**********/

  /**********Faculty Profile APIs**********/
  function loadFacultyDetails(){
    $('#homeContent').hide();
    $('#loadingHomeContent').show();
    $.post("php/api.php", {method : 'getFacultyDetails'},function(retData){
      //alert();
      document.getElementById('navName').innerHTML=retData.userDetail.Name +"<b class=\"caret\"></b>";
      document.getElementById('uName').innerHTML="<h4>Welcome</h4><h2>"+retData.userDetail.Name+"</h2>";
      document.getElementById('uID').innerHTML=retData.userDetail.ID;
      document.getElementById('uFBRoomNo').innerHTML=retData.facultyDetail.FBRoomNo;
      document.getElementById('uEmail').innerHTML=retData.userDetail.Email;
      document.getElementById('uContact').innerHTML=retData.userDetail.ContactNo;
      document.getElementById('uDOB').innerHTML=retData.userDetail.DOB;

      $('#homeContent').show();
      $('#loadingHomeContent').hide();

    }, "json");  
  }

  function getFacultyCurrentCourses(page){
    var loading = "<li id=\"loadingCourses\"><img width = \"100%\" src=\"img/loading.gif\"></li>";
    document.getElementById('courseList').innerHTML= loading;
    $.post("php/api.php", {method : 'getFacultyCurrentCourses'},function(retData){
      var courses = retData.courses;
      var list = "";
      for (var i=0; i<courses.length; i++){
        // for switching in different page formats
        switch(page){
          case "home":
            list = list +"<li><a href= \"course_faculty.html?id="+courses[i].id+"\">"+courses[i].name+"</a></li>";
            break;
          case "tt":
            list = list +"<li><a href= \"course_faculty.html?id="+courses[i].id+"\">"+courses[i].name+" ("+courses[i].id+")</a></li>";
            
            var tmp = document.getElementsByClassName(courses[i].id);

            [].slice.call(tmp).forEach(function (tmp) {
                tmp.innerHTML = courses[i].name+" ("+courses[i].id+")";
            });      
            $('#loadingTimetable').hide();
            $('#facultyTimetable').show();
            break;

          case "courses":
            list = list +"<li><a href= \"javascript:loadFacultyCourse(\'"+courses[i].id+"\')\">"+courses[i].name+"</a></li>";
            break;
        }  
      }
      document.getElementById('courseList').innerHTML=list;
      
    }, "json");

  }

  function loadFacultyCourse(courseId){
    $('#main-content').hide();
    $('#loading').show();
    $.post("php/api.php", {method : 'loadCourse', courseId : courseId},function(retData){
      document.getElementById('cName').innerHTML=retData.course.Name;
      document.getElementById('cCredit').innerHTML=retData.course.Credit;
      document.getElementById('cDescription').innerHTML=retData.course.Cdep;
      document.getElementById('cCode').innerHTML=retData.course.ID;
      document.getElementById('cNameSms').value=retData.course.Name+" "+retData.course.ID;
      //alert("Course Loaded");
      //calling other functions
      // var courseId = document.getElementById('cCode').innerHTML;

      path = '?id='+courseId;
      window.history.pushState( {} , courseId, path );

      $('#main-content').show();
      $('#loading').hide();
      

      //creating add attendance button
      document.getElementById('cAttendanceUploadButton').innerHTML = "<a class=\"btn btn-primary\" href=\"attendanceInput.html?id="+document.getElementById('cCode').innerHTML+"\" target=\"_blank\">Add Attendance</a>"

    }, "json");
    getFiles(courseId);
    loadFacultyAttendance(courseId);
    //Start By Vidhan
    getPolls(courseId);
    loadDiscussionTopics(courseId);
    //End by Vidhan
  }
    

  function getRegisteredStudentsInCourse(courseId){

    $('#aMarkError').hide();
    $('#aTypeError').hide();
    $('#aDateError').hide();

    $.post("php/api.php", {method : 'getRegisteredStudentsInCourse', courseId : courseId},function(retData){
      //alert("recieved registered Students");
      var studentList="<div class=\"row-fluid\"><div class=\"span2 well\">";
      var students = retData;
      document.getElementById('totalRegisteredStudents').innerHTML=students.length;
      for (var i=0; i<students.length; i++){
          studentList += "<input type=\"checkbox\" id=\"s"+i+"\" value=\""+students[i]+"\"/> "+students[i]+"<br>";
          if(i%10===9){
            studentList += "</div>";
            if(i%60===59){
              studentList += "</div><div class=\"row-fluid\">";
            }
            if(i!==students.length-1){
              studentList += "<div class=\"span2 well\">";
            }
          }
      }
      document.getElementById('attendanceStudentList').innerHTML=studentList;      
    }, "json");  
  }

  function addAttendance(){
    //Extracting values from document
    var flag = 0;
    var courseId = getURLParameter("id");
    var attendance = {};
    var noOfStuds = document.getElementById('totalRegisteredStudents').innerHTML;
    var aDate = document.getElementById('aDate').value;
    var aType = "none";
    var aMark = "none";

    aType = $('.aType[class*="active"]').val();
    aMark = $('.aMark[class*="active"]').val();

    alert("Date: "+aDate+"Type: "+aType+"Mark: "+aMark);
    if(aDate=== ""){
      $('#aDateError').show();
      flag = 1;
    }
    else{
      $('#aDateError').hide();
    }


    if(aType=== undefined){
      $('#aTypeError').show();
      flag = 1
    }
    else{
      $('#aTypeError').hide();
    }

    if(aMark=== undefined){
      $('#aMarkError').show();
      flag===1;
    }
    else{
      $('#aMarkError').hide();
    }

    if(flag===0){
      //deciding what to mark
      if (aMark===0) {
        mark=0;
        unmark=1;
      } else{
        mark=1;
        unmark=0;
      };

      // marking
      for (var i = 0; i <noOfStuds; i++) {
          var id = 's'+i;
          attendance[document.getElementById(id).value] = (document.getElementById(id).checked == true) ? mark : unmark;
      }
      var tmp = confirm("Submit Attendance?");
      if(tmp===true){
        $.post("php/api.php", {method : 'addAttendance', courseId : courseId, type : aType, date : aDate, attendance : attendance},function(retData){
          alert("Attendance Uploaded");
          window.close();   
        }, "json");
      }

    }
    else{
      flag=0;
    }
  }

  function loadFacultyAttendance(courseId){
    var list=""
    $.post("php/api.php", {method : 'loadFacultyAttendance', courseId:courseId, type:'Lecture'},function(retData){
      list="";
      for (var i = retData.length-1; i >-1; i--) {
        list += retData[i].Date+"<br><i class=\"icon-calendar\"></i> <a data-date=\""+retData[i].Date+"\" data-type=\"Lecture\" id=\"lec"+i+"\" href=\"#\" onclick=\"openAttendance(this)\">"+parseInt(100*parseInt(retData[i].studentattends)/parseInt(retData[i].totalstudents))+ " % attendance</a><hr>";
      }
      document.getElementById('attendanceLectureList').innerHTML=list;
      
    }, "json");
    document.getElementById('attendanceLectureList').innerHTML="None";

    $.post("php/api.php", {method : 'loadFacultyAttendance', courseId:courseId, type:'Lab'},function(retData){
      list="";
      for (var i = retData.length-1; i >-1; i--) {
        list += retData[i].Date+"<br><i class=\"icon-calendar\"></i> <a data-date=\""+retData[i].Date+"\" data-type=\"Lab\" id=\"lab"+i+"\" href=\"#\" onclick=\"openAttendance(this)\">"+parseInt(100*parseInt(retData[i].studentattends)/parseInt(retData[i].totalstudents))+ " % attendance</a><hr>";
      }
      document.getElementById('attendanceLabList').innerHTML=list;
      
    }, "json");
    document.getElementById('attendanceLabList').innerHTML="None";

    $.post("php/api.php", {method : 'loadFacultyAttendance', courseId:courseId, type:'Tutorial'},function(retData){
      list="";
      for (var i = retData.length-1; i >-1; i--) {
        list += retData[i].Date+"<br><i class=\"icon-calendar\"></i> <a data-date=\""+retData[i].Date+"\" data-type=\"Tutorial\" id=\"tut"+i+"\" href=\"#\" onclick=\"openAttendance(this)\">"+parseInt(100*parseInt(retData[i].studentattends)/parseInt(retData[i].totalstudents))+ " % attendance</a><hr>";
      }
      document.getElementById('attendanceTutorialList').innerHTML=list;
      
    }, "json");
    document.getElementById('attendanceTutorialList').innerHTML="None";
  }

  function openAttendance(sel){
    var pList="";
    var aList="";
    var id = $(sel).attr("id");
    var type = document.getElementById(id).getAttribute('data-type');
    var date = document.getElementById(id).getAttribute('data-date');
    var courseId = document.getElementById('cCode').innerHTML;
    document.getElementById('csvDate').value=date;
    document.getElementById('csvType').value=type;
    document.getElementById('csvCourseId').value=courseId;
    $.post("php/api.php", {method : 'getAttendanceDetail', date : date, type:type, courseId: courseId},function(retData){
      if(retData.present!=undefined){
        for (var i = 0; i < retData.present.length; i++) {
          pList+=retData.present[i]+': &nbsp&nbsp<br>';
        };
      }
      if(retData.absent!=undefined){
        for (var i = 0; i < retData.absent.length; i++) {
          aList+=retData.absent[i]+': &nbsp&nbsp<br>';
        };
      }
      document.getElementById('attendancePList').innerHTML=pList;
      document.getElementById('attendanceAList').innerHTML=aList;
      $('#attendanceModal').modal('show');
    }, "json");
    
  }

  function getFacultyNotifications(){
    $.post("php/api.php", {method : 'getFacultyNotifications', limit : 5},function(retData){
            var notifications = "<br>";
            if(retData[0].notification === "true"){
              var type = "none";
              for (var i = 0; i < retData.length; i++) {
                notifications += '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert"><span class="label label-success">'+(i+1)+'</span>&times;</button><strong><a style="text-decoration:none" target="_blank" href="course_faculty.html?id='+retData[i].Course_Id+'">New Interaction in: '+retData[0].Course_Id+'</a></strong></div>'
              };
            }
            else{
              notifications = "No Recent Notifications";
            }
            document.getElementById('notifications').innerHTML= notifications;
    }, "json");
  }

  function getCsv(){
    alert("Exporing");
    var type = $('#csvType').val();
    var date = $('#csvDate').val();
    var courseId = document.getElementById('cCode').innerHTML;
    $.post("php/api.php", {method : 'getCsv', courseId : courseId, type:type, date:date},function(retData){
            alert("Exported");
            $('#attendanceModal').modal('hide');
    }, "json");
  }

  function getFacultyTimetable(){
    $.post("php/api.php", {method : 'getFacultyTimetable'},function(retData){

    if(retData.LecMonday!==undefined){      
      for (var i = 0; i < retData.LecMonday.length; i++) {
        if(retData.LecMonday[i].StartTime==='08:30:00'){
          document.getElementById('mon1').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon1').className = retData.LecMonday[i].Course_Id;
        }
        else if(retData.LecMonday[i].StartTime==='09:30:00'){
          document.getElementById('mon2').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon2').className = retData.LecMonday[i].Course_Id;
        }
        else if(retData.LecMonday[i].StartTime==='11:00:00'){
          document.getElementById('mon3').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon3').className = retData.LecMonday[i].Course_Id;
        }
        else if(retData.LecMonday[i].StartTime==='12:00:00'){
          document.getElementById('mon4').innerHTML=retData.LecMonday[i].Course_Id;
          document.getElementById('mon4').className = retData.LecMonday[i].Course_Id;
        }
      }
    }

    if(retData.LecTuesday!==undefined){
      for (var i = 0; i < retData.LecTuesday.length; i++) {
        if(retData.LecTuesday[i].StartTime==='08:30:00'){
          document.getElementById('tue1').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue1').className = retData.LecTuesday[i].Course_Id;
        }
        else if(retData.LecTuesday[i].StartTime==='09:30:00'){
          document.getElementById('tue2').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue2').className = retData.LecTuesday[i].Course_Id;
        }
        else if(retData.LecTuesday[i].StartTime==='11:00:00'){
          document.getElementById('tue3').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue3').className = retData.LecTuesday[i].Course_Id;
        }
        else if(retData.LecTuesday[i].StartTime==='12:00:00'){
          document.getElementById('tue4').innerHTML=retData.LecTuesday[i].Course_Id;
          document.getElementById('tue4').className = retData.LecTuesday[i].Course_Id;
        }
      }
    }

    if(retData.LecWednesday!==undefined){
      for (var i = 0; i < retData.LecWednesday.length; i++) {
        if(retData.LecWednesday[i].StartTime==='08:30:00'){
          document.getElementById('wed1').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed1').className = retData.LecWednesday[i].Course_Id;
        }
        else if(retData.LecWednesday[i].StartTime==='09:30:00'){
          document.getElementById('wed2').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed2').className = retData.LecWednesday[i].Course_Id;
        }
        else if(retData.LecWednesday[i].StartTime==='11:00:00'){
          document.getElementById('wed3').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed3').className = retData.LecWednesday[i].Course_Id;
        }
        else if(retData.LecWednesday[i].StartTime==='12:00:00'){
          document.getElementById('wed4').innerHTML=retData.LecWednesday[i].Course_Id;
          document.getElementById('wed4').className = retData.LecWednesday[i].Course_Id;
        }
      }
    }

    if(retData.LecThursday!==undefined){
      for (var i = 0; i < retData.LecThursday.length; i++) {
        if(retData.LecThursday[i].StartTime==='08:30:00'){
          document.getElementById('thu1').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu1').className = retData.LecThursday[i].Course_Id;
        }
        else if(retData.LecThursday[i].StartTime==='09:30:00'){
          document.getElementById('thu2').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu2').className = retData.LecThursday[i].Course_Id;
        }
        else if(retData.LecThursday[i].StartTime==='11:00:00'){
          document.getElementById('thu3').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu3').className = retData.LecThursday[i].Course_Id;
        }
        else if(retData.LecThursday[i].StartTime==='12:00:00'){
          document.getElementById('thu4').innerHTML=retData.LecThursday[i].Course_Id;
          document.getElementById('thu4').className = retData.LecThursday[i].Course_Id;
        }
      }
    }

    if(retData.LecFriday!==undefined){      
      for (var i = 0; i < retData.LecFriday.length; i++) {
        if(retData.LecFriday[i].StartTime==='08:30:00'){
          document.getElementById('fri1').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri1').className = retData.LecFriday[i].Course_Id;
        }
        else if(retData.LecFriday[i].StartTime==='09:30:00'){
          document.getElementById('fri2').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri2').className = retData.LecFriday[i].Course_Id;
        }
        else if(retData.LecFriday[i].StartTime==='11:00:00'){
          document.getElementById('fri3').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri3').className = retData.LecFriday[i].Course_Id;
        }
        else if(retData.LecFriday[i].StartTime==='12:00:00'){
          document.getElementById('fri4').innerHTML=retData.LecFriday[i].Course_Id;
          document.getElementById('fri4').className = retData.LecFriday[i].Course_Id;
        }
      }
    }

    //alert(retData[(retData['courseId'][1].id)].Lecture[0].EndTime);      
    }, "json");  
  }

  function checkIfTa(page){
    $.post("php/api.php", {method : 'checkIfTa'},function(retData){
      //alert(retData.isTa);
      if(retData.isTa== 'true'){
        enableTaFunctions(page);
      }
      
    }, "json");  
  }

  function getTaCurrentCourses(page){
    var loading = "<li id=\"loadingCourses\"><img width = \"100%\" src=\"img/loading.gif\"></li>";
    document.getElementById('taCourseList').innerHTML= loading;
    $.post("php/api.php", {method : 'getTACurrentCourses'},function(retData){
      //alert(retData.length);
      //alert(courses.length);
      var list = "";
      for (var i=0; i<retData.length; i++){
        // for switching in different page formats
        switch(page){
          case "home":
            list = list +"<li><a href= \"course_ta.html?id="+retData[i].id+"\">"+retData[i].name+" ("+retData[i].id+")</a></li>";
            break;
          case "course":
            list = list +"<li><a href= \"javascript:loadTACourse(\'"+retData[i].id+"\')\">"+retData[i].name+"</a></li>";
            break;
        }  
      }
      document.getElementById('taCourseList').innerHTML=list;
      
    }, "json");

  }

  function loadTACourse(courseId){
    $('#main-content').hide();
    $('#loading').show();
    $.post("php/api.php", {method : 'loadCourse', courseId : courseId},function(retData){
      document.getElementById('cName').innerHTML=retData.course.Name;
      document.getElementById('cCredit').innerHTML=retData.course.Credit;
      document.getElementById('cDescription').innerHTML=retData.course.Cdep;
      document.getElementById('cCode').innerHTML=retData.course.ID;
      document.getElementById('cNameSms').value=retData.course.Name+" "+retData.course.ID;
      //alert("Course Loaded");
      //calling other functions
      // var courseId = document.getElementById('cCode').innerHTML;

      path = '?id='+courseId;
      window.history.pushState( {} , courseId, path );

      $('#main-content').show();
      $('#loading').hide();
      

      //creating add attendance button
      document.getElementById('cAttendanceUploadButton').innerHTML = "<a class=\"btn btn-primary\" href=\"attendanceInput.html?id="+document.getElementById('cCode').innerHTML+"\" target=\"_blank\">Add Attendance</a>"

    }, "json");
    //getFiles(courseId);
    loadFacultyAttendance(courseId);
    //Start By Vidhan
    //getPolls(courseId);
    //loadDiscussionTopics(courseId);
    //End by Vidhan

  }





  /**********End of Faculty APIs**********/

  /**********Genral APIs**********/
  

  function logout(){
    $.post("php/api.php", {method : 'logout'},function(retData){
      window.location.href="index.php";      
    }, "json");  
  }

  function deleteFile(del){
    var id = $(del).attr("id");
    var path = document.getElementById(id).getAttribute('data-path');
    document.getElementById(id).innerHTML="...Deleting...";
    
    $.post("php/api.php", {method : 'deleteFile', path : path, id : id},function(retData){
            
    }, "json");
    getFiles(CourseID); 
  }


  function getFiles(courseId){
    CourseID = courseId;
    $.post("php/api.php", {method : 'getFiles', courseId: courseId},function(retData){
            
            var fileList = "";
            var deleteButton = " ";
            if(retData[0].Time === undefined){
              fileList = " ";
            }
            else{
              for (var i = 0; i < retData.length; i++) {
                if(retData[0].delete === "true"){
                  deleteButton = "<a class=\"btn btn-danger btn-mini\" id=\""+retData[i].ID+"\" href=\"#\" data-path=\"../"+retData[i].Path+"\"  onclick=\"deleteFile(this);\">Delete File</a>";
                }
                else{
                  deleteButton = " ";
                }
                fileList += retData[i].Time+"<br><i class=\"icon-file\"></i> <a target = \"_blank\" href=\""+retData[i].Path+"\">"+retData[i].DisplayName+" ("+retData[i].Name+") </a>"+deleteButton+"<hr>";
                
              }
            }
            document.getElementById('fileList').innerHTML = fileList;
            
            // Generate File List
    }, "json");  
  }

  function loadUserName(){
    $.post("php/api.php", {method : 'loadUserName'},function(retData){
      document.getElementById('navName').innerHTML=retData.Name +"<b class=\"caret\"></b>";
    }, "json");  
  }

  function checkForLogin(){
    $.post("php/api.php", {method : 'none'},function(retData){
      if(retData.login==="false"){
        //window.navigate("index.php");
        self.location="index.php";
      }
    //   else{
    //     var sPath = window.location.pathname;
    //     var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    //     alert(sPage);
    //     //alert("I m in");
    //     $.post("php/api.php", {method : 'getRole'},function(retData){
    //       alert(retData.Role);
    //     if(retData.Role==1 && sPage!=''){
    //       self.location="home_student.html";
    //     }
    //     else if(retData.Role==2){
    //       alert("in faculty");
    //       self.location="home_faculty.html";
    //     }
    //     else if(retData.Role==3){
    //       self.location="admin.php";
    //     }
      

    // }, "json")
    //   }

    }, "json");  
  }

  function changePassword(){
    oldPass = $('#oldPass').val();
    newPass1 = $('#newPass1').val();
    newPass2 = $('#newPass2').val();
    if (oldPass===""||newPass2===""||newPass1==="") {
      alert("Fileds cannot be empty");
    } 
    else{
      if (newPass1===newPass2) {
        $('#changePassDiv').hide();
        $('#changingPass').show();
        $.post("php/api.php", {method : 'changePassword', oldPass : oldPass, newPass: newPass1},function(retData){
          if(retData.success==="true"){
            $('#oldPass').val("");
            $('#newPass1').val("");
            $('#newPass2').val("");
            alert("Password Changed");
            $('#changePassModal').modal('hide');
          }
          else{
            alert("Password Incorrect");
            $('#oldPass').val("");
            $('#newPass1').val("");
            $('#newPass2').val("");
          }

          $('#changePassDiv').show();
          $('#changingPass').hide();

        }, "json");
      } else{
        alert("New Passwords don't match");
          //$('#oldPass').val() = "";
          $('#newPass1').val("");
          $('#newPass2').val("");
      };
    };
    
      
  }

  /**********End of Genral APIs**********/

//EOF api.js
function createPoll(number){
  var courseid = document.getElementById("cCode"). innerHTML; 
  var question = document.getElementById("question").value;
  var response = [];
  
  if (question == ""){
      document.getElementById("alertBoxText").className = "alert alert-error";
        document.getElementById("alertBoxText").innerHTML = "Enter a question before submitting";
          document.getElementById("alertBox").style.display='block';
    
    
  }
  else{
    
     var j = 0;
    for (var i=0;i<=number;i++){
    var name = "option"+ i.toString();
    var temp = document.getElementById(name).value;
    if (temp == ""){
      j--;
    }
    else{
      response[j] = temp;
      }j++;
  }
  
  $.post("php/api.php",{method: 'createPoll' , courseid:courseid,response:response, question:question },function(retData){
    //if(retData.poll.pollid.pollid){
      document.getElementById("alertBoxText").className = "alert alert-success";
        document.getElementById("alertBoxText").innerHTML = "The poll has been created successfully";
          document.getElementById("alertBox").style.display='block';
    //}
  
  }, "json");
  
  getPolls(courseid);
  
  
  }
  
  
}

function getPolls(courseID){
  
  var courseid = courseID;
  var numberofpolls ;
  var i,j;
  var element = document.getElementById("pollresult");
  element.innerHTML = "";   
  var answers="";
  $.post("php/api.php",{method: 'getPoll' , courseid:courseid},function(retData){
      numberofpolls = retData.poll.length;
      for (i=numberofpolls-1;i>=0;i--){
        
        for (j =0;j<=retData.poll[i].Options.length-1;j++){
        answers = answers + retData.poll[i].Options[j] + ":"+retData.poll[i].Responses[j]+',';
        }
        //drawChart(retData.poll[i]);
        $('#loadingPollResults').hide();
        drawChart(retData.poll[i]);

      }}, "json");
        
    }
    
    
    function drawChart(a) {
        // Create the data table.
        
       var length=a.Options.length;
var j=new Array();     
var j1=new Array();
var k=0;
var element = "";
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Options');
        data.addColumn('number', 'Response_Count');
       
       for(k=0;k<length;k++)
      {
      j[k]=parseInt(a.Responses[k],10);
    j1[k]=a.Options[k]; 
      data.addRows([
         [j1[k],j[k]],
          ]);

     
      //alert(j1[k]);
       }
       // Set chart options
        var options = {'title':a.Question,
                       'width':400,
                       'height':400};

  var newDiv = document.createElement('div');
  newDiv.setAttribute('id', a.PollId.toString());
  document.getElementById("pollresult").appendChild(newDiv);  
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById(a.PollId.toString()));

        chart.draw(data, options);

      }
      
      
      //above code
function getPollStudent(courseID){
  
  var courseid = courseID;
  var numberofpolls ;
  var i,j;
  var element = document.getElementById("polldisplay");
  element.innerHTML = " "; 
  var answers="";
  $.post("php/api.php",{method: 'getPoll' , courseid:courseid},function(retData)
  {
    if(retData.length===0)
      numberofpolls = 0;
    else
      numberofpolls = retData.poll.length;
      //element.innerHTML = element.innerHTML + numberofpolls;
      for (i=numberofpolls-1;i>=0;i--){
        
        for (j =0;j<=retData.poll[i].Options.length-1;j++){
        answers = answers +"<input type=\"radio\"   name=\""+retData.poll[i].PollId+"\" value=\""+j+"\">&nbsp;&nbsp;" +retData.poll[i].Options[j]+"<br><br>";
    }
    
           element.innerHTML=element.innerHTML+"<div id=\"collapse"+i+"\" class=\"accordion-body collapse in\"> <div class=\"accordion-inner\">";
       
      element.innerHTML = element.innerHTML + "<table cellpadding= \"10px\" id=\" " + retData.poll[i].PollId+" \" > <tr> <th>Question: </th><td>"+retData.poll[i].Question+"</td></tr><tr>";
      element.innerHTML = element.innerHTML +"<td colspan= \" 2  \" >" +answers+" <a href=\"javascript:submitPollResponse("+retData.poll[i].PollId +")\" class=\"btn btn-success\">Submit Response</a>" +"</td> </tr></table></table><hr>" ;
            element.innerHTML = element.innerHTML + "</div></div>";
            answers = "";   
                    
    
      }
        
      
      }, "json");

  }
  
function submitPollResponse(groupName){
  var j = -1;
  var i;
  
    var radios = document.getElementsByName( groupName );
    for (i=0; i<radios.length;i++)  { 
      if (radios[i].checked){
        j=i;
         $.post("php/api.php",{method: 'respond' , pollid:groupName, option:j},function(retData)
            { 
              if (retData.responseStatus.ResponseStatus=="You have already answered the poll"){
                document.getElementById("alertBoxText").className = "alert";
              }
              else {
                document.getElementById("alertBoxText").className = "alert alert-success";
              }
              document.getElementById("alertBoxText").innerHTML = retData.responseStatus.ResponseStatus;
              document.getElementById("alertBox").style.display='block';
            
              
    }, "json");
      
        
      }
      
      
      }
      
      if (j==-1){
        document.getElementById("alertBoxText").className = "alert alert-error";
        document.getElementById("alertBoxText").innerHTML = "No option was selected";
          document.getElementById("alertBox").style.display='block';//alert("No option was selected");
      }
   
}

//Previous Course By Ayush
 function loadStudentPrevCoursesname()
{
  $('#main-content').hide();
  var year = document.getElementById('selectyear').value;
  // alert(year);
  var sem = document.getElementById('selectsem').value;
  alert(sem);
  $.post("php/api.php",{method: 'getStudentpreviousCourse' , year:year, sem:sem },function(retData){
    // alert("hii");
    //alert(retData.courses[0].id);

    var courses = retData.courses;
    var list="";
    document.getElementById("courses").innerHTML = list;
    for (var i=0; i<courses.length; i++)
    {
      list = list +"<li><a href= \"javascript:loadPrevCourseDetail(\'"+retData.courses[i].id+"\')\">"+retData.courses[i].id+"</a></li>";  
    }
    
    //document.getElementById("courses").innerHTML = "<a href=\"#\" onclick = "">"+retData.courses[0].id + "</a>";
    document.getElementById("courses").innerHTML = list;
    // document.getElementById("cCode").innerHTML =retData.courses[0].id;
    // document.getElementById("cName").innerHTML =retData.courses[0].name;
    

    
  }, "json");
}


  function loadPrevCourseDetail(courseId){
    $('#loading').show();
    $('#main-content').hide();
    $.post("php/api.php", {method : 'loadCourse', courseId : courseId},function(retData){
      document.getElementById('cName').innerHTML=retData.course.Name;
      document.getElementById('cCredit').innerHTML=retData.course.Credit;
      document.getElementById('cDescription').innerHTML=retData.course.Cdep;
      document.getElementById('cCode').innerHTML=retData.course.ID;
      //alert("Course Loaded");
      $('#main-content').show();
      $('#loading').hide();

      path = '?id='+courseId;
      window.history.pushState( {} , courseId, path );

      
    }, "json");
    //loadStudentAttendance(courseId);
    getFiles(courseId);
    //Start By Vidhan
    //getPollStudent(courseId);
    //End By Vidhan
  }



function loadFacultyPrevCoursesname()
{
  $('#main-content').hide();
  var year = document.getElementById('selectyear').value;
  // alert(year);
  var sem = document.getElementById('selectsem').value;
  alert(sem);
  $.post("php/api.php",{method: 'getFacultypreviousCourse' , year:year, sem:sem },function(retData){
    // alert("hii");
    //alert(retData.courses[0].id);

    var courses = retData.courses;
    var list="";
    document.getElementById("courses").innerHTML = list;
    for (var i=0; i<courses.length; i++)
    {
      list = list +"<li><a href= \"javascript:loadPrevCourseDetail(\'"+retData.courses[i].id+"\')\">"+retData.courses[i].id+"</a></li>";  
    }
    
    document.getElementById("courses").innerHTML = list;

    

    
  }, "json");
}
//Disscussion Forum By Vidhan

function changeType(){
  document.getElementById('createTopic').style.display = 'none';
  document.getElementById('topicInput').style.display = 'block';
  document.getElementById('submitTopic').style.display = 'inline';
}

function addDiscussionTopic(){
  var subject = document.getElementById('topicInput').value;
  if( subject == "")
{
  document.getElementById("alertBoxText").className = "alert alert-error";
    document.getElementById("alertBoxText").innerHTML = "The topic field was left blank";
    document.getElementById("alertBox").style.display='block';
    document.getElementById('topicInput').style.display='none';
  document.getElementById('submitTopic').style.display='none';
  document.getElementById('createTopic').style.display='block';
} 
 else {
  var courseid = document.getElementById("cCode"). innerHTML; 
  document.getElementById('topicInput').value="";
  document.getElementById('topicInput').style.display='none';
  document.getElementById('submitTopic').style.display='none';
  document.getElementById('createTopic').style.display='block';
  //alert(subject);
  //alert(courseid);
  $.post("php/api.php",{method: 'addDiscussionTopic' , subject:subject, courseid:courseid },function(retData){
    
  $value = retData.topicAddStatus;
  if ($value == "The topic has been added" ){
  document.getElementById("alertBoxText").className = "alert alert-success";
    document.getElementById("alertBoxText").innerHTML = $value;
    document.getElementById("alertBox").style.display='block';
   // alert(courseid);
    loadDiscussionTopics(courseid);}
    else if ($value == "The topic already exists" ){
    document.getElementById("alertBoxText").className = "alert";
    document.getElementById("alertBoxText").innerHTML = $value;
    document.getElementById("alertBox").style.display='block';  
    }
    else{
     document.getElementById("alertBoxText").className = "alert alert-error";
    document.getElementById("alertBoxText").innerHTML = $value;
    document.getElementById("alertBox").style.display='block';  
      
    }
    
    
  }, "json");
}
}

function addDiscussionResponse(topicid, uid){
  var courseid = document.getElementById("cCode"). innerHTML; 
  var response = document.getElementById("responseInput").value;
    if( response == "")
{
  document.getElementById("alertBoxText").className = "alert alert-error";
    document.getElementById("alertBoxText").innerHTML = "The response field was left blank";
    document.getElementById("alertBox").style.display='block';
  }
  
 else{
  $.post("php/api.php",{method: 'addDiscussionResponse' , topicid:topicid, courseid:courseid,response:response },function(retData){
    if (retData.responseAddStatus =="The response has been added"){
    
    }
    
    else {
      document.getElementById("alertBoxText").className = "alert alert-error";
        document.getElementById("alertBoxText").innerHTML = retData.responseAddStatus;
        document.getElementById("alertBox").style.display='block';
    }
    
    getDiscussionResponses(topicid, uid);
    
    
    
    
  }, "json");
  
 }
  
  
  
  
}

function loadDiscussionTopics(courseId){
  var element = document.getElementById("topicBox") ;
  var courseid = courseId; 
  var length;
    $.post("php/api.php", {method : 'getDiscussionTopics', courseId:courseid},function(retData){
    length = retData.topicList.length;
     element.innerHTML = "";
    for (var i = length-1; i>=0; i--){
      var time = retData.topicList[i].Topic_Date;
      //var month = time.getUTCMonth();
      //alert (month);
      element.innerHTML = element.innerHTML + "<li id = \"id"+ retData.topicList[i].Topic_Id+"\"class = \"\"><a href = \" javascript:getDiscussionResponses("+retData.topicList[i].Topic_Id + ","+retData.topicList[i].Uid +  ") \" ><i class=\"icon-chevron-right\"></i>"+retData.topicList[i].Topic_Subject + "  </a>  </li>";
      
      // onclick = \"javascript:getDiscussionResponses(courseid, "+retData.topicList.i.Topic_Id +")\"class = \"\"><a data-toggle=\"tab\">" +"<i class=\"icon-chevron-right\"></i>"+ retData.topicList.i.Topic_Subject+"</a></li>";

    }
  
    }, "json");
  }

//+","+retData.topicList[i].Topic_Date + ","+ retData.topicList[i].Uid 
//,topicdate,topicUid

function getDiscussionResponses(topicid,uid){
  var courseid = document.getElementById("cCode"). innerHTML; 
  var node = document.getElementById("responseBox");
  node.innerHTML = "";
  //alert ("success");
  var topicNode = document.createElement('div');
  topicNode.className = "span12 well"; //setAttribute('id', a.PollId.toString());
  node.appendChild (topicNode);
  topicNode.innerHTML = "<center>The topic was created by "+uid+"</center>";
  //topicNode.innerHTML = "<center>The forum should be used for academic discussions only</center>";
  
  $.post("php/api.php", {method : 'getDiscussionResponse', courseId: courseid, topicid: topicid},function(retData){
    if (retData.response == "No responses yet"){
      //alert ("No responses yet");
    }
    else if (retData.response =="Could not connect to the database"){
      //alert ("Could not connect to the database");
    }
    else {
      
        for (var i = 0; i<= retData.response.length-1;i++){
          var responseNode = document.createElement('div');
          responseNode.className = "span11 well";
          node.appendChild(responseNode);
          responseNode.innerHTML  = "<strong>"+retData.response[i].Uid+":</strong><br>"+retData.response[i].Resp_Content+"<br><br><i>"+ retData.response[i].Resp_Date+"</i>"; 
        }
        
        }
        
       var collectResponse = document.createElement('div');
        collectResponse.className = "span11 well"  ;
         node.appendChild(collectResponse);
        collectResponse.innerHTML = "Enter your response: <br><input id = \"responseInput\" type = \"text\" style = \" height:18px;\"class = \"input-xxlarge\">&nbsp;&nbsp;&nbsp;<button class = \"btn btn-success\" onclick = \"javascript:addDiscussionResponse( "+topicid+ ","+uid +") \" >Submit</button>";
    
    }, "json");
    
   
   
    
   
  }