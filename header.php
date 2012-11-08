<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="shortcut icon" href="/favicon.ico" />
		<?php do_action( 'bp_head' ) ?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>


<style type="text/css">
.top-register a { background:<?php echo of_get_option('color1', 'd80203' ); ?>; }
#wp-submit, #signup_submit, .blog-post-left-date, a.more-link, .wpcf7-submit, #post-topic-reply #submit, #new-topic-post #submit, .my-account #submit, #new-topic-button, .page-template-search-page-php #search-submit, .front-box-title { background:<?php echo of_get_option('color2', '' ); ?>; cursor:pointer; }
#wp-submit:hover, #signup_submit:hover, a.more-link:hover, .wpcf7-submit:hover, #post-topic-reply #submit:hover, #new-topic-button:hover, .my-account #submit:hover, #new-topic-post #submit:hover, .page-template-search-page-php #search-submit:hover, .front-box-title:hover { background:#df6e39; }
</style>

<?php echo of_get_option('analytics', ' ' ); ?>

	</head>

	<body <?php body_class() ?> id="bp-default">

	<?php do_action( 'bp_before_header' ) ?>
	<div id="header-container">
	<div id="header-top">
	<div id="header">
				
		<div id="logo"><a href="<?php echo home_url(); ?>" title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>"><img src="<?php echo of_get_option('logo_path', 'http://www.demo1.diaboliquedesign.com/3/logo.png' ); ?>" alt="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>" /></a></div>
	
			<div id="navigation">
				
				<?php 
				wp_nav_menu( array(
				 'container' =>false,
				 'menu_class' => 'nav',
				 'echo' => true,
				 'before' => '',
				 'after' => '',
				 'link_before' => '',
				 'link_after' => '',
				 'depth' => 0,
				 'walker' => new description_walker())
				 );
				 ?>
			</div>

			<div id="navigation-320">
			<form name="site-menu" action="" method="post">
				<?php 	
				wp_nav_menu_select(
    				array(
       				 'theme_location' => 'select-menu'
    					)
				);
				?>
			</form>
			</div>

			<?php do_action( 'bp_header' ) ?>


	</div><!-- #header -->
	</div><!-- #header-top -->

