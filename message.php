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
$class = $user->getTableDetailsbyId("class","classId",$u['classId']);
}else{
  $u = $user->getTableDetailsbyId('teacher','userId',$_SESSION['id']);
}
$u += $user->getTableDetailsbyId('user','userId',$_SESSION['id']);

if(isset($_POST['reply'])){
    $user->sendMessage($_POST['to'],$_POST['content']);
}
//rint_r($u);

//echo $u['classId'];
//echo $u['usn'];


//echo $class['sem'];
//echo $class['section'];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Messages | BMSCE Campus</title>
    



   
  </head>
  <body style="padding-top:35px">
    <?php
    $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
    if($_SESSION['type']=='student'){
      $design->getStudentNavbar($rp,-1,$u['usn'], $uNotif,$uMsg);
    }else{
      $design->getFacultyNavbar($rp,-1, $uNotif,$uMsg);
    }
     
    ?>
     
    <div class="container" >
      <div class="page-header">
        <h2>Messages</h2>
      </div>
    </div>
      

      
    <?php
    if(!isset($_GET['id']))
    {
      ?> 
      <div class="container" >
                    <div class="panel panel-default">
                       <div class="panel-heading">
                        <h3 class="panel-title">Inbox </h3>
                       </div>
                       <div class="panel-body">
                        <div class="row">
      <?php
        $result = $user ->getEvents();
        //print_r($result);
        //echo 'hello';
        if($result['total']>0){
            foreach ($result['events'] as $key => $value) {
            
              echo ' 
                <div class="col-sm-6 col-md-3">
                                  <div class="thumbnail">
                                    <img src="'.$value['imgurl'].'" alt="Event Image">
                                    <div class="caption">
                                      <h3>'.$value['name'].'</h3>';
                                      if($value['type']!='open'){
                                          if($value['type']=='dept'){
                                            $r = $user->getTableDetailsbyId('deptevent','id',$value['id']);
                                            $o = $user->getDeptNamefromId($r['deptId']);
                                            echo '<p>Organised by Dept. Of CSE</p>';
                                          }
                                      }
                                      echo '<p><a href="?id='.$value['id'].'" class="btn btn-primary" role="button">More Details</a> </p>
                                    </div>
                                  </div>
                                </div>

                             ';


            }
        } ?>
                         </div>
                       </div>
                    </div>
        </div>
    <?php
     }  
    else
    {
        $id = $_GET['id'];
        $result = $user -> getMessageDetails($id);
        //print_r($result);
        $conv = $user->getConversation($_SESSION['id'],$result['fromId']);
        //print_r($conv);
        $u2 = $user->getTableDetailsbyId('user','userId',$result['fromId']);

        ?> 
        <div class="container">
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-8">
                    <div class="old-messages">
                      <ul class="media-list">
                        <?php 
                          for($i=0;$i<$conv['length'];$i++){
                            echo '
                                    <div class="well well-sm">
                                      
                                        <li class="media">';
                                        if($_SESSION['id']==$conv['rows'][$i]['fromId'])
                                           echo '<a class="pull-left thumbnail profile-thumb" href="#"><img class="media-object" src="'.$u['pic'].'" alt="...">';
                                         else
                                           echo '<a class="pull-right thumbnail profile-thumb" href="#"><img class="media-object" src="'.$u2['pic'].'" alt="...">';
                                        echo '</a>';
                                        if($_SESSION['id']==$conv['rows'][$i]['fromId'])
                                          echo '<div class="media-body">
                                                <a href="'.$rp.'"<strong><h6 class="text-left media-heading">'.$u['name'].'
                                                </h6></strong></a>
                                                <h5 class="text-left">
                                                  <p>'.$conv['rows'][$i]['content'].'</p>
                                                 
                                                </h5>
                                                 <h6 class="text-left"><small>'.$conv['rows'][$i]['timestamp'].'</small></h6>'
                                                
                                                ;
                                        else
                                           echo '<div class="media-body">
                                                <a href="'.$rp.'profile.php?id='.$u2['userId'].'"<strong><h6 class="text-right media-heading">'.$u2['name'].'
                                                </h6> </strong></a>
                                                <h5 class="text-right">
                                                  <p>'.$conv['rows'][$i]['content'].'</p>
                                                  
                                                </h5>
                                                 <h6 class="text-right"><small>'.$conv['rows'][$i]['timestamp'].'</small></h6>';
                                            
                                        echo '  </div>
                                        </li>
                                      
                                    </div>

                                  ';
                          }
                        ?>
                        
                      </ul>
                    </div>
                    <div class="reply-box">
                      <div class="well">
                        <form action="" method="post">
                        <textarea name="content" class="form-control" rows="3" placeholder="Write here to reply..."></textarea>
                        <hr>
                        
                        <div class="hidden-all">
                          <input name="to" value="<?php echo $u2['userId']; ?>"/>
                        </div>
                          <button href="#" class="btn btn-primary active text-right" name="reply" type="submit" role="button">Reply</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
           </div>
        <?php
        /**echo '<div class="container">
                <div class="bs-callout bs-callout-info">
                  <h3><b>'.strtoupper($result['eventName']).'</b> &nbsp;&nbsp;<small>  By: &nbsp;'.$result['deptName'].'</small></h3>
                    <p style="font-size:12pt;"><b>Venue : </b>'.$result['venue'].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result['date'].'</p>

                    <p style="font-size:12pt;">'.$result['message'].'</p>
                    <br/>
                </div>
              </div>'; **/

    }

    ?>

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
     <script>
          function scrollToRecent(){
            $(window).load(function() {
                $('.old-messages').animate({ scrollTop: $('.old-messages').height() }, 1000);
              });
          }
          scrollToRecent();
     </script>   
  </body>
</html>