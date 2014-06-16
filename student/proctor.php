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
$u += $user->getTableDetailsbyId('user','userId',$_SESSION['id']);
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
      $design->getStudentNavbar($rp,3,$u['usn'],$uNotif,$uMsg);
     
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
                                  <li><a href="#history" data-toggle="tab">History</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                  <div class="tab-pane active" id="scheduled">
                                    <hr/>
                                    <div class="row">

                                       <?php
                                         $meetings =  $user->getScheduledProctorMeetingsByProctorId($u['proctorId']);
                                         //print_r($meetings);
                                        
                                          if($meetings['total']>=1){
                                            for($i=0;$i<$meetings['total'];$i++){
                                               echo ' <div class="col-xs-12 col-sm-4 col-md-4"> 
                                                        <div class="panel panel-primary">
                                                          <div class="panel-heading"><span class="badge">'.($i+1).'</span>&nbsp;&nbsp;'.$meetings['meetings'][$i]['timestamp'].'</div>
                                                          <div class="panel-body">
                                                            <p>'.$meetings['meetings'][$i]['issue'].'</p>
                                                            <div class="btn-group btn-group-sm">
                                                          
                                                          </div>
                                                        </div>
                                                       </div>
                                                  </div>';
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
                                 
                                  <div class="tab-pane" id="history">
                                    <hr/>
                                      <div class="row">
                                          <?php 
                                             $meetings =  $user->getOldProctorMeetingsByProctorId($u['proctorId']);
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
                      <div class="panel-heading">Ask Proctor</div>
                      <div class="panel-body">
                        <div class="row">
                             
                              
                                      
                                       
                                                                      
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
        
  </body>
</html>