		

		<?php do_action( 'bp_after_container' ); ?>
		<?php do_action( 'bp_before_footer'   ); ?>

		<div id="footer">
			
			<div id="footer-widgets">

			<div id="footer-col1">

			<div class="footer-column-title"><?php echo of_get_option('t-3', 'Recent replies' ); ?></div>

			<?php if ( bp_has_activities('max=8&object=groups&user_id=0&action=new_forum_post&scope=0&primary_id=0') ) : ?>
			<ul>
    			<?php while ( bp_activities() ) : bp_the_activity(); ?>
 
        			<?php locate_template( array( 'activity/entry.php' ), true, false ); ?>
 
    			<?php endwhile; ?>
			</ul>
			<?php endif; ?>

			</div><!--footer-col1 ends-->
				
			<div id="footer-col2">

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer-column1')) : ?>
			<?php endif; ?>

			</div><!--footer-col2 ends-->

			<div class="clear"></div>	
			</div>
		
		</div><!-- #footer -->
		
		<div id="footer-bottom">
		<div class="footer-bottom-left">
			<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/social-facebook.png" alt="Facebook" /></a>
			<a href="http://digg.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>&amp;bodytext=<?php the_excerpt(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/social-digg.png" alt="Digg" /></a>
			<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/social-stumbleupon.png" alt="Stumbleupon" /></a>
			<a href="http://technorati.com/faves?sub=addfavbtn&amp;add=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/social-technorati.png" alt="Technorati" /></a>		
			<a href="http://www.twitter.com"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/social-twitter.png" alt="Twitter" /></a>
  		</div>	
		<div class="footer-bottom-right"><a href="/credits/">Credits</a> | <a href="/privacy-policy/">Privacy</a> | <a href="/community-terms-of-use/">Terms of Use</a> | &copy; All Content Copyright <?php echo date('Y'). ' '; echo of_get_option('t-4', ' All rights reserved by' ); ?> <?php bloginfo( 'name' ); ?></div>
		</div>

		<?php do_action( 'bp_after_footer' ); ?>

		<?php wp_footer(); ?>




<div id="top-bar">
    <div id="top-bar-center"> 

        <div id="top-bar-left">

		<?php if ( is_user_logged_in() ) : ?>
			<div id="bar-user">
				<div class="bar-avatar"><a href="<?php echo bp_loggedin_user_domain() ?>"><?php bp_loggedin_user_avatar( 'type=thumb&width=15&height=15' ) ?></a></div>

				<div class="bar-username"><?php echo of_get_option('t-7', 'Hello' ); ?> <?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?> (<a href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>"><?php _e( 'Log Out', 'buddypress' ) ?></a>)</div>
			</div>

		<?php if ( bp_is_active( 'messages' ) ) : ?>
			<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
		<?php endif; ?>

		<?php else : ?>

			<div class="top-login"><a href="<?php echo home_url(); ?>/login"><?php _e( 'Log In', 'buddypress' ); ?></a></div> 
		<?php if ( bp_get_signup_allowed() ) : ?>
			<div class="top-register">&nbsp;<?php echo of_get_option('t-6', 'or' ); ?>&nbsp;<?php printf( __( '<a href="%s" title="Create an account">Create an account</a>', 'buddypress' ), site_url( bp_get_signup_slug() . '/' ) ) ?></div>	
		<?php endif; ?>

	<?php endif; ?>
       <div class="clear"></div>
      </div><!--top-bar-left ends-->




        <div id="top-bar-right">
	 <?php get_search_form(); ?> 
        </div><!--top-bar-right ends-->

  </div><!--top-bar-center ends-->
</div><!--top-bar ends-->


	</body>

</html>
