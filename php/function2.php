<?php
require_once('dbconfig.php');

class User{
	
	public static function setupDatabase(){
		$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if($db->connect_errno>0){
			die('Error:'.$db->connect_error.' ');
		}
		return $db;
	}

	public function addUser($name,$usn,$password){
		$db = User::setupDatabase();
		$name = $db->real_escape_string($name);
		$usn = $db->real_escape_string($usn);
		$password = $db->real_escape_string($password);
		$hashedPassword = sha1($password);
		$sql = "INSERT INTO student (name, usn ,password) VALUES ('$name', '$usn','$hashedPassword')";
		$result = $db->query($sql);
		if(!$result){
			die('Error:'.$db->error);
		}
		$id = $db->insert_id;
		return $id;
	}


	public function authenticate($email,$password){
		$db = User::setupDatabase();
		$email = $db->real_escape_string($email);
		$password = $db->real_escape_string($password);
		$hashedPassword = sha1($password);
		$sql = "SELECT * FROM user WHERE email = '$email'";
		//echo $sql;
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		if($result->num_rows==1){
			//echo 'User Exists<br/>';
			$user=$result->fetch_assoc();
			//print_r($user);
			if($user['password']==$hashedPassword){
				//user exists
				//echo 'User Entered Correct Password';
				return array('result'=>1,'type'=>$user['type'],'userId'=>$user['userId']); 
				
			}
			else{
				//echo 'User Entered Wrong password';
				return array('result'=>0,'message'=>'Hey '.$user['name'].' you didn\'t enter your coreect password.'); 
			}
		}
	
		//echo 'User Not Found anywhere';
		return array('result'=>0,'message'=>'We don\'t recognize your email. Please chack again.'); 
		
	}



	public function getUnreadNotificationNumber(){
		$db = User::setupDatabase();
		$uid= $_SESSION['id'];
		$notifications['notifications'] = array();
		$i=0;

		if($_SESSION['type']=='student'){
			$student = $this->getTableDetailsbyId('student','userId',$uid);
			$pid = $student['proctorId'];
			$sql = "SELECT * FROM proctornotification WHERE proctorId = $pid";
			$result = $db->query($sql);
			if(!$result){	
				die('Error:'.$db->error);
			}
			//return multiple rows when query fetches more than one
			
			if(mysqli_num_rows($result)>=1){
			$rows = array();
	    		while($row = $result->fetch_assoc()) {
	       			 $notifications['notifications'][] = $row;
	    		}
			}
		}
		$notifications['total'] = count($notifications['notifications']);
		return $notifications['total'];
		
	}

	public function getUnreadNotifications(){
		$db = User::setupDatabase();
		$uid= $_SESSION['id'];
		$notifications['notifications'] = array();
		$i=0;

		if($_SESSION['type']=='student'){
			$student = $this->getTableDetailsbyId('student','userId',$uid);
			$pid = $student['proctorId'];
			$sql = "SELECT * FROM proctornotification WHERE proctorId = $pid";
			$result = $db->query($sql);
			if(!$result){	
				die('Error:'.$db->error);
			}
			//return multiple rows when query fetches more than one
			
			if(mysqli_num_rows($result)>=1){
			$rows = array();
	    		while($row = $result->fetch_assoc()) {
	       			 $notifications['notifications'][] = $row;
	    		}
			}
		}
		$notifications['total'] = count($notifications['notifications']);
		return $notifications;
	}

	public function getUnreadMsgNumber(){
		$db = User::setupDatabase();
		$uid= $_SESSION['id'];
		$sql = "SELECT * from message where (toId = $uid AND seen = '0000-00-00 00:00:00')";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		return mysqli_num_rows($result);
	}

