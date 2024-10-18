<?php

/**
 * The Load Theme.
 */
add_action('after_setup_theme', 'after_setup_theme_function');
function after_setup_theme_function() {
	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support( 'post-thumbnails' ); // To add Custom Thumbnail Sizes
	add_theme_support( 'title-tag' );
};

/**
 * The Head Cleanup - clean up of WordPress head, taken from Bones Theme.
 */
add_action('init', 'init_function');
function init_function() {

	//give editors permissions
	$role_object = get_role( 'editor' );
	// to change menus
	$role_object->add_cap( 'edit_theme_options' );

	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// index link
	remove_action('wp_head', 'index_rel_link'); 
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	
	// Remove WordPress version from css
	add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999);
	// Remove WordPress version from scripts
	add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999);

	// Uncomment when need Custom Post Type for a webiste.
	// require_once 'post-types/custom-post-type.php';

	require_once 'email/email_shortcode.php';
	require_once 'inc/main-function.php';
	require_once 'inc/shortcodes.php';

}

/**
 * Remove WordPress version from RSS.
 */
add_filter('the_generator', function() { 
	return ''; 
});

/**
 * Remove WordPress version from scripts.
 */
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/**
 * To enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'enqueue_scripts_function');
function enqueue_scripts_function() {

	// Add CSS/JS only in Front-end.
	if (!is_admin()) {
		if(is_page('donatelife_flipbook')){
			wp_enqueue_style ( 'pdfscrollbar', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/scrollbar.css' );
			wp_enqueue_style ( 'pdfstyle', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/style.css' );
			wp_enqueue_style ( 'pdfplayer', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/player.css' );
			wp_enqueue_style ( 'pdfphone', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/phoneTemplate.css' );
			wp_enqueue_style ( 'pdftemplate', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/template.css' );
			wp_enqueue_style ( 'pdfmovingbg', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/MovingBackgrounds.min.css' );
			wp_enqueue_style ( 'pdfflipbook', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/FlipBookPlugins.min.css' );
			wp_enqueue_style ( 'pdfhislider', get_stylesheet_directory_uri() . '/donatelife_flipbook/style/hiSlider2.min.css' );

			wp_enqueue_script( 'pdfjs', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/jquery-1.9.1.min.js', array(),'', true );
			wp_enqueue_script( 'pdfconfig', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/config.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfloading', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/LoadingJS.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfmain', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/main.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfeditor', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/editor.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfbookconfig', get_stylesheet_directory_uri() . '/donatelife_flipbook/files/search/book_config.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfmovingbg-js', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/MovingBackgrounds.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfflipplugin-js', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/FlipBookPlugins.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdffliphtml', get_stylesheet_directory_uri() . '/donatelife_flipbook/javascript/flipHtml5.hiSlider2.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfslide-js', get_stylesheet_directory_uri() . '/donatelife_flipbook/slide_javascript/slideJS.js', array('jquery'),'', true );
			
		}
		if(is_page('portfolio_flipbook')){
			wp_enqueue_style ( 'pdfscrollbar', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/scrollbar.css' );
			wp_enqueue_style ( 'pdfstyle', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/style.css' );
			wp_enqueue_style ( 'pdfplayer', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/player.css' );
			wp_enqueue_style ( 'pdfphone', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/phoneTemplate.css' );
			wp_enqueue_style ( 'pdftemplate', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/template.css' );
			wp_enqueue_style ( 'pdfmovingbg', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/MovingBackgrounds.min.css' );
			wp_enqueue_style ( 'pdfflipbook', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/FlipBookPlugins.min.css' );
			wp_enqueue_style ( 'pdfhislider', get_stylesheet_directory_uri() . '/portfolio_flipbook/style/hiSlider2.min.css' );

			wp_enqueue_script( 'pdfjs', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/jquery-1.9.1.min.js', array(),'', true );
			wp_enqueue_script( 'pdfconfig', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/config.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfloading', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/LoadingJS.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfmain', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/main.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfeditor', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/editor.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfbookconfig', get_stylesheet_directory_uri() . '/portfolio_flipbook/files/search/book_config.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfmovingbg-js', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/MovingBackgrounds.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfflipplugin-js', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/FlipBookPlugins.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdffliphtml', get_stylesheet_directory_uri() . '/portfolio_flipbook/javascript/flipHtml5.hiSlider2.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'pdfslide-js', get_stylesheet_directory_uri() . '/portfolio_flipbook/slide_javascript/slideJS.js', array('jquery'),'', true );
			
		}

		wp_enqueue_script('jquery');

		wp_enqueue_style ( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );
		wp_enqueue_style ( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
		wp_enqueue_style ( 'owl', get_stylesheet_directory_uri() . '/css/owl.css' );
		wp_enqueue_style ( 'revolution-slider', get_stylesheet_directory_uri() . '/css/revolution-slider.css' );
		wp_enqueue_style ( 'responsive', get_stylesheet_directory_uri() . '/css/responsive.css' );


		wp_enqueue_script( 'bootstrapjs', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array(),'', true );
		wp_enqueue_script( 'jquerycountTo', get_stylesheet_directory_uri() . '/js/jquery.countTo.js', array('jquery'),'', true );
		wp_enqueue_script( 'isotopjs', get_stylesheet_directory_uri() . '/js/isotope.js', array('jquery'),'', true );
		wp_enqueue_script( 'jqueryappear', get_stylesheet_directory_uri() . '/js/jquery.appear.js', array('jquery'),'', true );
		wp_enqueue_script( 'owljs', get_stylesheet_directory_uri() . '/js/owl.js', array('jquery'),'', true );
		wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/js/wow.js', array('jquery'),'', true );
		wp_enqueue_script( 'revolution', get_stylesheet_directory_uri() . '/js/revolution.min.js', array('jquery'),'', true );
		wp_enqueue_script( 'countdown', get_stylesheet_directory_uri() . '/js/jquery.countdown.js', array('jquery'),'', true );

		if(!is_front_page() && !is_page('donatelife_flipbook') && !is_page('portfolio_flipbook')) {
			wp_enqueue_style ( 'lightgallerycss', get_stylesheet_directory_uri() . '/css/light_gallery/lightgallery.css' );
			wp_enqueue_style ( 'dataTablecss', get_stylesheet_directory_uri() . '/css/dataTables.bootstrap.min.css' );
			// wp_enqueue_style ( 'dataTablejquerycss', get_stylesheet_directory_uri() . '/css/jquery.dataTables.min.css' );

			wp_enqueue_script( 'dataTablejs', get_stylesheet_directory_uri() . '/js/jquery.dataTables.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'dataTablebootstrapjs', get_stylesheet_directory_uri() . '/js/dataTables.bootstrap.min.js', array('bootstrapjs'),'', true );
			wp_enqueue_script( 'lgfullscreen', get_stylesheet_directory_uri() . '/js/light_gallery/lg-fullscreen.js', array('lightgallery'),'', true );
			wp_enqueue_script( 'lightgallery', get_stylesheet_directory_uri() . '/js/light_gallery/lightgallery.js', array('jquery'),'', true );
			wp_enqueue_script( 'lgvideo', get_stylesheet_directory_uri() . '/js/light_gallery/lg-video.js', array('lightgallery'),'', true );
			wp_enqueue_script( 'lgautoplay', get_stylesheet_directory_uri() . '/js/light_gallery/lg-autoplay.js', array('lightgallery'),'', true );
			wp_enqueue_script( 'lgzoom', get_stylesheet_directory_uri() . '/js/light_gallery/lg-zoom.js', array('lightgallery'),'', true );
			wp_enqueue_script( 'lghash', get_stylesheet_directory_uri() . '/js/light_gallery/lg-hash.js', array('lightgallery'),'', true );
			wp_enqueue_script( 'lgpager', get_stylesheet_directory_uri() . '/js/light_gallery/lg-pager.js', array('lightgallery'),'', true );
			wp_enqueue_script( 'mousewheel', get_stylesheet_directory_uri() . '/js/light_gallery/jquery.mousewheel.min.js', array('jquery'),'', true );
			wp_enqueue_script( 'hipjs', get_stylesheet_directory_uri() . '/js/lib/hip.js', array(),'', true );

		}
		
		wp_enqueue_style ( 'style', get_stylesheet_directory_uri() . '/css/style.css' );

		wp_enqueue_script( 'scriptjs', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), time(), true );
		wp_enqueue_script( 'customjs', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), time(), true );
		wp_localize_script( 'customjs', 'ajax_obj', array('ajax_url' => admin_url( 'admin-ajax.php' )));
		
	}

    // This also removes some inline CSS variables for colors since 5.9 - global-styles-inline-css
    wp_dequeue_style( 'global-styles' );
    // WooCommerce - you can remove the following if you don't use Woocommerce
    wp_dequeue_style( 'wc-blocks-vendors-style' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'wp-webfonts' );

}

add_action('admin_enqueue_scripts', 'custom_admin_enqueue_bootstrap');

function custom_admin_enqueue_bootstrap($hook_suffix) {
    // Only load on your specific admin page
    // Replace 'your-custom-page' with your actual page slug
    if ($hook_suffix === 'toplevel_page_donor-data' || $hook_suffix === 'toplevel_page_volunteer-data' || $hook_suffix === 'toplevel_page_online-donation-data') {
		wp_enqueue_style ( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
		wp_enqueue_script( 'bootstrapjs', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array(),'', true );
    }
}

/**
 * Remove Emoji Styles and JS.
 * Default Load by WordPress.
 * Author: ETS.
 */
