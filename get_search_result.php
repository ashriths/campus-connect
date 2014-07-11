<?php

$rp = './';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}


$u = $user->getTableDetailsbyId('user','userId',$_SESSION['id']);

if(!isset($_GET['q'])){
  echo '<li>error...</li>';
  exit;
}
$q = urldecode($_GET['q']);
$rp = urldecode($_GET['rp']);
//echo $q;
$info = $user->searchAll($q);

if(count($info)==0){
	echo '<li> No Matches found</li>';
	exit;
}
$max = 3;
$students = array();
$teachers=array(); 
$events= array();

		foreach ($info as $key => $value) {
			switch($value['table']){
				case 'user':
						switch($value['type']){
							case 's':
								 $students[] = $value;
							 	break;
							 case 't':
							 	 $teachers[] = $value;
							 	break;
						}
					break;
				case 'student':
						 $students[] = $value;
					break;
				case 'teacher':
						$teachers[] = $value;
					break;
				case 'event':
						$events[] = $value;
					break;
			}
		}
		$sno = count($students);
		if($sno>0){
			echo '<li class="divider"></li><li style="display:inline-flex;" class="dropdown-header">Students <a class="pull-right" href="'.$rp.'search.php?type=student&q='.urlencode($q).'"><button class="pull-right btn btn-xs">Show All</button></a></li>';
			if($sno>$max)$sno=$max;
			for($i=0;$i<$sno;$i++){
				echo '<li><a href="'.$rp.'profile.php?id='.$students[$i]['userId'].'">
						<div class="media">
				              <div class="pull-left" >
				                <img class="media-object" height="30px" width="30px" src="'.$students[$i]['pic'].'" alt="...">
				              </div>
				              <div class="media-body">
				               '.$students[$i]['name'].' 
				              </div>              
			             </div></a>
					</li>
				';
				}

		}
		$sno = count($teachers);
		if($sno>0){
			echo '<li class="divider"></li><li style="display:inline-flex;" class="dropdown-header">Faculties <a class="pull-right" href="'.$rp.'search.php?type=faculty&q='.urlencode($q).'"><button class="btn btn-xs">Show All</button></a></li>';
			if($sno>$max)$sno=$max;
			for($i=0;$i<$sno;$i++){
				echo '<li><a href="'.$rp.'profile.php?id='.$teachers[$i]['userId'].'">
						<div class="media">
				              <div class="pull-left" >
				                <img class="media-object" height="30px" width="30px" src="'.$teachers[$i]['pic'].'" alt="...">
				              </div>
				              <div class="media-body">
				                '.$teachers[$i]['name'].'
				              </div>              
			             </div></a>
					</li>
				';
			}
		}

	?>