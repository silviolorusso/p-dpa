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
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<meta name="Description" content="Post-Digital Publishing Archive <?php wp_title('|',true,'left'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php wp_title('|',true,'right'); ?> P—DPA" />
		<meta property="og:description" content="Post-Digital Publishing Archive <?php wp_title('|',true,'left'); ?>" />

		<?php wp_head(); ?>
		
		<!-- Analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-17080297-56', 'p-dpa.net');
		  ga('send', 'pageview');
		
		</script>
		
		<!-- FitVids -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.fitvids.js"></script>
		<!-- Masonry -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/masonry.pkgd.min.js"></script>
		<!-- Infinite Scroll -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery.infinitescroll-mod.js"></script>
	</head>

	<body <?php body_class(); ?>>
		<h5 id="beta" style="position:fixed; top: 0; right:0; margin-top:0.2em; margin-right:0.3em; color:red; z-index:99999">BETA!</h5>
		<div id="container">
			<header class="header" role="banner">
				<div id="inner-header" class="wrap clearfix">
					<nav role="navigation">
						<div id="menu-button">
							<p>Menu</p>
						</div>
						<?php bones_main_nav(); ?>
					</nav>
					<div class="fourcol first">
						<div id="logo">
							<a href="<?php echo home_url(); ?>" rel="nofollow">
								<div id="logo-img">
								</div>
							</a>
						</div>
					</div>
					<div class="fourcol" id="blog-desc">
						<div>
							<div>
								<h2>Experimental Publishing<br/> Informed By Digital Technology</h2>
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
					    <!-- Begin MailChimp Signup Form -->
						<div id="mc_embed_signup">
						<form action="http://p-dpa.us3.list-manage1.com/subscribe/post?u=8e6a19c592baa05a72c42a8d7&amp;id=d58a595c96" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;"><input type="text" name="b_8e6a19c592baa05a72c42a8d7_d58a595c96" value=""></div>
						    <div id="inputs">
								<input type="email" onfocus="if(this.value=='Your Email') this.value='';" onblur="if(this.value=='') this.value='Your Email';" value="Your Email" name="EMAIL" class="required email" id="mce-EMAIL">
								<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						    </div>
						</form>
						</div>
						<!--End mc_embed_signup-->
					    <p><a href="https://www.facebook.com/postdigitalpublishingarchive">Facebook</a> &nbsp; <a href="https://twitter.com/p_dpa">Twitter</a> &nbsp; <a href="<?php echo home_url(); ?>/work/feed">RSS</a></p>
					</div>
				</div>
			</header>