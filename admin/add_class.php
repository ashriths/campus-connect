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

if(isset($_GET['clear'])){
  unset($_SESSION['add_classId']);
}

if(!isset($_POST['sem'])){
  if(!isset($_SESSION['add_classId']))
  Redirect::redirectTo($rp.'admin');
}

// add the class to dept
if(!isset($_SESSION['add_classId'])){
$_SESSION['add_classId'] = $classId =$user->createNewClass($u['deptId'],$_POST['sem']);
}
$class = $user->getTableDetailsbyId('class','classId',$_SESSION['add_classId']);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Add Class | BMSCE Campus</title>
    
   
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
            
            <div class="col-xs-12 col-sm-9 col-md-9">
                <div class="panel panel-default">
                      <div class="panel-heading"> <h2>Add Students to <?php echo $class['sem'].' '.$class['section']; ?> </h2> </div>
                      <div id="form" class="panel-body">
                          <form onsubmit="return validate();" role="form">

                            <table class="table table-hover .table-bordered">
                              <tr><th>#</th><th>Name</th><th>Email</th></tr>
                           
                            <?php 
                              for($i=0;$i<1;$i++){
                                  echo '<tr class="rows" row-no="'.($i+1).'"><th>'.($i+1).'</th><td><input type="text" class="name-entry form-control" id="name'.$i.'" required></td>
                                  <td><input type="email" class="email-entry form-control" status="status'.$i.'" id="email'.$i.'" required></td><td class="status" id="status'.$i.'"></td></tr>';
                              }
                            ?>
                            
                            </table>
                            <div class="row well">
                                 <div class="col-xs-4">
                                  <button id="add-one" type="button" class="btn btn-lg btn-success btn-block">+</button>
                                 </div>
                                 <div class=" col-xs-4">
                                 <button id="sub-one" type="button" class="btn btn-lg btn-danger btn-block" disabled="disabled">-</button>
                                 </div>
                                 <div class="col-xs-4">
                                 <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                                 </div>
                             </div>
                          </form>
                      </div>
              </div>
          </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
              <div class="panel panel-primary">
                      <div class="panel-heading"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Actions</div>
                      <div class="panel-body">
                        <div class="list-group">
                          <li class="list-group-item"><a href="?clear=1"><button type="button" class="btn btn-primary btn-lg btn-block">Delete this Class</button></a>
                            </li>
                          <li class="list-group-item"><div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="number" id="add_nos" class="form-control" value="1"/>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-md-6">
                          <button id="add-more" type="button" class="btn btn-default ">Add More</button>
                          </div></li>
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
    <script type="text/javascript" src="<?php echo $rp; ?>js/jquery.cookie.js" ></script>
    <script type="text/javascript">

      var classId= "class<?php echo $_SESSION['add_classId'] ; ?>" ;
     
      var cook = $.cookie(classId);
     
      if(!(typeof cook === "undefined")){
        if (confirm('Do you want to restore your form? \n \nclick cancel to start a new form')) {
            alert(cook);
            $('#form').html(cook);
        } 
      }
      

       function SaveForm(){
           var form  = document.getElementById('form').innerHTML;
            $.cookie(classId, form, {
                expires: 10
            });
            alert("form saved\n" +$.cookie(classId));

        }

        window.setInterval(SaveForm,5000);

    </script>

    <script src="add_class.js">

    </script>
        
  </body>
</html>