	//returns details ofa table searched with nonkey value
	public function getTableDetailsbyNonId($table,$att,$nid)
	{
		$db = User::setupDatabase();
		$sql = "SELECT * FROM $table WHERE $att = '$nid'";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		//return multiple rows when query fetches more than one
		
		if(mysqli_num_rows($result)>1){
		$rows = array();
    		while($row = $result->fetch_assoc()) {
       			 $rows[] = $row;
    		}
		return $rows;
		} 
		$result = $result ->fetch_assoc();
		return $result;
	}
	//generic function param(tablename,attribute,value)
	public function getTableDetailsbyId($table,$att,$id){
		$db = User::setupDatabase();
		$sql = "SELECT * FROM $table WHERE $att = '$id'";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		
		//by id cant return multiple rows ever cos its by id
		$result = $result->fetch_assoc();
		return $result;

	}


	//getGradebySemAndSub()

	public function getGradebySemAndSub($sem,$sub)
	{
		$db = User::setupDatabase();
		$sql = "SELECT * from oldgrades where (subjectId = $sub AND sem = $sem)";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		//for returning multiple rowsß
		
		
		if(mysqli_num_rows($result)>1){
		$rows = array();
    		while($row = $result->fetch_assoc()) {
       			 $rows[] = $row;
    		}
		return $rows;
		} 
		$result = $result->fetch_assoc();
		return $result;

	}

	/*
	public function getTableDetailsby2Id($table$idname1,$id1,$idname2,$id2)
	{
		$db = User::setupDatabase();
		$sql = "SELECT * from  where (subjectId = $sub AND sem = $sem)";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}

	}
	*/	

	
	public function doQuery($sql)//execute a string based query
	{
		$db =User::setupDatabase();
		$result = $db ->query($sql) or die("error: ".$db->error);
		

		if(mysqli_num_rows($result)>1){
		$rows = array();
    		while($row = $result->fetch_assoc()) {
       			 $rows[] = $row;
    			// print_r($row);
    			// echo "<br/>";
    		}

		return $rows;
		} 
		
		$result = $result ->fetch_assoc();
		return $result;


	}

	public function getMyAttendance($userId)
	{
		$db = User::setupDatabase();
		$student = $this->getTableDetailsbyId('student','userId',$userId);
		
		// get his class and hence his semester
		$classId = $student['classId'];
		$class = $this->getTableDetailsbyId('class','classId',$classId);
		$sem = $class['sem'];
		
		// get all subjects That are there for the semester
		$subjects = User::getSubjectsBySem($sem);
		$rows = array();
		//foreach subject get his attendance if he has attendaed any classes
		foreach ($subjects as $key => $value) {
			$subjectId = $value['subjectId'];
			$result = $this -> doQuery("SELECT * FROM attendance where userId = $userId and subjectId=$subjectId");
			$row['subjectName']=$value['subjectName'];
			$row['subjectId']=$subjectId;
			$row['classesAttended'] = $result['classesAttended'];
			
			// Get total number of classes
			$result = $this->doQuery("SELECT * FROM teachersubject where classId = $classId and subjectId=$subjectId");
			$row['totalClasses'] = $result['totalClasses'];
			$rows[] = $row;
		}
		return $rows;
		// obsolute untill needed
		// //obtain classId frm student
		// $result1 = $this->getTableDetailsbyId('student','userId',$userId);
		// #$arr['classId'] = $result1['classId'];

		
		// //query using classId to get all subjectId s
		// $result2 = $this -> getTableDetailsbyNonId('teacherSubject','classId',$result1['classId']);
		// //store in a named array

		// print_r($result2);
		// $i=0;
		// foreach ($result2 as $key => $value) 
		// {
				
		// 				# code...
		// 			$subjectId = $value['subjectId'];
		// 			$sql = "SELECT * FROM attendance WHERE subjectId = $subjectId and userId = $userId";
		// 			$result = $db->query($sql);
					
					
		// 			$result = $result->fetch_assoc();
		// 			$result3 = $this->getTableDetailsbyId('subject','subjectId',$result['subjectId']);

		// 			$arr[$i++] = array('totalClasses' => $result['totalClasses'],'classesAttended' => $result['classesAttended'], 'name' => $result3['subjectName']);

				
			
		// }
		// return $arr;
	}  

