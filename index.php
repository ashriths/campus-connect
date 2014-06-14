<?php
	$rp = "./";
	require_once $rp.'redirect.php';
	include_once $rp.'php/function.php';
	//include_once $rp.'php/design.php';
	//include_once $rp.'php/session.php';

	if(isset($_SESSION['id']))
		Redirect::redirectTo($rp."/home.php");
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./img/favicon.png">
    <script type="text/javascript" src="./js/pace.js" ></script>
    <title>Campus BMSCE</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/landing.css" rel="stylesheet">
      <!--[if !IE]-->
      <script type="text/javascript" src="js/pace.js" ></script>
      <!--[endif]-->
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
          <a class="navbar-brand" href="#"><b>Campus BMSCE</b></a>
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
					<form class="form-inline" id="loginForm" action="login.php" role="form" method="post">
					  <div class="form-group">
					    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address" required />
					    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Password" required />
					  </div>
					  <button type="submit" id="submit" class="login-button btn btn-warning btn-lg">Login</button>
					</form>
					<div id="pop" style="display:none;" class="alert alert-warning"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Please wait! Authenticating...</div>	
					<div class="white-heading">
						<h4><a class="link" href="join.php">Not a member yet ? </a></h4>
						<h4><a class="link" href="resetpassowrd.php">Reset password </a></h4>
					</div>
				</div><!-- /col-lg-6 -->
				<div class="behind col-lg-6">
					<img class="banner-image img-responsive" src="./img/ipad-hand.png" alt="">
				</div><!-- /col-lg-6 -->
				
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
	
	
	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<h1>Your Landing Page<br/>Looks Wonderful Now.</h1>
				<h3>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</h3>
			</div>
		</div><!-- /row -->
		
		<div class="row mt centered">
			<div class="col-lg-4">
				<img src="./img/ser01.png" width="180" alt="">
				<h4>1 - Browser Compatibility</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img src="./img/ser02.png" width="180" alt="">
				<h4>2 - Email Campaigns</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>

			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img src="./img/ser03.png" width="180" alt="">
				<h4>3 - Gather Your Notes</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>

			</div><!--/col-lg-4 -->
		</div><!-- /row -->
	</div><!-- /container -->
	
	<div class="container">
		<hr>
		<div class="row centered">
			<div class="col-lg-6 col-lg-offset-3">
				<form class="form-inline" role="form">
				  <div class="form-group">
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">
				  </div>
				  <button type="submit" class="btn btn-warning btn-lg">Invite Me!</button>
				</form>					
			</div>
			<div class="col-lg-3"></div>
		</div><!-- /row -->
		<hr>
	</div><!-- /container -->
	
	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<h1>Flatty is for Everyone.</h1>
				<h3>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</h3>
			</div>
		</div><!-- /row -->
	
		<!-- CAROUSEL -->
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="item active">
				      <img src="./img/p01.png" alt="">
				    </div>
				    <div class="item">
				      <img src="./img/p02.png" alt="">
				    </div>
				    <div class="item">
				      <img src="./img/p03.png" alt="">
				    </div>
				  </div>
				</div>			
			</div><!-- /col-lg-8 -->
		</div><!-- /row -->
	</div><!--/container -->
	
	<div class="container">
		<hr>
		<div class="row centered">
			<div class="col-lg-6 col-lg-offset-3">
				<form class="form-inline" role="form">
				  <div class="form-group">
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">
				  </div>
				  <button type="submit"  class="btn btn-warning btn-lg">Invite Me!</button>
				</form>					
			</div>
			<div class="col-lg-3"></div>
		</div><!-- /row -->
		<hr>
	</div><!-- /container -->

	<div class="container">
		<div class="row mt centered">
			<div class="col-lg-6 col-lg-offset-3">
				<h1>Our Awesome Team.<br/>Design Lovers.</h1>
				<h3>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</h3>
			</div>
		</div><!-- /row -->
		
		<div class="row mt centered">
			<div class="col-lg-4">
				<img class="img-circle" src="./img/pic1.jpg" width="140" alt="">
				<h4>Michael Robson</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
				<p><i class="glyphicon glyphicon-send"></i> <i class="glyphicon glyphicon-phone"></i> <i class="glyphicon glyphicon-globe"></i></p>
			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img class="img-circle" src="./img/pic2.jpg" width="140" alt="">
				<h4>Pete Ford</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
				<p><i class="glyphicon glyphicon-send"></i> <i class="glyphicon glyphicon-phone"></i> <i class="glyphicon glyphicon-globe"></i></p>
			</div><!--/col-lg-4 -->

			<div class="col-lg-4">
				<img class="img-circle" src="./img/pic3.jpg" width="140" alt="">
				<h4>Angelica Finning</h4>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
				<p><i class="glyphicon glyphicon-send"></i> <i class="glyphicon glyphicon-phone"></i> <i class="glyphicon glyphicon-globe"></i></p>
			</div><!--/col-lg-4 -->
		</div><!-- /row -->
	</div><!-- /container -->
	
	<div class="container">
		<hr>
		<div class="row centered">
			<div class="col-lg-6 col-lg-offset-3">
				<form class="form-inline" role="form">
				  <div class="form-group">
				    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">
				  </div>
				  <button type="submit" class="btn btn-warning btn-lg">Invite Me!</button>
				</form>					
			</div>
			<div class="col-lg-3"></div>
		</div><!-- /row -->
		<hr>
		<p class="centered">Powered by Team Name Here - All Rights Reserved</p>
	</div><!-- /container -->
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
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    
    <script src="./js/bootstrap.js"></script>
    <script src="http://blacktie.co/adpacks/demoad.js"></script>
    <script>
    $(document).ready(function(){
    	$('#loginForm').submit(function(){
    		
    		$( "#pop" ).fadeIn( "fast" );
    		$('.loading').fadeIn( "fast" ).delay(1000);
    		return true;
    	});
    });    	
    $('.link').click(function(e){
    	e.preventDefault();
    	$('.loading').fadeIn( "fast" ).delay(1000);
    	window.location.href=this.href;
    });
    </script>
  </body>
</html>
