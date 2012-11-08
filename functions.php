<?php
/**
 * BP-Default theme functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress and BuddyPress to change core functionality.
 *
 * The first function, bp_dtheme_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails and navigation menus, and
 * for BuddyPress, action buttons and javascript localisation.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development, http://codex.wordpress.org/Child_Themes
 * and http://codex.buddypress.org/theme-development/building-a-buddypress-child-theme/), you can override
 * certain functions (those wrapped in a function_exists() call) by defining them first in your
 * child theme's functions.php file. The child theme's functions.php file is included before the
 * parent theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package BuddyPress
 * @subpackage BP-Default
 * @since 1.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// If BuddyPress is not activated, switch back to the default WP theme and bail out
if ( ! function_exists( 'bp_is_active' ) ) {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	return;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 591;

if ( ! function_exists( 'bp_dtheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress and BuddyPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override bp_dtheme_setup() in a child theme, add your own bp_dtheme_setup to your child theme's
 * functions.php file.
 *
 * @global BuddyPress $bp The one true BuddyPress instance
 * @since BuddyPress (1.5)
 */
function bp_dtheme_setup() {

	// Load the AJAX functions for the theme
	require( get_template_directory() . '/_inc/ajax.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme comes with all the BuddyPress goodies
	add_theme_support( 'buddypress' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );


	if ( !is_admin() ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button',           5 );

		// Activity button
		if ( bp_is_active( 'activity' ) )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button',  20 );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button', 20 );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button',           5 );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}
add_action( 'after_setup_theme', 'bp_dtheme_setup' );
endif;

if ( !function_exists( 'bp_dtheme_enqueue_scripts' ) ) :
/**
 * Enqueue theme javascript safely
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @since BuddyPress (1.5)
 */
function bp_dtheme_enqueue_scripts() {

	// Enqueue the global JS - Ajax will not work without it
	wp_enqueue_script( 'dtheme-ajax-js', get_template_directory_uri() . '/_inc/global.js', array( 'jquery' ), bp_get_version() );

	// Add words that we need to use in JS to the end of the page so they can be translated and still used.
	$params = array(
		'my_favs'           => __( 'My Favorites', 'buddypress' ),
		'accepted'          => __( 'Accepted', 'buddypress' ),
		'rejected'          => __( 'Rejected', 'buddypress' ),
		'show_all_comments' => __( 'Show all comments for this thread', 'buddypress' ),
		'show_all'          => __( 'Show all', 'buddypress' ),
		'comments'          => __( 'comments', 'buddypress' ),
		'close'             => __( 'Close', 'buddypress' ),
		'view'              => __( 'View', 'buddypress' ),
		'mark_as_fav'	    => __( 'Favorite', 'buddypress' ),
		'remove_fav'	    => __( 'Remove Favorite', 'buddypress' )
	);
	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );

	// Maybe enqueue comment reply JS
	if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_scripts' );
endif;

if ( !function_exists( 'bp_dtheme_enqueue_styles' ) ) :
/**
 * Enqueue theme CSS safely
 *
 * For maximum flexibility, BuddyPress Default's stylesheet is enqueued, using wp_enqueue_style().
 * If you're building a child theme of bp-default, your stylesheet will also be enqueued,
 * automatically, as dependent on bp-default's CSS. For this reason, bp-default child themes are
 * not recommended to include bp-default's stylesheet using @import.
 *
 * If you would prefer to use @import, or would like to change the way in which stylesheets are
 * enqueued, you can override bp_dtheme_enqueue_styles() in your theme's functions.php file.
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * @see http://codex.buddypress.org/releases/1-5-developer-and-designer-information/
 * @since BuddyPress (1.5)
 */
function bp_dtheme_enqueue_styles() {

	wp_register_style( 'bp-default-main', get_template_directory_uri() . '/_inc/css/default.css', array(), bp_get_version() );
	wp_register_style( 'responsive', get_template_directory_uri() . '/_inc/css/responsive.css', array(), bp_get_version() );

	if ( is_child_theme() && 'bp-default' == get_template() ) {
		wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'bp-default-main' ), bp_get_version() );
	}

	wp_enqueue_style( 'bp-default-main' );
	wp_enqueue_style( 'responsive' );

	// Default CSS RTL
	if ( is_rtl() )
		wp_enqueue_style( 'bp-default-main-rtl',  get_template_directory_uri() . '/_inc/css/default-rtl.css', array( 'bp-default-main' ), bp_get_version() );


}
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_styles' );
endif;

