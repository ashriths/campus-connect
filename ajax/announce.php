<?php
$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}

if(!isset($_POST['type'])){
  echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Error. Announcement could not be made.</div>';
  exit;
}

switch($_POST['type']){
	case 'class':	
					if(! (  isset($_POST['content'])  &&  isset($_POST['to'])   )){
						echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Error. Announcement could not be made.</div>';
						exit;
					}
					$r = $user->addClassNotification($_POST['to'],$_POST['content']);
					if(!$r){
						echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Error. Announcement could not be made.</div>';
						exit;
					}
					else{
						echo '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Success. Announcement was made. <a href="notification.php?id='.$r.'">Edit or Delete ?</a></div>
							<div class="well well-sm">'.$_POST['content'].'</div>
						';
						exit;
					}


}



?>