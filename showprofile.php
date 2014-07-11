<?php

$rp = './';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){

	unset($_SESSION['id2']);
    Redirect::redirectTo($rp.'login.php');
}
if(isset($_GET['id']))
{
	$_SESSION['id2']=$_GET['id'];
	$profile = $user ->getTableDetailsById('user','userId',$_GET['id']);
	// echo "here";
}
else
{
	 Redirect::redirectTo($rp.'home.php');
}

if(($_SESSION['type']=='teacher') || ($_SESSION['type']=='student')){
    
	if($profile['type']=='t')
	{
		Redirect::redirectTo($rp.'faculty/profile.php');
	}
	elseif ($profile['type']=='s') {
		Redirect::redirectTo($rp.'student/profile.php');
	}
    

}
else{
   
   if($profile['type']=='t')
	{
		Redirect::redirectTo($rp.'faculty/toadmin.php');
	}
	elseif ($profile['type']=='s') {
		Redirect::redirectTo($rp.'student/toadmin.php');
	}
}

?>