if ( !function_exists( 'bp_dtheme_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in bp_dtheme_setup().
 *
 * @since 1.2
 */
function bp_dtheme_admin_header_style() {
?>
	<style type="text/css">
		#headimg {
			position: relative;
			color: #fff;
			background: url(<?php header_image(); ?>);
			-moz-border-radius-bottomleft: 6px;
			-webkit-border-bottom-left-radius: 6px;
			-moz-border-radius-bottomright: 6px;
			-webkit-border-bottom-right-radius: 6px;
			margin-bottom: 20px;
			height: 133px;
		}

		#headimg h1{
			position: absolute;
			bottom: 15px;
			left: 15px;
			width: 44%;
			margin: 0;
			font-family: Arial, Tahoma, sans-serif;
		}
		#headimg h1 a{
			color:#<?php header_textcolor(); ?>;
			text-decoration: none;
			border-bottom: none;
		}
		#headimg #desc{
			color:#<?php header_textcolor(); ?>;
			font-size:1em;
			margin-top:-0.5em;
		}

		#desc {
			display: none;
		}

		<?php if ( 'blank' == get_header_textcolor() ) { ?>
		#headimg h1, #headimg #desc {
			display: none;
		}
		#headimg h1 a, #headimg #desc {
			color:#<?php echo HEADER_TEXTCOLOR; ?>;
		}
		<?php } ?>
	</style>
<?php
}
endif;

if ( !function_exists( 'bp_dtheme_custom_background_style' ) ) :
/**
 * The style for the custom background image or colour.
 *
 * Referenced via add_custom_background() in bp_dtheme_setup().
 *
 * @see _custom_background_cb()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_custom_background_style() {
	$background = get_background_image();
	$color = get_background_color();
	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $style && !$background ) {
		$style .= ' background-image: none;';

	} elseif ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
?>
	<style type="text/css">
		body { <?php echo trim( $style ); ?> }
	</style>
<?php
}
endif;

if ( !function_exists( 'bp_dtheme_header_style' ) ) :
/**
 * The styles for the post thumbnails / custom page headers.
 *
 * Referenced via add_custom_image_header() in bp_dtheme_setup().
 *
 * @global WP_Query $post The current WP_Query object for the current post or page
 * @since 1.2
 */
function bp_dtheme_header_style() {
	global $post;

	$header_image = '';

	if ( is_singular() && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );

		// $src, $width, $height
		if ( !empty( $image ) && $image[1] >= HEADER_IMAGE_WIDTH )
			$header_image = $image[0];
		else
			$header_image = get_header_image();

	} else {
		$header_image = get_header_image();
	}
?>

	<style type="text/css">
		<?php if ( !empty( $header_image ) ) : ?>
			#header { background-image: url(<?php echo $header_image ?>); }
		<?php endif; ?>

		<?php if ( 'blank' == get_header_textcolor() ) { ?>
		#header h1, #header #desc { display: none; }
		<?php } else { ?>
		#header h1 a, #desc { color:#<?php header_textcolor(); ?>; }
		<?php } ?>
	</style>

<?php
}
endif;


if ( !function_exists( 'bp_dtheme_blog_comments' ) ) :
$counter = 0;
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own bp_dtheme_blog_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @param mixed $comment Comment record from database
 * @param array $args Arguments from wp_list_comments() call
 * @param int $depth Comment nesting level
 * @see wp_list_comments()
 * @since 1.2
 */
