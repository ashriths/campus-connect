<?php

$rp = '../';
require ($rp.'redirect.php');
require($rp.'php/design.php');
require($rp.'php/function.php');

?><!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    $design->getIncludeFiles($rp);
    ?>


      <title>Template | BMSCE Campus</title>
  
   
  </head>
  <body style="padding-top:35px">
    <!-- Navbar -->
    <?php
      $design->getStudentNavbar($rp,0,'1BMXXXXXXX',0,0);
    ?>
    
    <hr />
    <div class="container ">
      
       <!-- Elements of the page comes here -->
      
        
    </div>
        
   



    <!-- Footer -->
    <div class="container-fluid" style="margin-top:40pt;" >
   
      <div class="container" >
        <div class="well">
        <p class="text-muted">&copy; 2014 All Rights reserved.</p>
        </div>
      </div>
    </div>

    <?php
        $design->getJSIncludes($rp);
    ?>
        
  </body>
</html>