<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
	unset($_SESSION['id2']);
    Redirect::redirectTo($rp.'login.php');
}
if(!  (($_SESSION['type']=='student') || ($_SESSION['type']=='teacher'))  ){
   	
   	unset($_SESSION['id2']);
    Redirect::redirectTo($rp.'home.php');
}

if(!isset($_SESSION['id2']))
{	
	Redirect::redirectTo($rp.'home.php');
}else
{
	$id = $_SESSION['id2'];
}
	
// $id = 2;//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$u = $user->getTableDetailsbyId('teacher','userId',$id);
// print_r($u);

$k = $user->getTableDetailsbyId('user','userId',$id);
$u=array_merge($u,$k);

//exit;
//echo $u['classId'];
//echo $u['usn'];


//echo $class['sem'];
//echo $class['section'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Profile | BMSCE Campus</title>
      <style type="text/css">
        body {background-image: url("../img/creme-patterns.jpg");} 
      </style>
  
   
  </head>
  <body style="padding-top:35px;">
  <?php
      $uNotif = $user->getUnreadNotificationNumber();
      $uMsg = $user->getUnreadMsgNumber();
      $design->getFacultyNavbar($rp,-1,$uNotif,$uMsg);
    ?>
  	<hr />
    <div class="container ">



    <?php
    // print_r($u);
    ?>

    	<h2 class="heading">Profile<span class="small" style="font-size:13pt;"> Faculty</span></h2>
	    <div class="jumbotron" >
	         
	        <div class="row" >
	            
	            <div class="col-xs-4 col-sm-4">
	                <img src="../img/profile.jpg" class="img-thumbnail" width='150pt' height='250pt';/>
	            </div>
	          	<div class="col-xs-4 col-sm-4">
	               	<table class="table " style="font-size:11pt;">
	                    <tr><th>Name</th><td><?php echo strtoupper($u['name']); ?></td></tr>
	                   	<tr><th>Department</th><td>
	                    <?php //echo $class['deptId'];
	                        $dept = $user->getTableDetailsbyId('dept','deptId',$u['deptId']);
	                        echo strtoupper($dept['name']);
	                   	?>
	                   	</td></tr>
	                    
	                    <tr>
	                    	<th>Post</th> 
	                    	<td>Assistant&nbsp;Professor</td>
	                    </tr>
	                    <tr>
	                    	<th>Qualification</th> 
	                    	<td>M.Tech, BE</td>
	                    </tr>
	                    <tr>
	                    	<th>Specalization</th> 
	                    	<td>Nothing</td>
	                    </tr>
	                </table>
	         	</div>
	         	<div class="col-xs-4.col-md-offset-3 col-sm-4">
	         		<table cellpadding="20pt" style="margin-left:70pt;">
	         			<tr><td margin:>
	         				<a href="#mail.php"><button type="button" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
	         			</td></tr>
	         			<tr><td>
	         				<a href="#message.php"><button type="button" class="btn btn-primary">Message</button></a>
	         			</td></tr>
	         		</table>
	         	</div>
	        </div>
	        
	  	</div>
	 <!--     
	    
	    <div class="panel panel-primary">
            <div class="panel-heading">
            	<span class="glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;Classes:
            </div>
            <div class="panel-body">
            	<table class="table  table-condensed" >
            	<tr style="background:#F2F2F2;">
            		<th>Course</th>
            		<th>Code</th>
            		<th>Credits</th>
            		<th>Semester</th>
            		<th>Section</th>
            	</tr>
				<?php
		   //           $subject = $user -> getTableDetailsbyNonId('teachersubject','teacherId',$id);
		   //           if(!isset($subject[0]))
		   //           {	
					// 	//when a single row is returned
		   //           	$temp[0] = $subject;
		   //           	unset($subject);
		   //           	$subject=$temp;
		   //           }
		             
					// foreach ($subject as $key => $value) {
		   //           	$sub = $user -> getTableDetailsbyId('subject','subjectId',$value['subjectId']);
					// 	$class = $user -> getTableDetailsbyId('class','classId',$value['classId']);
					// 	$subject[$key]['subjectName'] = $sub['subjectName'];
					// 	$subject[$key]['subjectCode'] = $sub['subjectCode'];
					// 	$subject[$key]['credits'] = $sub['credits'];
					// 	$subject[$key]['sem'] = $class['sem'];
					// 	$subject[$key]['section'] = $class['section'];


		   //           }
		   //           //sort according t sem
					// function cmp($a, $b) 
					// {
					// 	return $a["sem"] - $b["sem"];
					// }
					// usort($subject, "cmp");
		   //   		foreach ($subject as $key => $value) {
					// 		echo "<tr>".
					// 		"<td>".$value['subjectName']."</td>".
					// 		"<td>".$value['subjectCode']."</td>".
					// 		"<td>".$value['credits']."</td>".
					// 		"<td>".$value['sem']."</td>".
					// 		"<td>".$value['section']."</td>".
					// 		"</tr>";
	    //      		}
        		?> 
                 </table>       
                                    
            </div>
        </div>   -->   

        <div class="panel panel-primary">
            <div class="panel-heading">
            	<span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Notes:
            </div>
            <div class="panel-body">
            	<table class="table  table-condensed" >

            	<!-- orderBy date Added -->
            	<tr style="background:#F2F2F2;">
            		<th>No.</th>
            		<th>Semester</th>
            		<th>Subject</th>
            		<th>Date Added</th>
            		
            	</tr>
            	<?php
            		$notes =array(1,2,3,4);
            		$i=1;
            		foreach ($notes as $key => $value) {
            			echo 	"<tr>".
            					"<td>".($i++)." <a href=\"#\" style=\"text-decoration:none;d\">"." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"glyphicon glyphicon-download-alt\"></span></a></td>".
            					"<td>"."</td>".
            					"<td>"."</td>".
            					"<td>"."</td>".
            					"</tr>";
            		}

            	?>
            	</table>
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