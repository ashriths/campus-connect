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

if(isset($_POST['added'])){
    //print_r($_POST);

    $result = $user->addProctorMeeting($_POST['date'].' '.$_POST['time'],$_POST['issue']);
    //$result['action']='add';
   
}
if(isset($_GET['remove'])){
    $result = $user->removeProctorMeeting($_GET['remove']);
    //$result['action']='remove';
}

?><!DOCTYPE html>
<html lang="en">
  <head><?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Proctor | BMSCE Campus</title>
  
   
  </head>
  <body style="padding-top:35px">
      <?php
       $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
      $design->getFacultyNavbar($rp,3,$uNotif,$uMsg);
     
    ?>
    
    <hr />
   

      <div class="container" >
        <div class="row">
            

            <div class="col-xs-12 col-sm-8 col-md-8">

              <div class="panel panel-default">
                      <div class="panel-heading">Meetings</div>
                      <div class="panel-body"> 
                              <ul class="nav nav-tabs">
                                  <li class="active"><a href="#scheduled" data-toggle="tab">Scheduled</a></li>
                                  <li><a href="#addMeeting" data-toggle="tab">Add Meeting</a></li>
                                  <li><a href="#history" data-toggle="tab">History</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                  <div class="tab-pane active" id="scheduled">
                                    <hr/>
                                    <div class="row">

                                       <?php
                                         $meetings =  $user->getScheduledProctorMeetingsByProctorId($_SESSION['id']);
                                         //print_r($meetings);
                                        
                                          if($meetings['total']>=1){
                                            for($i=0;$i<$meetings['total'];$i++){
                                               echo ' <div class="col-xs-12 col-sm-4 col-md-4"> 
                                                        <div class="panel panel-primary">
                                                          <div class="panel-heading"><span class="badge">'.($i+1).'</span>&nbsp;&nbsp;'.$meetings['meetings'][$i]['timestamp'].'</div>
                                                          <div class="panel-body">
                                                            <p>'.$meetings['meetings'][$i]['issue'].'</p>
                                                            <div class="btn-group btn-group-sm">
                                                            <a href="?remove='.$meetings['meetings'][$i]['id'].'"<button type="button" class="btn btn-default">Remove</button></a>
                                                          </div>
                                                        </div>
                                                       </div>
                                                  </div>';
                                                }
                                                if(isset($result)){

                                                  if($result){
                                                  echo '<div class="alert alert-success"> <span class="glyphicon glyphicon-ok" </span>&nbsp;&nbsp;Success !</div>';
                                                  }else{
                                                    echo '<div class="alert alert-danger"> <span class="glyphicon glyphicon-remove" </span>&nbsp;&nbsp;Error !</div>';
                                                  }
                                                }
                                            }else{
                                              echo '<div class="panel panel-default">
                                                    
                                                     <div class="panel-body"> 
                                                     <h2>No Meetings Scheduled</h2>
                                                     <a href="#addMeeting" data-toggle="tab">
                                                     <button class="btn btn-primary" id="addButton">Add New</button>
                                                     </a>
                                                     </div>
                                                     </div>';
                                            }
                                          
                                          ?>
                                    </div>                              
                                 
                                        
                                      
                                  </div>
                                  <div class="tab-pane" id="addMeeting">
                                    <hr/>
                                     <div class="col-xs-12 col-md-12">
                                          <form action="#" method="post">  
                                          <table class="table table-hover">
                                            <tr><th>DATE:</th><td><input type="date" name="date"/></td></tr>
                                            <tr><th>TIME:</th><td><input type="time" name="time"/></td></tr>
                                            <tr><th>ISSUE TO BE DISCUSSED </th><td><textarea type="text" name="issue" ></textarea> </td></tr>
                                          </table>
                                          <p align="right">
                                         <input class="btn btn-default" type="submit" name="added" value="Post">
                                        </p>
                                        </form>
                                     </div>
                                  </div>
                                  <div class="tab-pane" id="history">
                                    <hr/>
                                      <div class="row">
                                          <?php 
                                             $meetings =  $user->getOldProctorMeetingsByProctorId($_SESSION['id']);
                                           if($meetings['total']>=1){
                                            for($i=0;$i<$meetings['total'];$i++){
                                               echo ' <div class="col-xs-12 col-sm-4 col-md-4"> 
                                                        <div class="panel panel-primary">
                                                          <div class="panel-heading"><span class="badge">'.($i+1).'</span>&nbsp;&nbsp;'.$meetings['meetings'][$i]['timestamp'].'</div>
                                                          <div class="panel-body">
                                                            <p>'.$meetings['meetings'][$i]['issue'].'</p>
                                                            
                                                        </div>
                                                       </div>
                                                  </div>';
                                                }
                                            }else{
                                              echo '<div class="panel panel-default">
                                                    
                                                     <div class="panel-body"> 
                                                     <h2>No Meetings Held.</h2>
                                                     </div>
                                                     </div>';
                                            }

                                         ?>
                                      </div>
                                  </div>
                                 
                                </div>                   
                              
                        </div>
                       
                      
                      </div>
                        
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4">

              <div class="panel panel-primary">
                      <div class="panel-heading">Proctor Student List</div>
                      <div class="panel-body">
                        <div class="row">
                             
                              <div class="col-xs-12 col-md-12">
                                <div class="list-group">
                                  <?php
                                         $st =  $user->getStudentsUndermyProctorship();

                                         //print_r($st);
                                         for($i=0;$i<count($st);$i++){
                                              $uid = $st[$i]['userId'];
                                              $k = $user->getTableDetailsbyId('user','userId',$uid);
                                              $k += $user->getTableDetailsbyId('student','userId',$uid);
                                             echo '<a href="'.$rp.'profile.php?id='.$uid.'" class="list-group-item">'.($i+1).'.&nbsp;&nbsp;&nbsp;<b>'.strtoupper($k['name']).'</b>&nbsp;&nbsp;&nbsp;'.strtoupper($k['usn']).'</a>';
                                           }
                                         ?>
                                </div>
                                      
                                       
                                                                      
                             </div>
                        </div>
                      </div>
              </div>
              
             <p><a href="#"  class="btn btn-primary" role="button">Proctor Meeting History</a></p>
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
        
  </body>
</html>