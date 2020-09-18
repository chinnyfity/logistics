<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Admin Login | CarryGo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<!-- App favicon -->
	<link href="<?=base_url()?>assets/images/logo.png" rel="shortcut icon" type="image/png">
	<!-- App css -->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css">

	<link href="<?=base_url()?>assets/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
</head>

<body class="account-body">
	<input type="hidden" value="<?=base_url();?>" id="txtsite_url">
	<!-- Log In page -->
	<div class="row vh-100">
		<div class="col-lg-3 p-0 mt-50 mt-xs-10">
			<div class="card mb-0 shadow-none">
				<div class="card-body">
					<div class="px-3">
						<div class="media">
							<a href="#" class="logo logo-admin"><img src="<?=base_url()?>assets/images/logo.png" height="55" alt="logo" class="my-3"></a>
							<div class="media-body ml-3 align-self-center">
								<h4 class="mt-0 mb-1">Login on CarryGo</h4>
								<p class="text-dark font-13 mb-0">Sign in to continue to CarryGo</p>
							</div>
						</div>

						<form class="form-horizontal my-2 login_form" action="#">
							<div class="form-group">
								<label for="username">Username</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-outline font-16"></i></span></div>
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
								</div>
							</div>
							<div class="form-group">
								<label for="userpassword">Password</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="mdi mdi-key font-16"></i></span></div>
									<input type="password" class="form-control" id="userpassword" name="pass" placeholder="Enter password" style="text-transform: lowercase;">
								</div>
							</div>
							<!-- <div class="form-group row mt-4">
								<div class="col-sm-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customControlInline">
										<label class="custom-control-label" for="customControlInline">Remember me</label>
									</div>
								</div>
								<div class="col-sm-6 text-right"><a href="pages-recoverpw-2.html" class="text-muted font-13"><i class="mdi mdi-lock"></i> Forgot your password?</a></div>
							</div> -->
							<div class="form-group mb-10 row">
								<div class="col-12 mt-2">
									<button class="btn btn-primary btn-block waves-effect waves-light cmd_login_admin" type="button">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
								</div>
							</div>

							<div style="clear: both;"></div>
                    		<div class="alert alert-danger alert_msgs alert_msg1"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 p-0 d-flex justify-content-center for_desktop">
			<div class="accountbg d-flex align-items-center">
				<div class="account-title text-white text-center"><img src="<?=base_url()?>assets/images/logo.png" alt="" class="">
					<h4 class="mt-3">Welcome To CarryGo</h4>
					<div class="border w-25 mx-auto border-primary"></div>
					<h1 class="">Let's Get Started</h1>
					<p class="font-14 mt-3">Login and conntine with the admin dashboard</p>
				</div>
			</div>
		</div>
	</div>
	<!-- End Log In page -->
	<!-- jQuery  -->
	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
	<script src="<?=base_url()?>assets/js/waves.min.js"></script>
	<script src="<?=base_url()?>assets/js/jquery.slimscroll.min.js"></script>
	<!-- App js -->
	<script src="<?=base_url()?>assets/js/app.js"></script>

	<script src="<?=base_url()?>js/jscripts.js"></script>
</body>

</html>