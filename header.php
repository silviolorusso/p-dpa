<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title('|',true,'right'); ?> P—DPA</title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>
		
		<!-- FitVids -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.fitvids.js"></script>
		<!-- Masonry -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/masonry.pkgd.min.js"></script>
		<!-- Infinite Scroll -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.infinitescroll-mod.js"></script>
	</head>

	<body <?php body_class(); ?>>
		<div id="container">
			<header class="header" role="banner">
				<div id="inner-header" class="wrap clearfix">
					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>
					<div class="fourcol first">
						<p id="logo" class="h1">
							<a href="<?php echo home_url(); ?>" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.png">
							</a>
						</p>
					</div>
					<div class="fourcol" id="blog-desc">
						<div>
							<div>
								<h2>Projects and Artworks<br> at the Intersection<br> of Publishing<br> and Digital Technology</h2>
							</div>
						</div>
					</div>
					<div class="fourcol last">
						<div>
					    	<form id="search-form" method="get" action="<?php echo home_url(); ?>">
						        <div>
						            <input type="text" onfocus="if(this.value=='search') this.value='';" onblur="if(this.value=='') this.value='search';" value="search" class="inputbox" alt="search" maxlength="20" name="s" id="s" size="15">
						        </div>
					        </form>
					    </div>
					    <p><a href="https://www.facebook.com/postdigitalpublishingarchive">Facebook</a> &nbsp; <a href="https://twitter.com/p_dpa">Twitter</a> &nbsp; <a href="<?php echo home_url(); ?>/work/feed">RSS</a></p>
					</div>
				</div>
			</header>