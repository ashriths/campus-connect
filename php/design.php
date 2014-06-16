<?php


class Design{

	public function getIncludeFiles($rp){


		echo '<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  

    <!-- Bootstrap -->
    <link href="'.$rp.'css/bootstrap.min.css" rel="stylesheet">
    <link href="'.$rp.'css/docs.min.css" rel="stylesheet">
    <link href="'.$rp.'/grid.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="'.$rp.'css/bootstrap.css" rel="stylesheet">
    <link href="'.$rp.'css/pace.css" rel="stylesheet">
    <link href="'.$rp.'css/mycss.css" rel="stylesheet">
    <style id="holderjs-style" type="text/css"></style>
    <script type="text/javascript" src="'.$rp.'js/pace.js" ></script>
    <!-- Optional theme -->
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- sticky footer -->' ;

	}

	public function getStudentNavbar($rp,$active,$usn,$uNotif,$uMsg){
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
         <a href="'.$rp.'student"><img style="wigth:40pt; height:40pt; float:left"; atl="bmslogo" src="'.$rp.'/img/bms-logo.png"></a>
          <a class="navbar-brand" href="'.$rp.'student">'.$usn.'</a>
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
                <li><a class="link" href="notes.php">Notes</a></li>
                <li><a class="link" href="#">Question Papers</a></li>
                <li><a class="link" href="syllabus.php">Syllabus Copy</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="hidden-xs"><a class="link" href="notification.php"><span class="glyphicon glyphicon-globe"></span><span class="badge ';if($uMsg>0) echo 'red'; echo'">'.$uMsg.'</span></a></li>
            <li class="hidden-xs"><a class="link" href="messages.php"><span class="glyphicon glyphicon-comment"></span><span class="badge ';if($uMsg>0) echo 'red'; echo '">'.$uMsg.'</span></a></li>
            <li class="visible-xs"><a class="link" href="notification.php">Notifications<span class="glyphicon glyphicon-globe pull-right"></span><span class="badge pull-right ';if($uNotif>0) echo 'red'; echo'">'.$uMsg.'</span></a></li>
            <li class="visible-xs"><a class="link" href="messages.php">Messages<span class="glyphicon glyphicon-comment pull-right"></span><span class="badge pull-right ';if($uMsg>0) echo 'red'; echo '">'.$uMsg.'</span></a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b>&nbsp;<span class="glyphicon glyphicon-cog"></span>&nbsp;Account</a>
              <ul class="dropdown-menu">
                <li ><a class="link" href="'.$rp.'logout.php">&nbsp;Logout</a></li>
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
		
	}

  public function getFacultyNavbar($rp,$active,$uNotif,$uMsg){
    
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
         <a href="'.$rp.'faculty"><img style="wigth:40pt; height:40pt; float:left"; atl="bmslogo" src="'.$rp.'/img/bms-logo.png"></a>
          <a class="navbar-brand" href="'.$rp.'faculty">BMSCE</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li '; if($active==0) echo 'class="active"'; echo '><a class="link" href="'.$rp.'faculty">Home</a></li>
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
             <li class="hidden-xs"><a class="link" href="notification.php"><span class="glyphicon glyphicon-globe"></span><span class="badge ';if($uMsg>0) echo 'red'; echo'">'.$uMsg.'</span></a></li>
            <li class="hidden-xs"><a class="link" href="messages.php"><span class="glyphicon glyphicon-comment"></span><span class="badge ';if($uMsg>0) echo 'red'; echo '">'.$uMsg.'</span></a></li>
            <li class="visible-xs"><a class="link" href="notification.php">Notifications<span class="glyphicon glyphicon-globe pull-right"></span><span class="badge pull-right ';if($uNotif>0) echo 'red'; echo'">'.$uMsg.'</span></a></li>
            <li class="visible-xs"><a class="link" href="messages.php">Messages<span class="glyphicon glyphicon-comment pull-right"></span><span class="badge pull-right ';if($uMsg>0) echo 'red'; echo '">'.$uMsg.'</span></a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b>&nbsp;<span class="glyphicon glyphicon-cog"></span>&nbsp;Account</a>
              <ul class="dropdown-menu">
                <li ><a class="link" href="'.$rp.'logout.php">&nbsp;Logout</a></li>
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