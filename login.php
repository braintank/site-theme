<?php
/*
Template Name: Login Page
*/
?>

<?php get_header(); ?>

	<div id="header-bottom">

	<?php if ( is_user_logged_in() ) : ?>
		<div id="page-title"><span><?php echo of_get_option('welcome', 'Welcome to WildCommunity' ); ?></span></div>
	<?php else : ?>
		<div id="page-title"><span><?php the_title(); ?></span></div>
	<?php endif; ?>
		

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<a href="<?php echo home_url(); ?>"><?php echo of_get_option('t-5', 'Home' ); ?></a> &nbsp;&raquo;&nbsp; <?php the_title(); ?>
	</div>
	</div><!-- #frontpage-info -->

		<div id="container">

	<div id="content">


	<?php if ( is_user_logged_in() ) : ?>

		<center><h3>You are logged in! Redirecting to <a href="<?php echo bp_loggedin_user_domain() ?>">your profile</a>.</h3></center><br /><br /><br />

		<script type="text/javascript">
		<!--
		window.location = "<?php echo bp_loggedin_user_domain() ?>"
		//-->
		</script>

	<?php else : ?>

		<?php do_action( 'bp_before_sidebar_login_form' ) ?>

		<form name="login-form" id="page-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
			<label><?php _e( 'Username', 'buddypress' ) ?><br />
			<input type="text" name="log" id="page-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

			<label><?php _e( 'Password', 'buddypress' ) ?><br />
			<input type="password" name="pwd" id="page-user-pass" class="input" value="" tabindex="98" /></label>

			<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>

			<?php do_action( 'bp_sidebar_login_form' ) ?>
			<input type="submit" name="wp-submit" id="wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" />
			<input type="hidden" name="testcookie" value="1" />
		</form>
		<br /><br /><br />

		<?php do_action( 'bp_after_sidebar_login_form' ) ?>

	<?php endif; ?>




	</div><!-- #content -->

<div class="clear"></div>
</div> <!-- #container -->

<?php get_footer(); ?>
