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


      <title>Notes | BMSCE Campus</title>
    
  </head>
  <body style="padding-top:35px">
    <?php
      $design->getStudentNavbar($rp,4,$u['usn']);
    //  $marks = $user->getMyGrades($_SESSION['id']);

    ?>
    
    <hr />

    <div class="container" style="margin-top:30pt; margin-left:150pt;">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
                 <div class="panel-group" id="accordion">
                    <div class="panel panel-info">
                        <div class="panel-heading">    
                          <h1> Download Notes </h1>   
                          <p class="lead"> Select semester and department for subject notes: </p>           
                          <form action="notes.php" method="">
                          <div class="input-group">
                              
                              <span class="input-group-addon">Semester &nbsp;&nbsp;  </span>
                              <select name="sem" class="form-control">
                               <?php
                               $res = $user ->suggestSem();
                                foreach ($res as $key => $value) {
                                  echo '<option>'.$value['sem'].'</option>';
                               } 
                                
                                ?>
                              </select>
                              
                           </div>
                            <br/>
                            <div class="input-group">
                              <span class="input-group-addon">Department</span>
                              <select name="dept" class="form-control">
                              <?php
                              $res = $user ->suggestDept();
                              foreach ($res as $key => $value) {
                                echo '<option>'.$value['name'].'</option>';
                              }

                              ?>
                              </select>
                            </div>
                              <br/>
                            <div class="input-group">
                              <input type="submit" style="width:200pt;" class="form-control" value="OK" >
                              <br />
                            </form>
                            </div>

                         </div>
                    </div>
                </div>
          </div>
      </div>

<div style="margin-top:30pt;">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
                <form action="#">
                 <div class="panel-group" id="accordion">
                    <div class="panel panel-info">
                        <div class="panel-heading">    
                        <h1> Upload Notes </h1>   
                        <p class="lead"> Enter the subject, author and the link to the notes to be uploaded: </p>           
                        <div class="input-group">
                        <span class="input-group-addon">Subject</span>
                        <select class="form-control">


                        </select>
                        </div>
                        <br/>
                        <div class="input-group">
                        <span class="input-group-addon">Author&nbsp;&nbsp;</span>
                        <input type="text" name="author" ></input>
                        <br />
                        </div>
                        <br/>
                        <div class="input-group">
                        <span class="input-group-addon">URL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <input type="text" name="url"></input>
                        <br />
                        </div>
                        <br/>
                        <div class="input-group">
                        <input type="submit" style="width:200pt;" class="form-control" value="Upload" >
                        <br />
                        </div>
                        </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        
        
      <div class="container" >
        <div class="well">
        <p class="text-muted">&copy; 2014 All Rights reserved.</p>
        </div>
      </div>
   
  



    <?php
        $design->getJSIncludes($rp);
    ?>
        
  </body>
</html>