	public function sendMessage($to, $msg){
		$db = User::setupDatabase();
		$msg = $db->real_escape_string($msg);
		$from = $_SESSION['id'];
		$sql = "INSERT INTO message (fromId, toId ,content) VALUES ($from, $to,'$msg')";
		$result = $db->query($sql);
		if(!$result){
			die('Error:'.$db->error);
		}
		$id = $db->insert_id;
		return $id;
	}
	public function getGradebySem($sem,$uid)//query oldGrades table return * from oldgrades + subject name and code +[credits]
	{
		$db = User::setupDatabase();
		$sql = "SELECT * from oldgrades where (sem = $sem AND userId=$uid)";
		//all subject codes returned for a particular sem
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		//for returning multiple rowsß
		
		
		if($result->num_rows>=1){
			$rows = array();
    		while($row = $result->fetch_assoc()) {
       			 
    			// query subject table o find subjename and code...add these to query on oldgrades
       			 $result2 = $this ->getTableDetailsbyId('subject','subjectId',$row['subjectId']);


       			 	//row already has query from oldgrades..add more key,value pairs
       			 $row['subjectName'] = $result2['subjectName'];
       			 $row['subjectCode'] = $result2['subjectCode'];
       			 $row['credits'] = $result2['credits'];  
       			// print_r($row);echo '<br/>';
       			 //
       			 $rows[] = $row;
    		}
			return $rows;
		} 
		

		return array();

	}

	public function getSGPA($userId,$sem){
		$result = $this -> doQuery("SELECT * from studentsem where userId =$userId and sem=$sem");
		return $result['sgpa'];
	}
	
	//requires dept field to disambiguate
	public function getSubjectsBySem($sem){
		$result = $this -> doQuery("SELECT * from subject where sem =$sem");
		return $result;
	}


	public function getMarksByType($userId, $subjectId, $examType){
		$result = $this -> doQuery("SELECT score from marks where userId =$userId and subjectId=$subjectId and examTypeId=$examType");
		return $result['score'];
	}

	public function getCIE($userId,$subjectId){
		$result = $this -> doQuery("SELECT score from marks where userId =$userId and subjectId=$subjectId ");
		//return $result;
		$total =0;
		if(count($result)>1){
			for($i=0;$i<count($result);$i++){
				
				$total+=$result[$i]['score'];
			}
		}elseif(count($result)==1){
			$total = $result['score'];
		}
		return $total;
	}

	public function getMyGrades($userId)//current marks... returns (userId,subjectName,examName,code,score,maxMarks)
	{
		
		$db=User::setupDatabase();
		
		//obtain user details -classId
		$result1 = $this->getTableDetailsbyId('student','userId',$userId);
		
		//obtain subjectId for particular user		
		$result2 = $this -> getTableDetailsbyNonId('teacherSubject','classId',$result1['classId']);
		


		
		$i=0;
		#echo "<br/><br/>";
		foreach ($result2 as $key => $value) //loop for each subjectId that the user has
		{
			//using userId and subject id obtain score examTypeId from marks..will return multiple rows
			
			#$result3 = $this -> getTableDetailsbyId('marks','subjectId',$value['subjectId']);
			$result3 = $this -> doQuery('SELECT * from marks where userId ='.$userId.' and subjectId='.$value['subjectId']);

			//obtain maxScore and examName from examType table
			$result4 = $this -> getTableDetailsbyId('examType','examtypeId',$result3['examtypeId']);
			
			//get name of the subject
			$result5 = $this ->getTableDetailsbyId('subject','subjectId',$value['subjectId']);


			$arr[$i++] = array('userId' => $result1['userId'] ,'subjectName' =>$result5['subjectName'] ,
								'score' =>$result3['score'] , 'examName' => $result4['name'] ,
								'maxMarks' => $result4['maxMarks'] );
			//userId is gona repeat for every row..cn choose not to send it


		}
		return $arr;

	}



