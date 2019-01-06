<?php

//update_option('siteurl','http://mauricenaef.ch');
//update_option('home','http://mauricenaef.ch');

$fahrschuelteam =  get_bloginfo( 'name' );
$prefix = 'fb';

// Support area YYYY/MM/DD
$release_date = "2018/11/31";
$days_to_add = 31;

#------------------------------------------------------------------------------------
# Clean Up and General functions
#------------------------------------------------------------------------------------

// Remove Menu Container Div
function fahrschuelteam_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}
add_filter( 'wp_nav_menu_args', 'fahrschuelteam_wp_nav_menu_args' );

// add home to Menu
function home_page_menu_item( $args ) {  
    $args['show_home'] = true;  
    return $args;  
}  
add_filter( 'wp_page_menu_args', 'home_page_menu_item' ); 

/**
 * Fritz Blanke functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package fahrschuelteam
 */

if ( ! function_exists( 'fahrschuelteam_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fahrschuelteam_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Fritz Blanke, use a find and replace
		 * to change 'fahrschuelteam' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fahrschuelteam', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Add editor style
		add_editor_style( array( 'editor-styles.css') );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(150, 150, true);
		add_image_size('mini', 50, 50);
		add_image_size('portrait', 350, 350, true);
		add_image_size('portrait_large', 700, 700, true);
		add_image_size('hero', 1600, false);
		add_image_size('gallery_item', 480, false);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( 
			array(
				'primary' => esc_html__( 'Hauptnavigation', 'fahrschuelteam' ),
				'footer_1' => esc_html__( 'Fusszeile 1', 'fahrschuelteam' ),
				'footer_2' => esc_html__( 'Fusszeile 2', 'fahrschuelteam' ),
				'footer_3' => esc_html__( 'Fusszeile 3', 'fahrschuelteam' ),
				'footer_4' => esc_html__( 'Fusszeile 4', 'fahrschuelteam' ),
			) 
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'fahrschuelteam_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'qtrans_header');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'print_emoji_detection_script', 7 );
		remove_action('wp_print_styles', 'print_emoji_styles');
	}
endif;
add_action( 'after_setup_theme', 'fahrschuelteam_setup' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fahrschuelteam_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fahrschuelteam' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fahrschuelteam' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar FAQ', 'fahrschuelteam' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'fahrschuelteam' ),
		'before_widget' => '<id id="%1$s" class="widget %2$s">',
		'after_widget'  => '</id>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'fahrschuelteam_widgets_init' );



#------------------------------------------------------------------------------------
# SCRIPTS & ENQUEUEING
#------------------------------------------------------------------------------------

// remove WP version from RSS
function fahrschuelteam_rss_version() { return ''; }

// remove WP version from scripts
function fahrschuelteam_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function fahrschuelteam_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function fahrschuelteam_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function fahrschuelteam_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/**
 * Enqueue scripts and styles.
 */
// include custom jQuery
function load_custom_jquery() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'load_custom_jquery');
// loading modernizr and jquery, and reply script
function fahrschuelteam_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {

	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_script('header_js', get_template_directory_uri() . '/js/header-bundle.js', array('jquery'), 1.0, false);
	wp_enqueue_script('footer_js', get_template_directory_uri() . '/js/footer-bundle.js', null, 1.0, true);


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    	wp_enqueue_script( 'comment-reply' );
    }
      
  }
 
}
add_action( 'wp_enqueue_scripts', 'fahrschuelteam_scripts_and_styles' );


#------------------------------------------------------------------------------------
# Custom Icons
#------------------------------------------------------------------------------------

function wp_localize_icon_vars(){
    $svg_url = get_bloginfo('template_url') . '/images/symbol-defs.svg';
    $svglocalstorage = array(
    	'url'			=> get_bloginfo('template_url'),
    	'svg_url' 		=> $svg_url,
    	'timestamp'		=> filemtime( TEMPLATEPATH . '/images/symbol-defs.svg' )
    );
    wp_localize_script( 'header_js', 'php_vars', $svglocalstorage );
}
add_action( 'wp_enqueue_scripts', 'wp_localize_icon_vars', 9999 );

function svg_icon( $icon, $class = NULL ) {

	echo '<svg class="icon icon-' . $icon . ' ' . $class . '"><use xlink:href="'. get_bloginfo('template_url') . '/images/symbol-defs.svg#' . $icon . '"></use></svg>';

}

function get_svg_icon( $icon, $class = NULL  ) {
	$svg = '<svg class="icon icon-' . $icon . ' ' . $class . '"><use xlink:href="'. get_bloginfo('template_url') . '/images/symbol-defs.svg#' . $icon . '"></use></svg>';
	return $svg;
}

#------------------------------------------------------------------------------------
# Responsiv Images
#------------------------------------------------------------------------------------

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
 
function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
}


#------------------------------------------------------------------------------------
# Responsiv YouTube embed
#------------------------------------------------------------------------------------

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="responsive-embed">'.$html.'</div>';
    return $return;
}

#------------------------------------------------------------------------------------
# Gravityforms Edit
#------------------------------------------------------------------------------------

add_filter("gform_address_display_format", "address_format");
function address_format($format){
    return "zip_before_city";
}

add_filter("gform_address_street", "change_anschrift_strasse", 10, 2);
function change_anschrift_strasse($label, $form_id){
	return "Strasse Nr.";
}

add_filter("gform_address_zip", "change_anschrift_plz", 10, 2);
function change_anschrift_plz($label, $form_id){
	return "PLZ";
}

add_filter("gform_ajax_spinner_url", "spinner_url", 10, 2);

function spinner_url($image_src, $form){

    return  get_bloginfo('template_directory') . '/images/blank.gif' ; // relative to you theme images folder

}
#------------------------------------------------------------------------------------
# PHP Inculdes
#------------------------------------------------------------------------------------

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/admin-custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/admin-template-tags.php';

/**
 * Carbon Fields
 */
require get_template_directory() .  '/inc/admin-carbon-fields.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/admin-template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/admin-customizer.php';


/**
 * CPT Angebot
 */
require get_template_directory() .  '/inc/admin-angebot.php';
/**
 * CPT FAQ
 */
require get_template_directory() .  '/inc/admin-faq.php';

/**
 * CPT Feedback
 */
require get_template_directory() .  '/inc/admin-feedback.php';

/**
 * Settings Page additions.
 */
require get_template_directory() . '/inc/admin-settings.php';
require get_template_directory() . '/inc/admin-mce.php';

require get_template_directory() .  '/inc/admin-admin.php';
require get_template_directory() .  '/inc/admin-login.php';
require get_template_directory() .  '/inc/admin-dashboard.php';
require get_template_directory() .  '/inc/admin-widgets.php';
require get_template_directory() .  '/inc/admin-images.php';
require get_template_directory() .  '/inc/admin-menu.php';
require get_template_directory() .  '/inc/admin-forms.php';

require get_template_directory() .  '/inc/admin-intro.php';
require get_template_directory() .  '/inc/admin-sponsoren.php';
require get_template_directory() .  '/inc/admin-testimonial.php';
require get_template_directory() .  '/inc/admin-sections.php';


