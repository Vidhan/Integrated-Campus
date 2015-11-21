function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}



//Student Profile Functions
function loadStudentHomePage(){
	loadStudentDetails();
	$('.dropdown-toggle').dropdown();
	//load course dropdown
    getStudentCurrentCourses("home");	//in api.js

}
function loadStudentCourseFromURI(){
    $('#main-content').hide();
    var uriId = getURLParameter("id");
    loadStudentCourse(uriId);
}

function loadStudentCoursePage(){
    loadUserName();
    getStudentCurrentCourses("courses");
    loadStudentCourseFromURI();
}

function loadTACoursePage(page){
    loadUserName();
    if(page=='course')
        getStudentCurrentCourses("courses");
    else
        getStudentCurrentCourses("home");
    $('#main-content').hide();
    var uriId = getURLParameter("id");
    loadTACourse(uriId);
}


//Faculty Profile Functions
function loadFacultyCoursePage(){
    loadUserName();
    getFacultyCurrentCourses("courses");
    loadFacultyCourseFromURI();
}

function loadFacultyCourseFromURI(){
    $('#main-content').hide();
    var uriId = getURLParameter("id");
    loadFacultyCourse(uriId);
}

function loadFacultyHomePage(){
    loadFacultyDetails();
    $('.dropdown-toggle').dropdown();
    //load course dropdown
    getFacultyCurrentCourses("home");   //in api.js  
}

function loadAttendancePage(){
    var courseId = getURLParameter("id");    //extract the courses id from the url
    //alert(courseId);
    getRegisteredStudentsInCourse(courseId);//get the list of students registered in the course
}

function submitAttendance(){
    // var courseId = getURLParameter("id");
    // var attendance = new Array();
    // var noOfStuds = document.getElementById('totalRegisteredStudents').innerHTML;
    // // alert("No. of Students: "+noOfStuds + "checked: "+document.getElementById('s0').checked);
    // for (var i = 0; i <noOfStuds; i++) {
    //     var id = 's'+i;
    //     attendance[id] = (document.getElementById(id).checked == true) ? 1 : 0;
    // };
    addAttendance();        //in api.js
    
}   




function loadResp(){
	$(window).resize(function() {
            if($(window).width()<950){
                // $('#collapse').style.fontSize="3px";
                $("#collapse").css("font-size","10px");
                $("#notice").css("display","none");
            }
            if($(window).width()>950){
                // $('#collapse').style.fontSize="3px";
                $("#collapse").css("font-size","14px");
                $("#notice").css("display","block");
            }
    });
}

function setVisibilty(){
        document.getElementById('alertBox').style.display = 'none';
}

//Previous Courses By Ayush
function loadStudentPrevCoursePage()
{
    loadUserName();
    getStudentCurrentCourses("prevcourse");
}

function loadFacultyPrevCoursePage()
{
    loadUserName();
    getFacultyCurrentCourses("prevcourse");
}

function enableTaFunctions(page){
    //enable ta functions
    $('#taDrop').show();
    getTaCurrentCourses(page);
}