	//functions for teachers
	public function getSubjectsTaught($tid)
	{   
		// part 1 of function
		//returns subject name and class section and sem eg webprogramming 6 A +other details
		//display this and ask to select any one ...den send (classId and subjectId) and query further


		$db =User::setupDatabase();
		$allsubjects = $this -> getTableDetailsbyNonId('teachersubject','teacherid',$tid);
		
		foreach ($allsubjects as $key => $value) {
			
			$subject = $this -> getTableDetailsbyNonId('subject','subjectId',$value['subjectId']);
			$value['subjectName'] = $subject['subjectName'];
			$value['subjectCode'] = $subject['subjectCode'];
		
			$class = $this -> getTableDetailsbyNonId('class','classId',$value['classId']);
			$value['className'] = $class["sem"]." ".$class['section']." ";
			$allsubjects[$key] = $value;
			
		}
		// Array ( [teacherid] => 2 [subjectId] => 17 [classId] => 1 [totalClasses] => 20 [subjectName] => Computer Networks [subjectCode] => 10CI5GCCON [className] => 6 A ) 
		//pass one array from $allsubjects as $assArray
		return $allsubjects;
	} 

	public function getStudentAttendance($assArray)
	{
		// part 2
		// query student with classid and obtain list of all studnets ,,,order by usn
		//query attemdamce with userid
		// print_r($assArray);
		// echo "<br/>";
		$db = User::setupDatabase();
		$sql = "select userId, usn, name from student where classId =".$assArray['classId']." order by(usn)";
		$students = $this -> doQuery($sql);

		foreach ($students as $key => $value) {
			$sql = "select * from attendance where userId =".$value['userId']." and subjectId =".$assArray['subjectId'];
			$attendance = $this -> doQuery($sql);	
		
			$value['classesAttended'] = $attendance['classesAttended'];
			$students[$key] = $value;
			// print_r($value);
			// echo "<br/>";
		}
		// Array ( [userId] => 5 [usn] => 1BM11CS012 [name] => alta soni [classesAttended] => 20 ) 

		return $students;

	}

	public function getStudentMarks($assArray)
	{

		
		
		$db = User::setupDatabase();
		$sql = "select userId, usn, name from student where classId =".$assArray['classId']." order by(usn)";
		$students = $this -> doQuery($sql);
		
		foreach ($students as $key => $value) {
			$sql = "select * from marks where subjectId =".$assArray['subjectId']." and userId =".$value['userId']." ";
			$marks = $this -> doQuery($sql);  
			
			if($marks)
			{
				//if user data is found...obviously user will be there...while testing it wasnt
				$value['marksarray'] = $marks;
				// print_r($marks);
				// echo "<br/>";
				$students[$key]=$value;
			}
			else
			{
				//when user data dosnt exists
				// echo "<br/>not found userId=>".$value['userId'];

			}

		}
		//$value['marksarray'] is a 2d array ...traverse it using double foreach
			
		return $students;
	}




	public function getStudentsUndermyProctorship(){
		$uid = $_SESSION['id'];
		$students = $this->doQuery("SELECT * FROM student WHERE proctorId = $uid");
		return $students;
	}

	public function addProctorMeeting($datetime,$issue){
		$db = User::setupDatabase();
		$pid = $_SESSION['id'];
		$sql = "INSERT INTO proctormeeting (proctorId, timestamp ,issue) VALUES ($pid, '$datetime','$issue')";
		$result = $db->query($sql);
		if(!$result){
			die('Error:'.$db->error);
		}
		$id = $db->insert_id;
		$sql = "INSERT INTO notification (type, timestamp) VALUES ('proctor', NOW())";
		$result = $db->query($sql);
		if(!$result){
			die('Error:'.$db->error);
		}
		$id2 =  $db->insert_id;
		$sql = "INSERT INTO proctornotification (id, proctorId ,content) VALUES ($id2,$pid, 'Your proctor scheduled a proctor meeting on $datetime')";
		$result = $db->query($sql);
		if(!$result){
			die('Error:'.$db->error);
		}
		return $id;
	}

	public function removeProctorMeeting($id){
		$db = User::setupDatabase();
		$pid = $_SESSION['id'];
		$sql = "DELETE FROM proctormeeting WHERE id = $id";
		$result = $db->query($sql);
		if(!$result){
			die('Error:'.$db->error);
		}
		return $result;
	}

