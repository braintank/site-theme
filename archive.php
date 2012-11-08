<?php get_header(); ?>


	<div id="header-bottom">

		<div id="page-title"><span><?php printf( __( '%1$s ', 'buddypress' ), wp_title( false, false ) ); ?></span></div>

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<a href="<?php echo home_url(); ?>"><?php echo of_get_option('t-5', 'Home' ); ?></a> &nbsp;&raquo;&nbsp; <a href="<?php echo home_url(); ?>/<?php echo of_get_option('t-17', 'blog' ); ?>"><?php echo of_get_option('t-16', 'Community News' ); ?></a> &nbsp;&raquo;&nbsp; <?php printf( __( '%1$s ', 'buddypress' ), wp_title( false, false ) ); ?>
	</div>
	</div><!-- #frontpage-info -->

		<div id="container">

	<div id="content">

		<?php do_action( 'bp_before_archive' ); ?>



			<?php if ( have_posts() ) : ?>

				<?php bp_dtheme_content_nav( 'nav-above' ); ?>

				<?php while (have_posts()) : the_post(); ?>

					<?php do_action( 'bp_before_blog_post' ); ?>

					<div class="blog-post">

					<div class="blog-post-left">
					<div class="blog-post-left-date">
					<div class="blog-post-left-month"><?php the_time('M') ?></div>
					<div class="blog-post-left-day"><?php the_time('j') ?></div>
					</div>
					<div class="blog-post-left-author"><?php the_author(); ?></div>
					</div>

					<div class="blog-post-right">
					<div class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Fixed link <?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
					<div class="post-title-bottom">
					<div class="post-title-bottom-category"><?php the_category(', ') ?></div>
					<div class="post-title-bottom-comments"><?php comments_number('0', '1', '%'); ?></div>
					<div class="post-title-bottom-tags"><?php the_tags('', ', ', '<br />'); ?> </div>
					</div>
					<div class="clear"> </div>

					<div class="text">

<?php
if ( has_post_thumbnail() ) { ?>
	<div class="thumbnail">
		<?php the_post_thumbnail('full'); ?>
	</div>
<?php } else {
	// no thumbnail
}
?>
					<div class="entry">
					<?php the_content( __( 'Read more ...', 'buddypress' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
					</div>

											
					<?php do_action( 'bp_after_blog_post' ); ?>

					</div><!--text-->

					</div><!--blog-post-right-->

					</div><!--blog-post-->
					<div class="clear"> </div>

				<?php endwhile; ?>

				<?php bp_dtheme_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<h2 class="center"><?php _e( 'Not Found', 'buddypress' ); ?></h2>
				<?php get_search_form(); ?>

			<?php endif; ?>


		<?php do_action( 'bp_after_archive' ); ?>

	</div><!-- #content -->

<div id="sidebar">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-blog')) : ?><?php endif; ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-ad-blog')) : ?><?php endif; ?>
</div><!--sidebar ends-->


<div class="clear"></div>
</div> <!-- #container -->

<?php get_footer(); ?>
