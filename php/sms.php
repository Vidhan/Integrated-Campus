<?php
require_once ('user.php');
/* Haarisoft sms api.......................Fullonsms api.................... */
/* harishjose007@rediffmail.com........................ http://harishjose.in */
if (isset ($_POST['submit'])){
    $cookie_file_path = "/cookie.txt";
    $studentId = $_POST['studentId']; 
    $msg = $_POST['facMsg'];
    $username="7878779783";
    $password="61244";

    $student1 = new Student($studentId);
    $num =  $student1->getUserDetail('ContactNo');
    $tomobno = $num['ContactNo'];

    //$tomobno="7878779783";
    $attendance = "low";
    $courseInfo = $_POST['courseInfo'];
    $message=urlencode($studentId."Your Attendance is ".$attendance." in Course: ".$courseInfo.".".$msg.".---Integrated Campus");
    //$message=urlencode("hi how are you");  
      
    	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://sms.fullonsms.com/login.php");    
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "MobileNoLogin=$username&LoginPassword=$password&x=16&y=14");
        $html=curl_exec($ch);
         curl_setopt($ch, CURLOPT_URL,"http://sms.fullonsms.com/home.php");    
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "ActionScript=%2Fhome.php&CancelScript=%2Fhome.php&HtmlTemplate=%2Fvar%2Fwww%2Fhtml%2Ffullonsms%2FStaticSpamWarning.html&MessageLength=140&MobileNos=$tomobno&Message=$message&Gender=0&FriendName=Your+Friend+Name&ETemplatesId=&TabValue=contacts");
        
          $html = curl_exec($ch);
          //echo $html;
          echo "sms sent";

}
?>
