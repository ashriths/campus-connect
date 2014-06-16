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


      <title>Marks | BMSCE Campus</title>
    



   
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
          
          <div class="col-md-2 col-sm-2 col-xs-12">
              <div class="panel panel-default">
               <div class="panel-heading">
                <h3 class="panel-title">CGPA</h3>
               </div>
               <div class="panel-body">
                    <h1 class="text-center"><?php echo $u['cgpa']; ?></h1>
               </div>
            </div>
            <table class="hidden-xs table">
              <?php
                for($i=$class['sem']-1;$i>0;$i--){
                    echo '<tr><th>Sem'.$i.'</th><td>'.$user->getSGPA($_SESSION['id'],$i).'</td></tr>';
                }
              ?>
            </table>
          </div>
          <div class="col-md-10 col-sm-10 col-xs-12">
                 <div class="panel-group" id="accordion">
                    <div class="panel panel-success">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $class['sem']; ?>">
                                    Semester <?php echo $class['sem']; ?>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapse<?php echo $class['sem']; ?>" class="panel-collapse collapse in">
                                <div class="panel-body">
                                      <div class="panel-group" id="accordion1">
                                        <?php 
                                          $subjects = $user->getSubjectsBySem($class['sem']);
                                        for($i=0;$i<count($subjects);$i++){ 
                                          ?>
                                            <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                      <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $class['sem'].$i; ?>">
                                                         <?php echo $subjects[$i]['subjectName']; ?>&nbsp;&nbsp;&nbsp;<span class="badge"><?php echo $user->getCIE($_SESSION['id'],$subjects[$i]['subjectId']);?></span>
                                                        </a>
                                                      </h4>
                                                    </div>
                                                    <div id="collapse<?php echo $class['sem'].$i; ?>" class="panel-collapse collapse">
                                                      <div class="panel-body">
                                                            <table class="table table-hover table-condensed">
                                                              <tr><th>Exam Type</th><th>Maximum Marks</th><th>Score</th></tr>
                                                               <?php if($subjects[$i]['credits']>4) { ?>
                                                               <tr><th>Test 1</th><td>10</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],1); ?></td></tr>
                                                                <tr><th>Test 2</th><td>10</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],2); ?></td></tr>
                                                                <tr><th>Test 3</th><td>10</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],3); ?></td></tr>
                                                                <tr><th>Quiz 1</th><td>5</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],4); ?></td></tr>
                                                                <tr><th>Lab 1</th><td>10</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],6); ?></td></tr>
                                                                <tr><th>Lab 2</th><td>15</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],7); ?></td></tr>
                                                                <?php }else{
                                                                  ?>
                                                                  <tr><th>Test 1</th><td>20</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],1); ?></td></tr>
                                                                <tr><th>Test 2</th><td>20</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],2); ?></td></tr>
                                                                <tr><th>Test 3</th><td>20</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],3); ?></td></tr>
                                                                <tr><th>Quiz 1</th><td>5</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],4); ?></td></tr>
                                                                <tr><th>Quiz 2</th><td>5</td><td><?php echo $user->getMarksByType($_SESSION['id'],$subjects[$i]['subjectId'],5); ?></td></tr>
                                                                  <?php
                                                                } ?>

                                                            </table>
                                                            
                                                      </div>
                                                    </div>
                                            </div>
                                          <?php 
                                              }
                                          ?>
                                      </div>
                                </div>
                              </div>
                      </div>
                  <?php 

                      for($i=($class['sem']-1);$i>0;$i--){
                          $oldGrades = $user->getGradebySem($i,$_SESSION['id']);
                          $sgpa = $user->getSGPA($_SESSION['id'],$i);
                        ?>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                                    Semester <?php echo $i; 
                                      
                                    ?>
                                  </a>
                                  &nbsp;&nbsp;<span class="badge"><?php echo $sgpa;?></span>
                                </h4>
                              </div>
                              <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                                <div class="panel-body">

                                  <table class="table hover">
                                    <tr><th>Subject</th><th>Code</th><th>Credits</th><th>Grade</th></tr>
                                    <?php 
                                     for($j=0;$j<count($oldGrades);$j++){
                                       echo '<tr><td>'.$oldGrades[$j]['subjectName'].'</td><td>'.$oldGrades[$j]['subjectCode'].'</td><td>'.$oldGrades[$j]['credits'].'</td><td>'.$oldGrades[$j]['grade'].'</td></tr>';
                                     }
                                    ?>
                                  </table>
                              </div>
                            </div>
                          </div>
                        <?php
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