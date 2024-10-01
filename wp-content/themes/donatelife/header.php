<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Favicons and Icons -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-icon-touch.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
	<!-- or, set /favicon.ico for IE10 win -->
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage"
		content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png">

	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->

	<?php if($_SERVER['HTTP_HOST']  == 'donatelife.org.in'){ ?>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-RV7DVV8PDJ"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-RV7DVV8PDJ');
		</script>
	<?php } ?>

</head>

<body <?php body_class(); ?>>
	<div class="page-wrapper">
		<!-- Main Header--><?php
		$blog_info = get_bloginfo('name');
		$logo_full = "full";
		$attachment_image = get_field('logo', 'option');
		$logo_array = wp_get_attachment_image_src($attachment_image['ID'], $logo_full); ?>
		<header class="main-header header-style-one">
			<section class="header-top hidden-xs hidden-sm">
				<div class="container">
					<div class="header">
						<div class="header-top-left">
							<ul>
								<li><a href="https://www.facebook.com/donatelifetrust/" target="_blank"><i
											class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="https://www.twitter.com/donatelifetrust/" target="_blank"><i
											class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="https://www.youtube.com/channel/UC66llzaVILfu-zdKWuM_0tA"
										target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="header-top-right topbar-contact">
							<ul>
								<li>
									<a href="mailto:info@donatelife.org.in"><i class="fa fa-envelope-o"
											aria-hidden="true"></i> info@donatelife.org.in</a>
								</li>
								<li><a><i class="fa fa-phone" aria-hidden="true"></i></a><a
										href="tel:+91 75730 11101">+91 75730 11101,</a> <a
										href="tel:+91 75730 11103">+91 75730 11103</a></li>
							</ul>
						</div>
						<div class="header-top-right pull-right">
							<ul>
								<li>
									<a href="<?php echo site_url(); ?>/download"> Downloads</a>
								</li>

								<li>
									<a href="<?php echo site_url(); ?>/blog"> Blog</a>
								</li>
								<li>
									<a href="<?php echo site_url(); ?>/faq"> FAQs </a>
								</li>

								<li><a href="<?php echo site_url(); ?>/contact">Contact us</a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<section class="mainmenu-area">
				<div class="container">
					<div class="logo pull-left">
						<a href="<?php echo esc_url(home_url('/')); ?>"><?php
						   if (!empty($logo_array)) { ?>
								<img src="<?php echo $logo_array[0]; ?>" alt="<?php echo $blog_info; ?>"
									title="<?php echo $blog_info; ?>" /><?php
						   } else {
							   echo $blog_info;
						   } ?>
						</a>
					</div>
					<nav class="main-menu">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse"
								data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse clearfix">
							<?php
							if(wp_is_mobile()) {
								wp_nav_menu(
									array(
										'theme_location' => 'primary-navigation',
										'menu_class' => 'primary-navigation mobile-menu clearfix',
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									)
								);
							}else{

								wp_nav_menu(array(
									'theme_location' => 'primary-navigation',
									'menu_class' => 'primary-navigation navigation clearfix',
									'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									)
								);
							}
							?>
						</div>
					</nav>
				</div>
			</section>

			<!-- sticky header -->
			<section class="bounce-in-header">
				<div class="container">
					<div class="logo pull-left">
						<a href="<?php echo esc_url(home_url('/')); ?>"><?php
						   if (!empty($logo_array)) { ?>
								<img src="<?php echo $logo_array[0]; ?>" alt="<?php echo $blog_info; ?>"
									title="<?php echo $blog_info; ?>" /><?php
						   } else {
							   echo $blog_info;
						   } ?>
						</a>
					</div>
					<nav class="main-menu">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse"
								data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse clearfix">
							<?php
							if(wp_is_mobile()) {
								wp_nav_menu(
									array(
										'theme_location' => 'primary-navigation',
										'menu_class' => 'primary-navigation navigation clearfix',
										'items_wrap' => '<ul id="%1$s" class="mobile-menu clearfix">%3$s</ul>',
									)
								);
							}else{

								wp_nav_menu(array(
									'theme_location' => 'primary-navigation',
									'menu_class' => 'primary-navigation navigation clearfix',
									'items_wrap' => '<ul id="%1$s" class="navigation clearfix">%3$s</ul>',
									)
								);
							}
							?>
						</div>
					</nav>
				</div>
			</section>
			
			<?php if(!is_page('donatelife_flipbook')) { ?>
			<aside id="sticky-social" style="">
				<ul>
					<li><a href="https://www.facebook.com/donatelifetrust/" class="entypo-facebook" target="_blank"><span>Facebook</span></a></li>
					<li><a href="https://twitter.com/donatelifetrust/" class="entypo-twitter" target="_blank"><span>Twitter</span></a></li>
					<li><a href="https://www.youtube.com/channel/UC66llzaVILfu-zdKWuM_0tA" class="youTube-social" target="_blank"><i class="fa fa-youtube"></i><span>YouTube</span></a></li>
				</ul>
			</aside>
			<?php } ?>
			<a class="left-sticky scroll-to-target" href="<?php echo site_url(); ?>/become-donor" style="display: block;" data-toggle="tooltip" title="" data-original-title="Become A Organ Donor">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
			</a>
			<!-- Header-Upper -->
			<div class="header-upper" style="display: none;">
				<div class="container-fluid">
					<div class="clearfix home-menu">
						<div class="pull-left logo-box">
							<div class="logo"><?php
							if (!empty($logo_array)) { ?>
									<div class="site-logo">
										<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
											<img src="<?php echo $logo_array[0]; ?>" alt="<?php echo $blog_info; ?>"
												title="<?php echo $blog_info; ?>" />
										</a>
									</div><?php
							} else {
								if (!empty($blog_info)) {
									if (is_front_page() && is_home()) { ?>
											<h1 class="site-title">
												<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
													<?php echo $blog_info; ?>
												</a>
											</h1><?php
									} else { ?>
											<p class="site-title">
												<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
													<?php echo $blog_info; ?>
												</a>
											</p><?php
									}
								}
							} ?>
							</div>
						</div>
						<div class="nav-outer clearfix">
							<!--Mobile Navigation Toggler For Mobile-->
							<div class="mobile-nav-toggler">
								<span class="icon flaticon-menu-4"></span>
							</div>
							<nav class="main-menu mega navbar-expand-md pull-right">
								<div class="navbar-header">
									<button class="navbar-toggler" type="button" data-toggle="collapse"
										data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
										aria-expanded="false" aria-label="Toggle navigation">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div class="navbar-collapse collapse scroll-nav clearfix" id="navbarSupportedContent">
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary-navigation',
											'menu_class' => 'primary-navigation navigation clearfix',
											'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										)
									);
									?>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- End Header Upper -->

			
		</header><!-- End Main Header -->