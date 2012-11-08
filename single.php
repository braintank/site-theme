<?php get_header(); ?>



	<div id="header-bottom">

	<div id="page-title"><span><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 37; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></span></div>

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<a href="<?php echo home_url(); ?>"><?php echo of_get_option('t-5', 'Home' ); ?></a> &nbsp;&raquo;&nbsp; <a href="<?php echo home_url(); ?>/<?php echo of_get_option('t-17', 'blog' ); ?>"><?php echo of_get_option('t-16', 'Community News' ); ?></a> &nbsp;&raquo;&nbsp; <?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 20; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?>
	</div>
	</div><!-- #frontpage-info -->

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>

		<div id="container">

<div id="container-single">

	<div id="content">

			<?php do_action( 'bp_before_blog_single_post' ); ?>


			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
					<?php the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); ?>

					<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
				</div>
<br />
<br />
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-504612076f0dbf6b"></script>
<!-- AddThis Button END -->


    <?php $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=>5, // Number of related posts that will be shown.
    'caller_get_posts'=>1
    );
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {

    echo '<div id="relatedposts"><div id="relatedposts-title">' .  of_get_option('t-20', 'Related Posts' ) . ':</div>';

    while( $my_query->have_posts() ) {
    $my_query->the_post(); ?>

    <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><br /><br />
    <?php }
    echo '</div>';
    }
    }
    $post = $orig_post;
    wp_reset_query(); ?>


	</div><!--text-->

	</div><!--blog-post-right-->

	</div><!--blog-post-->
	<div class="clear"> </div>

			

			<?php endwhile; else: ?>

				<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>

			<?php endif; ?>


		<?php do_action( 'bp_after_blog_single_post' ); ?>

	</div><!-- #content -->

<div id="sidebar">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-single')) : ?><?php endif; ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-ad-single')) : ?><?php endif; ?>
</div><!--sidebar ends-->
</div><!-- #container-single -->
<div class="clear"> </div>
<?php comments_template(); ?>

</div> <!-- #container -->
<?php get_footer(); ?>