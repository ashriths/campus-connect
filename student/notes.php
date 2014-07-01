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
    <form action="" method="GET">
    <div class="container" style="margin-top:30pt; margin-left:120pt;">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
<<<<<<< HEAD
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
=======
                 <div class="panel-group" id="accord">
                    <div class="panel panel-success">
                        <div class="panel-heading">    
                        <h1> Download Notes </h1>   
                        <h4> Enter the semester and department for subject notes: </h4>           
          <div class="input-group">
          <span class="input-group-addon">Semester</span>
          <input type="text" class="form-control" placeholder="Ex:6" name="semester"> 
          <br />
          </div>

          <div class="input-group">
          <span class="input-group-addon">Department</span>
          <input type="text" class="form-control" placeholder="Ex:CSE" name="dept">
          <br />
          </div>

          <div class="input-group">
          <input type="submit" class="form-control" value="OK">
          <br />
          </div>

        </div>
>>>>>>> FETCH_HEAD
      </div>

<div style="margin-top:30pt;">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
<<<<<<< HEAD
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
=======
                 <div class="panel-group" id="accord">
                    <div class="panel panel-success">
                        <div class="panel-heading">    
                        <h1> Upload Notes </h1>   
                        <h4> Enter the subject, author and the link to the notes to be uploaded: </h4>           
          <div class="input-group">
          <span class="input-group-addon">Subject</span>
          <input type="text" class="form-control" placeholder="Ex:Engineering Mathematics I" name="subject"> 
          <br />
          </div>

          <div class="input-group">
          <span class="input-group-addon">Author</span>
          <input type="text" class="form-control" placeholder="Ex:Dr. K.S.C" name="author"> 
          <br />
          </div>

          <div class="input-group">
          <span class="input-group-addon">URL</span>
          <input type="text" class="form-control" placeholder="Ex:http://bmsce/notes/eng_math1" name="url">
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

    <div class="container-fluid" style="margin-top:40pt;" >
   
>>>>>>> FETCH_HEAD
        <div class="well">
        <p class="text-muted">&copy; 2014 All Rights reserved.</p>
        </div>
      </div>
<<<<<<< HEAD
   
  


=======
>>>>>>> FETCH_HEAD

    <?php
        $design->getJSIncludes($rp);
    ?>
   </form>     
  </body>
</html>