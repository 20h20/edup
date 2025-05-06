<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/library/img/fav/favicon-16x16.png">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

	<header role="banner" itemscope itemtype="http://schema.org/WPHeader">
		<div class="header-inner">
			<a class="header-logo cbo-picture-contain" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>" itemprop="url">
				<img
					decoding="async"
					src="<?php bloginfo('template_directory'); ?>/library/img/logo-edup.svg"
					alt="<?php echo get_bloginfo('description'); ?>" sizes="100vw"
					width="112" height="80"
					itemprop="logo"
				>
			</a>
			<button type="button" class="burger-menu" aria-label="Ouvrir la navigation principale">
				<span class="top"></span>
				<span class="middle"></span>
				<span class="bottom"></span>
			</button>
		</div>

		<nav class="header-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="Navigation principale">
			<?php wp_nav_menu( array(
				'container' => false,
				'container_class' => '',
				'menu_class' => 'cbo-menu',
				'theme_location' => 'primary-menu',
			));?>
		</nav>
	</header>

	<main class="cbo-main" role="main" itemscope itemtype="http://schema.org/WebPageElement">