	public function getScheduledProctorMeetingsByProctorId($pid){
		$db = User::setupDatabase();
		$sql = "SELECT * from proctormeeting where (proctorId = $pid AND timestamp >= NOW()) ORDER BY timestamp";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		$num = mysqli_num_rows($result);
		if($num<1){
			return array('total'=> 0 ,'meetings'=>null);
		}else if($num==1){
			$meetings = $this->doQuery("SELECT * from proctormeeting where (proctorId = $pid AND timestamp >= NOW()) ORDER BY timestamp");
			return array('total'=>$num, 'meetings'=>array(0=>$meetings));
		}else{
			$meetings = $this->doQuery("SELECT * from proctormeeting where (proctorId = $pid AND timestamp >= NOW()) ORDER BY timestamp");
			return array('total'=>$num, 'meetings'=>$meetings);
		}

	}

	public function getOldProctorMeetingsByProctorId($pid){
		$db = User::setupDatabase();
		$sql = "SELECT * from proctormeeting where (proctorId = $pid AND timestamp <= NOW()) ORDER BY timestamp";
		$result = $db->query($sql);
		if(!$result){	
			die('Error:'.$db->error);
		}
		$num = mysqli_num_rows($result);
		if($num<1){
			return array('total'=> 0 ,'meetings'=>null);
		}else if($num==1){
			$meetings = $this->doQuery("SELECT * from proctormeeting where (proctorId = $pid AND timestamp <= NOW()) ORDER BY timestamp");
			return array('total'=>$num, 'meetings'=>array(0=>$meetings));
		}else{
			$meetings = $this->doQuery("SELECT * from proctormeeting where (proctorId = $pid AND timestamp <= NOW()) ORDER BY timestamp");
			return array('total'=>$num, 'meetings'=>$meetings);
		}
	}



		//execute a call to updateAttendance with subjectid and userid to increment attendance

	
	public function update_getNames($assArray)
	{
		$db = User::setupDatabase();
		$sql = "select userId, usn, name from student where classId =".$assArray['classId']." order by(usn)";
		$students = $this -> doQuery($sql);

		return $students;
	}
//>>>>>>> origin/master
	

	//call updateAttendance each time for every studnt in class
	public function updateAttendance($subjectId,$userId,$bool)
	{
		$db = User::setupDatabase();
		if($bool){
			
			$sql = "update attendance set classesAttended = (classesAttended + 1) where subjectId=".$subjectId." and userId=".$userId." ";
			$result = $db -> query($sql);
		}
		else{
			
			$sql ="insert into absentees (userId , subjectId) values ( ".$userId.' ,'.$subjectId.' ) ';
			$result = $db -> query($sql) or die("error updating");
		}
			//no error codes returned
	}

	public function updateMarks($userId,$subjectId,$examtypeId,$newmarks){

		$db= User::setupDatabase();

		//obtain max score 
		$sql = "SELECT * from examtype where examtypeId=".$examtypeId." ";
		$result = $this -> doQuery($sql);
		// print_r($result);

		if($newmarks > $result['maxMarks'])
		{
			echo " Error...entered score higher than max score";
		}
		else
		{
			//query marks to check if we hav to insert or update
			$sql ="select * from marks where userId=".$userId." and subjectId=".$subjectId." and examtypeId=".$examtypeId;
			$result = $this ->doQuery($sql);
			if($result)
			{	//if table exists we do an update
				// echo "updating";
				$sql = "update marks set score=".$newmarks." where userId=".$userId." and subjectId=".$subjectId." and examtypeId=".$examtypeId;
				$success = $db -> query($sql) or die("error ".$db->error);
				if(!$success)
				{  echo "error on update/insert";  }
			}
			else
			{
				//record dosnt exists...insert into marks
				// echo "inserting";
				$sql = "insert into marks values(".$userId." , ".$subjectId." , ".$newmarks." , ".$examtypeId." )";
				$res = $db ->query($sql);
				if(!$res)
					{	echo "error or update/insert";  }
			}
		}
	}

	public function getDeptNamefromId($id){
		$result = $this -> getTableDetailsbyId('dept','deptId',$id);
		return $result['name'];
	}

