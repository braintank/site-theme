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


		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page" id="blog-page" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

						<?php the_content( __( '<p class="serif">Read the rest of this page &rarr;</p>', 'buddypress' ) ); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
					
					</div>
					</div>

				</div>

			<?php endwhile; endif; ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>


<div class="clear"></div>
</div> <!-- #container -->

<?php comments_template(); ?>

<?php get_footer(); ?>
