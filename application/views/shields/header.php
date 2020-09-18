<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?=$page_title?> | Logistics</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta content="" name="description">
	<meta content="Mannatthemes" name="author">
	<!-- App favicon -->
	<!-- <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico"> -->
	<link href="<?=base_url()?>assets/images/logo.png" rel="shortcut icon" type="image/png">

	<link href="<?=base_url()?>assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">

	<?php if($page_name != ""){ ?>
	<link href="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
	<?php } ?>

	<!-- App css -->
	<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css">

	<link href="<?=base_url()?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />

	<link href="<?=base_url()?>assets/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">

	
</head>

<body class="js-sweetalert">
	<input type="hidden" value="<?=base_url();?>" id="txtsite_url">
	<input type="hidden" value="<?=$page_name;?>" id="txtpage_name">

	<button class="btn btn-primary waves-effect btn_sweet_art" style="display: none;" data-type="success" data-msg="<?=$datamsg?>">CLICK ME</button>

	<button class="btn btn-primary waves-effect btn_sweet_art1" style="display: none;" data-type="success" data-msg="<?=$datamsg1?>">CLICK ME</button>

	<button class="btn btn-primary waves-effect btn_sweet_art2" style="display: none;" data-type="success" data-msg="<?=$datamsg2?>">CLICK ME</button>

	<!-- Top Bar Start -->
	<div class="topbar">
		<!-- Navbar -->
		<nav class="navbar-custom">
			<!-- LOGO -->
			<ul class="list-unstyled topbar-nav mb-0">
				<li>
					<button class="button-menu-mobile nav-link waves-effect waves-light"><i class="mdi mdi-menu nav-icon"></i></button>
				</li>
			</ul>

			<div class="topbar-left">
				<a href="#" class="logo">
					<span><img src="<?=base_url()?>assets/images/logo.png" alt="logo-small" class="logo-md"> </span>
					<!-- <span><img src="<?=base_url()?>assets/images/logo-dark.png" alt="logo-large" class="logo-lg"></span> -->
				</a>
			</div>


			<ul class="list-unstyled topbar-nav float-right mb-0">
				<li class="dropdown"><a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="mdi mdi-bell-outline nav-icon"></i> <span class="badge badge-danger badge-pill noti-icon-badge">2</span></a>
					<div class="dropdown-menu dropdown-menu-right dropdown-lg">
						<!-- item-->
						<h6 class="dropdown-item-text">Notifications (258)</h6>
						<div class="slimscroll notification-list">
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item active">
								<div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
								<p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
							</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
								<p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
							</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
								<p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
							</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
								<p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
							</a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item notify-item">
								<div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
								<p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
							</a>
						</div>
						<!-- All--><a href="javascript:void(0);" class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a></div>
				</li>
				<li class="dropdown">
					<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><img src="<?=base_url()?>assets/images/no_passport.jpg" alt="profile-user" class="rounded-circle"> <span class="ml-1 nav-user-name hidden-sm"><i class="mdi mdi-chevron-down"></i></span></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
						<!-- <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> -->
						<a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
						<!-- <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a> -->
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
					</div>
				</li>
			</ul>

			<!-- <ul class="list-unstyled topbar-nav mb-0">
				<li>
					<button class="button-menu-mobile nav-link waves-effect waves-light"><i class="mdi mdi-menu nav-icon"></i></button>
				</li>
			</ul> -->
		</nav>
		<!-- end navbar-->
	</div>



	<!-- Top Bar End -->
	<div class="page-wrapper-img">
		<div class="page-wrapper-img-inner">
			<div class="sidebar-user media"><img src="<?=base_url()?>assets/images/no_passport.jpg" alt="user" class="rounded-circle img-thumbnail mb-1"> <span class="online-icon">&nbsp;&nbsp; </span>
				<div class="media-body">
					<h5 class="text-light">Administrator</h5>
					<ul class="list-unstyled list-inline mb-0 mt-2">
						<!-- <li class="list-inline-item"><a href="javascript: void(0);" class=""><i class="mdi mdi-account text-light"></i></a></li> -->
						<li class="list-inline-item"><a href="javascript: void(0);" class=""><i class="mdi mdi-settings text-light"></i></a></li>
						<li class="list-inline-item"><a href="javascript: void(0);" class=""><i class="mdi mdi-power text-danger2"></i></a></li>
					</ul>
				</div>
			</div>
			<!-- Page-Title -->
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title-box">
						<!-- <div class="float-right align-item-center mt-2">
							<button class="btn btn-info px-4 align-self-center report-btn">Creat Report</button>
						</div> -->
						<h4 class="page-title mb-2"><i class="mdi mdi-monitor mr-2"></i><?=$page_title?></h4>
						<div class="">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active"><?=$page_title?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- end page title end breadcrumb -->
		</div>
	</div>



	<?php /* if($page_name=="add_mission"){ ?>
	<div class="select_riders_mask" style="cursor:pointer; display:none;" title="Click to close"></div>
    <div class="select_riders" style="display:none;">
        <div class="card-body all_tables all_tables_ride">
            <p style="text-align:center; font-size:17px;"><b>SELECT AND ASSIGN RIDERS</b></p>
            <!-- <input type="hidden" value="0" id="cart_invoice_ids"> -->

            <div id="err_div2_cats" class="error_riders"></div>
                
            <table id="" class="table table-striped table-bordered display responsive expand_tbls dark_tr choose_riders" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Engaged</th>
                    <th>Name</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div style="text-align:center; font-size:18px; cursor:pointer;" class="close_riders">[Close]</div>
    </div>
	<?php } */ ?>







	<div class="page-wrapper">
		<div class="page-wrapper-inner">

			<div class="left-sidenav">
				<ul class="metismenu left-sidenav-menu" id="side-nav">
					<li class="menu-title">Main</li>
					<li><a href="<?=base_url()?>shields/"><i class="mdi mdi-monitor"></i><span>Dashboards</span></a></li>
					
					<li class="menu-title mt-20">Components</li>
					<li><a href="javascript: void(0);"><i class="fa fa-user"></i><span>Customers</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
						<ul class="nav-second-level" aria-expanded="false">
							<li><a href="<?=base_url()?>shields/add-customers/">Add Customers</a></li>
							<li><a href="<?=base_url()?>shields/customers/">View Customers</a></li>
							<!-- <li><a href="ui-cards.html">Cards</a></li>
							<li><a href="ui-dropdowns.html">Dropdowns</a></li>
							<li><a href="ui-modals.html">Modals</a></li>
							<li><a href="ui-typography.html">Typography</a></li>
							<li><a href="ui-progress.html">Progress</a></li>
							<li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
							<li><a href="ui-tooltips-popovers.html">Tooltips & Popover</a></li>
							<li><a href="ui-carousel.html">Carousel</a></li>
							<li><a href="ui-pagination.html">Pagination</a></li>
							<li><a href="ui-grid.html">Grid System</a></li>
							<li><a href="ui-scrollspy.html">Scrollspy</a></li>
							<li><a href="ui-spinners.html">Spinners</a></li>
							<li><a href="ui-toasts.html">Toasts</a></li>
							<li><a href="javascript: void(0);">Oter Components <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
								<ul class="nav-second-level" aria-expanded="false">
									<li><a href="ui-other-animation.html">Animation</a></li>
									<li><a href="ui-other-avatar.html">Avatar</a></li>
									<li><a href="ui-other-clipboard.html">Clip Board</a></li>
									<li><a href="ui-other-files.html">File Meneger</a></li>
									<li><a href="ui-other-ribbons.html">Ribbons</a></li>
									<li><a href="ui-other-dragula.html"><span>Dragula</span></a></li>
									<li><a href="ui-other-check-radio.html"><span>Check & Radio Buttons</span></a></li>
								</ul>
							</li> -->
						</ul>
					</li>
					<li><a href="javascript: void(0);"><i class="fa fa-car"></i><span>Dispatchers</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
						<ul class="nav-second-level" aria-expanded="false">
							<li><a href="<?=base_url()?>shields/add-riders/">Add Rider</a></li>
							<li><a href="<?=base_url()?>shields/view-riders/">View Riders</a></li>
						</ul>
					</li>

					<li><a href="<?=base_url()?>shields/add-mission/"><i class="fab fa-tripadvisor"></i><span>Add Mission</span></a></li>

					<li><a href="#"><i class="fa fa-truck-loading"></i><span>View Deliveries</span></a></li>

					<!-- <li><a href="#"><i class="fa fa-envelope"></i><span>Message Section</span></a></li> -->

					<li class="menu-title mt-20">More</li>
					<li><a href="<?=base_url()?>shields/settings/"><i class="mdi mdi-settings"></i><span>Settings</span></a></li>
					<li><a href="<?=base_url()?>shields/logout/"><i class="mdi mdi-power"></i><span>Logout</span></a></li>

					<!-- <li><a href="javascript: void(0);"><i class="mdi mdi-lock-outline"></i><span>Authentication</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
						<ul class="nav-second-level" aria-expanded="false">
							<li><a href="auth-login.html">Login</a></li>
							<li><a href="auth-register.html">Register</a></li>
							<li><a href="auth-recoverpw.html">Recover Password</a></li>
							<li><a href="auth-lock-screen.html">Lock Screen</a></li>
							<li><a href="auth-404.html">Error 404</a></li>
							<li><a href="auth-500.html">Error 500</a></li>
						</ul>
					</li>
					<li><a href="javascript: void(0);"><i class="mdi mdi-book-open-page-variant"></i><span>Pages</span><span class="badge badge-success float-right">Hot</span></a>
						<ul class="nav-second-level" aria-expanded="false">
							<li><a href="page-tour.html">Tour</a></li>
							<li><a href="page-timeline.html">Timeline</a></li>
							<li><a href="page-invoice.html">Invoice</a></li>
							<li><a href="page-treeview.html">Treeview</a></li>
							<li><a href="page-profile.html">Profile</a></li>
							<li><a href="page-starter.html">Starter Page</a></li>
							<li><a href="page-pricing.html">Pricing</a></li>
							<li><a href="page-blogs.html"><span>Blogs</span></a></li>
							<li><a href="page-faq.html">FAQs</a></li>
							<li><a href="page-gallery.html">Gallery</a></li>
						</ul>
					</li>
					<li><a href="javascript:void(0);"><i class="mdi mdi-contact-mail"></i><span>Email Templates</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
						<ul class="nav-second-level" aria-expanded="false">
							<li><a href="email-templates-basic.html">Basic Action Email</a></li>
							<li><a href="email-templates-alert.html">Alert Email</a></li>
							<li><a href="email-templates-billing.html">Billing Email</a></li>
						</ul>
					</li> -->
				</ul>
			</div>