	public function getEvents()
	{
		//list all kinds of events 

		$db = User::setupDatabase();

		// get all dept events
		$sql = "SELECT * from event where type='dept' order by (datetime)";
		$result = $db->query($sql);
		$num = mysqli_num_rows($result);
		if($num<1){
			$ev =  array('total'=> 0 ,'events'=>null);
		}else if($num==1){
			$meetings = $this->doQuery("SELECT * from event where type='dept' order by (datetime)");
			$ev  = array('total'=>$num, 'events'=>array(0=>$meetings));
		}else{
			$meetings = $this->doQuery("SELECT * from event where type='dept' order by (datetime)");
			$ev = array('total'=>$num, 'events'=>$meetings);
		}

		
		// get open events
		$sql = "SELECT * from event where type='open' order by (datetime)";
		$result = $db->query($sql);
		$num = mysqli_num_rows($result);
		if($num==1){
			$meetings = $this->doQuery("SELECT * from event where type='open' order by (datetime)");
			$i = $ev['total']+=1;
			 $ev['events'][$i-1]=$meetings;
		}else{
			$meetings = $this->doQuery("SELECT * from event where type='open' order by (datetime)");
			$ev['total']+=$num;
			 $ev['events']+=$meetings;
		}

		// print_r($result);
		return $ev;

	}
	public function getEventDetails($id)
	{
		$db = User::setupDatabase();
		$sql = "SELECT * from collegeevents where eventId=".$id;
		$result = $this ->doQuery($sql);

		$sql = "select name from dept where deptId=".$result['deptId'];
			$res = $this ->doQuery($sql);
		$result['deptName'] = $res['name'];
		return $result;

	}			
	public function allDepts()
	{
		$result = $this -> doQuery("SELECT * from dept");
		foreach ($result as $key => $value) {
			echo "<br/>";
			print_r($value);
		}
	}
	

	//admin functions

	public function sendEmail($email)
	{
		date_default_timezone_set("Asia/Calcutta");
		$date = date("Y-m-d H:i:s");
		
		//now send mail
		$message = $date."\nHi,\nYou hav been registered for Campus_connect bla bla bla.\n".
					"Your login ID is your email and password is 12345.\nSign in at www.bmsapp.tk.\nIniti".
					"alize the awesomeness.\nThank You";

		$headers = 'From: admin@campus_connect.com' . "\r\n" .
    			   'Reply-To: admin@campus_connect.com' . "\r\n" .
    			   'X-Mailer: PHP/' . phpversion();

		$mailres = mail($email,"Welcome to Campus Connect\r\n",$message,$headers);
		// echo "<br/>::::::mail respone :$email=$mailres:::::";


	}

	//to be used by admin to add teachers to database
	public function addTeacher($email,$name,$password,$deptId)
	{
		 // bool mysqli_autocommit ( mysqli $link , bool $mode )
		$db = User::setupDatabase();
		$res= $db -> autocommit(FALSE);
		
	

		//prepare data and insert row into user table
		$password='12345';
		$pass = sha1($password);
		$type = 't';

		$sql = "INSERT into user(type,email,password) values('$type','$email','$pass')";
		$result = $db ->query($sql) or die("error:".$db->error);
		// $db->commit();
		
		if($result)
		{
			//if insertion successful insert into teacher table
			//obtain userId 
			$sql = "SELECT userId from user where email='$email'";
			$result = $db -> query($sql) or die("error: ".$db->error);
			$result = $result->fetch_assoc();
			// print_r($result);
			$sql = "INSERT into teacher values(".$result['userId'].",'$name',$deptId)";
			$result = $db ->query($sql) or die("error: ".$db->error);
			if($result)
			{
				User::sendEmail($email);
				$db->commit();
				$db -> autocommit(TRUE);
				return TRUE;
			}
			else
			{
				$db->rollback();	
			}
		}
		else
		{
			$db->rollback();
		}
		$db -> autocommit(TRUE);
		return FALSE;

		//everthing went well
		
	}

	
	public function addStudent($email,$password,$name,$usn,$classId)
	{
		$db= User::setupDatabase();
		$db->autocommit(FALSE);
		$password ="12345";
		$pass=sha1($password);
		$type = 's';
	
		$sql = "INSERT into user(type, email, password) values('$type','$email','$pass')";
		$result = $db->query($sql) or die("Error: ".$db->error);

		if($result)
		{
			$sql = "SELECT userId from user where email='$email'";
			$result = $db -> query($sql) or die("error: ".$db->error);
			if(mysqli_num_rows($result)>1)
				{	$db->rollback();
					$db->autocommit(TRUE);
					return;
				}

			$result = $result->fetch_assoc();
			// print_r($result);
			$sql = "INSERT into student(userId, usn, name, classId) values(".$result['userId'].",'$usn','$name',$classId)";
			$result = $db ->query($sql) or die("error: ".$db->error);
			if($result)
			{
				$this->sendEmail($email);
				$db->commit();
				$db -> autocommit(TRUE);
				return TRUE;

			}
			else
			{
				$db->rollback();	
			}
		}
		else
		{
			$db->rollback();
		}
		$db -> autocommit(TRUE);
		return FALSE;
	}
	
