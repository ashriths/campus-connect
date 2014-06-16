<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if(!($_SESSION['type']=='student')){
    Redirect::redirectTo($rp.'home.php');
}
$u = $user->getTableDetailsbyId('student','userId',$_SESSION['id']);
//print_r($u);
$k = $user->getTableDetailsbyId('user','userId',$_SESSION['id']);
$u=array_merge($u,$k);
//print_r($u);
//exit;
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


      <title>Home | BMSCE Campus</title>
  
   
  </head>
  <body style="padding-top:35px">
    <?php
      $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
      $design->getStudentNavbar($rp,0,$u['usn'], $uNotif,$uMsg);
    ?>
    
    <hr />
    <div class="container ">
      
      <div class="container" >
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="panel panel-primary">
                      <div class="panel-heading"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Personal Details:</div>
                      <div class="panel-body">
                        <div class="row">
                             <div class="col-xs-12 col-md-4">
                                <img src="../img/profile.jpg" class="img-thumbnail"/>
                             </div>
                              <div class="col-xs-12 col-md-8">
                                   
                                      <table class="table table-hover">
                                        <tr><th>Name</th><td><?php echo strtoupper($u['name']); ?></td></tr>
                                        <tr><th>USN</th><td><?php echo strtoupper($u['usn']); ?></td></tr>
                                        <tr><th>Branch</th><td>
                                        <?php //echo $class['deptId'];
                                            $dept = $user->getTableDetailsbyId('dept','deptId',$class['deptId']);
                                            echo strtoupper($dept['name']);?>
                                        </td></tr>
                                        <tr><th>Semester</th><td><?php echo $class['sem']; ?></td></tr>
                                         <tr><th>Email&nbsp;<span href="#" data-toggle="tooltip" title="Your email address is visible only to you" data-original-title="Your email address is visible only to you"><span class="glyphicon glyphicon-lock"></span></span></th><td><?php echo $u['email']; ?></td></tr>
                                      </table>
                                    
                             </div>
                        </div>
                       
                      
                      </div>
                </div>
             
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel panel-default">
                      <div class="panel-heading">Notifications  <span class="badge pull-right">42</span></div>
                      <div class="panel-body">
                    
   <?php
                
                //write test data here
           // $att = $user -> getSubjectsTaught(2);
            // print_r($att);

          	$result = $user -> updateMarks(3,15,5,5);
          	// print_r($result);
                /*

                $grade = $user->getGradebySemAndSub(6,17);
                
                foreach ($grade as $key => $value) {
                  echo "<br/>key: $key =>      ";
                  foreach ($value as $key2 => $value2) { //for 2D array in case of multiple rows
                    echo " $key2=> $value2";
                    # code...
                  }
                }
              
          */  
          /*
                $cls= $user->getTableDetailsbyNonId('student','classId',$u['classId']);

                foreach ($cls as $key => $value) {
                  echo "<br/><br/>key: $key =>";
                  foreach ($value as $key2 => $value2) { //for 2D array in case of multiple rows
                    echo "<br/> $key2=> $value2";
                    # code...
                  }
                }
                //code to print associative array
          */  


               // get all Notification and print here


          ?> 
      </div>
                      </div>
                </div>
            </div>
        </div>
        
    </div>
        
    <div class="container" >
            <div class="panel panel-default">
               <div class="panel-heading">
                <h3 class="panel-title">Recent Activity</h3>
               </div>
               <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                      <div class="thumbnail">
                        <img src="http://2.bp.blogspot.com/-xe4it8bjn80/UCErXN0gYpI/AAAAAAAAADE/ZTZWjUNj-98/s640/228-data-structures-front.jpg" alt="Datastructures Image">
                        <div class="caption">
                          <h3>Lecture on Datastructures</h3>
                          <p>Organised by Dept. Of CSE</p>
                          <p><a href="#" class="btn btn-primary" role="button">More Details</a> </p>
                        </div>
                      </div>
                    </div>
                  </div>
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