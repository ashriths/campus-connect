<?php

$rp = './';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if($_SESSION['type']=='student'){
$u = $user->getTableDetailsbyId('student','userId',$_SESSION['id']);

}else if($_SESSION['type']=='teacher'){
  $u = $user->getTableDetailsbyId('teacher','userId',$_SESSION['id']);
}else{
  $u = $user->getTableDetailsbyId('deptadmin','userId',$_SESSION['id']);
}

if(!isset($_GET['id'])){
    Redirect::redirectTo($rp.'404.php');
}
  $class = $user->getTableDetailsbyId('class','classId',$_GET['id']); 
  //print_r($class);
  if(!$class){
      Redirect::redirectTo($rp.'404.php');
  }

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Class Profile | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
    $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
    if($_SESSION['type']=='student'){
      $design->getStudentNavbar($rp,-1,$u['usn'], $uNotif,$uMsg);
     }else if($_SESSION['type']=='teacher'){
      $design->getFacultyNavbar($rp,-1, $uNotif,$uMsg);
    }else{
      $design->getAdminNavbar($rp,-1, $uNotif,$uMsg);
    }
     
    ?>
     
    <div class="container" >
      <div class="page-header">

        <h2><?php  
      $dept = $user->getTableDetailsbyId('dept','deptId',$class['deptId']);
        echo $dept['name'].' '.strtoupper($class['sem']).' '.strtoupper($class['section']); ?><span class="small" style="font-size:13pt;"> Class Profile</span></h2>
      </div>
    </div>
    <?php    $dept = $user->getTableDetailsbyId('class','deptId',$u['deptId']); ?>
      <div class="container">
              <div class="col-md-4 col-xs-12">
                  <div class="panel panel-default">
                      <!-- Default panel contents -->     
                     <div class="panel-content">              
                  <table class="table " style="font-size:11pt;">
                        <tr><th>Semester</th><td><?php echo strtoupper($class['sem']); ?></td></tr>
                        <tr><th>Department</th><td>
                        <?php //echo $class['deptId'];
                            $dept = $user->getTableDetailsbyId('dept','deptId',$class['deptId']);
                            echo strtoupper($dept['name']);
                        ?>
                        </td></tr>
                        
                        <tr>
                          <th>Strength</th> 
                          <td><?php echo $user->getClassStrength($class['classId']); ?></td>
                        </tr>
                       
                    </table>   
     
                    <?php if(  ($_SESSION['type']=='teacher')||($_SESSION['type']=='deptadmin')  ){ ?> 
                      <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#announce"><span class="glyphicon glyphicon-comment"></span>&nbsp;Announce</button>
                    <?php } ?>
                    <?php if( ($_SESSION['type']=='deptadmin')  ){  ?>
                      <button type="button" class="btn btn-lg btn-block btn-danger" data-toggle="modal" data-target="#deleteuser"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Delete</button>
                    <?php } ?>
                  </div>
              </div>
            </div> 
             
              <div class="col-md-8 col-xs-12">
                  <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading"><strong>Students</strong></div>

      <?php 
          $students = $user->getClassStudents($class['classId']); 
          
      ?>              

                    
                      <div class="list-group">
                      <?php 
                        for($i=0;$i<$students['length'];$i++){
                          $st = $students['rows'][$i];
                          //print_r($st);
                          $u2 = $user->getTableDetailsbyId('user','userId',$st['userId']);
                          $u2+= $user->getTableDetailsbyId('student','userId',$st['userId']);
                          echo '<a  class="list-group-item" href="profile.php?id='.$st['userId'].'">'.($i+1).'&nbsp;&nbsp;&nbsp;<img width="32px" height="32px" src="'.$u2['pic'].'"/>&nbsp;&nbsp;&nbsp;<strong>'.strtoupper($u2['name']).'</strong>&nbsp;&nbsp;&nbsp;'.strtoupper($u2['usn']).'</a>';
                        }
                      ?>
                        
                      </div>
                   
                    
              </div>
            </div>  

      
   
      </div>

      <div class="modal fade" id="announce" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Make an Announcement for <?php echo strtoupper($class['sem']).' '.strtoupper($class['section']); ?></h4>
                      </div>
                      <div class="modal-body">
                           <div class="form-group">
                              <label for="name">What do you want to announce ?</label>
                              <textarea rows="3"  id="content" class="form-control"></textarea>
                            </div>
                            <p class="small"><span id="chars">200</span> characters remaining.</p>
                            <div id="result"></result>
                      </div>
                      <div class="modal-footer">
                         <a><button type="button" id="submit" class="btn btn-primary" disabled="disabled">Post</button></a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
    <script type="text/javascript">
        $('#content').keyup(function(){
            len = $(this).val().length;
            if(len==0){
              $('#submit').attr('disabled','disabled');
              $('#chars').html(200-len);
            }
            else if(len>200){
                $('#submit').attr('disabled','disabled');
                $('#chars').html(0);
            }else{
              $('#submit').removeAttr('disabled');
              $('#chars').html(200-len);
            }
        });
        var xhr=null;
         $('#submit').click(function(){
            $('#submit').attr('disabled','disabled');
            $('#submit').html('<img src="img/spinner.gif"/>');
            var con = $('#content').val();
            xhr = $.ajax({
              type: "post",
              url: "ajax/announce.php",
              data: { type:'class',to: <?php echo $_GET['id']; ?> ,content  :con},
              cache: false
            })
              .done(function( html ) {   
                $('#result').html( html );
                $('#content').val('');
                $('#submit').removeAttr('disabled');
                $('#submit').html('Post Another ?');
                $('#chars').html(200);
              });
         });


    </script>    
  </body>
</html>