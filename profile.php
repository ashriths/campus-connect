<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_GET['id']){

    Redirect::redirectTo($rp.'404.php');
}
$id= $_GET['id'];
$k = $user->getTableDetailsbyId('user','userId',$id);

?>