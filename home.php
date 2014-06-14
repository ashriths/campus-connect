<?php
  require_once('redirect.php');
  $rp = './';
  if(!isset($_SESSION['id'])){
    Redirect::redirectTo($rp.'login.php');
  }
  if($_SESSION['type']=='teacher'){
    Redirect::redirectTo($rp.'teacher');
  }
  else{
    Redirect::redirectTo($rp.'teacher');
  }
 ?>