	//accept no of students to ba assigned and userId of teacher
	//query and find students without proctors,,assign proctorId field
 	
 	public function assignProctors($size,$proctorId,$deptId)
 	{
 		$db = User::setupDatabase();
 		//students without proctors in a particular dept
 		$sql = "update student set proctorId=$proctorId where (proctorId IS NULL and classID in" . 
 			   "(SELECT classId from class where deptId=$deptId)) LIMIT $size";
 		$result = $db->query($sql);
 		// print_r($uid);
 		if($result)
 		{
 			return TRUE;
 		}
 		return FALSE;
 	}
 	// returns uid,name  of teachers who are not proctors
 	public function nonProctors($deptId)
 	{
 		$db = User::setupDatabase();
 		$sql ="SELECT userId,name from teacher where userId NOT IN" .
 				"(SELECT proctorId from student where classId IN " .
 				"(SELECT classId from class where deptId=$detId) and proctorId is not NULL)";

		$nonProctors = $this -> doQuery($sql);
		// print_r($nonProctors);
		return $nonProctors;

 	}

 	//dynamic table finctions
 	public function baseStudent($deptId,$sem,$sec="all")
 	{
 		$db = User::setupDatabase();

 		if($sec=="all")
 		{
 			$sql = "select classId from class where deptId = $deptId and sem =$sem";
 		}
 		else
 		{
 			$sql = "select classId from class where deptId = $deptId and sem=$sem and $section = $sec";
 		}
 		
 		$classIds = $this->doQuery($sql);
 		
 		// print_r($classIds); //classids obtained
 		$info = array();
 		foreach ($classIds as $key => $value) {
 			$sql = "select * from student where classId = ".$value['classId'];
 			$baseinfo = $db -> query($sql) or die("error: ".$db->error);
 			
 			foreach ($baseinfo as $key2 => $value2) {
 				$info[] = $value2;
 				// echo "<br/>$key2::<br/>";
 				// print_r($value2);
 			}
 		}
 		return $info;
 	}
 	//pass  $baseinfo[][] as array(0 => array(userid['classId'] => 1))
 	//returns $baseinfo with sem and section
 	public function plusSemAndSection($baseinfo)
 	{
 		$db = User::setupDatabase();
 		
 		foreach ($baseinfo as $key => $value) {
 			$sql = "select sem,section from class where classId=".$value['classId'];
 			$semsec = $this ->doQuery($sql);
 			// print_r($semsec);
 			// echo "<br/>";
 			$baseinfo[$key]['sem'] = $semsec['sem'];
 			$baseinfo[$key]['section'] =$semsec['section'];
 			// print_r($baseinfo[$key]);
 		}
 		return $baseinfo;


 	}
 	