remove_action( 'wp_head', 'wp_resource_hints', 2, 99 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script', 7 );


/**
 * Register WordPress Nav Menus.
 * Author: ETS.
 */
register_nav_menus(
	array(
		'primary-navigation' => __( 'Primary Navigation' ),
	)
); 

/**
 * Add Extra dimmenssion for Image library.
 * Author: ETS.
 */
add_image_size( 'large-thumbnail', 300, 300, true );
add_image_size( 'full-width', 1200, 9999, false );

/**
 * Add Option Page with ACF Plugin.
 * ACF Paid Plugin.
 * Author: ETS.
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**
 * register an API key for google maps to work in ACF backend. also add to wp_register_script above.
 * https://developers.google.com/maps/documentation/javascript/get-api-key
 * Author: ACF Plugin.
 */
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
 function my_acf_google_map_api( $api ){
	$api['key'] = '';
	return $api;	
}

/**
 * set gallery link default to media file instead of attachment page
 * Author: ETS.
 */
add_filter( 'media_view_settings', function ( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
	//$settings['galleryDefaults']['columns'] = '5';
    return $settings;
});

/**
 * remove some sections of admin
 * Author: ETS.
 */
add_action('admin_menu', 'remove_admin_menu_function');
function remove_admin_menu_function() { 
	//lower than admin
	if(!current_user_can('activate_plugins')) {
		remove_menu_page('tools.php');
	}

	// Remove Posts Menu from admin - comment this line if no need of posts.
	// remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}

/**
 * make yoast appear at bottom of edit screens
 * Author: ETS.
 */
add_filter( 'wpseo_metabox_prio', function() {
	return 'low';
});

/**
 * HELPER FUNCTION
 * Author: ETS.
 */
if(!function_exists('is_blog')){
	// is_blog();
	// @link https://gist.github.com/wesbos/1189639
	function is_blog() {
	    global $post;
	    //Post type must be 'post'.
	    $post_type = get_post_type($post);
	    //Check all blog-related conditional tags, as well as the current post type, 
	    //to determine if we're viewing a blog page.
	    return (
	        ( is_home() || is_archive() || is_single() )
	        && ($post_type == 'post')
	    ) ? true : false ;

	}
}

/**
 * Register Widgets.
 * Author: ETS.
 */
add_action('widgets_init','flexibond_widgets_init');
function flexibond_widgets_init() {
	register_sidebar(array(	
		'name'          => esc_html__('Page Sidebar', 'flexibond'),
		'id'            => 'page-sidebar',
		'description'   => esc_html__('Page Sidebar', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget page_sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 1 Widget Area', 'flexibond'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Footer 1', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget text text-justify">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 2 Widget Area', 'flexibond'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Footer 2', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget links">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 3 Widget Area', 'flexibond'),
		'id'            => 'footer-3',
		'description'   => esc_html__('Footer 3', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget links">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 4 Widget Area', 'flexibond'),
		'id'            => 'footer-4',
		'description'   => esc_html__('Footer 4', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget links">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Copyrights Widget Area', 'flexibond'),
		'id'            => 'copyrights',
		'description'   => esc_html__('Copyrights Widget', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}

/**
 * Breadcrumb.
 * Author: ETS.
 */
function ah_breadcrumb() {

	// Check if is front/home page, return
	if ( is_front_page() ) {
		return;
	}

	// Define
	global $post;
	$custom_taxonomy  = ''; // If you have custom taxonomy place it here
  
	$defaults = array(
	  'seperator'   =>  '',
	  'id'          =>  'ah-breadcrumb',
	  'classes'     =>  'ah-breadcrumb',
	  'home_title'  =>  esc_html__( 'Home', '' )
	);
  
	$sep  = '';
  
	// Start the breadcrumb with a link to your homepage
	// echo '<ul id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';
  
	// Creating home link
	echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html( $defaults['home_title'] ) .'</a></li>' . $sep;
  
	if ( is_single() ) {

	  // Get posts type
	  $post_type = get_post_type();
  
	  // If post type is not post
	  if( $post_type != 'post' ) {

		$post_type_object   = get_post_type_object( $post_type );
		$post_type_link     = get_post_type_archive_link( $post_type );
  
		echo '<li class="item item-cat"><a href="'. $post_type_link .'">'. $post_type_object->labels->name .'</a></li>'. $sep;
  
	  }
  
	  // Get categories
	  $category = get_the_category( $post->ID );
  
	  // If category not empty
	  if( !empty( $category ) ) {
  
		// Arrange category parent to child
		$category_values      = array_values( $category );
		$get_last_category    = end( $category_values );
		// $get_last_category    = $category[count($category) - 1];
		$get_parent_category  = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
		$cat_parent           = explode( ',', $get_parent_category );
  
		// Store category in $display_category
		$display_category = '';
		foreach( $cat_parent as $p ) {
			$display_category .=  '<li class="item item-cat">'. $p .'</li>' . $sep;
		}
  
	  }
  
	  // If it's a custom post type within a custom taxonomy
	  $taxonomy_exists = taxonomy_exists( $custom_taxonomy );
  
	  if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
  
		$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
		$cat_id         = $taxonomy_terms[0]->term_id;
		$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
		$cat_name       = $taxonomy_terms[0]->name;
  
	  }
  
	  // Check if the post is in a category
	  if( !empty( $get_last_category ) ) {
  
		echo $display_category;
		echo '<li class="item item-current">'. get_the_title() .'</li>';
  
	  } else if( !empty( $cat_id ) ) {
  
		echo '<li class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  } else {
  
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  }
  
	} else if( is_archive() ) {
  
	  if( is_tax() ) {
		// Get posts type
		$post_type = get_post_type();
  
		// If post type is not post
		if( $post_type != 'post' ) {
  
		  $post_type_object   = get_post_type_object( $post_type );
		  $post_type_link     = get_post_type_archive_link( $post_type );
  
		  echo '<li class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;
  
		}
  
		$custom_tax_name = get_queried_object()->name;
		echo '<li class="item item-current">'. $custom_tax_name .'</li>';
  
	  } else if ( is_category() ) {
  
		$parent = get_queried_object()->category_parent;
  
		if ( $parent !== 0 ) {
  
		  $parent_category = get_category( $parent );
		  $category_link   = get_category_link( $parent );
  
		  echo '<li class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;
  
		}
  
		echo '<li class="item item-current">'. single_cat_title( '', false ) .'</li>';
  
	  } else if ( is_tag() ) {
  
		// Get tag information
		$term_id        = get_query_var('tag_id');
		$taxonomy       = 'post_tag';
		$args           = 'include=' . $term_id;
		$terms          = get_terms( $taxonomy, $args );
		$get_term_name  = $terms[0]->name;
  
		// Display the tag name
		echo '<li class="item-current item">'. $get_term_name .'</li>';
  
	  } else if( is_day() ) {
  
		// Day archive
  
		// Year link
		echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . '</a></li>' . $sep;
  
		// Month link
		echo '<li class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a></li>' . $sep;
  
		// Day display
		echo '<li class="item-current item">'. get_the_time('jS') .' '. get_the_time('F'). '</li>';
  
	  } else if( is_month() ) {
  
		// Month archive
  
		// Year link
		echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . '</a></li>' . $sep;
  
		// Month Display
		echo '<li class="item-month item-current item">'. get_the_time('F') .'</li>';
  
	  } else if ( is_year() ) {
  
		// Year Display
		echo '<li class="item-year item-current item">'. get_the_time('Y') .'</li>';
  
	  } else if ( is_author() ) {
  
		// Auhor archive
  
		// Get the author information
		global $author;
		$userdata = get_userdata( $author );
  
		// Display author name
		echo '<li class="item-current item">'. 'Author: '. $userdata->display_name . '</li>';
  
	  } else {
  
		echo '<li class="item item-current">'. post_type_archive_title() .'</li>';
  
	  }
  
	} else if ( is_page() ) {
  
	  // Standard page
	  if( $post->post_parent ) {
  
		// If child page, get parents
		$anc = get_post_ancestors( $post->ID );
  
		// Get parents in the right order
		$anc = array_reverse( $anc );
  
		// Parent page loop
		if ( !isset( $parents ) ) $parents = null;
		foreach ( $anc as $ancestor ) {
  
		  $parents .= '<li class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;
  
		}
  
		// Display parent pages
		echo $parents;
  
		// Current page
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  } else {
  
		// Just display current page if not parents
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  }

	} else if(is_blog()) {
		echo '<li class="item-current item">Blog</li>';
	} else if ( is_search() ) {
  
	  // Search results page
	  echo '<li class="item-current item">Search results for: '. get_search_query() .'</li>';
  
	} else if ( is_404() ) {

	  // 404 page
	  echo '<li class="item-current item">' . 'Error 404' . '</li>';
  
	}

	// End breadcrumb
	// echo '</ul>';
  
}

/**mail setting */
add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer){
	$phpmailer->isSMTP();
	$phpmailer->Host = 'smtp.gmail.com';
	$phpmailer->Port = 587;
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Username = 'noreplydonatelife9@gmail.com'; 
	$phpmailer->Password = 'qyglskhwknbxkdid'; //old app password - rlnatpsumukmopjp
	$phpmailer->From = 'noreplydonatelife9@gmail.com';
	$phpmailer->FromName = 'Donate Life';
}

//Remove P tag from the ACF field - content blocks/WYSIWYG editor on frontend
function my_acf_wysiwyg_remove_wpautop( $value, $post_id, $field ) {
    // Disable wpautop for specific ACF fields
    remove_filter('acf_the_content', 'wpautop');
    return $value;
}
add_filter('acf/format_value/type=wysiwyg', 'my_acf_wysiwyg_remove_wpautop', 10, 3);


add_filter( 'wpcf7_form_elements', 'do_shortcode' );
function header_special_mail_tag( $output, $name, $html ) {
	if ( 'email_footer_template' == $name ) {

		$output = do_shortcode( "[$name]" );
	}
	if ( 'email_header_template' == $name ) {

		$output = do_shortcode( "[$name]" );
	}

	return $output;
}
add_filter( 'wpcf7_special_mail_tags', 'header_special_mail_tag', 10, 3 );

add_filter( 'wp_mail', 'process_shortcodes_in_wp_mail', 10, 1 );

function process_shortcodes_in_wp_mail( $args ) {
    if ( isset( $args['message'] ) ) {
        $args['message'] =  wpautop(do_shortcode($args['message'] ));
    }
    return $args;
}
add_filter( 'wp_mail_content_type', function() {
    return 'text/html';
});


/** generate pdf function */
function generate_pdf($form_data,$submitid) {
	$registration_no = $submitid;
	$year = date("y");
	$mandal = $form_data['hidden-1'];
	$dfirstname = $form_data['name-1-first-name']; //donor's full name
	$dmiddlename = $form_data['name-1-middle-name'];
	$dlastname = $form_data['name-1-last-name'];
	$dwcontact = $form_data['phone-3']; //relative telephone number
	$final_dOrgan_arr = $form_data['checkbox-1']; //organs checkbox
	$final_dTissues_arr = $form_data['checkbox-2']; //tissues checkbox
	$ganesha_mandal = $form_data['text-4']; //reference textbox value
	
	if($mandal == ''){
		$html = '<!DOCUMENT html>
					<html lang="en">
					<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>Donatelife Donor Card</title>
					</head>
					<body>
					
						<div style=" border:1px solid #ccc; width:100%;border-bottom:none;">
					
							<div style="background:#008275; -webkit-print-color-adjust: exact;">
								<h2 style="text-align:center; margin:0px; padding:5px 0; color:#fff; font-size:40px;">ORGAN DONOR CARD</h2>
							</div>
					
							<div style="width:100%">
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/card2.jpg" alt="donate" width="99.94%">
							</div>
						
							<div style="width:100%; background-color:#cde1d6; margin-top:0;color: #fff;">
								<div style="width:100%; float:left; background-color:#02786a; padding:10px 0;">
									<p style="margin-top:0; text-align:center; margin-bottom:0; color:#fff; font-size:32px; text-transform: uppercase">'.$dfirstname.' '.$dmiddlename.' '.$dlastname.'</p>
								</div>
								
							</div>
							
					
							<div style="padding: 10px;">
							
							<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footerfront.jpeg">
							
							
							</div>
							<div style="clear:both;"></div>
						</div>
						<div style=" border:1px solid #ccc; width:100%;border-top:3px dotted #ccc;">
					
						<div>
							<p style="text-align:center; font-size:20px;"><strong>Registration No.DL'.$year.' '.$registration_no.'</strong></p>
							<p style="text-align:center; color: #484747; font-size:18px;">I have pledged to donate the organs & Tissues from<br> my body for therapeutic purpose after my death(Brain stem/Cardiac)</p>
						</div>
					
						<div style="border-top:2px solid #5cbb79; border-bottom:2px solid #5cbb79; margin:3px; ">
							<p style="text-align:center; font-size:17px; margin:5px;"><strong>Emergency Contact No: '.$dwcontact.'</strong></p>
						</div>
						
						<div>
							<p style="font-size: 14px; padding:0 40px;">
							<strong>
							Organs : <span style="font-size:14px; color: red;">
							Heart :<input type="radio" name="Heart" value="heart" '.(in_array("Heart",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Lungs :<input type="radio" name="Lungs" value="lungs" '.(in_array("Lungs",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Liver :<input type="radio" name="liver" value="liver" '.(in_array("Liver",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Kidneys :<input type="radio" name="kidneys" value="kidneys" '.(in_array("Kidneys",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
							Pancreas :<input type="radio" name="pancreas" value="pancreas" '.(in_array("Pancrease",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Intestine :<input type="radio" name="intestine" value="intestine" '.(in_array("Intestine",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
							All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'></span>
							</strong></p>
					
							<p style="font-size: 14px; padding:0 40px;"><strong>
							Tissues : <span style="font-size:14px; color: red;">
							Corneas :<input type="radio" name="corneas" value="corneas"  '.(in_array("Corneas-Eye-Balls",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Skin :<input type="radio" name="skin" value="skin"  '.(in_array("Skin",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Bones :<input type="radio" name="bones" value="bones" '.(in_array("Bones",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Heart Valves :<input type="radio" name="heart_valves" value="heart_valves" '.(in_array("Heart Valves",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Blood Vessels :<input type="radio" name="blood_vessels" value="blood_vessels" '.(in_array("Blood vessels",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dTissues_arr) ? ' checked="checked" ' : '') .'></span></strong></p> 
						</div>
						
					
						<div style="margin:10px 1px;">
							<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footer_slogan.jpg" alt="footer" style="width:100%;">
						</div>
						<div style="margin:10px 1px;">
							<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footer2.jpg" alt="footer" style="width:100%;">
						</div>
					
						</div>
						
					</body>
					</html>';
	} else  {
		$html = '<!DOCUMENT html>
					<html lang="en">
						<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>Donatelife Donor Card</title>
						</head>
						<body>
						
							<div style=" border:1px solid #ccc; width:100%;border-bottom:none;">
						
								<div style="background:#008275; -webkit-print-color-adjust: exact;">
									<h2 style="text-align:center; margin:0px; padding:5px 0; color:#fff; font-size:40px;">ORGAN DONOR CARD</h2>
								</div>
						
								<div style="width:100%">
									<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/card2.jpg" alt="donate" width="99.94%">
								</div>
							
								<div style="width:100%; background-color:#cde1d6; margin-top:0;color: #fff;">
									<div style="width:100%; float:left; background-color:#02786a; padding:10px 0;">
										<p style="margin-top:0; text-align:center; margin-bottom:0; color:#fff; font-size:32px; text-transform: uppercase">'.$dfirstname.' '.$dmiddlename.' '.$dlastname.'</p>
									</div>
									
								</div>
								
						
								<div style="padding: 10px;">
								
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footerfront.jpeg">
								
								
								</div>
								<div style="clear:both;"></div>
							</div>
							<div style=" border:1px solid #ccc; width:100%;border-top:3px dotted #ccc;">
						
							<div>
								<p style="text-align:center; font-size:20px;"><strong>Registration No.DL'.$year.' '.$registration_no.'</strong></p>
								<p style="text-align:center; color: #484747; font-size:18px;">I have pledged to donate the organs & Tissues from<br> my body for therapeutic purpose after my death(Brain stem/Cardiac)</p>
							</div>
						
							<div style="border-top:2px solid #5cbb79; border-bottom:2px solid #5cbb79; margin:3px; ">
								<p style="text-align:center; font-size:17px; margin:5px;"><strong>Emergency Contact No: '.$dwcontact.'</strong></p>
							</div>
							
							<div>
								<p style="font-size: 14px; padding:0 40px;">
								<strong>
								Organs : <span style="font-size:14px; color: red;">
								Heart :<input type="radio" name="Heart" value="heart" '.(in_array("Heart",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Lungs :<input type="radio" name="Lungs" value="lungs" '.(in_array("Lungs",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Liver :<input type="radio" name="liver" value="liver" '.(in_array("Liver",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Kidneys :<input type="radio" name="kidneys" value="kidneys" '.(in_array("Kidneys",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
								Pancreas :<input type="radio" name="pancreas" value="pancreas" '.(in_array("Pancrease",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Intestine :<input type="radio" name="intestine" value="intestine" '.(in_array("Intestine",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
								All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'></span>
								</strong></p>
						
								<p style="font-size: 14px; padding:0 40px;"><strong>
								Tissues : <span style="font-size:14px; color: red;">
								Corneas :<input type="radio" name="corneas" value="corneas"  '.(in_array("Corneas-Eye-Balls",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Skin :<input type="radio" name="skin" value="skin"  '.(in_array("Skin",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Bones :<input type="radio" name="bones" value="bones" '.(in_array("Bones",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Heart Valves :<input type="radio" name="heart_valves" value="heart_valves" '.(in_array("Heart Valves",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Blood Vessels :<input type="radio" name="blood_vessels" value="blood_vessels" '.(in_array("Blood vessels",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dTissues_arr) ? ' checked="checked" ' : '') .'></span></strong></p> 
							</div>
							
						
							<div style="margin:10px 1px;">
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footer_slogan.jpg" alt="footer" style="width:100%;">
							</div>
						<div style="margin:10px 1px; position: relative;;">
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/angdan_img-1.jpg" alt="footer" style="width:100%;position: relative;z-index:8;">
								<div style="color: red;
										font-weight: bold;
										font-size: 16px;
										margin-top: -50px;
										padding-bottom:20px;
										margin-left: 25%;
										z-index:10;
										postion:relative;
										display: block;">'. $ganesha_mandal .'</div>
								
							</div>
							</div>
							
						</body>
					</html>';
	}
	
	$filename = $dfirstname.'_'.time().'.pdf';
	$upload_dir = wp_upload_dir();
    $pdf_file_path = $upload_dir['basedir'] . '/donor_card/'. $filename;
   
    return array('html' => $html, 'filepath' => $pdf_file_path, 'filename'=> $filename);
}

/** generate pdf function */
function generate_pdf_cf7($form_data,$submitid) {
	$registration_no = $submitid;
	$year = date("y");
	$mandal = $form_data['ref_mandal'];
	$dfirstname = $form_data['dfirstname']; //donor's full name
	$dmiddlename = $form_data['dmiddlename'];
	$dlastname = $form_data['dlastname'];
	$dwcontact = $form_data['dwcontact']; //relative telephone number
	$final_dOrgan_arr = $form_data['dOrgan']; //organs checkbox
	$final_dTissues_arr = $form_data['dTissues']; //tissues checkbox
	$ganesha_mandal = $form_data['ganesha_mandal']; //reference textbox value
	
	if($mandal == ''){
		$html = '<!DOCUMENT html>
					<html lang="en">
					<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>Donatelife Donor Card</title>
					</head>
					<body>
					
						<div style=" border:1px solid #ccc; width:100%;border-bottom:none;">
					
							<div style="background:#008275; -webkit-print-color-adjust: exact;">
								<h2 style="text-align:center; margin:0px; padding:5px 0; color:#fff; font-size:40px;">ORGAN DONOR CARD</h2>
							</div>
					
							<div style="width:100%">
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/card2.jpg" alt="donate" width="99.94%">
							</div>
						
							<div style="width:100%; background-color:#cde1d6; margin-top:0;color: #fff;">
								<div style="width:100%; float:left; background-color:#02786a; padding:10px 0;">
									<p style="margin-top:0; text-align:center; margin-bottom:0; color:#fff; font-size:32px; text-transform: uppercase">'.$dfirstname.' '.$dmiddlename.' '.$dlastname.'</p>
								</div>
								
							</div>
							
					
							<div style="padding: 10px;">
							
							<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footerfront.jpeg">
							
							
							</div>
							<div style="clear:both;"></div>
						</div>
						<div style=" border:1px solid #ccc; width:100%;border-top:3px dotted #ccc;">
					
						<div>
							<p style="text-align:center; font-size:20px;"><strong>Registration No.DL'.$year.' '.$registration_no.'</strong></p>
							<p style="text-align:center; color: #484747; font-size:18px;">I have pledged to donate the organs & Tissues from<br> my body for therapeutic purpose after my death(Brain stem/Cardiac)</p>
						</div>
					
						<div style="border-top:2px solid #5cbb79; border-bottom:2px solid #5cbb79; margin:3px; ">
							<p style="text-align:center; font-size:17px; margin:5px;"><strong>Emergency Contact No: '.$dwcontact.'</strong></p>
						</div>
						
						<div>
							<p style="font-size: 14px; padding:0 40px;">
							<strong>
							Organs : <span style="font-size:14px; color: red;">
							Heart :<input type="radio" name="Heart" value="heart" '.(in_array("Heart",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Lungs :<input type="radio" name="Lungs" value="lungs" '.(in_array("Lungs",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Liver :<input type="radio" name="liver" value="liver" '.(in_array("Liver",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Kidneys :<input type="radio" name="kidneys" value="kidneys" '.(in_array("Kidneys",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
							Pancreas :<input type="radio" name="pancreas" value="pancreas" '.(in_array("Pancrease",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
							Intestine :<input type="radio" name="intestine" value="intestine" '.(in_array("Intestine",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
							All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'></span>
							</strong></p>
					
							<p style="font-size: 14px; padding:0 40px;"><strong>
							Tissues : <span style="font-size:14px; color: red;">
							Corneas :<input type="radio" name="corneas" value="corneas"  '.(in_array("Corneas-Eye-Balls",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Skin :<input type="radio" name="skin" value="skin"  '.(in_array("Skin",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Bones :<input type="radio" name="bones" value="bones" '.(in_array("Bones",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Heart Valves :<input type="radio" name="heart_valves" value="heart_valves" '.(in_array("Heart Valves",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							Blood Vessels :<input type="radio" name="blood_vessels" value="blood_vessels" '.(in_array("Blood vessels",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
							All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dTissues_arr) ? ' checked="checked" ' : '') .'></span></strong></p> 
						</div>
						
					
						<div style="margin:10px 1px;">
							<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footer_slogan.jpg" alt="footer" style="width:100%;">
						</div>
						<div style="margin:10px 1px;">
							<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footer2.jpg" alt="footer" style="width:100%;">
						</div>
					
						</div>
						
					</body>
					</html>';
	} else  {
		$html = '<!DOCUMENT html>
					<html lang="en">
						<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>Donatelife Donor Card</title>
						</head>
						<body>
						
							<div style=" border:1px solid #ccc; width:100%;border-bottom:none;">
						
								<div style="background:#008275; -webkit-print-color-adjust: exact;">
									<h2 style="text-align:center; margin:0px; padding:5px 0; color:#fff; font-size:40px;">ORGAN DONOR CARD</h2>
								</div>
						
								<div style="width:100%">
									<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/card2.jpg" alt="donate" width="99.94%">
								</div>
							
								<div style="width:100%; background-color:#cde1d6; margin-top:0;color: #fff;">
									<div style="width:100%; float:left; background-color:#02786a; padding:10px 0;">
										<p style="margin-top:0; text-align:center; margin-bottom:0; color:#fff; font-size:32px; text-transform: uppercase">'.$dfirstname.' '.$dmiddlename.' '.$dlastname.'</p>
									</div>
									
								</div>
								
						
								<div style="padding: 10px;">
								
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footerfront.jpeg">
								
								
								</div>
								<div style="clear:both;"></div>
							</div>
							<div style=" border:1px solid #ccc; width:100%;border-top:3px dotted #ccc;">
						
							<div>
								<p style="text-align:center; font-size:20px;"><strong>Registration No.DL'.$year.' '.$registration_no.'</strong></p>
								<p style="text-align:center; color: #484747; font-size:18px;">I have pledged to donate the organs & Tissues from<br> my body for therapeutic purpose after my death(Brain stem/Cardiac)</p>
							</div>
						
							<div style="border-top:2px solid #5cbb79; border-bottom:2px solid #5cbb79; margin:3px; ">
								<p style="text-align:center; font-size:17px; margin:5px;"><strong>Emergency Contact No: '.$dwcontact.'</strong></p>
							</div>
							
							<div>
								<p style="font-size: 14px; padding:0 40px;">
								<strong>
								Organs : <span style="font-size:14px; color: red;">
								Heart :<input type="radio" name="Heart" value="heart" '.(in_array("Heart",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Lungs :<input type="radio" name="Lungs" value="lungs" '.(in_array("Lungs",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Liver :<input type="radio" name="liver" value="liver" '.(in_array("Liver",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Kidneys :<input type="radio" name="kidneys" value="kidneys" '.(in_array("Kidneys",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
								Pancreas :<input type="radio" name="pancreas" value="pancreas" '.(in_array("Pancrease",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'> 
								Intestine :<input type="radio" name="intestine" value="intestine" '.(in_array("Intestine",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'>
								All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dOrgan_arr) ? ' checked="checked" ' : '') .'></span>
								</strong></p>
						
								<p style="font-size: 14px; padding:0 40px;"><strong>
								Tissues : <span style="font-size:14px; color: red;">
								Corneas :<input type="radio" name="corneas" value="corneas"  '.(in_array("Corneas-Eye-Balls",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Skin :<input type="radio" name="skin" value="skin"  '.(in_array("Skin",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Bones :<input type="radio" name="bones" value="bones" '.(in_array("Bones",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Heart Valves :<input type="radio" name="heart_valves" value="heart_valves" '.(in_array("Heart Valves",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								Blood Vessels :<input type="radio" name="blood_vessels" value="blood_vessels" '.(in_array("Blood vessels",$final_dTissues_arr) ? ' checked="checked" ' : '') .'> 
								All :<input type="radio" name="all" value="all" '.(in_array("All",$final_dTissues_arr) ? ' checked="checked" ' : '') .'></span></strong></p> 
							</div>
							
						
							<div style="margin:10px 1px;">
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/footer_slogan.jpg" alt="footer" style="width:100%;">
							</div>
						<div style="margin:10px 1px; position: relative;;">
								<img src="'.get_stylesheet_directory_uri().'/images/pdfimages/angdan_img-1.jpg" alt="footer" style="width:100%;position: relative;z-index:8;">
								<div style="color: red;
										font-weight: bold;
										font-size: 16px;
										margin-top: -50px;
										padding-bottom:20px;
										margin-left: 25%;
										z-index:10;
										postion:relative;
										display: block;">'. $ganesha_mandal .'</div>
								
							</div>
							</div>
							
						</body>
					</html>';
	}
	
	$filename = $dfirstname.'_'.time().'.pdf';
	$upload_dir = wp_upload_dir();
    $pdf_file_path = $upload_dir['basedir'] . '/donor_card/'. $filename;
   
    return array('html' => $html, 'filepath' => $pdf_file_path, 'filename'=> $filename);
}

/**Generate pdf for become a donor form before sending an email */
add_action('forminator_custom_form_mail_before_send_mail', 'generate_pdf_and_attach_to_email', 20, 4);
function generate_pdf_and_attach_to_email($mail_object, $custom_form, $data, $entry) {
	global $wpdb;
	
    if($custom_form->name == 'become-a-donor') { //become a donor form
		

		$dOrgan = $data['checkbox-1'];
		$dTissues = $data['checkbox-2'];
		
		$final_dOrgan =implode(',', $dOrgan);
		$final_dTissues =implode(',', $dTissues);

		$donor_table = $wpdb->prefix.'donor_master';
		$insert_donor = $wpdb->insert($donor_table, 
			array(
				'dfirstname' => $data['name-1-first-name'],
    			'dmiddlename' => $data['name-1-middle-name'],
    			'dlastname' => $data['name-1-last-name'],
    			'daged' => $data['text-1'],
    			'ddate' => date('Y-m-d',strtotime($data['date-1'])),
    			'dwhatsapp' => $data['phone-1'],
    			'dgender' => $data['radio-1'],
    			'dOrgan' => $final_dOrgan,
    			'dTissues' => $final_dTissues,
    			'dbloodgroup' => $data['select-1'],
    			'dcontact' => $data['phone-2'],
    			'demail' => $data['email-1'],
    			'daddress' => $data['address-1-street_address'],
    			'dtaluka' => $data['address-1-address_line'],
    			'ddist' => $data['address-1-city'],
    			'dstate' => $data['address-1-state'],
    			'dfirstNameOfWitness' => $data['name-2-first-name'],
    			'dmiddleNameOfWitness' => $data['name-2-middle-name'],
    			'dlastNameOfWitness' => $data['name-2-last-name'],
    			'dwaged' => $data['text-2'],
    			'dwcontact' => $data['phone-3'],
    			'dwemail' => $data['email-2'],
    			'dwgender' => $data['radio-2'],
    			'dwaddress' => $data['address-2-street_address'],
    			'dwtaluka' => $data['address-2-address_line'],
    			'dwdist' => $data['address-2-city'],
    			'dwstate' => $data['address-2-state'],
    			'todaydate' => date('Y-m-d'),
    			'ganesha_mandal' => $data['text-4'],
    			'dwNearRelative'	=> $data['text-3'],
    			'createdate' => date('Y-m-d'),
				'is_trash' => 0,
			)
		);
		
		if($insert_donor) {

			$entryid = $wpdb->insert_id;
			$pdf_data = generate_pdf($data, $entryid);
			$pdf_file_path = $pdf_data['filepath'];

			require_once get_stylesheet_directory() . '/vendor/autoload.php';

			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($pdf_data['html']);
			$mpdf->Output($pdf_file_path,'F');
			
			
			// Step 2: Attach PDF to email
			// $mail_object->set_attachment(array($pdf_file_path), $custom_form, $entry);
			add_filter('forminator_custom_form_mail_attachment', function($attachments) use ($pdf_file_path) {
				$attachments[] = $pdf_file_path;
				return $attachments;
			});

			$year = date("y");
			$register_number = 'DL'.$year.' '.$entryid;
			
			$update_data = $wpdb->update($donor_table,
				array(
					'donor_card' => $pdf_data['filename'],
					'registration_no' => $register_number,
				),
				array('id' => $entryid)
			);
		}
	}
	else if($custom_form->name == 'become-a-volunteer') {
	
		$timeOfContribution = $data['checkbox-1'];
		$areaOfInterest = $data['checkbox-2'];
		
		$final_timeOfContribution =implode(',', $timeOfContribution);
		$final_areaOfInterest =implode(',', $areaOfInterest);

		$volunteer_table = $wpdb->prefix.'volunteer_master';
		$insert_volunteer = $wpdb->insert($volunteer_table, 
			array(
				'vfullname' => $data['name-1'],
				'vdate' => date('Y-m-d',strtotime($data['date-1'])),
				'vemail' => $data['email-1'],
				'vaddress1' => $data['address-1-street_address'],
				'vbloodgroup' => $data['text-1'],
				'vcity' => $data['address-1-city'],
				'vstate' => $data['address-1-state'],
				'vmobile' => $data['phone-2'],
				'vgender' => $data['select-1'],
				'timeOfContribution' => $final_timeOfContribution,
				'areaOfInterest' => $final_areaOfInterest,
				'vphone' => $data['phone-1'],
				'todaydate' => date('Y-m-d'),
				'vcountry'	=> '',
				'is_trash' => 0,
			)
		);
		
		if($insert_volunteer) {
			
			$lastid = $wpdb->insert_id;
			$tmp_name = $_FILES['upload-1']['tmp_name'];
			$photoname = basename($_FILES['upload-1']['name']);

			$photo = $lastid.'-'.$photoname;

			$upload_dir = wp_upload_dir();
			$custom_dir = $upload_dir['basedir'] . '/volunteer';
			$custom_url = $upload_dir['baseurl'] . '/volunteer';
			
			$data['upload-1']['file']['file_name'] = $photo;
			$data['upload-1']['file']['file_url'] = $custom_url.'/'.$photo;
			$data['upload-1']['file']['file_path'] = $custom_dir.'/'.$photo;
			// if ( ! file_exists( $custom_dir ) ) {
			// 	wp_mkdir_p( $custom_dir ); // Create the directory with the correct permissions
			// 	chmod($custom_dir, 0755);
			// }
			$wpdb->update($volunteer_table,array('photo' => $photo), array('id' => $lastid));

			chmod($custom_dir, 0755);
			$move_path =  $custom_dir.'/'.$photo;
			// Check if the custom folder exists, if not create it
			
			if(move_uploaded_file($tmp_name,$move_path)) {
				// echo 'successfully uplaoded';
			}
			// else{
			// 	echo $_FILES['upload-1']['error'];
			// }
			
		}
	}

}

add_filter('forminator_custom_upload_subfolder',function($subfolder, $form_id, $dir) {
	if($form_id == '2257') { //volunteer form id
		$subfolder = '';
	} 
	return $subfolder;
},20,3);


/**Send SMS after user submits the form - right now API is not working. */
//add_action('forminator_custom_form_mail_before_send_mail', 'send_sms_after_form_submission', 30,4);
function send_sms_after_form_submission($mail_object, $custom_form, $data, $entry){
	
	if($custom_form->id == 1993) {
		$entryid = $entry->entry_id;
		$entrydata = Forminator_API::get_form_entry($custom_form->id, $entry->entry_id);
		$meta_data = $entrydata->meta_data;
		
		$donor_card_id = $meta_data['register_number']['value'];
		
		//curl request for message
		$ch = curl_init();
		$sms_message = 'Hi '.$meta_data['name-1']['value']['first-name'].', Thank you for being an Organ Donor. Please check your Email for your Organ Donor Card.';
		$msg = urlencode($sms_message);
		curl_setopt($ch, CURLOPT_URL, 'mobileadz.in/smsapi.aspx?username=donatelife&password=donatelife&sender=DONATE&to='.$meta_data['phone-1']['value'].'&message='.$msg.'&route=route3');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		$contents = curl_exec($ch);
		curl_close($ch);
	
	
		$ch1 = curl_init();
		$sms_message1 = 'Hi, You have received a Pledge request from website having Donar Card Id : '.$donor_card_id;
		$msg1 = urlencode($sms_message1);
		curl_setopt($ch1, CURLOPT_URL, 'mobileadz.in/smsapi.aspx?username=donatelife&password=donatelife&sender=DONATE&to=7573011107&message='.$msg1.'&route=route3');
		curl_setopt($ch1, CURLOPT_HEADER, 0);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, false);
		$contents1 = curl_exec($ch1);
		curl_close($ch1);
	}

}


/**Display content on become donor page */
add_shortcode('content_after_donor_form','display_text_after_donor_form');
function display_text_after_donor_form() {
	ob_start(); ?>
	<hr>
        <div class="row">
            <div class="col-sm-12">  <h3 style="color:black"><b>Note:</b></h3>
            <ol >
                <li> Organ Donation is a family decision. So it is important that you discuss your decision with family members and loved ones so that it will be easier for them to follow through with your wishes.</li>
                <li>The person making the pledge has the option to withdraw the pledge. </li>
                <li>After filling the form, Kindly send it to Donate Life, on address mention below.</li>
            </ol>
            </div>
        </div>
        
        <hr>
        <div class="row">
            <div class="col-sm-12">  <h3 style="color:black; margin-bottom: 20px;"><b>Sample Donor Card:</b></h3> </div>
          <div class="col-sm-6"><h5 style="font-weight: 600;margin-bottom: 10px; ">Front Side: </h5><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/donor_card_front.png" class="img-responsive" style="border: 1px solid #ccc;" loading="lazy"></div>
            <div class="col-sm-6"><h5 style="font-weight: 600;margin-bottom: 10px; ">Back Side: </h5>
            
            
            
                <?php 
                if(isset($_GET['ref']) && $_GET['ref'] = 'Sri Dayalaji Anavil Kelvani Mandal') { 
                    echo '<img src="'.get_stylesheet_directory_uri().'/images/kelvani_mandal.png" class="img-responsive" style="border: 1px solid #ccc; " loading="lazy">';
                } else {
                    echo '<img src="'.get_stylesheet_directory_uri().'/images/donor_card_back.jpg" class="img-responsive" style="border: 1px solid #ccc; " loading="lazy">';
                }
                ?>
            </div>
        </div> 
        
        <hr>
        <div class="row">
            <div class="col-sm-12">
            <h3 style="color:black"><b>"Donate Life"</b></h3><br>
                <a href="<?php echo home_url(); ?>"><img src="<?php echo wp_get_attachment_url( get_option( 'site_logo' ) ); ?>" alt="" style="margin: 10px 0; " loading="lazy"></a><br>
            <b>
                Address: <br />
                Prime Shoppers, 428 to 430, 4th Floor, Near Happy Residency, <br />
                Opp. Safal Square, University Air Port Road, Vesu, Surat-395007.
                <br>
                Phone No: +91-7573011101/03/07/09
                <br>
                Email: info@donatelife.org.in
                <br>
                Website: www.donatelife.org.in
                <br>
                Toll Free Number: 1800 200 1944</b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
               <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/donate_life/donor_footer.jpg" style="max-width:100%" alt="" loading="lazy">
            </div>
        </div>
	<?php 
	return ob_get_clean();
}

add_action('wp_footer', 'forminator_custom_submit_script');
function forminator_custom_submit_script() {
    ?>
	<script type="text/javascript">
        jQuery(document).ready(function($) {
            
            $('#forminator-module-2270').on('submit', function(event) {
				event.preventDefault();
				
                var form = event.target;
                var formId = $(form).data('form-id'); // Get form ID
				var isValid = true;

                if (formId == 2270) {
                    
                    // Loop through all required fields
					$('#forminator-module-2270 .forminator-field input[data-required="1"], #forminator-module-2270 .forminator-field textarea[data-required="1"], #forminator-module-2270 .forminator-field select[data-required="1"]').each(function() {
					   
						if ($(this).val() === '') {
							isValid = false;
							
						} else {
                            //isValid = true;
                            
						}
					});
					
					if (isValid) {
						var amount = $(form).find('input[name="number-1"]').val();
						var name = $(form).find('input[name="name-1"]').val();
						var email = $(form).find('input[name="email-1"]').val();
						
						var formData = new FormData(this);
						
				// 		formData.append('amount', amount);
				// 		formData.append('name', name);
				// 		formData.append('email', email);

						$.ajax({
							url: '<?php echo get_stylesheet_directory_uri()."/ccavenue/ccavRequestHandler.php"; ?>',
							type: 'POST',
							data: formData,
							processData: false,
							contentType: false,
							success: function(response) {
								
								$('body').append(response);
							}
						});
					}else{
						
						return false;
					}
                }
            });
        });
    </script>
    <?php
}
//contact form submission store to db
add_action('wpcf7_before_send_mail', 'save_contact_form_data_to_custom_table');

function save_contact_form_data_to_custom_table($contact_form) {
    
    if ($contact_form->id() == '2049') { //contact form
        
        $submission = WPCF7_Submission::get_instance();
        
        if ($submission) {
            $data = $submission->get_posted_data();

            // Prepare the data to insert into your custom table
            global $wpdb;

            $table_name = $wpdb->prefix . 'contact_master'; // Use your actual custom table name

            $wpdb->insert($table_name, array(
                'cname' => sanitize_text_field($data['username']), // Change 'your-name' to your field name
                'cemail' => sanitize_email($data['email']), // Change 'your-email' to your field name
                'ccontact' => sanitize_text_field($data['contact']), // Change 'your-phone' to your field name
                'csubject' => sanitize_text_field($data['subject']), // Change 'your-message' to your field name
                'cmessage' => sanitize_textarea_field($data['message']), // Change 'your-message' to your field name
                'is_trash' => 0,
            ));
        }
    }
    
	if ($contact_form->id() == '98') { //subscription form
        
        $submission = WPCF7_Submission::get_instance();
        
        if ($submission) {
            $data = $submission->get_posted_data();

            // Prepare the data to insert into your custom table
            global $wpdb;

            $table_name = $wpdb->prefix . 'subscription_master'; // Use your actual custom table name

            $wpdb->insert($table_name, array(
                's_name' => sanitize_text_field($data['fullname']), // Change 'your-name' to your field name
                's_email' => sanitize_email($data['useremail']), // Change 'your-email' to your field name
                's_date' => date('Y-m-d'),
				'new' => 1
            ));
        }
    }

}

