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
}else{
  $u = $user->getTableDetailsbyId('teacher','userId',$_SESSION['id']);
}
//rint_r($u);

//echo $u['classId'];
//echo $u['usn'];


//echo $class['sem'];
//echo $class['section'];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Events | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
    $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
    if($_SESSION['type']=='student'){
      $design->getStudentNavbar($rp,-1,$u['usn'], $uNotif,$uMsg);
    }else{
      $design->getFacultyNavbar($rp,-1, $uNotif,$uMsg);
    }
     
    ?>
     
    <div class="container" >
      <div class="page-header">
        <h2>Events <small>at BMSCE <small> The latest happenings</small></small></h2>
      </div>
    </div>
      

      
    <?php
    if(!isset($_GET['id']))
    {
      ?> 
      <div class="container" >
                    <div class="panel panel-default">
                       <div class="panel-heading">
                        <h3 class="panel-title">Upcoming Events </h3>
                       </div>
                       <div class="panel-body">
                        <div class="row">
      <?php
        $result = $user ->getEvents();
        //print_r($result);
        //echo 'hello';
        if($result['total']>0){
            foreach ($result['events'] as $key => $value) {
            
              echo ' 
                <div class="col-sm-6 col-md-3">
                                  <div class="thumbnail">
                                    <img src="'.$value['imgurl'].'" alt="Event Image">
                                    <div class="caption">
                                      <h3>'.$value['name'].'</h3>';
                                      if($value['type']!='open'){
                                          if($value['type']=='dept'){
                                            $r = $user->getTableDetailsbyId('deptevent','id',$value['id']);
                                            $o = $user->getDeptNamefromId($r['deptId']);
                                            echo '<p>Organised by Dept. Of CSE</p>';
                                          }
                                      }
                                      echo '<p><a href="?id='.$value['id'].'" class="btn btn-primary" role="button">More Details</a> </p>
                                    </div>
                                  </div>
                                </div>

                             ';


            }
        } ?>
                         </div>
                       </div>
                    </div>
        </div>
    <?php
     }  
    else
    {
        $id = $_GET['id'];
        $result = $user -> getEventDetails($id);
         print_r($result);
        
        echo '<div class="container">
                <div class="bs-callout bs-callout-info">
                  <h3><b>'.strtoupper($result['eventName']).'</b> &nbsp;&nbsp;<small>  By: &nbsp;'.$result['deptName'].'</small></h3>
                    <p style="font-size:12pt;"><b>Venue : </b>'.$result['venue'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result['date'].'</p>

                    <p style="font-size:12pt;">'.$result['message'].'</p>
                    <br/>
                </div>
              </div>';
    }

    ?>

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