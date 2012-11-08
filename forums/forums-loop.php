<?php

/**
 * BuddyPress - Forums Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_forums_loop' ); ?>

<?php if ( bp_has_forum_topics( 'per_page=10' ) ) : ?>

	

	<?php do_action( 'bp_before_directory_forums_list' ); ?>

	<div class="forum">
		<div class="forum-head">
	
				<div class="forum-head-author">Author</div>
				<div class="forum-head-topic"><?php _e( 'Topic', 'buddypress' ); ?></div>
				<div class="forum-head-freshness"><?php _e( 'Freshness', 'buddypress' ); ?></div>

		</div>
<div class="clear"></div>   


			<?php while ( bp_forum_topics() ) : bp_the_forum_topic(); ?>

			<div class="<?php bp_the_topic_css_class(); ?> topic-row">
			<div class="post-author"><?php printf( __( '%1$s', 'buddypress' ),  bp_get_the_topic_poster_avatar( 'height=50&width=50') ); ?></div>
			
			<div class="buble"></div>
			<div class="topic-title">
				<a class="forum-post-title" href="<?php bp_the_topic_permalink(); ?>" title="<?php bp_the_topic_title(); ?> - <?php _e( 'Permalink', 'buddypress' ); ?>"><?php bp_the_topic_title(); ?></a>

					<p class="topic-meta">
						<span class="topic-by"><span class="topic-counter"><?php bp_the_topic_total_posts(); ?></span> <?php _e( 'Posts', 'buddypress' ); ?> - <?php /* translators: "started by [poster] in [forum]" */ printf( __( 'Started by %1$s', 'buddypress' ), bp_get_the_topic_poster_name() ); ?> on <?php echo date( 'm.d.Y', strtotime( bp_get_the_topic_time() ) ) ?></span>

						<?php if ( !bp_is_group_forum() ) : ?>

							<span class="topic-in">

								<?php
									$topic_in = '<a style="display:none" href="' . bp_get_the_topic_object_permalink() . '">' . bp_get_the_topic_object_avatar( 'type=thumb&width=20&height=20' ) . '</a>' .
									'<a href="' . bp_get_the_topic_object_permalink() . '" title="' . bp_get_the_topic_object_name() . '">' . bp_get_the_topic_object_name() .'</a>';

									/* translators: "started by [poster] in [forum]" */
									printf( __( 'in %1$s', 'buddypress' ), $topic_in );
								?>
							</span>

						<?php endif; ?>

					</p>
			</div>
				

				<div class="topic-freshness">
					
				<div class="last-poster-avatar"><a href="<?php bp_the_topic_permalink(); ?>"><?php bp_the_topic_last_poster_avatar( 'type=thumb&width=40&height=40' ); ?></a></div>
				<div class="last-poster-right">
				<div class="time-since"><?php bp_the_topic_time_since_last_post(); ?></div>
				Last post by <?php bp_the_topic_last_poster_name(); ?>

				</div>


				</div>
<div class="clear"></div>   
				<?php do_action( 'bp_directory_forums_extra_cell' ); ?>

			</div>

			<?php do_action( 'bp_directory_forums_extra_row' ); ?>

			<?php endwhile; ?>

	</div>

	<?php do_action( 'bp_after_directory_forums_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="topic-count-bottom">
			<?php bp_forum_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="topic-pag-bottom">
			<?php bp_forum_pagination(); ?>
		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, there were no forum topics found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_forums_loop' ); ?>
