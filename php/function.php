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
		$result = $db ->query($sql);
		if(!$result)
		{
			die('Error'>$db->error);
		}

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

	/* acquire subjectid and classid
		update_getNames() will just get u the students

		execute a call to updateAttendance with subjectid and userid to increment attendance

		*/
	public function update_getNames($assArray)
	{
		$db = User::setupDatabase();
		$sql = "select userId, usn, name from student where classId =".$assArray['classId']." order by(usn)";
		$students = $this -> doQuery($sql);

		return $students;
	}
	

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