function bp_dtheme_blog_comments( $comment, $args, $depth ) {
	global $counter; // Make counter variable global so we can use it inside this function.
	$counter++;
	$GLOBALS['comment'] = $comment;


	if ( 'pingback' == $comment->comment_type )
		return false;

	if ( 1 == $depth )
		$avatar_size = 70;
	else
		$avatar_size = 40;
	?>


	<li <?php comment_class(); ?> id="comment-<?php echo $counter; ?>">
	<div class="comment-body" id="comment-body-<?php echo $counter; ?>">

		<div class="comment-avatar-box">
			<div class="avb">
				<a href="<?php echo get_comment_author_url(); ?>" rel="nofollow">
					<?php if ( $comment->user_id ) : ?>
						<?php echo bp_core_fetch_avatar( array( 'item_id' => $comment->user_id, 'width' => $avatar_size, 'height' => $avatar_size, 'email' => $comment->comment_author_email ) ); ?>
					<?php else : ?>
						<?php echo get_avatar( $comment, $avatar_size ); ?>
					<?php endif; ?>
				</a>
			</div>
		</div>
		
		<div class="comment-content">
			<div class="comment-meta">
				<p>
					<?php
						/* translators: 1: comment author url, 2: comment author name, 3: comment permalink, 4: comment date/timestamp*/
						printf( __( '<a href="%1$s" rel="nofollow">%2$s</a> said on <a href="%3$s"><span class="time-since">%4$s</span></a>', 'buddypress' ), get_comment_author_url(), get_comment_author(), get_comment_link(), get_comment_date() );
					?>
				</p>
			</div>

			<div class="comment-entry">
				<?php if ( $comment->comment_approved == '0' ) : ?>
				 	<em class="moderate"><?php _e( 'Your comment is awaiting moderation.', 'buddypress' ); ?></em>
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>

			<div class="comment-options">
					<?php if ( comments_open() ) : ?>
						<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ); ?>
					<?php endif; ?>

					<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>
						<?php printf( '<a class="comment-edit-link" href="%1$s" title="%2$s">%3$s</a> ', get_edit_comment_link( $comment->comment_ID ), esc_attr__( 'Edit comment', 'buddypress' ), __( 'Edit', 'buddypress' ) ); ?>
					<?php endif; ?>

			</div>

		</div><!-- comment-content -->

<div class="comment-counter" id="comment-counter-<?php echo $counter; ?>"><a href="#comment-<?php comment_ID(); ?>"><?php echo $counter; ?></a></div>
<div class="clear"> </div>
	</div><!-- comment-body -->

<?php
}
endif;

if ( !function_exists( 'bp_dtheme_page_on_front' ) ) :
/**
 * Return the ID of a page set as the home page.
 *
 * @return false|int ID of page set as the home page
 * @since 1.2
 */
function bp_dtheme_page_on_front() {
	if ( 'page' != get_option( 'show_on_front' ) )
		return false;

	return apply_filters( 'bp_dtheme_page_on_front', get_option( 'page_on_front' ) );
}
endif;

if ( !function_exists( 'bp_dtheme_activity_secondary_avatars' ) ) :
/**
 * Add secondary avatar image to this activity stream's record, if supported.
 *
 * @param string $action The text of this activity
 * @param BP_Activity_Activity $activity Activity object
 * @package BuddyPress Theme
 * @return string
 * @since 1.2.6
 */
function bp_dtheme_activity_secondary_avatars( $action, $activity ) {
	switch ( $activity->component ) {
		case 'groups' :
		case 'friends' :
			// Only insert avatar if one exists
			if ( $secondary_avatar = bp_get_activity_secondary_avatar() ) {
				$reverse_content = strrev( $action );
				$position        = strpos( $reverse_content, 'a<' );
				$action          = substr_replace( $action, $secondary_avatar, -$position - 2, 0 );
			}
			break;
	}

	return $action;
}
add_filter( 'bp_get_activity_action_pre_meta', 'bp_dtheme_activity_secondary_avatars', 10, 2 );
endif;

if ( !function_exists( 'bp_dtheme_show_notice' ) ) :
/**
 * Show a notice when the theme is activated - workaround by Ozh (http://old.nabble.com/Activation-hook-exist-for-themes--td25211004.html)
 *
 * @since 1.2
 */
function bp_dtheme_show_notice() {
	global $pagenow;

	// Bail if bp-default theme was not just activated
	if ( empty( $_GET['activated'] ) || ( 'themes.php' != $pagenow ) || !is_admin() )
		return;

	?>

	<div id="message" class="updated fade">
		<p><?php printf( __( 'Theme activated! This theme contains <a href="%s">custom header image</a> support and <a href="%s">sidebar widgets</a>.', 'buddypress' ), admin_url( 'themes.php?page=custom-header' ), admin_url( 'widgets.php' ) ); ?></p>
	</div>

	<style type="text/css">#message2, #message0 { display: none; }</style>

	<?php
}
add_action( 'admin_notices', 'bp_dtheme_show_notice' );
endif;


