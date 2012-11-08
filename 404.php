<?php get_header(); ?>

	<div id="header-bottom">

		<div id="page-title"><span><?php _e( "Page not found", 'buddypress' ); ?></span></div>

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<a href="<?php echo home_url(); ?>"><?php echo of_get_option('t-5', 'Home' ); ?></a> &nbsp;&raquo;&nbsp; <?php _e( "Page not found", 'buddypress' ); ?>
	</div>
	</div><!-- #frontpage-info -->

		<div id="container">

	<div id="content">

<br />


<p><?php _e( "We're sorry, but we can't find the page that you're looking for. Perhaps searching will help.", 'buddypress' ); ?></p>

<br />

<br />	



	</div><!-- #content -->


<div class="clear"></div>
</div> <!-- #container -->

<?php comments_template(); ?>

<?php get_footer(); ?>