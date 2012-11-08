<?php

/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_groups_loop' ); ?>

<div id="tabs-container">

        	<ul class="tabs-nav">
                <li class="nav-one"><a href="#popular" class="current"><?php echo of_get_option('t-9', 'Popular' ); ?></a></li>
                <li class="nav-two"><a href="#active"><?php echo of_get_option('t-10', 'Active' ); ?></a></li>
                <li class="nav-three"><a href="#alphabetical"><?php echo of_get_option('t-11', 'Alphabetical' ); ?></a></li>
                <li class="nav-four"><a href="#newest"><?php echo of_get_option('t-12', 'Newest' ); ?></a></li>
            </ul>

<div class="list-wrap">

<!-- GROUPS LOOP POPULAR -->
<?php if ( bp_has_groups( 'type=popular' ) ) : ?>

<ul id="popular">
     <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <span class="group-box">
	<span class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?>
		<span class="group-box-members"><?php bp_group_member_count(); ?></span>
		<span class="group-box-item-meta"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
		</a>
	</span>
	<span class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php bp_group_name(); ?></a></span>
	<span class="group-box-item-desc"><object><?php bp_group_description_excerpt(); ?> ...</object></span><br />
        </span><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 <ul id="popular">
    <div id="message" class="info" style="width:50%">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
</ul>
<?php endif; ?>
<!-- POPULAR GROUPS LOOP END -->


<!-- NEWEST GROUPS LOOP START -->
<?php if ( bp_has_groups( 'type=newest' ) ) : ?>

<ul id="newest" class="hide">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <span class="group-box">
	<span class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?>
		<span class="group-box-members"><?php bp_group_member_count(); ?></span>
		<span class="group-box-item-meta"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
		</a>
	</span>
	<span class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php bp_group_name(); ?></a></span>
	<span class="group-box-item-desc"><object><?php bp_group_description_excerpt(); ?> ...</object></span><br />
        </span><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 <ul id="newest" class="hide">
    <div id="message" class="info" style="width:50%">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
 </ul>
<?php endif; ?>

<!-- NEWEST GROUPS LOOP END -->


<!-- LAST ACTIVE GROUPS LOOP START -->

<?php if ( bp_has_groups( 'type=active' ) ) : ?>

<ul id="active" class="hide">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <span class="group-box">
	<span class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?>
		<span class="group-box-members"><?php bp_group_member_count(); ?></span>
		<span class="group-box-item-meta"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
		</a>
	</span>
	<span class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php bp_group_name(); ?></a></span>
	<span class="group-box-item-desc"><object><?php bp_group_description_excerpt(); ?> ...</object></span><br />
        </span><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 <ul id="active" class="hide">
    <div id="message" class="info" style="width:50%">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
 </ul>
<?php endif; ?>
<!-- LAST ACTIVE GROUPS LOOP END -->



<!-- ALPHABETICAL GROUPS LOOP -->
<?php if ( bp_has_groups( 'type=alphabetical' ) ) : ?>

<ul id="alphabetical" class="hide">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <span class="group-box">
	<span class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?>
		<span class="group-box-members"><?php bp_group_member_count(); ?></span>
		<span class="group-box-item-meta"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>
		</a>
	</span>
	<span class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php bp_group_name(); ?></a></span>
	<span class="group-box-item-desc"><object><?php bp_group_description_excerpt(); ?> ...</object></span><br />
        </span><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 <ul id="alphabetical" class="hide">
    <div id="message" class="info" style="width:50%">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
</ul>
<?php endif; ?>
<!-- ALPHABETICAL GROUPS LOOP END -->





</div> <!-- List Wrap -->
</div> <!-- tabs-container -->


<?php do_action( 'bp_after_groups_loop' ); ?>
