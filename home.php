<?php
  require_once('redirect.php');
  include_once $rp.'php/function.php';
  $rp = './';

  if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
  }
  if($_SESSION['type']=='teacher'){
    Redirect::redirectTo($rp.'faculty');
  }
  else if($_SESSION['type']=='deptadmin'){
    Redirect::redirectTo($rp.'admin');
  }
  else{
    Redirect::redirectTo($rp.'student');
  }
 ?>