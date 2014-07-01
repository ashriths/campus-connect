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


$class = $user->getTableDetailsbyId("class","classId",$u['classId']);

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Question Papers | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php

     $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
      $design->getStudentNavbar($rp,1,$u['usn'], $uNotif,$uMsg);
   
    //  $marks = $user->getMyGrades($_SESSION['id']);

    ?>
    
    <hr />
    <div class="container ">
      <div class="row">
          
         
          <div class="col-md-10 col-sm-10 col-xs-12">
                 <div class="panel-group" id="accordion">
                    <div class="panel panel-success">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                    Computer Networks                                 </a>
                                </h4>
                              </div>
                              <div id="collapse6" class="panel-collapse collapse in">
                                <div class="panel-body">
                                      <div class="panel-group" id="accordion1">
                                                                                    <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                      <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse60">
                                                         SEE&nbsp;&nbsp;&nbsp;<span class="badge">59</span>
                                                        </a>
                                                      </h4>
                                                    </div>
                                                    <div id="collapse60" class="panel-collapse collapse">
                                                      <div class="panel-body">
                                                            <p><a href="#">qp1</a>
								</p>
                                                            
                                                      </div>
                                                    </div>
                                            </div>
                                                                                      <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                      <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse61">
                                                         CIE&nbsp;&nbsp;&nbsp;<span class="badge">0</span>
                                                        </a>
                                                      </h4>
                                                    </div>
                                                    <div id="collapse61" class="panel-collapse collapse">
                                                      <div class="panel-body">
                                                            <p><a href="#">qp1</a>
								</p>
                                                            
                                                      </div>
                                                    </div>
                                            </div>                                                                                </div>
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