<?php
/*
Author: Silvio Lorusso
URL: http://silviolorusso.com/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
// require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!

/************************************************/
/************* Custom Fields & Posts ************/
/************************************************/


// Custom Post "Work"
function my_custom_post_work() {
	$labels = array(
		'name'               => _x( 'Works', 'post type general name' ),
		'singular_name'      => _x( 'Work', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'work' ),
		'add_new_item'       => __( 'Add New Work' ),
		'edit_item'          => __( 'Edit Work' ),
		'new_item'           => __( 'New Work' ),
		'all_items'          => __( 'All Works' ),
		'view_item'          => __( 'View Work' ),
		'search_items'       => __( 'Search Works' ),
		'not_found'          => __( 'No works found' ),
		'not_found_in_trash' => __( 'No works found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Works'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Artworks and design projects',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies' 	=> array('post_tag'),
		'has_archive'   => true,
	);
	register_post_type( 'work', $args );	
}
add_action( 'init', 'my_custom_post_work' );

// Custom Post "Author"
function my_custom_post_author() {
	$labels = array(
		'name'               => _x( 'Authors', 'post type general name' ),
		'singular_name'      => _x( 'Author', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'author' ),
		'add_new_item'       => __( 'Add New Author' ),
		'edit_item'          => __( 'Edit Author' ),
		'new_item'           => __( 'New Author' ),
		'all_items'          => __( 'All Authors' ),
		'view_item'          => __( 'View Author' ),
		'search_items'       => __( 'Search Authors' ),
		'not_found'          => __( 'No authors found' ),
		'not_found_in_trash' => __( 'No authors found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Authors'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Authors of the works',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'has_archive'   => true,
	);
	register_post_type( 'creator', $args );
}
add_action( 'init', 'my_custom_post_author' );

if ( !is_admin() ) add_filter( 'pre_get_posts', 'my_get_posts' );


function my_get_posts( $query ) {
	if ( is_home() && $query->is_main_query() ){
		$query->set( 'post_type', array( 'work' ) );
		$query->set('posts_per_page', 1);                       

	}
	return $query;
}

/************************************************/
/************* RDFa Implementations *************/
/************************************************/

//Avoid WP creating <br>s and <p>s
remove_filter( 'the_content', 'wpautop' );

remove_filter( 'the_excerpt', 'wpautop' );

//display first image of a post
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  if (isset($matches[1][0])) {
  	$first_img = $matches[1][0];
  }
  return $first_img;
}

// Send metadata to the store when a post is updated
function send_metadata( $post_id ) {
	if (!is_page($post_id)) {
		if ( get_post_status ( $post_id ) != 'trash' ) {
			include_once('rdfa/send_metadata.php');
			$permalink = get_permalink( $post_id );
			send_record($permalink, $post_id);
			// die('sent!');
			// include_once('rdfa/generate_index.php');
		}
	}
}
add_action( 'edit_post', 'send_metadata' );

// Delete metadata from the store when a post is trashed
function clear_metadata( $post_id ) {
	if (!is_page($post_id)) {
		include_once('rdfa/clear_metadata.php');
		$permalink = get_permalink( $post_id );
		clear_record($permalink);
		// die('deleted!');
		// include_once('rdfa/generate_index.php');
	}
}
add_action( 'trashed_post', 'clear_metadata' );

// List all the vocabularies used
function my_vocabs() {
	$filename = 'wp-content/themes/p-dpa/rdfa/vocabularies.txt';
	$handle = fopen($filename, "r");
	$vocabs = fread($handle, filesize($filename));
	fclose($handle);
	echo $vocabs;
}

// Add the triplestore as a DB in order not to create conflict with WP
$newdb = new wpdb('root', 'root', 'p-dpa-sparql', 'localhost');
$newdb->show_errors();

// Add custom text to the rich text editor
/*
function my_default_post($content)
{
	if (empty($content))
		$content = "Your default text";
	return $content;
}
add_filter('the_editor_content', 'my_default_post');
*/
?>