if ( !function_exists( 'bp_dtheme_comment_form' ) ) :
/**
 * Applies BuddyPress customisations to the post comment form.
 *
 * @param array $default_labels The default options for strings, fields etc in the form
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_comment_form( $default_labels ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$fields    =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'buddypress' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'buddypress' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'buddypress' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$new_labels = array(
		'comment_field'  => '<p class="form-textarea"><textarea name="comment" id="comment" cols="60" rows="10" aria-required="true"></textarea></p>',
		'fields'         => apply_filters( 'comment_form_default_fields', $fields ),
		'logged_in_as'   => '',
		'must_log_in'    => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s">logged in</a> to post a comment.', 'buddypress' ), wp_login_url( get_permalink() ) )	. '</p>',
		'id_submit' => 'comment-submit',
		'title_reply'    => __( 'Leave a reply', 'buddypress' )
	);

	return apply_filters( 'bp_dtheme_comment_form', array_merge( $default_labels, $new_labels ) );
}
add_filter( 'comment_form_defaults', 'bp_dtheme_comment_form', 10 );
endif;

if ( !function_exists( 'bp_dtheme_before_comment_form' ) ) :
/**
 * Adds the user's avatar before the comment form box.
 *
 * The 'comment_form_top' action is used to insert our HTML within <div id="reply">
 * so that the nested comments comment-reply javascript moves the entirety of the comment reply area.
 *
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_before_comment_form() {
?>

	<div class="comment-content standard-form">
<?php
}
add_action( 'comment_form_top', 'bp_dtheme_before_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_after_comment_form' ) ) :
/**
 * Closes tags opened in bp_dtheme_before_comment_form().
 *
 * @see bp_dtheme_before_comment_form()
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_after_comment_form() {
?>

	</div><!-- .comment-content standard-form -->

<?php
}
add_action( 'comment_form', 'bp_dtheme_after_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_sidebar_login_redirect_to' ) ) :
/**
 * Adds a hidden "redirect_to" input field to the sidebar login form.
 *
 * @since BuddyPress (1.5)
 */
function bp_dtheme_sidebar_login_redirect_to() {
	$redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	$redirect_to = apply_filters( 'bp_no_access_redirect', $redirect_to ); ?>

	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />

<?php
}
add_action( 'bp_sidebar_login_form', 'bp_dtheme_sidebar_login_redirect_to' );
endif;

