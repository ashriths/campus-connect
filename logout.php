<?php 
$rp = "./";
require_once $rp.'redirect.php';
	include_once $rp.'php/function.php';
	include_once $rp.'php/design.php';
	
$session->destroySession();
	Redirect::redirectTo($rp);
	?>