<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= _get('site_title', 'Hello Metro');?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style type="text/css">
        body {
            padding-top: 50px;
        }
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
		.form-signin {
			max-width:330px;margin:0 auto;padding:15px;
		}
		.form-signin .form-signin-heading,.form-signin .checkbox {
			margin-bottom:10px;
		}
		.form-signin .checkbox {
			font-weight:normal;
		}
		.form-signin .form-control {
			position:relative;font-size:16px;height:auto;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:10px;
		}
		.form-signin .form-control:focus {
			z-index:2;
		}
		.form-signin input[type="text"] {
			margin-bottom:-1px;border-bottom-left-radius:0;border-bottom-right-radius:0;
		}
		.form-signin input[type="password"] {
			margin-bottom:10px;border-top-left-radius:0;border-top-right-radius:0;
		}
		.account-wall {
			margin-top:20px;background-color:#f7f7f7;-moz-box-shadow:0 2px 2px rgba(0,0,0,0.3);-webkit-box-shadow:0 2px 2px rgba(0,0,0,0.3);box-shadow:0 2px 2px rgba(0,0,0,0.3);padding:40px 0 20px;
		}
		.login-title {
			color:#555;font-size:18px;font-weight:400;display:block;
		}
		.profile-img {
			width:96px;height:96px;display:block;-moz-border-radius:50%;-webkit-border-radius:50%;border-radius:50%;margin:0 auto 10px;
		}
		.need-help {
			margin-top:10px;
		}
		.new-account {
			display:block;margin-top:10px;
		}
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      <a class="navbar-brand"><?php echo _get('site_title');?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo m_appurl();?>">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav pull-right">
            <?php if ($user->isAnonymous()): ?>
            <li><a href="<?php echo m_appurl('login');?>">Sign in</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      <?php echo Metrofw_Template::parseSection('nav'); ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<h1 class="text-center login-title">Sign in to continue to <?php echo _get('site_title');?></h1>
				<div class="account-wall">
					<img class="profile-img" src="<?= m_turl();?>img/photo_120.jpg"
						alt="">
					<form class="form-signin" action="<?php echo m_appurl('dologin');?>" method="POST">
					<input type="text" name="username" class="form-control" placeholder="Email" required autofocus>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">
						Sign in</button>
					<label class="checkbox pull-left">
						<input type="checkbox" value="remember-me">
						Remember me
					</label>
					<a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
					</form>
				</div>
<!--
				<a href="#" class="text-center new-account">Create an account </a>
-->
			</div>
		</div>
 
    </div><!-- /.container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
