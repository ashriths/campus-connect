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


      <title>Events | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
      $design->getStudentNavbar($rp,-1,$u['usn']);
    ?>
     
    <div class="container" >
      <div class="page-header">
        <h2>Events <small>at BMSCE <small> The latest happenings</small></small></h2>
      </div>
    </div>
      
    <?php
    if(!isset($_GET['eventId']))
    {
        $result = $user ->getEvents();

        foreach ($result as $key => $value) {
        

          echo '<div class="container">
                  <div class="bs-callout bs-callout-info">
                    <a href="?eventId='.$value['eventId'].'&deptName='.$value['deptName'] .'" style="" >
                      <h4>'.strtoupper($value['eventName']).'</h4>
                    </a>
                    <p>
                      <small> on '.$value['date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($value['deptName']).'</small> 
                    </p>                   
                  </div>
                </div>';


        }
    }
    else
    {
        $id = $_GET['eventId'];
        $result = $user -> getEventDetails($id);
        // print_r($result);
        
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