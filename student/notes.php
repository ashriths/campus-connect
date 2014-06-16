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
      $design->getStudentNavbar($rp,1,$u['usn']);
    //  $marks = $user->getMyGrades($_SESSION['id']);

    ?>
    
    <hr />

    <div class="container" style="margin-top:30pt; margin-left:150pt;">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
                 <div class="panel-group" id="accordion">
                    <div class="panel panel-success">
                        <div class="panel-heading">    
                        <h1> Download Notes </h1>   
                        <h4> Enter the semester and department for subject notes: </h4>           
          <div class="input-group">
          <span class="input-group-addon">Semester</span>
          <input type="text" class="form-control" placeholder="Ex:6"> 
          <br />
          </div>

          <div class="input-group">
          <span class="input-group-addon">Department</span>
          <input type="text" class="form-control" placeholder="Ex:CSE">
          <br />
          </div>

          <div class="input-group">
          <input type="submit" class="form-control" value="OK" onClick="6thsem_notes.php">
          <br />
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div style="margin-top:30pt;">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
                 <div class="panel-group" id="accordion">
                    <div class="panel panel-success">
                        <div class="panel-heading">    
                        <h1> Upload Notes </h1>   
                        <h4> Enter the subject, author and the link to the notes to be uploaded: </h4>           
          <div class="input-group">
          <span class="input-group-addon">Subject</span>
          <input type="text" class="form-control" placeholder="Ex:Engineering Mathematics I"> 
          <br />
          </div>

          <div class="input-group">
          <span class="input-group-addon">Author</span>
          <input type="text" class="form-control" placeholder="Ex:Dr. K.S.C"> 
          <br />
          </div>

          <div class="input-group">
          <span class="input-group-addon">URL</span>
          <input type="text" class="form-control" placeholder="Ex:http://bmsce/notes/eng_math1">
          <br />
          </div>

          <div class="input-group">
          <input type="submit" class="form-control" value="Upload" onClick="6thsem_notes.php">
          <br />
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

    <div class="container-fluid" style="margin-top:30pt;" >
        
        <p class="text-muted">&copy; 2014 All Rights reserved.</p>
        </div>
  



    <?php
        $design->getJSIncludes($rp);
    ?>
        
  </body>
</html>