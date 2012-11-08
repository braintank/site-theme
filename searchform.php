<?php do_action( 'bp_before_blog_search_form' ); ?>

<div id="top-search-container">
<div id="adv-search-link"><a href="<?php echo home_url(); ?>/searching"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/adv-search.png" alt="Advanced Search" /></a></div>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" title="<?php echo of_get_option('t-8', 'Search' ); ?>" value="<?php the_search_query(); ?>" name="s" id="s" class="hoverText hoverTextActive" />
	<input type="submit" id="searchsubmit" value=" " />
	<?php do_action( 'bp_blog_search_form' ); ?>
</form>
</div>

<?php do_action( 'bp_after_blog_search_form' ); ?>