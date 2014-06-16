<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if(!$_SESSION['type']=='student'){
    Redirect::redirectTo($rp.'home.php');
}
$u = $user->getTableDetailsbyId('student','userId',$_SESSION['id']);
//rint_r($u);

//echo $u['classId'];
//echo $u['usn'];

$subject = $user->getTableDetailsbyId("subject","subjectId",$u['classId']);
//echo $class['sem'];
//echo $class['section'];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Syllabus Copy | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
      $design->getStudentNavbar($rp,1,$u['usn']);
    //  $marks = $user->getMyGrades($_SESSION['id']);

    ?>
    
    <hr />
    <div class="container ">
      <div class="row">
          
          <div class="col-md-2 col-sm-2 col-xs-12">
            <table class="hidden-xs table">
              <?php
                for($i=$subject['subjectName'];$i>0;$i--){
                    echo '<tr><td>$i</td></tr>';
                }
              ?>
            </table>
          </div>
        </div>
            <div class="container-fluid" style="margin-top:40pt;" >
   
      <div class="container" >
        <div class="well">
        <p class="text-muted">&copy; 2014 All Rights reserved.</p>
        </div>
      </div>
    </div>

    <?php
        $design->getJSIncludes($rp);
    ?>
        
  </body>
</html>