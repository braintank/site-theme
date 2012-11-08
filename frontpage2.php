<?php
/*
Template Name: Frontpage 2
*/
?>

<?php get_header() ?>


	<div id="header-bottom">

		<div id="text1"><span><?php echo of_get_option('welcome', 'Welcome to WildCommunity' ); ?></span></div>
		<div id="text2"><span><?php echo of_get_option('members', '75.000 members and counting...' ); ?></span></div>

	</div><!-- #header-bottom -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<div id="frontpage-info-icon"></div>
<?php echo of_get_option('info', 'BuddyPress lets users register on your site and start creating profiles, posting messages, making connections, creating and interacting in groups and much more. A social network in a box, BuddyPress lets you build a social network for your company, school, sports team or niche community. BuddyPress boasts an ever growing array of new features developed by an awesome plugin development community. There are more than 330 BuddyPress plugins available, and the list is growing every day.' ); ?>
	</div>
	</div><!-- #frontpage-info -->

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>

<div id="container">

	<div id="content">


<div id="front-boxes2">
<div id="front-boxes-wider2">

<div class="front-box2">
    <div style="padding:0px;"><a href="<?php echo of_get_option('1box-link', 'forums' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/box-forum.png" alt="<?php echo of_get_option('1box-title', 'Forums' ); ?>" /></a></div><br />
    <div class="front-box-title2"><a href="<?php echo of_get_option('1box-link', 'forums' ); ?>"><?php echo of_get_option('1box-title', 'Forums' ); ?></a></div>			
<?php echo of_get_option('1box-desc', 'Cras fermentum neque et dui adipiscing mattis. Donec vitae justo lacus, vitae rutrum dolor. Donec dolor leo, blandit sit amet mattis id, ultricies sed risus.' ); ?><br />	
</div><!--front-box2 ends-->


<div class="front-box2">
   <div style="padding:0px;"><a href="<?php echo of_get_option('2box-link', 'groups' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/box-groups.png" alt="<?php echo of_get_option('2box-title', 'Our Groups' ); ?>" /></a></div><br />
    <div class="front-box-title2"><a href="<?php echo of_get_option('2box-link', 'groups' ); ?>"><?php echo of_get_option('2box-title', 'Our Groups' ); ?></a></div>
<?php echo of_get_option('2box-desc', 'Morbi ipsum mauris, volutpat dictum pharetra a, congue sit amet neque. Fusce a nisl id est auctor tincidunt. Etiam laoreet orci, nec consequat.' ); ?><br />	
</div><!--front-box2 ends-->

<div class="front-box2">
    <div style="padding:0px;"><a href="<?php echo of_get_option('3box-link', 'about-us' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/box-info.png" alt="<?php echo of_get_option('3box-title', 'How it works?' ); ?>" /></a></div><br />
    <div class="front-box-title2"><a href="<?php echo of_get_option('3box-link', 'about-us' ); ?>"><?php echo of_get_option('3box-title', 'How it works?' ); ?></a></div>
<?php echo of_get_option('3box-desc', 'In hac habitasse platea dictumst. Morbi ipsum mauris, volutpat dictum pharetra a, congue sit amet neque. Fusce a nisl id est volutpat dictum.' ); ?><br />	
</div><!--front-box2 ends-->

<div class="clear"> </div>
</div><!-- front-boxes-wider ends-->
</div><!-- front-boxes ends-->









<div class="frontpage-bottom">


<div id="tabs-container">

        	<ul class="tabs-nav">
                <li class="nav-one"><a href="#popular" class="current"><?php echo of_get_option('t-9', 'Popular' ); ?></a></li>
                <li class="nav-two"><a href="#active"><?php echo of_get_option('t-10', 'Active' ); ?></a></li>
                <li class="nav-three"><a href="#alphabetical"><?php echo of_get_option('t-11', 'Alphabetical' ); ?></a></li>
                <li class="nav-four"><a href="#newest"><?php echo of_get_option('t-12', 'Newest' ); ?></a></li>
            </ul>

<div class="list-wrap">

<!-- NEWEST GROUPS LOOP POPULAR -->
<?php if ( bp_has_groups( 'type=popular&max=12' ) ) : ?>

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
 
    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>

<?php endif; ?>
<!-- POPULAR GROUPS LOOP END -->

<!-- NEWEST GROUPS LOOP START -->
<?php if ( bp_has_groups( 'type=newest&max=12' ) ) : ?>

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
 
    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>
 
<?php endif; ?>

<!-- NEWEST GROUPS LOOP END -->


<!-- LAST ACTIVE GROUPS LOOP START -->

<?php if ( bp_has_groups( 'type=active&max=12' ) ) : ?>

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
 
    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>
 
<?php endif; ?>
<!-- LAST ACTIVE GROUPS LOOP END -->



<!-- ALPHABETICAL GROUPS LOOP -->
<?php if ( bp_has_groups( 'type=alphabetical&max=12' ) ) : ?>

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
 
    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>

<?php endif; ?>
<!-- ALPHABETICAL GROUPS LOOP END -->



</div> <!-- List Wrap -->
</div> <!-- tabs-container -->

</div><!-- .frontpage-bottom -->


	</div><!-- #content -->
</div> <!-- #container -->
<?php get_footer() ?>
