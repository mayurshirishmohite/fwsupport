<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	<?php get_template_part('template-parts/meta-description'); ?>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  type='text/css'>
	<link rel="stylesheet" href="https://feed.mikle.com/support/wp-content/themes/FWSupport/style.css?<?php echo filemtime( get_stylesheet_directory() . '/style.css'); ?>">
	<link rel="alternate" type="application/rss+xml" title="FeedWind Support" href="https://feed.mikle.com/support/feed/">
	<link rel="canonical" href="https://feed.mikle.com<?php echo parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ); ?>" />
	<link href="https://feed.mikle.com/support/wp-content/themes/FWSupport/assets/images/icon/favicon.ico" rel="shortcut icon">
	<link href="https://feed.mikle.com/support/wp-content/themes/FWSupport/assets/images/icon/touch.png" rel="apple-touch-icon-precomposed">
	<link href="https://feed.mikle.com/support/wp-content/themes/FWSupport/assets/images/icon/favicon.ico" rel="icon" sizes="32x32" />
	<?php wp_head(); ?>
	
	<!--Start of Zendesk Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="https://v2.zopim.com/?28hNmtBtV7uB20baPbQmNA3ptWs9fOSp";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>
	<!--End of Zendesk Chat Script-->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-199268-3', 'auto');
	ga('send', 'pageview');
	setTimeout("ga('send', 'event', 'NoBounce', 'Over 30 seconds')",30000);
	</script>
</head>
<body<?php if ( is_single() ) :?> class="single-knowledgebase"<?php endif; ?>>

<!-- Header -->

<header <?php if ( is_front_page() ) :?>id="hero" <?php endif; ?>class="hero overlay">
	<nav class="navbar navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<a href="/" class="brand">
					<img src="/support/wp-content/themes/FWSupport/assets/images/feedwind-logo2x.png" alt="FeedWind">
				</a>
			</div>
			<div class="navbar-collapse collapse" id="navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/">Home</a></li>
					<li><a href="/blog/">Blog</a></li>
					<li><a href="/support/">Support</a></li>
					<li><a href="/plans/">Plans</a></li>
					<li><a href="/signup/" class="btn btn-success nav-btn fw-sign-up-btn">Sign Up</a></li>
				</ul>
			</div>
		</div>
	</nav>
<?php if ( is_front_page() ) :?>
	<div class="masthead <?php if ( is_front_page() ) :?>text-center<?php else: ?>single-masthead<?php endif; ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-8<?php if ( is_front_page() ) :?> col-md-offset-2<?php endif; ?>">
					<h1>FeedWind Support</h1>
					<p class="lead text-muted">Advice and answers from the FeedWind Team</p>
					<form role="search" method="get" action="/support/">
						<input type="text" class="search-field" placeholder="Search for ... " aria-label="search input" name="s" />
						<button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</header>