if ( !function_exists( 'bp_dtheme_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @global WP_Query $wp_query
 * @param string $nav_id DOM ID for this navigation
 * @since BuddyPress (1.5)
 */
function bp_dtheme_content_nav( $nav_id ) {
	global $wp_query;

	if ( !empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 1 ) : ?>

		<div id="<?php echo $nav_id; ?>" class="navigation">
			<div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ); ?></div>
		</div><!-- #<?php echo $nav_id; ?> -->

	<?php endif;
}
endif;

/**
 * Adds the no-js class to the body tag.
 *
 * This function ensures that the <body> element will have the 'no-js' class by default. If you're
 * using JavaScript for some visual functionality in your theme, and you want to provide noscript
 * support, apply those styles to body.no-js.
 *
 * The no-js class is removed by the JavaScript created in bp_dtheme_remove_nojs_body_class().
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_remove_nojs_body_class()
 */
function bp_dtheme_add_nojs_body_class( $classes ) {
	$classes[] = 'no-js';
	return array_unique( $classes );
}
add_filter( 'bp_get_the_body_class', 'bp_dtheme_add_nojs_body_class' );

/**
 * Dynamically removes the no-js class from the <body> element.
 *
 * By default, the no-js class is added to the body (see bp_dtheme_add_no_js_body_class()). The
 * JavaScript in this function is loaded into the <body> element immediately after the <body> tag
 * (note that it's hooked to bp_before_header), and uses JavaScript to switch the 'no-js' body class
 * to 'js'. If your theme has styles that should only apply for JavaScript-enabled users, apply them
 * to body.js.
 *
 * This technique is borrowed from WordPress, wp-admin/admin-header.php.
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_add_nojs_body_class()
 */
function bp_dtheme_remove_nojs_body_class() {
?><script type="text/javascript">//<![CDATA[
(function(){var c=document.body.className;c=c.replace(/no-js/,'js');document.body.className=c;})();
//]]></script>
<?php
}
add_action( 'bp_before_header', 'bp_dtheme_remove_nojs_body_class' );



 function load_fonts() {
           wp_register_style('DroidSans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
            wp_enqueue_style( 'DroidSans');
        }
 
 add_action('wp_print_styles', 'load_fonts');


function add_scripts(){
  if (!is_admin()) {
   wp_enqueue_script("jquery");
   wp_enqueue_script('Cufon',get_stylesheet_directory_uri().'/font/cufon.js',false,'1.09i',false);
   wp_enqueue_script('Titillium',get_stylesheet_directory_uri().'/font/Titillium_basic.font.js',false,'1.0',false);
   wp_enqueue_script('SelectStyle',get_stylesheet_directory_uri().'/js/select-styling.js',false,'1.0',false);
   wp_enqueue_script('InputText',get_stylesheet_directory_uri().'/js/input-text.js',false,'1.0',false);
   wp_enqueue_script('OrganicTabs',get_stylesheet_directory_uri().'/js/organictabs.jquery.js',false,'1.0',false);
  }
}
add_action('init','add_scripts');

if (!is_admin()) {
add_filter('show_admin_bar', '__return_false');
}

if (function_exists('register_sidebar')) {


	register_sidebar(array(
		'name' => 'Sidebar - Frontpage',
		'id'   => 'sidebar-frontpage',
		'description'   => 'This is a widgetized area visible on the frontpage.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box-child ends--></div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div><div class="sidebar-box-child">'
	));

	register_sidebar(array(
		'name' => 'Sidebar - Frontpage (Middle-Top)',
		'id'   => 'sidebar-middle-top',
		'description'   => 'This is a widgetized area visible on the frontpage.',
		'before_widget' => '',
		'after_widget'  => '<div class="clear"></div>',
		'before_title'  => '',
		'after_title'   => ''
	));

	register_sidebar(array(
		'name' => 'Sidebar - Frontpage (Middle)',
		'id'   => 'sidebar-middle',
		'description'   => 'This is a widgetized area visible on the frontpage.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box-child ends--></div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div><div class="sidebar-box-child">'
	));

	register_sidebar(array(
		'name' => 'Sidebar - Blog',
		'id'   => 'sidebar-blog',
		'description'   => 'This is a widgetized area visible on the blog pages.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box-child ends--></div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div><div class="sidebar-box-child">'
	));

	register_sidebar(array(
		'name' => 'Sidebar - Single Post',
		'id'   => 'sidebar-single',
		'description'   => 'This is a widgetized area visible on the single post.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box-child ends--></div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div><div class="sidebar-box-child">'
	));


	register_sidebar(array(
		'name' => 'Sidebar - Contact',
		'id'   => 'sidebar-contact',
		'description'   => 'This is a widgetized area visible on the contact form page.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box-child ends--></div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div><div class="sidebar-box-child">'
	));


	register_sidebar(array(
		'name' => 'Sidebar - Pages',
		'id'   => 'sidebar-pages',
		'description'   => 'This is a widgetized area visible on the pages.',
		'before_widget' => '<div class="sidebar-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><!--sidebar-box-child ends--></div><!--sidebar-box ends--><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-title">',
		'after_title'   => '</div><div class="sidebar-box-child">'
	));





	register_sidebar(array(
		'name' => 'Sidebar Ad - Blog',
		'id'   => 'sidebar-ad-blog',
		'description'   => 'This is a widgetized area for ads visible on the blog pages.',
		'before_widget' => '<div class="sidebar-ad-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-ad-title">',
		'after_title'   => '</div>'
	));

	register_sidebar(array(
		'name' => 'Sidebar Ad - Single Post',
		'id'   => 'sidebar-ad-single',
		'description'   => 'This is a widgetized area for ads  visible on the blog post pages.',
		'before_widget' => '<div class="sidebar-ad-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-ad-title">',
		'after_title'   => '</div>'
	));


	register_sidebar(array(
		'name' => 'Sidebar Ad - Pages',
		'id'   => 'sidebar-ad-pages',
		'description'   => 'This is a widgetized area for ads visible on the pages.',
		'before_widget' => '<div class="sidebar-ad-box %2$s"  id="%1$s">',
		'after_widget'  => '</div><div class="clear"></div>',
		'before_title'  => '<div class="sidebar-ad-title">',
		'after_title'   => '</div>'
	));



	register_sidebar(array(
		'name' => 'Footer Right Column',
		'id'   => 'footer-column1',
		'description'   => 'This is a widgetized area.',
		'before_widget' => '<div class="footer-column-box">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="footer-column-title">',
		'after_title'   => '</div>'

	));


}






class My_BlogCategories extends WP_Widget {  
        function My_BlogCategories() {  
            parent::WP_Widget(false, 'Blog categories');  
        }  
    function form($instance) {  
               print "This widget displays blog categories in 2 columns";  
        }  
    function update($new_instance, $old_instance) {  
            // processes widget options to be saved  
            return $new_instance;  
        }  
function widget($args, $instance) {  ?>
        
<?php
$cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=1&style=none'));
$cat_n = count($cats) - 1;
$cat_left = '';
$cat_right = '';
for ($i=0;$i<$cat_n;$i++):
if ($i<$cat_n/2):
$cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
elseif ($i>=$cat_n/2):
$cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
endif;
endfor;
?>

<div class="sidebar-box"  id="blog-categories">
<div class="sidebar-title"><?php echo of_get_option('t-15', 'Blog categories' ); ?></div>
<ul id="blog-categories-left">
<?php echo $cat_left;?>
</ul>
<ul id="blog-categories-right">
<?php echo $cat_right;?>
</ul>
<div class="clear"> </div>
</div>
 <?php
    }  
}  
register_widget('My_BlogCategories');  






class My_Login extends WP_Widget {  
        function My_Login() {  
            parent::WP_Widget(false, 'Login Widget');  
        }  
    function form($instance) {  
               print "This widget displays login form";  
        }  
    function update($new_instance, $old_instance) {  
            // processes widget options to be saved  
            return $new_instance;  
        }  
function widget($args, $instance) {  ?>
        
<div id="right-login">

	<?php if ( is_user_logged_in() ) : ?>
		<a href="<?php echo bp_loggedin_user_domain() ?>"><?php bp_loggedin_user_avatar( 'type=thumb&width=40&height=40' ) ?></a>
		<div class="right-login-logged"><?php echo of_get_option('t-7', 'Hello' ); ?> <?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?>!</div>
			

	<?php else : ?>

	<div id="right-login-title"><?php _e( 'Log In', 'buddypress' ); ?></div>
	<div id="right-login-desc"><?php echo of_get_option('t-18', 'Login to your account and check new messages.' ); ?></div>

		<?php do_action( 'bp_before_sidebar_login_form' ) ?>

		<form name="login-form" id="front-login-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
			<label><?php _e( 'Username', 'buddypress' ) ?><br />
			<input type="text" name="log" id="front-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

			<label><?php _e( 'Password', 'buddypress' ) ?><br />
			<input type="password" name="pwd" id="front-user-pass" class="input" value="" tabindex="98" /></label>

			<div class="forgetmenot"><label><input name="rememberme" type="checkbox" id="front-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></div>

			<?php do_action( 'bp_sidebar_login_form' ) ?>
			<input type="submit" name="wp-submit" id="front-login-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" />
			<input type="hidden" name="testcookie" value="1" />
		</form>
		<p><a href="/register/">Register for an account</a></p>

		<?php do_action( 'bp_after_sidebar_login_form' ) ?>

	<?php endif; ?>

</div><!-- right-login -->

 <?php
    }  
}  
register_widget('My_Login');  




class My_Tags extends WP_Widget {  
        function My_Tags() {  
            parent::WP_Widget(false, 'My Tags Widget');  
        }  
    function form($instance) {  
               print "This widged displays tags";  
        }  
    function update($new_instance, $old_instance) {  
            // processes widget options to be saved  
            return $new_instance;  
        }  
function widget($args, $instance) {  ?>
        
<?php
$tags = get_tags(array(
'orderby' => 'count',
'order' => 'DESC',
'number' => 8,
) );
echo '<div id="tags-middle"><div id="tags-middle-title">' . of_get_option('t-19', 'Tags' ) . '</div>';
foreach ($tags as $tag) {
echo '<a href="' . get_tag_link($tag->term_id) . '" rel="tag">' . $tag->name . '</a>';
echo "\r\n"; 
}
echo '</div>';
?>
<div class="clear"> </div>

 <?php
    }  
}  
register_widget('My_Tags');  



add_action( 'init', 'register_menus' );
     function register_menus() {
           register_nav_menus(
                array(
                     'primary-menu' => __( 'WildCommunity',  'Primary Menu' )
                 )
            );
      }



class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<br /><span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

register_nav_menus(
    array(
        'select-menu' => 'Mobile Menu',
    )
);

function wp_nav_menu_select( $args = array() ) {
     
    $defaults = array(
        'theme_location' => '',
        'menu_class' => 'select-menu',
    );
     
    $args = wp_parse_args( $args, $defaults );
     
    if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $args['theme_location'] ] ) ) {
        $menu = wp_get_nav_menu_object( $menu_locations[ $args['theme_location'] ] );
         
        $menu_items = wp_get_nav_menu_items( $menu->term_id );
        ?>
            <select name="menu-items" ONCHANGE="location = this.options[this.selectedIndex].value;" id="menu-<?php echo $args['theme_location'] ?>" class="<?php echo $args['menu_class'] ?>">
                <option value="">Menu</option>
                <?php foreach( (array) $menu_items as $key => $menu_item ) : ?>
                    <option value="<?php echo $menu_item->url ?>"><?php echo $menu_item->title ?></option>
                <?php endforeach; ?>
            </select>
        <?php
    }
     
    else {
        ?>
            <select class="menu-not-found">
                <option value="">Menu Not Found</option>
            </select>
        <?php
    }
 
}