 	//pass baseinfo ,returns baseinfo with deptname
 	public function plusDept($baseinfo)
 	{
 		$db = User::setupDatabase();

 		foreach ($baseinfo as $key => $value) {
 			$sql = "select name from dept where deptId in (select deptId from class where classId=".$value['classId'].")";
 			$depts = $this ->doQuery($sql);
 			// echo "<br/>";
 			$baseinfo[$key]['deptName'] = $depts['name'];
 			
 		}
 		return $baseinfo;

 	}
 	//pass baseinfo  returns baseinfo with email
 	public function plusEmail($baseinfo)
 	{
 		$db = User::setupDatabase();
 		foreach ($baseinfo as $key => $value) {
 			$sql = "select email from user where userId = ".$value['userId'];
 			$email = $this ->doQuery($sql);

 			$baseinfo[$key]['email']= $email['email']	;
 		}
 		return $baseinfo;

 	}
 	public function plusProctor($baseinfo)
 	{
 		$db = User::setupDatabase();
 		foreach ($baseinfo as $key => $value) {
 			
 			$sql = "SELECT name from teacher where userId = ".$value['proctorId'];
 			$proc = $this -> doQuery($sql);
 			$baseinfo[$key]['proctorName'] = $proc['name'];
 		}
 		return $baseinfo;
 	}

 	//>>>>>>>>>>>>>>>>>search functions

 	//suggest for search will narrow down the search asking user to select particular fields
 	public function suggestForSearch()
 	{

 		$suggest = array( 

 			  array('table' => 'user',     'fields' => array('email')),
 			  array('table' => 'student',  'fields' => array('name','usn')),
 			  array('table' => 'teacher',  'fields' => array('name')),
 			  array('table' => 'dept',     'fields' => array('name')),
 			  array('table' => 'examtype', 'fields' => array('name')),
 			  array('table' => 'event' ,   'fields' => array('type', 'name', 'description')),
 			  array('table' => 'subject',  'fields' => array('subjectName','subjectCode')),
 			);

 		
 		return $suggest;
 	}

 	public function genericSearch($string)
 	{
 		$db = User::setupDatabase();
 		$tables = $this ->suggestForSearch();
 		$string = $db->real_escape_string($string);
 		$i=0;

 		

 		foreach ($tables as $key => $value) {
				
			$sql = "select * from ".$value['table']." where ".$value['fields'][0]." like \"%".$string."%\" ";
			
			foreach ($value['fields'] as $key2 => $value2) {
				if($key2 !=0)
				{
					$sql .= " or ".$value2." like \"%".$string."%\" ";
					
				}
			}
			$temp = $db ->query($sql);
			$table = $temp -> fetch_fields();
			//obtain table name
			$table = $table[0]->table;

			$res = $temp-> fetch_all(MYSQLI_ASSOC);

			//accumulate results in one array
			foreach ($res as $key => $value) {
				//assign table name
				$value['table'] = $table;
				$info[$i++] = $value;
				// print_r($value);
				// echo "<br/>";		
			}
 		}
 	
 		return $info;
 	}

 	//update functions.....to be used by admin 
 	//info id an associative array of all fields,name of table and primary key of that table
 	public function updateEntireTable($tablename,$info,$id)
 	{
 		$db = User::setupDatabase();
		$allkeys = array_keys($info);
		// print_r($allkeys);
		$flag = TRUE;
		
 		$sql = "update ".$tablename." set ";
 		foreach ($allkeys as $key => $value) {
 			//for non id keys only
 			if($value != $id)
 			{	if($flag)
 				{
 					$flag = FALSE;
 					$sql .=" ".$value." = '".$info[$value]."' ";
 				}
 				else
					$sql .=", ".$value." = '".$info[$value]."' ";	
 			}
 		}
 		$sql .= " where $id = '".$info[$id]."' ";

 		$result = $db ->query($sql);
 		if(!$result)
 			return $db->error;
 		else
 			return TRUE;

  	}
  	



}

$user = new User();

class Session{

	
	public function createSession($id,$type){
		$_SESSION['id']=$id;
		$_SESSION['type']=$type;
	}
	public function createSessionTemp($var)
	{
		$_SESSION['temp']=$var;
	}

	function __construct(){
		session_start();
	}

	function destroySession(){

		session_destroy();
	} 

}

$session = new Session();

?>