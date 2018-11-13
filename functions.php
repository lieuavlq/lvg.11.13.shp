<?php
/**
 * LVGames Shop functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since LVGames Shop 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * LVGames Shop only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'lvgames_shop_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since LVGames Shop 1.0
 */
function lvgames_shop_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/lvgames_shop
	 * If you're building a theme based on lvgames_shop, use a find and replace
	 * to change 'lvgames_shop' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lvgames_shop' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'lvgames_shop' ),
		'social'  => __( 'Social Links Menu', 'lvgames_shop' ),
		'top'  => __( 'Top Menu', 'lvgames_shop' ),
		'product'  => __( 'Product Menu', 'lvgames_shop' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since LVGames Shop 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = lvgames_shop_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.

	/**
	 * Filter LVGames Shop custom-header support arguments.
	 *
	 * @since LVGames Shop 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-color     		Default color of the header.
	 *     @type string $default-attachment     Default attachment of the header.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'lvgames_shop_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css' ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // lvgames_shop_setup
add_action( 'after_setup_theme', 'lvgames_shop_setup' );

/**
 * Register widget area.
 *
 * @since LVGames Shop 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lvgames_shop_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Chổ để ốp lưng', 'lvgames_shop' ),
		'id'            => 'sidebar-6',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lvgames_shop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Widget Area', 'lvgames_shop' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lvgames_shop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget Area 2', 'lvgames_shop' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lvgames_shop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget Area 3', 'lvgames_shop' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lvgames_shop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget Area 4', 'lvgames_shop' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lvgames_shop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Widget Area 5', 'lvgames_shop' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lvgames_shop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title mb0"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'lvgames_shop_widgets_init' );

if ( ! function_exists( 'lvgames_shop_fonts_url' ) ) :
/**
 * Register Google fonts for LVGames Shop.
 *
 * @since LVGames Shop 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function lvgames_shop_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'lvgames_shop' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'lvgames_shop' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'lvgames_shop' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'lvgames_shop' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since LVGames Shop 1.1
 */
// function lvgames_shop_javascript_detection() {
// 	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
// }
// add_action( 'wp_head', 'lvgames_shop_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since LVGames Shop 1.0
 */
function lvgames_shop_scripts() {

	// Load our main stylesheet.
	wp_enqueue_style( 'lvgames_shop-jqui', get_template_directory_uri() . '/css/jquery-ui.min.css', array( 'lvgames_shop-style' ), '181110' );
	wp_enqueue_style( 'lvgames_shop-style', get_stylesheet_uri(), array(), '181110' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'lvgames_shop-ie', get_template_directory_uri() . '/css/ie.css', array( 'lvgames_shop-style' ), '20141010' );
	wp_style_add_data( 'lvgames_shop-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'lvgames_shop-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'lvgames_shop-style' ), '20141010' );
	wp_style_add_data( 'lvgames_shop-ie7', 'conditional', 'lt IE 8' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'lvgames_shop-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'matchheight-script', get_template_directory_uri() . '/js/jquery.matchHeight.js', array( 'jquery' ), '180822', true );
	wp_enqueue_script( 'jqui-script', get_template_directory_uri() . '/js/jquery-ui.min.js', array( 'jquery' ), '181110', true );
	wp_enqueue_script( 'lvgames_shop-script_new', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '181110', true );
	wp_localize_script( 'lvgames_shop-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'lvgames_shop' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'lvgames_shop' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'lvgames_shop_scripts' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since LVGames Shop 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function lvgames_shop_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'lvgames_shop-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'lvgames_shop_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since LVGames Shop 1.0
 *
 * @see wp_add_inline_style()
 */
// function lvgames_shop_post_nav_background() {
// 	if ( ! is_single() ) {
// 		return;
// 	}

// 	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
// 	$next     = get_adjacent_post( false, '', false );
// 	$css      = '';

// 	if ( is_attachment() && 'attachment' == $previous->post_type ) {
// 		return;
// 	}

// 	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
// 		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
// 		$css .= '
// 			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
// 			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
// 			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
// 		';
// 	}

// 	if ( $next && has_post_thumbnail( $next->ID ) ) {
// 		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
// 		$css .= '
// 			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
// 			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
// 			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
// 		';
// 	}

// 	wp_add_inline_style( 'lvgames_shop-style', $css );
// }
// add_action( 'wp_enqueue_scripts', 'lvgames_shop_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since LVGames Shop 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function lvgames_shop_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'lvgames_shop_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since LVGames Shop 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function lvgames_shop_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'lvgames_shop_search_form_modify' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since LVGames Shop 1.9
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function lvgames_shop_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'lvgames_shop_widget_tag_cloud_args' );


/**
 * Implement the Custom Header feature.
 *
 * @since LVGames Shop 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since LVGames Shop 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since LVGames Shop 1.0
 */
require get_template_directory() . '/inc/customizer.php';

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// REMOVE FEED
function wpb_disable_feed() {
wp_die( __('Trang Feed không có vui lòng quay lại <a href="'. get_bloginfo('url') .'">trang chủ</a>!') );
}
 
add_action('do_feed', 'wpb_disable_feed', 1);
add_action('do_feed_rdf', 'wpb_disable_feed', 1);
add_action('do_feed_rss', 'wpb_disable_feed', 1);
add_action('do_feed_rss2', 'wpb_disable_feed', 1);
add_action('do_feed_atom', 'wpb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'wpb_disable_feed', 1);
add_action('do_feed_atom_comments', 'wpb_disable_feed', 1);
add_filter( 'emoji_svg_url', '__return_false' );

// REMOVE LINK
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); //Removes prev and next links

remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'template_redirect', 'rest_output_link_header', 11);

function change_price($val){
	return $val.',000 <sup>đ</sup>';
}

function pagination($pages = '', $range = 1){
  $showitems = ($range * 2)+1;

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '')
  {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages)
    {
      $pages = 1;
    }
  }

  if(1 != $pages){
    echo "<nav class=\"navigation pagination\" role=\"navigation\"><div class=\"nav-links\">";

    // if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";

    if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&laquo;</a>";

    for ($i=1; $i <= $pages; $i++){
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
      {
        echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
      }
    }

    if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&raquo;</a>";

    // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";

    echo "</div></nav>";
  }
}

// Our custom post type function
function create_posttype() {
 
    register_post_type( 'orders',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Đơn Hàng' ),
                'singular_name' => __( 'Order' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'order'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Quản lý Đơn Hàng', 'Post Type General Name', 'lvgames_shop' ),
        'singular_name'       => _x( 'Order', 'Post Type Singular Name', 'lvgames_shop' ),
        'menu_name'           => __( 'Orders', 'lvgames_shop' ),
        'parent_item_colon'   => __( 'Parent Order', 'lvgames_shop' ),
        'all_items'           => __( 'All Orders', 'lvgames_shop' ),
        'view_item'           => __( 'View Order', 'lvgames_shop' ),
        'add_new_item'        => __( 'Add New Order', 'lvgames_shop' ),
        'add_new'             => __( 'Add New', 'lvgames_shop' ),
        'edit_item'           => __( 'Edit Order', 'lvgames_shop' ),
        'update_item'         => __( 'Update Order', 'lvgames_shop' ),
        'search_items'        => __( 'Search Order', 'lvgames_shop' ),
        'not_found'           => __( 'Not Found', 'lvgames_shop' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'lvgames_shop' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'orders', 'lvgames_shop' ),
        'description'         => __( 'Managerment orders.', 'lvgames_shop' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'group' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 2,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type( 'orders', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );