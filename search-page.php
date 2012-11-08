<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

	<div id="header-bottom">

		<div id="page-title"><span><?php the_title(); ?></span></div>

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<a href="<?php echo home_url(); ?>"><?php echo of_get_option('t-5', 'Home' ); ?></a> &nbsp;&raquo;&nbsp; <?php the_title(); ?>
	</div>
	</div><!-- #frontpage-info -->

		<div id="container">

	<div id="content">


	<form action="<?php echo bp_search_form_action(); ?>" method="post" id="search-form">
		<span id="search-page-border">
		<label class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
		<input type="text" class="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />
		<?php echo bp_search_form_type_select(); ?>
		</span>
		<input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ); ?>" />
		<?php wp_nonce_field( 'bp_search_form' ); ?>
	</form><!-- #search-form -->



	</div><!-- #content -->

<div class="clear"></div>
</div> <!-- #container -->

<?php get_footer(); ?>
