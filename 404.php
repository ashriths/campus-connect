<?php

$rp = './';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(isset($_SESSION['id'])){
 
if($_SESSION['type']=='student'){
$u = $user->getTableDetailsbyId('student','userId',$_SESSION['id']);
$class = $user->getTableDetailsbyId("class","classId",$u['classId']);
}else if($_SESSION['type']=='teacher'){
  $u = $user->getTableDetailsbyId('teacher','userId',$_SESSION['id']);
}else{
  $u = $user->getTableDetailsbyId('deptadmin','userId',$_SESSION['id']);
}
$u += $user->getTableDetailsbyId('user','userId',$_SESSION['id']);
}



?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Lost | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php

    if(isset($_SESSION['id'])){
        $uNotif = $user->getUnreadNotificationNumber();
          $uMsg = $user->getUnreadMsgNumber();
        if($_SESSION['type']=='student'){
          $design->getStudentNavbar($rp,-1,$u['usn'], $uNotif,$uMsg);
        }else if($_SESSION['type']=='teacher'){
          $design->getFacultyNavbar($rp,-1, $uNotif,$uMsg);
        }else{
          $design->getAdminNavbar($rp,-1, $uNotif,$uMsg);
        }

  }
     
    ?>
     
    <div class="container" >
      <div class="page-header">
        <h2>You seem to be lost.</h2>
        <h3 class="text-warning">The page you requested could not be found. (404 error)</h3>
      </div>
    </div>
     
     <div class="container"
    <div class="col-xs-12 col-md-12">
      <img class="img-responsive" src="http://media.creativebloq.futurecdn.net/sites/creativebloq.com/files/images/2013/01/csstricks.jpg"/>
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