if ( !function_exists( 'optionsframework_init' ) ) {

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

	if ( get_stylesheet_directory() == get_stylesheet_directory() ) {
		define('OPTIONS_FRAMEWORK_URL', get_stylesheet_directory() . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', get_stylesheet_directory() . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri('stylesheet_directory') . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}



add_action('admin_init','optionscheck_change_santiziation', 100);
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
       "width" => array()
      );
      $custom_allowedtags["script"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}


remove_action( 'bp_init', 'bp_core_set_avatar_constants', 3 );

function my_bp_core_set_avatar_constants() {
	global $bp;

	if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) )
		define( 'BP_AVATAR_THUMB_WIDTH', 50 );

	if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) )
		define( 'BP_AVATAR_THUMB_HEIGHT', 50 );

	if ( !defined( 'BP_AVATAR_FULL_WIDTH' ) )
		define( 'BP_AVATAR_FULL_WIDTH', 215 );

	if ( !defined( 'BP_AVATAR_FULL_HEIGHT' ) )
		define( 'BP_AVATAR_FULL_HEIGHT', 135 );

	if ( !defined( 'BP_AVATAR_ORIGINAL_MAX_WIDTH' ) )
		define( 'BP_AVATAR_ORIGINAL_MAX_WIDTH', 215 );

	if ( !defined( 'BP_AVATAR_ORIGINAL_MAX_FILESIZE' ) ) {
		if ( !isset( $bp->site_options['fileupload_maxk'] ) ) {
			define( 'BP_AVATAR_ORIGINAL_MAX_FILESIZE', 120000 ); // 5mb
		} else {
			define( 'BP_AVATAR_ORIGINAL_MAX_FILESIZE', $bp->site_options['fileupload_maxk'] * 1024 );
		}
	}

	if ( !defined( 'BP_AVATAR_DEFAULT' ) )
		define( 'BP_AVATAR_DEFAULT', BP_PLUGIN_URL . 'bp-core/images/mystery-man.jpg' );

	if ( !defined( 'BP_AVATAR_DEFAULT_THUMB' ) )
		define( 'BP_AVATAR_DEFAULT_THUMB', BP_PLUGIN_URL . 'bp-core/images/mystery-man-50.jpg' );
}
add_action( 'bp_init', 'my_bp_core_set_avatar_constants', 3 );

function bp_excerpt_group_description( $description ) {
$length = 100;
$description = substr($description,0,$length);
return strip_tags($description);
}
add_filter( 'bp_get_group_description_excerpt', 'bp_excerpt_group_description');

?>