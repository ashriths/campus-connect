<?php

$rp = './';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if($_SESSION['type']=='student'){
$u = $user->getTableDetailsbyId('student','userId',$_SESSION['id']);
$class = $user->getTableDetailsbyId("class","classId",$u['classId']);
}else if($_SESSION['type']=='teacher'){
  $u = $user->getTableDetailsbyId('teacher','userId',$_SESSION['id']);
}else{
  $u = $user->getTableDetailsbyId('deptadmin','userId',$_SESSION['id']);
}

if(!isset($_GET['id'])){
  
}


?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Class Profile | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
    $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
    if($_SESSION['type']=='student'){
      $design->getStudentNavbar($rp,-1,$u['usn'], $uNotif,$uMsg);
     }else if($_SESSION['type']=='teacher'){
      $design->getFacultyNavbar($rp,-1, $uNotif,$uMsg);
    }else{
      $design->getAdminNavbar($rp,-1, $uNotif,$uMsg);
    }
     
    ?>
     
    <div class="container" >
      <div class="page-header">
        <h2>Class Profile</h2>
      </div>
    </div>
      <div class="container">
        <div class="col-md-4 col-xs-12">

        </div>
        <div class="col-md-8 col-xs-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><strong>Students</strong></div>
               

                
                <ul class="list-group">
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                </ul>
              
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