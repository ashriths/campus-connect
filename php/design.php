<?php


class Design{

	public function getIncludeFiles($rp){


		echo '<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  

    <!-- Bootstrap -->
    <link href="'.$rp.'css/bootstrap.min.css" rel="stylesheet">
    <link href="'.$rp.'/grid.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="'.$rp.'css/bootstrap.css" rel="stylesheet">
   
    <style id="holderjs-style" type="text/css"></style>
    <![if !IE]>
    <link href="'.$rp.'css/pace.css" rel="stylesheet">
      <script type="text/javascript" src="'.$rp.'js/pace.js" ></script>
    <![endif]>
      
   
    
     <!-- Just for debugging purposes. Don\'t actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="'.$rp.'js/modernizr-latest.js" ></script>
    <!-- sticky footer -->' ;

	}

	public function getStudentNavbar($rp,$active,$usn){
    echo ' <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="link" href="'.$rp.'student"><img style="wigth:40pt; height:40pt; float:left"; atl="bmslogo" src="'.$rp.'/img/bms-logo.png"></a>
          <a class="link navbar-brand" href="'.$rp.'student">'.$usn.'</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li '; if($active==0) echo 'class="active"'; echo '><a class="link" href="'.$rp.'student">Home</a></li>
             <li '; if($active==1) echo 'class="active"'; echo '><a class="link" href="marks.php">Marks</a></li>
             <li '; if($active==2) echo 'class="active"'; echo '><a class="link" href="attendance.php">Attendance</a></li>
             <li '; if($active==3) echo 'class="active"'; echo '><a class="link" href="proctor.php">Proctor</a></li>
            <li class="'; if($active==4) echo 'active';  echo ' dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Archive <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a class="link" href="#">Notes</a></li>
                <li><a class="link" href="#">Question Papers</a></li>
                <li><a class="link" href="#">Syllabus Copy</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b>&nbsp;<span class="glyphicon glyphicon-cog"></span>&nbsp;Account</a>
              <ul class="dropdown-menu">
                <li ><a class="link" href="'.$rp.'/logout.php">&nbsp;Logout</a></li>
                <li class="divider"></li>
                <li><a class="link" href="#">Edit Profile</a></li>
                <li><a class="link" href="#">Settings</a></li>
                <li><a class="link" href="#">Privacy</a></li>
                <li class="divider"></li>
                <li><a class="link" href="#">Help</a></li>
                <li><a class="link" href="#">Report a Problem</a></li>
              </ul>
            </li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>';
		/*echo '<div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container" style="font-size:13pt;">
        <div class="navbar-header" >
          <!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">-->
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="http://www.bmsce.in/"><img style="wigth:40pt; height:40pt; float:left"; atl="bmslogo" src="'.$rp.'/img/bms-logo.png"></a>
          <a class="navbar-brand" href="#"> &nbsp &nbsp '.$usn.'</a>
         <!-- <sup>Logged IN</sup> -->
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav" >
      
        <li '; if($active==0) echo 'class="active"'; echo '><a href="home.php">Home</a></li>
      
        <li '; if($active==1) echo 'class="active"'; echo '><a href="marks.php">Marks</a></li>
        
        <li '; if($active==2) echo 'class="active"'; echo '><a href="attendance.php">Attendance</a></li>
        
        <li '; if($active==3) echo 'class="active"'; echo '><a href="proctor.php">Proctor</a></li>
            
        <li '; if($active==4) echo 'class="active"'; echo '><a href="#notes">Notes</a></li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Syllabus<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#syllabuscopy">Sylabus Copy</a></li>
                
                  <li class="divider"></li>
                <!--<li class="dropdown-header">Nav header</li>-->
                <li><a href="#quisportion">Quiz Portion</a></li>
                <li><a href="#testportion">Test Portion</a></li> 
              </ul>
            </li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#editprofile">Edit Profile</a></li>
                <li><a href="#changepassword">Change Password</a></li>   
              </ul>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div> '; */
	}

  function getJSIncludes($rp){
    echo '
    <div class="loading" >
  <div class="pace-static pace-static-active">
    <div class="pace-static-progress">
      <div class="pace-static-progress-inner">
      </div>
    </div>
    <div class="pace-static-activity">
    </div>
  </div>
  </div>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="'.$rp.'js/bootstrap.js"></script>  
    <script>
    $(\'.link\').click(function(e){
      e.preventDefault();
      $(\'.loading\').fadeIn( "fast" ).delay(1000);
      window.location.href=this.href;
    });
  </script>
    ';
  }

}
$design = new Design();
?>