<?php

do_action( 'bp_before_group_header' );

?>


<div id="item-header-avatar">

	<div class="single-group-box-image-container">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_avatar(); ?>
		<div class="group-box-members"><?php bp_group_type(); ?></div>
		<div class="group-box-item-meta"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></div>
		</a>
	</div>


</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<?php do_action( 'bp_before_group_header_meta' ); ?>

		<?php bp_group_description(); ?>

	<div id="item-buttons">

		<?php do_action( 'bp_group_header_actions' ); ?>

	</div><!-- #item-buttons -->

		<?php do_action( 'bp_group_header_meta' ); ?>

</div><!-- #item-header-content -->

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>