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
                                <img src="<?php echo $u['pic'] ; ?>" class="img-thumbnail"/>
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
                      <div class="panel-heading">Notifications  <span class="badge pull-right"><?php echo $uNotif; ?></span></div>
                      <div class="panel-body">
                         <div class="col-xs-12 col-md-12">
                                <div class="list-group">
                                     <?php

                                             // get all Notification and print here
                                              $not = $user->getUnreadNotifications();
                                              //print_r($not);
                                              for($i=0;$i<$not['total'];$i++){
                                              echo '<a href="'.$rp.'notification.php?id='.$not['notifications'][$i]['id'].'" class="list-group-item"><b>'.$not['notifications'][$i]['content'].'</b></a>';
                                              }
                                        ?> 
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