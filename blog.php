<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

	<div id="header-bottom">

		<div id="page-title"><span><?php echo of_get_option('t-16', 'Community News' ); ?></span></div>

	</div><!-- #header-bottom-small -->

	</div><!-- #header-container -->

	<div id="frontpage-info">
	<div id="frontpage-info-center">
	<a href="<?php echo home_url(); ?>"><?php echo of_get_option('t-5', 'Home' ); ?></a> &nbsp;&raquo;&nbsp; <?php echo of_get_option('t-16', 'Community News' ); ?>
	</div>
	</div><!-- #frontpage-info -->

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>

		<div id="container">

<div id="content">



<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=4'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

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

<?php
global $more;
$more = 0;
the_content( __( '<span class="more">Read more ...</span>', 'buddypress' ) );
?>

</div><!--text-->

</div><!--blog-post-right-->

</div><!--blog-post-->
<div class="clear"> </div>


<?php endwhile; // end of loop
 ?>

<div style="display:inline">
<div class="older-entries"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ); ?></div>
<div class="newer-entries"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ); ?></div>
</div>

<?php $wp_query = null; $wp_query = $temp;?>

</div><!--content ends-->

<div id="sidebar">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-blog')) : ?><?php endif; ?>
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-ad-blog')) : ?><?php endif; ?>
</div><!--sidebar ends-->

<div class="clear"></div>
</div> <!-- #container -->
<?php get_footer(); ?>