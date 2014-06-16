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

$class = $user->getTableDetailsbyId("class","classId",$u['classId']);
//echo $class['sem'];
//echo $class['section'];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Attendance | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
      $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
      $design->getStudentNavbar($rp,2,$u['usn'], $uNotif,$uMsg);

      $att = $user->getMyAttendance($_SESSION['id']);
    ?>
    
    <hr />

    <div class="container">
              <div class="col-md-8">
               <div class="panel-group" id="accordion">
                <?php 
                  for($i=0;$i<count($att);$i++){
                    ?>
                  <div class="panel panel-<?php
                  $per = $att[$i]['classesAttended']/$att[$i]['totalClasses'];
                  if($per>0.85){
                    echo 'success';
                  }elseif($per>0.75){
                    echo 'warning';
                  }else{
                    echo 'danger';
                  }
                  ?>">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>">
                          <?php echo $att[$i]['subjectName']; ?>&nbsp;&nbsp;&nbsp;<span class="badge"> <?php echo $per*100; ?></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php if($i==0) echo 'in'; ?>">
                      <div class="panel-body">
                        <h1>
                        <?php
                          echo $att[$i]['classesAttended'].'/'.$att[$i]['totalClasses'].'='.($per*100).'%';  
                        ?>
                        </h1>
                      </div>
                       <div class="panel-footer">Last Updated on 20-05-2014</div>
                    </div>
                  </div>
                  <?php } ?>
              
               
              </div> 
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