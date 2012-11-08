<?php get_header( 'buddypress' ); ?>

	<div id="header-bottom">

		<div id="page-title"><span><?php _e( 'Groups Directory', 'buddypress' ); ?></span></div>

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	Home &raquo; <?php _e( 'Groups Directory', 'buddypress' ); ?>
	</div>
	</div><!-- #frontpage-info -->

		<div id="container">


<?php do_action( 'template_notices' ); ?>

<div class="activity no-ajax" role="main">
	<?php if ( bp_has_activities( 'display_comments=threaded&show_hidden=true&include=' . bp_current_action() ) ) : ?>

		<ul id="activity-stream" class="activity-list item-list">
		<?php while ( bp_activities() ) : bp_the_activity(); ?>

			<?php locate_template( array( 'activity/entry.php' ), true ); ?>

		<?php endwhile; ?>
		</ul>

	<?php endif; ?>
</div>

<div class="clear"></div>
</div> <!-- #container -->

<?php get_footer( 'buddypress' ); ?>