<!DOCTYPE html>
<head>
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/front/css/bulma.css'); ?>">
	<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/general/images/favicon.ico'); ?>">	
</head>
<body>
<div id="page">
<header id="header">
	<nav class="navbar is-primary">
		<div class="container">
		
			<div class="navbar-brand">
				<a href="<?php echo site_url(); ?>" class="navbar-item"><strong>Rental Alat Camping UMBY</strong></a>
				<div class="navbar-burger burger" data-target="navbar-jos">
				  <span></span>
				  <span></span>
				  <span></span>
				</div>
			</div>

			<div id="navbar-jos" class="navbar-menu">
				
				<div class="navbar-start">
					<a class="navbar-item" href="<?php echo site_url(); ?>">Home</a>
					<?php bulma_navbar_menus($cat_tree); ?>
				</div>
				
				<div class="navbar-end">
					
					<?php if($this->session->user_id): ?>
						
						<a href="<?php echo site_url('admin/dashboard'); ?>" class="navbar-item">Dashboard</a>

						<div class="navbar-item">
							<a href="<?php echo site_url('login/logout'); ?>" class="button is-link"><strong>Log Out</strong></a>
						</div>
					<?php else: ?>
						<div class="navbar-item">
							<a href="<?php echo site_url('login'); ?>" class="button is-link"><strong>Log In</strong></a>
						</div>
					<?php endif; ?>
					
				</div>
			</div>
		
		</div>
	</nav>
</header>
<div class="container">