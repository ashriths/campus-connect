<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if(!($_SESSION['type']=='teacher')){
    Redirect::redirectTo($rp.'home.php');
}
$u = $user->getTableDetailsbyId('teacher','userId',$_SESSION['id']);
$u += $user->getTableDetailsbyId('user','userId',$_SESSION['id']);

//echo $u['classId'];
//echo $u['usn'];

//$class = $user->getTableDetailsbyId("class","classId",$u['classId']);
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
      $design->getFacultyNavbar($rp,0,$uNotif,$uMsg);
    ?>
    
    <hr />
    <div class="container ">
      
      <div class="container" >
        <div class="row">
           
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel panel-default">
                      <div class="panel-heading">Notifications  <span class="badge pull-right">42</span></div>
                      <div class="panel-body">
                    
   <?php
                
                
          //  $att = $user->getMyAttendance($_SESSION['id']);
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


          ?> 
      </div>
                      </div>
                </div>

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
                                       
                                        <tr><th>Department</th><td>
                                        <?php //echo $class['deptId'];
                                            $dept = $user->getTableDetailsbyId('dept','deptId',$u['deptId']);
                                            echo strtoupper($dept['name']);?>
                                        </td></tr>
                                         <tr><th>Email&nbsp;<span href="#" data-toggle="tooltip" title="Your email address is visible only to you" data-original-title="Your email address is visible only to you"><span class="glyphicon glyphicon-lock"></span></span></th><td><?php echo $u['email']; ?></td></tr>
                                      </table>
                                    
                             </div>
                        </div>
                       
                      
                      </div>
                </div>
             
            </div>
            </div>
        </div>
        
    </div>
        
    <div class="container" >
            <div class="panel panel-default">
               <div class="panel-heading">
                <h3 class="panel-title">Upcoming Activity</h3>
               </div>
               <div class="panel-body">
                <div class="row">
                    <?php $result = $user ->getEvents();
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
        }
        ?>
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