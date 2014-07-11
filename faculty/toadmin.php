<?php
//deletion  of user code after js files....redirect=1 and op=deleteuser

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){

	unset($_SESSION['id2']);
    Redirect::redirectTo($rp.'login.php');
}
if(  ($_SESSION['type']=='student') || ($_SESSION['type']=='teacher')  ) {
    
    unset($_SESSION['id2']);
    Redirect::redirectTo($rp.'home.php');
}
if(isset($_GET['redirect']))
{
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

   


      <title><?php echo strtoupper($u['name']); ?> | Profile @ campusBMSCE</title>
      <style type="text/css">
        body {background-image: url("../img/creme-patterns.jpg");} 
      </style>
  
   
  </head>
  <body style="padding-top:35px;">
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
  	<hr />
    <div class="container ">


	<?php
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$actual_link = $actual_link."?".$_SERVER['QUERY_STRING'];
	?>
    


    	<h2 class="heading"><?php echo strtoupper($u['name']); ?><span class="small" style="font-size:13pt;"> Faculty Profile</span></h2>
	    <div class="container-fluid">
		    <div class="jumbotron" >
		       
		        <div class="row" >
		            
		          <div class="col-xs-12  col-sm-4 col-md-2">
	                                <img src="../img/profile.jpg"  class="img-thumbnail"/>
	                             </div>
		          	<div class="col-xs-4 col-sm-6 col-md-8">
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
		         	<div class="col-xs-12 col-md-2 col-sm-12 pull-right">
		         		<div class="visible-xs visible-sm">
		         			<div class="btn-group btn-group-md">
		         					<button type="button" class="btn"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Mail</button>
		         					<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-comment"></span>&nbsp;Message</button>
		         					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteuser"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Delete</button>
		         			</div>
		         		</div>	
		         		<div class="visible-md visible-lg ">
		         			<div class="btn-group-vertical btn-group-lg">
		         					<button type="button" class="btn"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Mail</button>
		         					<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-comment"></span>&nbsp;Message</button>
		         					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteuser"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Delete</button>
		         					
		         			</div>
		         		</div>	
		         		
		         	</div>
		        </div>
		    </div>
	        
	  	</div>
	  		<!-- modal -->
					<div class="modal fade" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					        <h4 class="modal-title" id="myModalLabel">Delete this user???</h4>
					      </div>
					      <div class="modal-body">
					        Data once deleted cannot be retrieved.
					        <br/>
					        All related entries for user will be deleted.
					        <br/>
					        Are you sure about this?

					      </div>
					      <div class="modal-footer">
					         <a href="?<?php echo $_SERVER['QUERY_STRING'];
					         ?>&op=deleteuser" ><button type="button" class="btn btn-primary">Delete</button></a>
					       	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					      </div>
					    </div>
					  </div>
					</div>	  		     
	    	<!-- modal -->
	    





	    	

	    <div class="panel panel-primary">
            <div class="panel-heading">
            	<span class="glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;Classes:
            </div>
            <div class="panel-body">
            	<table class="table  table-condensed" >
            	<tr style="background:#F2F2F2;">
            		<th>&nbsp;<span class='glyphicon glyphicon-edit'></sapn></th>
            		<th>Course</th>
            		<th>Code</th>
            		<th>Credits</th>
            		<th>Semester</th>
            		<th>Section</th>
            		
            	</tr>
				<?php
		             $subject = $user -> getTableDetailsbyNonId('teachersubject','teacherId',$id);
		             if(!isset($subject[0]))
		             {	
						//when a single row is returned
		             	$temp[0] = $subject;
		             	unset($subject);
		             	$subject=$temp;
		             }

					foreach ($subject as $key => $value) {
		             	$sub = $user -> getTableDetailsbyId('subject','subjectId',$value['subjectId']);
						$class = $user -> getTableDetailsbyId('class','classId',$value['classId']);
						$subject[$key]['subjectName'] = $sub['subjectName'];
						$subject[$key]['subjectCode'] = $sub['subjectCode'];
						$subject[$key]['credits'] = $sub['credits'];
						$subject[$key]['sem'] = $class['sem'];
						$subject[$key]['section'] = $class['section'];


		             }
		             //sort according t sem
					function cmp($a, $b) 
					{
						return $a["sem"] - $b["sem"];
					}
					usort($subject, "cmp");
		     		foreach ($subject as $key => $value) {
							echo "<tr>".
							"<td>&nbsp;<a href='#'><span class='glyphicon glyphicon-trash'></sapn></a></td>".
							"<td>".$value['subjectName']."</td>".
							"<td>".$value['subjectCode']."</td>".
							"<td>".$value['credits']."</td>".
							"<td>".$value['sem']."</td>".
							"<td>".$value['section']."</td>".
							"</tr>";
	         		}
        		?> 
                 </table>       
              
                 <a href=""><button type="button"  class="btn btn-success" data-toggle="modal" data-target="#assignclass">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
                          
						<!-- modal -->
							<div class="modal fade" id="assignclass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							        <h4 class="modal-title" id="myModalLabel">Add</h4>
							      </div>
							      <div class="modal-body">
							        <?php
							        	$dept = $user -> getTableDetailsbyId('teacher','userId',$_SESSION['id2']);
							        
							        	$course = $user -> getTableDetailsbyNonId('subject','deptId',$dept['deptId']);
							        
							        ?>


							        <form method='get' action=""> <!-- form starts -->
							        	
							        	<table class="table">
							        	<tr><th>Course / Sem </th>
							        	<?php

							        		echo "<td><select name=\"subject\" autofocus>";
							        		foreach ($course as $key => $value) {
							        			echo "<option value=\"".$value['subjectId']."\">".$value['subjectName']." / ".$value['sem']."</option>";
							        		}
							        		echo "</select></td></tr>";
							        		
							        		$var = array('A','B','C','D','E','F','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
							        		
							        		echo "<tr><th>Section </th>";

							        		echo "<td><select name=\"section\" >";
							        		foreach ($var as $key => $value) {
							        			echo "<option value=\"".$value."\">".$value."</option>";
							        		}
							        		echo "</select></td>";

							        	?>	
							        		
							        		</table>
							        	

							      	</div>
							      		<div class="modal-footer">
							        	 
							      <input  type="submit" value="Submit" class="btn btn-primary"></input>

							         </form>
							         <!-- form ends -->
							       	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							      </div>
							    </div>
							  </div>
							</div>	  		     
			    	<!-- modal -->

            </div>
        </div>     

        <div class="panel panel-primary">
            <div class="panel-heading">
            	<span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Notes:
            </div>
            <div class="panel-body">
            	<table class="table  table-condensed" >

            	<!-- orderBy date Added -->
            	<tr style="background:#F2F2F2;">
            		<th width="10%">&nbsp;<span class='glyphicon glyphicon-edit'></sapn></th>
            		<th width="10%">Semester</th>
            		<th width="15%">Subject</th>
            		<th width="15%">Date Added</th>
            		<th width="30%">Tags</th>
            		<th width="10%">&nbsp;<span class="glyphicon glyphicon-inbox"></span></th>
            		
            	</tr>
            	<?php
            		$notes =array(1,2,3,4);
            		foreach ($notes as $key => $value) {
            			echo 	"<tr>".
            					"<td> &nbsp;<a href='#'><span class='glyphicon glyphicon-trash'></sapn></a></td>".
            					"<td>"."</td>".
            					"<td>"."</td>".
            					"<td>"."</td>".
            					"<td>"."</td>".
            					"<td><a href=\"#\" style=\"text-decoration:none;d\">"."&nbsp;<span class=\"glyphicon glyphicon-download-alt\"></span></a></td>".
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
        
		if(isset($_GET['op']) && $_GET['op']=='deleteuser')
		{

			$result = $user ->removeRow('user','userId',$_GET['id']);
			if($result)
			{	
				echo '<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <a href="?'.$_SERVER['QUERY_STRING'].'&redirect=1" ><button type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
						        <h4 class="modal-title" id="myModalLabel">Success</h4>
						      </div>
						      <div class="modal-body">
						        <b>User has been removed from the database.</b>
						        <br/>Redirecting to Home.
						      </div>
						      <div class="modal-footer">
						       
						        <a href="?'.$_SERVER['QUERY_STRING'].'&redirect=1" ><button type="button"  class="btn btn-primary">OK</button></a>
						      </div>
						    </div>
						  </div>
						</div>';
						echo "<script type=\"text/javascript\">$('#modal').modal();</script>";

			}
		}
		if(isset($_GET['subject']) || isset($_GET['section']) )
		{
			$result = $user -> assignTeacherSubject($_SESSION['id2'], $_GET['section'], $_GET['subject']);
			
			if($result==1)
			{
					echo '<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <a href="?'.$_SERVER['QUERY_STRING'].'" ><button type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
								        <h4 class="modal-title" id="myModalLabel">Success</h4>
								      </div>
								      <div class="modal-body">
								        <b>Sbject has been assigned</b>'.$result.
								        '<br/>
								      </div>
								      <div class="modal-footer">
								       
								        <a href="?'.$_SERVER['QUERY_STRING'].'" ><button type="button"  class="btn btn-primary">OK</button></a>
								      </div>
								    </div>
								  </div>
								</div>';

					echo "<script type=\"text/javascript\">$('#modal2').modal();</script>";
			}
			else
			{
					echo '<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <a href="?'.$_SERVER['QUERY_STRING'].'" ><button type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
								        <h4 class="modal-title" id="myModalLabel">Insertion Failure</h4>
								      </div>
								      <div class="modal-body">
								        <b>Sbject could not be assigned</b>
								        <br/>Class does not exist in the database <br/> OR <br/> Insertion Error

								      </div>
								      <div class="modal-footer">
								       
								        <a href="?'.$_SERVER['QUERY_STRING'].'" ><button type="button"  class="btn btn-primary">OK</button></a>
								      </div>
								    </div>
								  </div>
								</div>';

					echo "<script type=\"text/javascript\">$('#modal3').modal();</script>";

			}
		}

        
    ?>
        
  </body>
</html>