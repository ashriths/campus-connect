<?php
	$rp = "./";
	require_once $rp.'redirect.php';
	include_once $rp.'php/function.php';
	//include_once $rp.'php/design.php';
	//include_once $rp.'php/session.php';
	if(isset($_POST['email'])&&isset($_POST['password'])){
		$result = $user->authenticate($_POST['email'],$_POST['password']);
		if($result['result']==1){
			if($result['type']=='s'){
				//login student
				$session->createSession($result['userId'],'student');
				
			}
			else if($result['type']=='t'){
				//login teacher
				$session->createSession($result['userId'],'teacher');
				//echo 'Session Create for Teacher';
			}
      else if($result['type']=='da'){
        //login teacher
        $session->createSession($result['userId'],'deptadmin');
        //echo 'Session Create for Dept Admin';
      }
      Redirect::redirectTo($rp.'home.php');
		}
	}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./img/favicon.png">

    <title>Campus BMSCE</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/landing.css" rel="stylesheet">
        <link href="./css/pace.css" rel="stylesheet">
    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>BMSCE APP</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Not a member yet?</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="front col-lg-6">
					<h1>Initialize the <br/>
					Awesomeness</h1>
					<form class="form-inline" role="form" id="loginForm" method="post">
					  <div class="form-group">
					    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address"/>
					    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Password"/>
					  </div>
					  <button type="submit" class="login-button btn btn-warning btn-lg">Login</button>
					</form>		
					<div id="pop" style="display:none;" class="alert alert-warning"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Please wait! Authenticating...</div>	
					<?php 
					if(isset($_POST['email'])) echo'<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp; '.$result['message'].'</div>	'; 
					?>
					<div class="white-heading">
						<h4><a href="join.php">Not a member yet ? </a></h4>
						<h4><a href="resetpassowrd.php">Reset password </a></h4>
					</div>		
				</div><!-- /col-lg-6 -->
				<div class="behind col-lg-6">
					<img class="banner-image img-responsive" src="./img/ipad-hand.png" alt="">
				</div><!-- /col-lg-6 -->
				
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
	
	
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="http://blacktie.co/adpacks/demoad.js"></script>+
     <script>
    $(document).ready(function(){
    	$('#loginForm').submit(function(){
    		
    		$( "#pop" ).fadeIn( "fast" ).delay(1000);
    		return true;
    	});
    });    	
    </script>
  </body>
</html>
