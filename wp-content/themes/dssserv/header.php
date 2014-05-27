<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo get_bloginfo('name');  wp_title(); ?></title>

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/assets/plugins/jquery.bxslider/jquery.bxslider.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/assets/plugins/nivo-lightbox/nivo-lightbox.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/assets/plugins/nivo-lightbox/themes/default/default.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/assets/stylesheets/styles.css">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.ico" />
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body <?php body_class($class); ?>>
	<div class="header">
		<div class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="nav navbar-nav navbar-right">
						<div class="row">
							<div class="number">
								<span class="text"><span class="call">Call</span> 1-212-369-9212</span>
								<img src="<?php bloginfo('template_directory'); ?>/assets/images/fb-count.png"></a>
								<img src="<?php bloginfo('template_directory'); ?>/assets/images/twitter-ds.png"></a>
							</div>
						</div>
					</div>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<a class="navbar-brand" href="<?php echo site_url(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/assets/images/main-logo.png" alt="DSS Services">
						</a>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="<?php echo site_url(); ?>/property-search">Property Search</a></li>
								<li id="list-link"><a>List With Us</a></li>
								<li><a id="services-link">Services</a></li>
								<li><a id="resources-link">Resources</a></li>
								<li><a href="<?php echo site_url();?>/about-us">About</a></li>
								<li><a href="#" data-toggle="modal" data-target="#contact">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div><!--/.nav-collapse -->
			<div class="submenu">
							
				<div class="container">
				<hr>
				<ul id="list">
					<li><a href="<?php echo site_url();?>/rentals">Rentals</a></li>
					<li><a href="<?php echo site_url();?>/sales">Sales</a></li>
				</ul>
				<ul id="services">
					<li><a href="<?php echo site_url();?>/property-management">Property Management</a></li>
					<li><a href="<?php echo site_url();?>/insurance">Insurance</a></li>
				</ul>
				<ul id="resources">
					<li><a href="<?php echo site_url();?>/neighborhood-guide">Neighborhood Guide</a></li>
					<li><a href="<?php echo site_url();?>/mortgage-guide">Mortgage Guide</a></li>
					<li><a href="<?php echo site_url();?>/sellers-guide">Seller's Guide</a></li>
					<li><a href="<?php echo site_url();?>/renters-guide">Renter's Guide</a></li>
				</ul>
			</div>
		</div
		</div><!--/.container-fluid -->
	</div>


