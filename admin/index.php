<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if(!($_SESSION['type']=='deptadmin')){
    Redirect::redirectTo($rp.'home.php');
}
$u = $user->getTableDetailsbyId('deptadmin','userId',$_SESSION['id']);
//print_r($u);
$k = $user->getTableDetailsbyId('user','userId',$_SESSION['id']);
$u=array_merge($u,$k);


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
      $design->getAdminNavbar($rp,0, $uNotif,$uMsg);
    ?>
    
    <hr />
    <div class="container ">
      
      <div class="container" >
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
              <div class="panel panel-primary">
                      <div class="panel-heading"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Quick Links:</div>
                      <div class="panel-body">
                        
                       
                      
                      </div>
                </div>
             
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="panel panel-default">
                      <div class="panel-heading"> Manage  </div>
                      <div class="panel-body">
                         <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a href="#home" role="tab" data-toggle="tab">Home</a></li>
                              <li><a href="#classes" role="tab" data-toggle="tab">Classes</a></li>
                              <li><a href="#faculty" role="tab" data-toggle="tab">Faculty</a></li>
                              <li><a href="#proctor" role="tab" data-toggle="tab">Proctor</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane fade in active" id="home">
                              </div>
                              <div class="tab-pane fade" id="classes">
                                <div class="panel panel-default">
                                  <div class="panel-body">

                                    <div class="panel-group" id="accordion">
                                      <?php 
                                        for($i=0;$i<4;$i++){
                                            $classes = $user->getClassByYear($u['deptId'],$i+1);
                                            //print_r($classes);
                                            echo '<div class="panel panel-default">
                                                    <div class="panel-heading">
                                                      <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.($i).'">
                                                              Year : '.($i+1).'
                                                        </a>
                                                      </h4>
                                                    </div>
                                                    <div id="collapse'.($i).'" class="panel-collapse collapse">
                                                      <div class="panel-body"><div class="list-group">
                                                      ';
                                                          for($j=0;$j<$classes['length'];$j++){
                                                              echo '<a href="'.$rp.'class.php?id='.$classes['rows'][$j]['classId'].'" class="list-group-item">
                                                                      <h4 class="list-group-item-heading">'.$classes['rows'][$j]['sem'].' '.$classes['rows'][$j]['section'].' <span class="pull-right badge">'.$classes['rows'][$j]['strength'].'</span></h4>
                                                                        
                                                                    </a>';
                                                           } 
                                                        echo '</div>
                                                      </div>
                                                    </div>
                                                  </div>';

                                        }
                                      ?>

                                          <!-- Large modal -->
                                          <button class="btn btn-primary" data-toggle="modal" data-target="#add-class">Add Class</button>

                                          <div class="modal fade" id="add-class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Add A Class</h4>
                                                </div>
                                                <form action="add_class.php" method="post" role="form">
                                                  <div class="modal-body">
                                                      
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Select Semester</label>
                                                          <select name="sem" class="form-control">
                                                            <option>1</option>
                                                            <option>3</option>
                                                          </select>
                                                        </div>

                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Proceed</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                     
                                    </div>
                                </div>
                               </div>
                              </div>
                              <div class="tab-pane fade" id="faculty">
                                    <div class="panel panel-default">
                                      <div class="panel-body">
  
 
                                        <?php
                                        $fac =  $user->getAllFacultyByDept($u['deptId']);
                                         echo ' <div class="list-group">';
                                                          for($j=0;$j<$fac['length'];$j++){
                                                            $u2 = $user->getTableDetailsbyId('user','userId',$fac['rows'][$j]['userId']);
                                                              echo '<a href="faculty.php?id='.$fac['rows'][$j]['userId'].'" class="list-group-item">
                                                                      <h4 class="list-group-item-heading">'.$u2['name'].'</h4>
                                                                        
                                                                    </a>';
                                                           } 
                                                        echo '</div>';
                                        ?>
                                        <!-- Large modal -->
                                          <button class="btn btn-primary" data-toggle="modal" data-target="#add-faculty">Add Faculty</button>

                                          <div class="modal fade" id="add-faculty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Add A Faculty</h4>
                                                </div>
                                                <div class="modal-body">
                                                       <div class="form-group">
                                                          <label for="name">Enter Name</label>
                                                          <input type="text" name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="email">Enter Name</label>
                                                          <input type="email" name="email" class="form-control">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                              <div class="tab-pane fade" id="protcor">
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