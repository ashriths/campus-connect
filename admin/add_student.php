<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
}
if(!($_SESSION['type']=='deptadmin')){
    Redirect::redirectTo($rp.'home.php');
}
$u = $user->getTableDetailsbyId('deptadmin','userId',$_SESSION['id']);
//print_r($u);
$k = $user->getTableDetailsbyId('user','userId',$_SESSION['id']);
$u=array_merge($u,$k);

if(!isset($_POST['email'])){
  echo 'false<br>';
  exit;
}
$result = $user->addStudent($_POST['email'],$_POST['name'],$_SESSION['add_classId']);
if($result) echo 'true';
else echo 'false';
echo '<br>';

?>