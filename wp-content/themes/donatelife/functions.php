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

/**display donated numbers on home page */
add_shortcode('display_donated_number','display_donated_number_callback');
function display_donated_number_callback(){
	ob_start(); ?>
	<div class="row custom-flex">
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-1.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('kidneys_donated','option'); ?></h3>
						<h4>KIDNEYS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>"> Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-2.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('livers_donated','option'); ?></h3>
						<h4>LIVER <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor');?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
			<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-3.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('hearts_donated','option'); ?></h3>
						<h4>HEARTS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/lungs.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('lungs_donated','option'); ?></h3>
						<h4>LUNG <br> DONATED </h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-4.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('pancreas_donated','option'); ?></h3>
						<h4>PANCREAS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-9.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('intestine_donated','option'); ?></h3>
						<h4> INTESTINE <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h7.png" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('hands_donated','option'); ?></h3>
						<h4>HANDS <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
			<div class="col-md-2 col-sm-6 col-xs-6 organ-div">
			<!-- Start single-item -->
			<div class="welcome-item">
				<div class="img-holder">
					<figure><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/h-5.jpg" alt="Images" loading="lazy"></a></figure>
				</div>
				<div class="text">
					<div class="pro-text text-center">
						<h3><?php echo get_field('eyes_donated','option'); ?></h3>
						<h4>EYES <br> DONATED</h4>
					</div>
					<a target="_blank" href="<?php echo home_url('/become-donor'); ?>">Pledge now</a>
				</div>
			</div>
			<!-- End single-item -->
		</div>
	</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h4 class="digit-below">Total <?php echo get_field('total_donated','option'); ?> Organs & Tissues donated which has given New Life & Vision to 1147 persons across Country & Globe.</h4>
			</div>
		</div>
		<?php //$total = $web_arr['kidneys_donated'] + $web_arr['intestine_donated'] + $web_arr['livers_donated'] + $web_arr['hearts_donated'] + $web_arr['pancreas_donated'] + $web_arr['eyes_donated'] + $web_arr['hand_donation']; ?>
		
	<?php 
	return ob_get_clean();
}

/**shortcode for home page awards section */
add_shortcode( 'display_awards_home','display_awards_callback');
function display_awards_callback(){
	ob_start();
	$args = array(
		'post_type' => 'awards_appr',
		'post_status' => 'publish',
		'posts_per_page' => 4,
		'orderby' => 'menu_order',
		'order' => 'asc',
	);
	$awardslist = get_posts($args);
	
	if(!empty($awardslist)){
		foreach($awardslist as $award) {
			$awid = $award->ID;
			$pdf = get_field('award_pdf',$awid);
			$pdflink = !empty($pdf) ? $pdf['url'] : '';
			$featuredimg = get_the_post_thumbnail( $awid,array(370,230));
			$desc = $award->post_content;
			?>
			<div class="col-md-6 col-sm-6 col-xs-12 event-block">
				<!-- Start single-item -->
				<div class="event-item">
					<div class="img-holder">
						<a class="event-open" target="_blank" href="<?php echo $pdflink; ?>" title="<?php echo $desc; ?>">
							<i class="eg-icon-search" aria-hidden="true"></i>
							<?php if(has_post_thumbnail( $awid )) { ?>
								<figure><span><?php echo $featuredimg; ?></span></figure>
							<?php } ?>
						
							<div class="text">
								<h4>
									<span class="award-title">
									<?php
										$length = strlen($desc);
										if ($length > 32){
											echo substr($desc, 0 ,32);
											echo "...";
										}
										else{
											echo $desc;
										}

									?>
									</span>
								</h4>
							</div>
						</a>
					</div>
				</div>
				<!-- End single-item -->
			</div>
	<?php } } 
	return ob_get_clean();

}

/**Team member listing shortcode */
add_shortcode( 'teamlist','get_team_member_data' );
function get_team_member_data($atts) {
	$typed = shortcode_atts(array('m_type'=>'office-bearers'), $atts);
	ob_start(); 
	$args = array(
		'post_type' => 'team_members',
		'post_status' => 'publish',
		'orderby' =>'menu_order',
		'posts_per_page' => -1,
		'order' => 'asc',
		'tax_query' => array(
			array(
				'taxonomy' => 'team_type',
				'terms' => $typed['m_type'],
				'field' => 'slug',
				'operator' => 'IN'
			),
		),
	);

	$teamlist = get_posts($args);

	if(!empty($teamlist)) {
		foreach($teamlist as $tl) {
			$tid = $tl->ID;
			$imgurl = has_post_thumbnail($tid) ? get_the_post_thumbnail( $tid, 'medium') : '';
			$description = $tl->post_content;
	?>
		<div class="col-md-3 col-sm-6 col-xs-12 team-single-item">
			<!-- Start single-item -->
			<div class="single-item wow fadeInUp">
				<div class="img-holder">
					<figure><?php echo $imgurl; ?></figure>
					<!-- Start overlay -->
					<div class="overlay">
						<div class="link-icon">
						</div>
					</div>
					<!-- End overlay -->
				</div>
				<div class="text">
					<h4><a><?php echo get_the_title( $tid ); ?></a></h4>
					<p><?php echo get_field('member_designation',$tid); ?></p>
					<?php if($description != '') { ?><a href="#" data-toggle="modal" data-target="#myModal<?php echo $tid; ?>"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View Details</a><?php } ?>
				</div>
			</div>
			<!-- End single-item -->
			<div class="modal fade myModal teamModal" id="myModal<?php echo $tid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><?php echo get_the_title( $tid ); ?></h4>
						</div>
						<div class="modal-body">
							<?php echo $description; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php 
		}
	}else{
		echo 'no data found';
	}
	return ob_get_clean();
}

add_shortcode( 'list_testimonials','get_testimonial_list' );
function get_testimonial_list($atts){
	$typed = shortcode_atts( array('type'=>'testimonial'), $atts );
	ob_start();

	$args = array(
		'post_type' => 'testimonials',
		'post_status' => 'publish',
		'orderby' =>'menu_order',
		'order' => 'asc',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'testimonial_type',
				'terms' => $typed['type'],
				'field' => 'slug',
				'operator' => 'IN'
			),
		),
	);

	$testimonidal_data = get_posts( $args );
	$size = ($typed['type'] == 'feelings-of-organ-recipients') ? 'large' : array(260,340);
	$colsize9 =  ($typed['type'] == 'feelings-of-organ-recipients') ? 'col-sm-6' : 'col-sm-9';
	$colsize3 =  ($typed['type'] == 'feelings-of-organ-recipients') ? 'col-sm-6' : 'col-sm-3';
	if(!empty($testimonidal_data)) {
		$i = 1;
		foreach($testimonidal_data as $ttdata) {
			$ttid = $ttdata->ID;
			$title = get_the_title( $ttid );
			$desc = $ttdata->post_content;
			$designation = get_field('tt_designation',$ttid);
			$ytlink = get_field('tt_youtube_link',$ttid);
			
			$image = (has_post_thumbnail( $ttid )) ? get_the_post_thumbnail( $ttid, $size, array('class' => 'img-responsive') ) : '';
 			if(wp_is_mobile()) { ?>
				<div class="news-well wow fadeInUp news-line animated testimonial-block visible-xs" style="visibility: visible; animation-name: fadeInUp;">
					<div class="row">
						<div class="<?php echo $colsize9; ?>"><p><i class="quote">“</i> </p>
							<p><?php echo $desc; ?></p>
							<h3>- &nbsp;<?php echo $title; if ($designation != '' ) { ?>&nbsp;(<?php echo $designation; ?>)<?php } ?></h3>
							<?php if ($ytlink != '') { ?>
								<div class="video-gallery">
									<a href="<?php echo $ytlink;?>" >
										<div class=" btn-3">
											<i class="fa fa-youtube-square" aria-hidden="true"></i>
											View Video
										</div>
									</a>
								</div>
							<?php } ?>
						</div>
						<div class="<?php echo $colsize3; ?>"><?php echo $image; ?></div>
					</div>
				</div>
			<?php 
			}else{
				if($i % 2 == 0 ) {  ?>
                    <div class="news-well wow fadeInUp news-line animated testimonial-block hidden-xs" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                            <div class="<?php echo $colsize3; ?>"><?php echo $image; ?></div>
                            <div class="<?php echo $colsize9; ?>"><p><i class="quote">“</i> </p>
                                <p><?php echo $desc; ?></p>
                                <h3>- &nbsp;<?php echo $title; if ($designation != '' ) { ?>&nbsp;(<?php echo $designation; ?>)<?php } ?></h3>

                                <?php if ($ytlink != '') { ?>
                                    <div class="video-gallery">
                                        <a href="<?php echo $ytlink;?>">
                                            <div class=" btn-3">
                                                <i class="fa fa-youtube-square" aria-hidden="true"></i>
                                                    View Video
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php } else { ?>

                    <div class="news-well wow fadeInUp news-line animated testimonial-block hidden-xs" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="row">
                            <div class="<?php echo $colsize9; ?>"><p><i class="quote">“</i> </p>
                                <p><?php echo $desc; ?></p>
                                <h3>- &nbsp;<?php echo $title; if ($designation != '' ) { ?>&nbsp;(<?php echo $designation; ?>)<?php } ?></h3>

                                <?php if ($ytlink != '') { ?>
                                <div class="video-gallery">
                                    <a href="<?php echo $ytlink;?>" >
                                        <div class=" btn-3">
                                            <i class="fa fa-youtube-square" aria-hidden="true"></i>
                                                View Video
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="<?php echo $colsize3; ?>"><?php echo $image; ?></div>
                        </div>

                    </div>
			<?php }
			}
			$i++;
		}
	}
	return ob_get_clean();
}

add_filter( 'manage_edit-cadaver_donor_columns', 'add_acf_column_to_cpt' );
function add_acf_column_to_cpt( $columns ) {
    $columns['organ_receiver'] = 'Receiver';
    $columns['cadaver_orgon_donor'] = 'Donor';
    
	unset($columns['date']);
    return $columns;
}

// 2. Populate the custom column with the ACF field value
add_action( 'manage_cadaver_donor_posts_custom_column', 'show_acf_field_in_cpt_column', 10, 2 );
function show_acf_field_in_cpt_column( $column, $post_id ) {

	$acf_value = get_field( $column, $post_id ); 
	echo $acf_value ? $acf_value : '—'; 
	 
}

/** Display data in datatable - /awards/ page */
add_action('wp_ajax_fetch_awards_data', 'fetch_awards_data');
add_action('wp_ajax_nopriv_fetch_awards_data', 'fetch_awards_data');
function fetch_awards_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'awards_appr';

    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'year_of_award', 'awarding_authority', 'award_pdf');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order ASC';
	}else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'year_of_award'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'awarding_authority'
                ) LIKE %s
               
            )
        ", "%$search_value%", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish'
    ", $post_type);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query
    ", $post_type);
    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'year_of_award') AS year_of_award,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'awarding_authority') AS awarding_authority,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'award_pdf') AS award_pdf
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query
        ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    // Prepare the data for DataTables
    $data = array();
	$start_index = $offset + 1; // Adjust start index for pagination
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $start_index + $index,
            'award_name' => $row['post_title'],
            'year' => $row['year_of_award'],
            'authority' => $row['awarding_authority'],
            'pdf' => (!empty($row['award_pdf'])) ? '<a href="'.wp_get_attachment_url($row['award_pdf']).'" target="_blank" class="donate-btn">View PDF </a>' : '',
        );
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/**Fetch donations page data in data table */
add_action('wp_ajax_fetch_donor_data', 'fetch_donor_data');
add_action('wp_ajax_nopriv_fetch_donor_data', 'fetch_donor_data');
function fetch_donor_data() {
	global $wpdb;
    // Check and sanitize the post type and taxonomy term
    $post_type = 'cadaver_donor';
	$taxonomy_term = isset($_POST['taxonomy_term']) ? sanitize_text_field($_POST['taxonomy_term']) : '';
	$limit = intval($_POST['length']);
	$offset = intval($_POST['start']);
	$order_column_index = intval($_POST['order'][0]['column']);
	$order_direction = sanitize_text_field($_POST['order'][0]['dir']);
	$search_value = sanitize_text_field($_POST['search']['value']);

	// Columns for ordering
	$columns = array(
		1 => 'donation_date',
		2 => 'organ_receiver',
		3 => 'city',
		4 => 'transplanted_at',
		5 => 'cadaver_orgon_donor'
	);
	$acf_field = isset($columns[$order_column_index]) ? $columns[$order_column_index] : '';
	// $order_by = 'menu_order ASC';

	$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;


	// Search query
	$search_query = "";
	if (!empty($search_value)) {
		$search_query = $wpdb->prepare("
			AND (
				EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'donation_date' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'organ_receiver' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'city' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'transplanted_at' AND meta_value LIKE %s)
				OR EXISTS (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'cadaver_orgon_donor' AND meta_value LIKE %s)
			)
		", "%$search_value%", "%$search_value%", "%$search_value%", "%$search_value%", "%$search_value%");
	}

	// Total records query
	$total_records_query = $wpdb->prepare("
		SELECT COUNT(*)
		FROM {$wpdb->posts}
		WHERE post_type = %s AND post_status = 'publish'
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'donor_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s)))
	", $post_type, $taxonomy_term);
	$total_records = $wpdb->get_var($total_records_query);

	// Total filtered records query
	$filtered_records_query = $wpdb->prepare("
		SELECT COUNT(*)
		FROM {$wpdb->posts}
		WHERE post_type = %s AND post_status = 'publish'
		$search_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'donor_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s)))
	", $post_type, $taxonomy_term);
	$filtered_records = $wpdb->get_var($filtered_records_query);

	// Fetch records with pagination, ordering, and search
	$results_query = $wpdb->prepare("
		SELECT ID, post_title
		FROM {$wpdb->posts}
		WHERE post_type = %s AND post_status = 'publish'
		$search_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'donor_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s)))
		ORDER BY $order_by
		LIMIT %d OFFSET %d
	", $post_type, $taxonomy_term, $limit, $offset);

	$results = $wpdb->get_results($results_query, ARRAY_A);
	
	// print_r($results_query);
    $data = array();
	
    if ($results) {
		if($taxonomy_term == 'liver') {
			$i = $total_records + 30;
		}else{
			$i = $total_records;
		}
        $start_index = $offset; // + 1  - Adjust start index for pagination
        foreach ($results as $index => $row) {
            
			$postid = $row['ID'];
			//$terms = wp_get_post_terms(get_the_ID(), 'your_taxonomy_name', array('fields' => 'term_id'))
            $data[] = array(
                'id' => $i - $start_index, //$start_index + $index,
                'post_title' => $row['post_title'],
				'date' => get_field('donation_date',$postid),
				'receiver' => get_field('organ_receiver',$postid),
				'city' => get_field('city',$postid),
				'transplant' => get_field('transplanted_at',$postid),
				'donor_name' => get_field('cadaver_orgon_donor',$postid),
                'pdf' => (!empty(get_field('press_coverage',$postid))) ? '<a href="'.get_field('press_coverage',$postid).'" target="_blank" class="btn btn-info btn-block">View PDF </a>' : '',
                
            );
			$newspaperlinks = '';
			if(have_rows('newspaper_links')) : 
				while(have_rows('newspaper_links')) : the_row();
				$newspaperlinks = ob_start();

				$sandeshLink = get_sub_field('sandesh_link',$postid);
				if ($sandeshLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $sandeshLink; ?>" target="_blank">Sandesh</a>&nbsp;&nbsp;
				<?php }

				$navbharatTimes = get_sub_field('navbharat_times',$postid);
				if ($navbharatTimes != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $navbharatTimes; ?>" target="_blank">Navbharat Times</a>&nbsp;&nbsp;
				<?php }
				
				$indiaTimes = get_sub_field('india_times',$postid);
				if ($indiaTimes != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $indiaTimes; ?>" target="_blank">India Times</a>&nbsp;&nbsp;
				<?php }
				
				$gujaratiNews18 = get_sub_field('gujarati_news18',$postid);
				if ($gujaratiNews18 != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $gujaratiNews18; ?>" target="_blank">Gujarat News18</a>&nbsp;&nbsp;
				<?php }
				
				$iamGujarat = get_sub_field('i_am_gujarat',$postid);
				if ($iamGujarat != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $iamGujarat; ?>" target="_blank">I am gujarat</a>&nbsp;&nbsp;
				<?php }
				
				$gujaratSamacharLink = get_sub_field('gujarat_samachar_link',$postid);
				if ($gujaratSamacharLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $gujaratSamacharLink; ?>" target="_blank">Gujarat Samachar</a>&nbsp;&nbsp;
				<?php }
				
				$timesOfIndiaLink = get_sub_field('the_times_of_india_link',$postid);
				if ($timesOfIndiaLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $timesOfIndiaLink; ?>" target="_blank">Times Of India</a>&nbsp;&nbsp;
				<?php }
				
				$divyaBhaskarLink = get_sub_field('divya_bhaskar',$postid);
				if ($divyaBhaskarLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $divyaBhaskarLink; ?>" target="_blank">Divya Bhaskar</a>&nbsp;&nbsp;
				<?php }
				
				$dnaLink = get_sub_field('dna_link',$postid);
				if ($dnaLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $dnaLink; ?>" target="_blank">DNA</a>&nbsp;&nbsp;
				<?php }
				
				$nyoozLink = get_sub_field('nyooz_link',$postid);
				if ($nyoozLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $nyoozLink; ?>" target="_blank">NYOOZ</a>&nbsp;&nbsp;
				<?php }

				$indiaTodayLink = get_sub_field('india_today_link',$postid);
				if ($indiaTodayLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $indiaTodayLink; ?>" target="_blank">India Today</a>&nbsp;&nbsp;
				<?php }

				$medicalDialoguesLink = get_sub_field('medical_dialogues_link',$postid);
				if ($medicalDialoguesLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $medicalDialoguesLink; ?>" target="_blank">Medical Dialogues</a>&nbsp;&nbsp;
				<?php }

				$outlookIndiaLink = get_sub_field('outlook_india_link',$postid);
				if ($outlookIndiaLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $outlookIndiaLink; ?>" target="_blank">Outlook India</a>&nbsp;&nbsp;
				<?php }

				$midDayLink = get_sub_field('mid_day_link',$postid);
				if ($midDayLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $midDayLink; ?>" target="_blank">Mid Day</a>&nbsp;&nbsp;
				<?php }

				$ummidLink = get_sub_field('ummid_link',$postid);
				if ($ummidLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $ummidLink; ?>" target="_blank">Ummid</a>&nbsp;&nbsp;
				<?php }

				$theHinduLink = get_sub_field('the_hindu_link',$postid);
				if ($theHinduLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $theHinduLink; ?>" target="_blank">The Hindu</a>&nbsp;&nbsp;
				<?php }

				$mumbaiMirrorLink = get_sub_field('mumbai_mirror_link',$postid);
				if ($mumbaiMirrorLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $mumbaiMirrorLink; ?>" target="_blank">Mumbai Mirror</a>&nbsp;&nbsp;
				<?php }

				$khabarChheLink = get_sub_field('khabar_chhe_link',$postid);
				if ($khabarChheLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $khabarChheLink; ?>" target="_blank">Khabar Chhe</a>&nbsp;&nbsp;
				<?php }

				$theHealthSiteLink = get_sub_field('the_health_site_link',$postid);
				if ($theHealthSiteLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $theHealthSiteLink; ?>" target="_blank">The Health Site</a>&nbsp;&nbsp;
				<?php }
				
				$NDTVLink = get_sub_field('ndtv_link',$postid);
				if ($NDTVLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $NDTVLink; ?>" target="_blank">NDTV</a>&nbsp;&nbsp;
				<?php }

				$freePressLink = get_sub_field('free_press_link',$postid);
				if ($freePressLink != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $freePressLink; ?>" target="_blank">Free Press</a>&nbsp;&nbsp;
				<?php }

				$rajesthan_patrika = get_sub_field('rajesthan_patrika',$postid);
				if ($rajesthan_patrika != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $rajesthan_patrika; ?>" target="_blank">Rajesthan Patrika</a>&nbsp;&nbsp;
				<?php }

				$chitralekha = get_sub_field('chitralekha',$postid);
				if ($chitralekha != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $chitralekha; ?>" target="_blank">Chitralekha</a>&nbsp;&nbsp;
				<?php }

				$daily_bhaskar = get_sub_field('daily_bhaskar',$postid);
				if ($daily_bhaskar != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $daily_bhaskar; ?>" target="_blank">Daily Bhaskar</a>&nbsp;&nbsp;
				<?php }

				$indian_express = get_sub_field('indian_express',$postid);
				if ($indian_express != '') { ?>
					<a class="btn btn-success btn-xs" href="<?php echo $indian_express; ?>" target="_blank">Indian Express</a>&nbsp;&nbsp;
				<?php }

				$newspaperlinks = ob_get_clean();
				endwhile;
			endif;
			
			$data[count($data) - 1]['other_links'] = $newspaperlinks;
			
			$i--;
			
        }
        wp_reset_postdata();
    }

    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data,
    );

    echo json_encode($response);
    wp_die();
}

/**Display filters on electronic media page */
add_shortcode( 'display_date_filters','display_date_filter' );
function display_date_filter(){
	ob_start(); 
	global $wpdb;

    // Query for all posts with the custom field 'em_date'
    $post_type = 'electronic_media';
    $meta_key = 'em_date';

    // Get unique years
    $years = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT YEAR(meta_value) AS year 
        FROM {$wpdb->postmeta}
        WHERE meta_key = %s and meta_value != ''
        ORDER BY year DESC", $meta_key
    ),ARRAY_A);

    // Get unique months
    $months = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT MONTH(meta_value) AS month 
        FROM {$wpdb->postmeta}
        WHERE meta_key = %s and meta_value != ''
        ORDER BY month ASC", $meta_key
    ),ARRAY_A);

    // Get unique days
    $emtypes = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT meta_value AS type 
        FROM {$wpdb->postmeta}
        WHERE meta_key ='em_type'
        ORDER BY type ASC"
    ),ARRAY_A);


	?>
	<div class="row">
            <form class="filter-form">
                <div class="col-sm-3">
                    <div class="form-group">
						<select class="form-control" name="month" id="month">
							<option value="">Select Month</option>
							<?php foreach($months as $mnt) {
								if($mnt['month'] != '') {
									echo '<option value="'.$mnt['month'].'">'. date("F", mktime(0,0,0,$mnt['month'])).'</option>';
								}
							} ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
						<select class="form-control" name="year" id="year">
							<option value="">Select Year</option>
                            <?php foreach($years as $yr) {
								if($yr['year'] != '') {

									echo '<option value="'.$yr['year'].'">'.$yr['year'].'</option>';
								}
							} ?>
                        </select>
                        
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="type" id="type">
							<option value="">Select Type</option>
							<?php foreach($emtypes as $dy) {
								echo '<option value="'.$dy['type'].'">'.$dy['type'].'</option>';
							} ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-color btn-block" id="filter_btn">Apply Filter</button>
                    </div>
                </div>
            </form>
        </div>
		<hr>
	<?php return ob_get_clean();
}

/** Display electronic media in datatable - /electronic-media/ page */
add_action('wp_ajax_fetch_electronic_data', 'fetch_electronic_data');
add_action('wp_ajax_nopriv_fetch_electronic_data', 'fetch_electronic_data');
function fetch_electronic_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'electronic_media';
	$taxonomy_term = isset($_POST['taxonomy_term']) ? sanitize_text_field($_POST['taxonomy_term']) : '';

	 // Get year, month, and day filters from AJAX request
	 $year = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';
	 $month = isset($_POST['month']) ? sanitize_text_field($_POST['month']) : '';
	 $emtype = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'name_of_channel', 'youtube_link', 'em_date');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order DESC';
	}else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

	// Search query for year, month, and day
    $date_query = '';
    if (!empty($year)) {
        $date_query .= " AND YEAR((SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date')) = '$year'";
    }
    if (!empty($month)) {
        $date_query .= " AND MONTH((SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date')) = '$month'";
    }
    if (!empty($emtype)) {
        $date_query .= " AND (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_type') = '$emtype'";
    }
	
    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_channel'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'youtube_link'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date'
                ) LIKE %s
               
            )
        ", "%$search_value%", "%$search_value%", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish'
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query $date_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);

    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_channel') AS name_of_channel,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'youtube_link') AS youtube_link,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'em_date') AS em_date
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query $date_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
        ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $taxonomy_term, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    // Prepare the data for DataTables
    $data = array();
	$i = $total_records;
	$start_index = $offset; //+ 1; // Adjust start index for pagination
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $i - $start_index, //$start_index + $index,
            'em_date' => date('d/m/Y',strtotime($row['em_date'])),
            'description' => $row['post_title'],
            'channel' => $row['name_of_channel'],
            'ytlink' => '<a href="'. $row['youtube_link'].'" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>',
        );

		$i--;
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/** Display data in datatable - /digital-media/ page */
add_action('wp_ajax_fetch_digitalmedia_data', 'fetch_digitalmedia_data');
add_action('wp_ajax_nopriv_fetch_digitalmedia_data', 'fetch_digitalmedia_data');
function fetch_digitalmedia_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'digital_media';
	$taxonomy_term = isset($_POST['taxonomy_term']) ? sanitize_text_field($_POST['taxonomy_term']) : '';
    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'name_of_digital_media', 'dm_date');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order ASC';
	}else if($order_column_index == 1) {
		
		$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'dm_date') " . $order_direction;
	}
	else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_digital_media'
                ) LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'dm_date'
                ) LIKE %s
               
            )
        ", "%$search_value%", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' 
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'dg_media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'dg_media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
    ", $post_type, $taxonomy_term);
    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'name_of_digital_media') AS name_of_digital_media,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'dm_date') AS dm_date,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'digital_media_link') AS digital_media_link
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query 
		AND ID IN (SELECT object_id FROM {$wpdb->term_relationships} WHERE term_taxonomy_id IN (SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'dg_media_type' AND term_id IN (SELECT term_id FROM {$wpdb->terms} WHERE slug = %s))) 
		ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $taxonomy_term, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    // Prepare the data for DataTables
    $data = array();
	$i = $total_records;
	$start_index = $offset; // + 1; // Adjust start index for pagination
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $i - $start_index, //$start_index + $index,
            'dm_name' => $row['post_title'],
            'date' => date("d/m/Y",strtotime($row['dm_date'])),
            'media' => $row['name_of_digital_media'],
            'link' => (!empty($row['digital_media_link'])) ? '<a href="'.$row['digital_media_link'].'" target="_blank">Link <i class="fa fa-external-link" aria-hidden="true"></i></a>' : '',
        );

		$i--;
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/** Display data in datatable - /press-release/ page */
add_action('wp_ajax_fetch_pressrelease_data', 'fetch_pressrelease_data');
add_action('wp_ajax_nopriv_fetch_pressrelease_data', 'fetch_pressrelease_data');
function fetch_pressrelease_data() {
    global $wpdb;

    // Get the custom post type from the AJAX request
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'press_releases';

    // Pagination and search params from DataTables
    $limit = intval($_POST['length']); // Number of records to show
    $offset = intval($_POST['start']); // Starting index

    // Handle ordering
    $order_column_index = intval($_POST['order'][0]['column']); // Column index to order
    $order_direction = sanitize_text_field($_POST['order'][0]['dir']); // 'asc' or 'desc'
    $columns = array('post_title', 'press_release_date');
    // $order_by = 'menu_order ASC, '. $columns[$order_column_index] . ' ' . $order_direction;

	if($order_column_index == 0) {
		$order_by = 'menu_order ASC';
	}else{

		if ($columns[$order_column_index] == 'post_title') {
			$order_by = 'post_title ' . $order_direction;
		} else {
			// For ACF fields, order by their meta_value
			$acf_field = $columns[$order_column_index];
			$order_by = "(SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '$acf_field') " . $order_direction;
		}
	}

    // Handle search
    $search_value = sanitize_text_field($_POST['search']['value']);
    $search_query = "";
    if (!empty($search_value)) {
        // Query for title and ACF fields
        $search_query = $wpdb->prepare("
            AND (
                post_title LIKE %s
                OR (
                    SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'press_release_date'
                ) LIKE %s
            )
        ", "%$search_value%", "%$search_value%");
    }

    // Get total records without search
    $total_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish'
    ", $post_type);
    $total_records = $wpdb->get_var($total_records_query);

    // Get total records with search
    $filtered_records_query = $wpdb->prepare("
        SELECT COUNT(*) 
        FROM {$wpdb->posts} 
        WHERE post_type = %s AND post_status = 'publish' $search_query
    ", $post_type);
    $filtered_records = $wpdb->get_var($filtered_records_query);

    // Query to fetch records with pagination, ordering, and search
    $results_query = $wpdb->prepare("
        SELECT ID, post_title,
            (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = 'press_release_date') AS press_release_date
        FROM {$wpdb->posts}
        WHERE post_type = %s AND post_status = 'publish' $search_query
        ORDER BY $order_by
        LIMIT %d OFFSET %d
    ", $post_type, $limit, $offset);
    $results = $wpdb->get_results($results_query, ARRAY_A);

    /**Images, pdf and link data are not currently visible in the website */
    $data = array();
	$i = $total_records;
	$start_index = $offset; // + 1; 
    foreach ($results as $index => $row) {
        $data[] = array(
			'id' => $i - $start_index, //$start_index + $index,
            'title' => $row['post_title'],
            'date' => date("d/m/Y", strtotime($row['press_release_date'])),
        );

		$i--;
    }

    // Return the JSON response expected by DataTables
    $response = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => intval($total_records),
        "recordsFiltered" => intval($filtered_records),
        "data" => $data
    );

    echo json_encode($response);
    wp_die(); // Required to end AJAX request
}

/**downloads page shortcode */
add_shortcode( 'downloads_pdf', 'fetch_pdf_data' );
function fetch_pdf_data(){
	ob_start();
	$args = array(
		'post_type' => 'downloadspdf', 
		'post_status' => 'publish', 
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'asc',
	);

	$getpdflist = get_posts( $args );
	
	if(!empty($getpdflist)){
		foreach($getpdflist as $index => $row) {
			$downloadid = $row->ID;
			$file = get_field('upload_pdf', $downloadid);
			$image = has_post_thumbnail( $downloadid ) ? get_the_post_thumbnail_url( $row->ID ) : '';
			$downloadTitle = $row->post_title;
			$downloadDate = get_field('pdf_date', $downloadid);
			$newDate = date("M d, Y", strtotime($downloadDate));
			?>

			<div class="col-md-4 col-sm-6 photogallery-block">
				<div class="gallery-item">
					<div class="img-holder">
						<div class="text-center csr-gallery position-relative wow fadeInUp" data-wow-duration="300ms">
							<a class="" href="<?php echo $file; ?>" target="_blank">
								<figure>
									<img src="<?php echo $image; ?>" alt="<?php echo $downloadTitle; ?>" class="" height="300" loading="lazy"/>
									<div class="overlay">
										<span class="overlay-span">
											<i class="fa fa-search" aria-hidden="true"></i>
										</span>
									</div>
								</figure>
							</a>
						</div>
					</div>
					<h4><?php echo $downloadTitle; ?></h4>
				</div>
			</div>

		<?php } } 
	return ob_get_clean();
}

//video gallery shortcode for founder pages and gallery pages.
add_shortcode('abt_video_gallery', 'abt_video_gallery_shortcode');
function abt_video_gallery_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'type' => 'vyakti-vishesh-ci', 
    ), $atts);
	$posts_per_page = 18;
	$offset = 0;
    // Start output buffering
    ob_start();

    // Prepare the query arguments based on the selected type
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => 18,
        'offset' => $offset,
		'post_status' => 'publish'
    );

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'vi_gl_type',
			'field'    => 'slug',
			'terms'    => $atts['type'],
		),
	);

    // The query
    $gqry = new WP_Query($args);
    ?>
	<div class="search-box">
		
		<input type="text" placeholder="Search" value="" name="vg_srch" id="vg_srch" class="hip-search-input" data-term="<?php echo $atts['type']; ?>">
	</div>

	<div class="items-container hip-grid" id="abt-video-gallery">
		<?php get_video_grid_layout($gqry,$posts_per_page,$offset,$atts['type']); ?>
	</div>

    <?php
    return ob_get_clean(); // Return the buffered output
}

//ajax load more
function abt_load_more_videos() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'all';
	$posts_per_page = 18;
	$search_vg = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    // Prepare the query arguments
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
		'post_status' => 'publish'
    );
	
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'vi_gl_type',
			'field'    => 'slug',
			'terms'    => $type,
		),
	);

	if (!empty($search_vg)) {
        add_filter('posts_search', function($search, $wp_query) use ($search_vg) {
            global $wpdb;
            if (!empty($search_vg)) {
                // Construct the search condition to target only the post title
                $search = " AND ({$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_vg)) . "%')";
            }
            return $search;
        }, 10, 2);
    }

	
    $gqry = new WP_Query($args);
	
	get_video_grid_layout($gqry,$posts_per_page,$offset,$type);
    die(); // End AJAX request
}
add_action('wp_ajax_abt_load_more_videos', 'abt_load_more_videos');
add_action('wp_ajax_nopriv_abt_load_more_videos', 'abt_load_more_videos');


// Register the shortcode
add_shortcode('video_gallery', 'video_gallery_shortcode');
function video_gallery_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'type' => 'all', 
    ), $atts);
	$posts_per_page = 18;
	$offset = 0;
    // Start output buffering
    ob_start();

    // Prepare the query arguments based on the selected type
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => 18,
        'offset' => $offset,
		'post_status' => 'publish',
		// 'orderby' => 'meta_value',
        // 'meta_key' => 'vg_date', 
        // 'order' => 'DESC',
    );
	if($atts['type'] === 'all') {
		$args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => array('awareness-aw','speech-sp','vyakti-vishesh-ci'),
            ),
        );
	} else if ($atts['type'] === 'awareness') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'awareness-aw',
            ),
        );
    } else if ($atts['type'] === 'speech') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'speech-sp',
            ),
        );
    }

    // The query
    $gqry = new WP_Query($args);
	
    ?>
    <section class="gallery-section">
        <div class="container">
			<div class="filters text-center">
                <ul class="filter-tabs filter-btns clearfix">
                    <li class="filter <?php echo ($atts['type'] == 'all') ? 'active' : ''; ?>" data-type="all"><a href="<?php echo home_url('/video-gallery-all/'); ?>"><span>ALL</span></a></li>
                    <li class="filter <?php echo ($atts['type'] == 'awareness') ? 'active' : ''; ?>" data-type="awareness"><a href="<?php echo home_url('/video-gallery-awareness/'); ?>"><span>Awareness</span></a></li>
                    <li class="filter <?php echo ($atts['type'] == 'speech') ? 'active' : ''; ?>" data-type="speech"><a href="<?php echo home_url('/video-gallery-speech/'); ?>"><span>Speech</span></a></li>
                </ul>
            </div>
			<div class="search-box">
				
				<input type="text" placeholder="Search" value="" name="vg_srch" id="vg_srch" class="hip-search-input" data-term="<?php echo $atts['type']; ?>">
			</div>

            <div class="items-container hip-grid" id="video-gallery">
                <?php get_video_grid_layout($gqry,$posts_per_page,$offset,$atts['type']); ?>
                
            </div>

        </div>
    </section>
    <?php
    return ob_get_clean(); // Return the buffered output
}

/**Video layout design */
function get_video_grid_layout($gqry,$posts_per_page,$offset, $type) {
	
	// Check if the query returns any posts
	if ($gqry->have_posts()) {
		while ($gqry->have_posts()) {
			$gqry->the_post();
			$youtube_link = get_field('vg_link'); // Assuming the YouTube link is stored as a post meta
			?>
			<div class="hip-item">
				<iframe width="100%" height="315" src="<?php echo esc_url($youtube_link); ?>?rel=0" loading="lazy" allowfullscreen></iframe>
				
				<p hidden><?php the_title(); ?></p>
				<p hidden><?php echo date("d/m/Y",strtotime(get_field('vg_date'))); ?></p>
			</div>
			<?php
		}
	} else {
		echo "<p style='text-align: center'>No data found</p>";
	}

	// Reset post data
	wp_reset_postdata();
	
	?>
	<?php if ($gqry->found_posts > ($posts_per_page + $offset)) : ?>
		<button class="load-more lm-design" data-type="<?php echo esc_attr($type); ?>" data-offset="<?php echo esc_attr($posts_per_page + $offset); ?>">Load More</button>
	<?php endif; 
}


/**Ajax call for video-gallery load more button */
function load_more_videos() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : 'all';
	$posts_per_page = 18;
	$search_vg = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    // Prepare the query arguments
    $args = array(
        'post_type' => 'video_gallery',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
		'post_status' => 'publish'
    );
	if($type === 'all') {
		$args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => array('awareness-aw','speech-sp','vyakti-vishesh-ci'),
            ),
        );
	} else if ($type === 'awareness') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'awareness-aw',
            ),
        );
    } else if ($type === 'speech') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'vi_gl_type',
                'field'    => 'slug',
                'terms'    => 'speech-sp',
            ),
        );
    }

	if (!empty($search_vg)) {
        add_filter('posts_search', function($search, $wp_query) use ($search_vg) {
            global $wpdb;
            if (!empty($search_vg)) {
                // Construct the search condition to target only the post title
                $search = " AND ({$wpdb->posts}.post_title LIKE '%" . esc_sql($wpdb->esc_like($search_vg)) . "%')";
            }
            return $search;
        }, 10, 2);
    }

	
    $gqry = new WP_Query($args);
	
	get_video_grid_layout($gqry,$posts_per_page,$offset,$type);
    die(); // End AJAX request
}
add_action('wp_ajax_load_more_videos', 'load_more_videos');
add_action('wp_ajax_nopriv_load_more_videos', 'load_more_videos');

/** display FAQ data */
add_shortcode( 'faq_list', 'fetch_faq_data' );
function fetch_faq_data(){
	ob_start();
	
	$args = array(
		'post_type' => 'faq_post', 
		'post_status' => 'publish', 
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'asc',
	);

	$faqlist = get_posts( $args );

	foreach($faqlist as $index => $row){
	$title = $row->post_title;
	$description = $row->post_content;
	?>

	<div class="faq-box">
		<h2 class="faq-head"><?php echo $title; ?></h2>
		<p><?php echo $description; ?></p>
	</div>
		<?php
	}
	return ob_get_clean();
}

/**About founder gallery ul li tab view - founder-photo-gallery */
add_shortcode( 'founder_tabs', 'display_category_list');
function display_category_list($atts){ 
	$args = shortcode_atts( array('category'=>'dignitaries'), $atts );
	$catname = $args['category'];
	
	ob_start();
	?>
	<ul class="filter-tabs filter-btns clearfix">
		<?php /* <li class="filter <?php echo ($catname == 'all') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-photo-gallery"><span class="txt">ALL</span></a></li> */ ?>
		<li class="filter <?php echo ($catname == 'dignitaries') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/dignitaries-photo-gallery"><span class="txt">Dignitaries</span></a></li>
		<li class="filter <?php echo ($catname == 'awareness') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/awareness-program-photo-gallery"><span class="txt">Awareness program</span></a></li>
		<li class="filter <?php echo ($catname == 'organ-donation') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/organ-donation-photo-gallery"><span class="txt">Organ donation</span></a></li>
		<li class="filter <?php echo ($catname == 'organ-recipients') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/organ-recipients-photo-gallery"><span class="txt">Organ recipients</span></a></li>
	</ul>
<?php 
	return ob_get_clean();
}

/**Media coverage ul li tab view - founder-direct-coverage */
add_shortcode( 'media_coverage_tabs', 'display_tabs_list');
function display_tabs_list($atts){ 
	$args = shortcode_atts( array('tabs'=>'press-coverage'), $atts );
	$catname = $args['tabs'];
	
	ob_start();
	?>
	<ul class="filter-tabs filter-btns clearfix">
		<li class="filter <?php echo ($catname == 'press-coverage') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-direct-coverage"><span class="txt">Press Coverage</span></a></li>
		<li class="filter <?php echo ($catname == 'vyakti-vishesh-ci') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/video-gallery-interview"><span class="txt">Vyakti Vishesh</span></a></li>
		<li class="filter <?php echo ($catname == 'el-media') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-electronic-media"><span class="txt">Electronic Media</span></a></li>
		<li class="filter <?php echo ($catname == 'dl-media') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/founder-digital-media"><span class="txt">Digital Media</span></a></li>
		<li class="filter <?php echo ($catname == 'radio-talk-rt') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/video-gallery-radiotalk"><span class="txt">Radio Talk</span></a></li>
	</ul>
<?php 
	return ob_get_clean();
}

/**Media coverage ul li tab view - founder-direct-coverage */
add_shortcode( 'press_coverage_tabs', 'display_press_tabs_list');
function display_press_tabs_list($atts){ 
	$args = shortcode_atts( array('tabs'=>'cadaver-activities'), $atts );
	$catname = $args['tabs'];
	
	ob_start();
	?>
	<ul class="filter-tabs filter-btns clearfix">
		<li class="filter <?php echo ($catname == 'cadaver-activities') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/cadaver-organ-donation-activities"><span class="txt">Cadaver Organ Donation Activities</span></a></li>
		<li class="filter <?php echo ($catname == 'life-activities') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/donate-life-activities"><span class="txt">Donate Life Activities</span></a></li>
		<li class="filter <?php echo ($catname == 'press-other') ? 'active': ''; ?>" data-role="button"><a href="<?php echo home_url(); ?>/press-other"><span class="txt">Others</span></a></li>
		
	</ul>
<?php 
	return ob_get_clean();
}

/**mail setting */
add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer)
{
	$phpmailer->isSMTP();
	$phpmailer->Host = 'smtp.gmail.com';
	$phpmailer->Port = 587;
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Username = 'noreplydonatelife9@gmail.com'; 
	$phpmailer->Password = 'rlnatpsumukmopjp';
	$phpmailer->From = 'noreplydonatelife9@gmail.com';
	$phpmailer->FromName = 'Donate Life';
}
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
	else if($custom_form->name == 'online-donation-form') {
		
		$od_table = $wpdb->prefix.'online_donation_master';
		$od_insert = $wpdb->insert($od_table,
			array(
				'odname' => $data['name-1'],
				'odaddress' => $data['address-1-street_address'],
				'odcity' => $data['address-1-city'],
				'odstate' => $data['address-1-state'],
				'odpin' => $data['address-1-zip'],
				'odcountry' => $data['address-1-country'],
				'odmobile' => $data['phone-1'],
				'odemail' => $data['email-1'],
				'oddetails' => $data['text-1'],
				'odamount' => $data['number-1'],
				'odstatus' => 'pending',
				'is_trash' => 0,
			)
		);
	}
}

add_filter('forminator_custom_upload_subfolder',function($subfolder, $form_id, $dir) {
	if($form_id == '2257') { //volunteer form id
		$subfolder = 'volunteer';
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

add_action('forminator_form_after_handle_submit', 'save_forminator_data_to_custom_table', 10, 2);
function save_forminator_data_to_custom_table($entry, $form_id) {
    global $wpdb;
	echo 'entry';
	print_r($entry); 
	echo 'form id';
	print_r($form_id);

    // Get form data
    $form_data = $entry->get_fields();

    // Extract specific fields based on your form (replace 'name' and 'email' with your field IDs)
    $user_name = isset($form_data['name']) ? sanitize_text_field($form_data['name']) : '';
    $user_email = isset($form_data['email']) ? sanitize_email($form_data['email']) : '';
    $message = isset($form_data['message']) ? sanitize_textarea_field($form_data['message']) : '';

    // Insert data into custom table
    $wpdb->insert(
        $wpdb->prefix . 'custom_form_submissions',
        array(
            'form_id'         => $form_id,
            'user_name'       => $user_name,
            'user_email'      => $user_email,
            'message'         => $message,
            'submission_date' => current_time('mysql')
        ),
        array(
            '%d', '%s', '%s', '%s', '%s'
        )
    );
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

/**Online donation form - connect with ccavenue payment gateway */
//add_action('forminator_custom_form_after_handle_submit', 'custom_forminator_ccavenue_redirect', 10, 4);
function custom_forminator_ccavenue_redirect($entry, $form_id, $field_data_array, $form_settings) {
	print_r($field_data_array); die();
    if ($form_id == 2270) {
        // Create the CCAvenue request
        $ccavenue_data = array(
            'merchant_id' => '187810',
            'amount' => $entry->amount,
            'order_id' => $entry->entry_id,
            'currency' => 'INR',
            'redirect_url' => 'YOUR_REDIRECT_URL',
            'cancel_url' => 'YOUR_CANCEL_URL',
			'language' => 'EN',
			'billing_name' => $odname,
			'billing_address' => $odaddress,
			'billing_city' => $odcity,
			'billing_state' => $odstate,
			'billing_zip' => $odpin,
			'billing_country' => $odcountry,
			'billing_tel' => $odmobile,
			'billing_email' => $odemail,
			'delivery_name' => $odname,
			'delivery_address' => $odaddress,
			'delivery_city' => $odcity,
			'delivery_state' => $odstate,
			'delivery_zip' => $odpin,
			'delivery_country' => $odcountry,
			'delivery_tel' => $odmobile,
			'merchant_param1' => '',
			'merchant_param2' => '',
			'merchant_param3' => '',
			'merchant_param4' => '',
			'merchant_param5' => '',
			'promo_code' => '',
			'customer_identifier' => '',
        );
        // Redirect to CCAvenue payment page
        wp_redirect('https://secure.ccavenue.com/transaction/initTrans');
        exit;
    }
}

function custom_table_menu() {
    add_menu_page(
        'Donor Data',      // Page title
        'Donor Data',      // Menu title
        'manage_options',    // Capability
        'donor-data',      // Menu slug
        'get_wp_donor_data', // Callback function
        'dashicons-list-view', // Icon
        6                    // Position
    );

	add_menu_page(
        'Volunteer Data',      // Page title
        'Volunteer Data',      // Menu title
        'manage_options',    // Capability
        'volunteer-data',      // Menu slug
        'get_wp_volunteer_data', // Callback function
        'dashicons-list-view', // Icon
        7                    // Position
    );

	add_menu_page(
        'Online Donation Data',      // Page title
        'Online Donation Data',      // Menu title
        'manage_options',    // Capability
        'online-donation-data',      // Menu slug
        'get_wp_online_donation_data', // Callback function
        'dashicons-list-view', // Icon
        8                    // Position
    );
	
	add_menu_page(
        'Contact Data',      // Page title
        'Contact Data',      // Menu title
        'manage_options',    // Capability
        'contact-form-data',      // Menu slug
        'get_wp_contact_form_data', // Callback function
        'dashicons-list-view', // Icon
        9                    // Position
    );
	
	add_menu_page(
        'Subscription Data',      // Page title
        'Subscription Data',      // Menu title
        'manage_options',    // Capability
        'subscription-form-data',      // Menu slug
        'get_wp_subscription_form_data', // Callback function
        'dashicons-list-view', // Icon
        10                   // Position
    );
}
add_action('admin_menu', 'custom_table_menu');

function get_wp_donor_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once 'class/wp_list_donor_data.php'; 

	$table = new Donor_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Donor Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_volunteer_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once 'class/wp_list_volunteer_data.php'; 

	$table = new Volunteer_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Volunteer Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_online_donation_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once 'class/wp_list_online_donation_data.php'; 

	$table = new Online_Donation_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Online Donation Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_contact_form_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once 'class/wp_list_contact_form_data.php'; 

	$table = new Contact_Form_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Contact form Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}

function get_wp_subscription_form_data(){
	if (!class_exists('WP_List_Table')) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
	}
	require_once 'class/wp_list_subscription_form_data.php'; 

	$table = new Subscription_Form_List();
    $table->prepare_items();
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline"><?php _e('Subscription Data', 'sp'); ?></h1>
        <form method="post">
            <?php
            $table->display();
            ?>
        </form>
    </div>
    <?php
}



add_action('wp_ajax_load_modal_content', 'load_modal_content_callback');
function load_modal_content_callback() {
	global $wpdb;
	$id = $_POST['id'];
	$table_name = $wpdb->prefix . 'donor_master'; // Replace with your custom table name
	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	$dfirstname = $row['dfirstname'];
	$dmiddlename = $row['dmiddlename'];
	$dlastname = $row['dlastname'];
	$daged = $row['daged'];
	$ddate = date('Y-m-d',strtotime($row['ddate']));
	$dgender = $row['dgender'];
	$dwhatsapp = $row['dwhatsapp'];
	$dOrgan = $row['dOrgan'];
	$dTissues = $row['dTissues'];
	$dbloodgroup = $row['dbloodgroup'];
	$dcontact = $row['dcontact'];
	$demail = $row['demail'];
	$daddress = $row['daddress'];
	$dtaluka = $row['dtaluka'];
	$ddist = $row['ddist'];
	$dstate = $row['dstate'];
	$dfirstNameOfWitness = $row['dfirstNameOfWitness'];
	$dmiddleNameOfWitness = $row['dmiddleNameOfWitness'];
	$dlastNameOfWitness = $row['dlastNameOfWitness'];
	$dwaged = $row['dwaged'];
	$dwcontact = $row['dwcontact'];
	$dwemail = $row['dwemail'];
	$dwgender = $row['dwgender'];
	$dwaddress = $row['dwaddress'];
	$dwtaluka = $row['dwtaluka'];
	$dwdist = $row['dwdist'];
	$dwstate = $row['dwstate'];
	$dwNearRelative = $row['dwNearRelative'];
	$todaydate = $row['todaydate'];
	$photo = stripslashes($row['donor_card']);
	$ganesha_mandal = $row['ganesha_mandal'];
	$html = ob_start();
	?>

	<!--<link rel="stylesheet" href="stylesheet.css" type="text/css" media="screen" />-->
	<table class="table table-bordered" cellspacing="3" cellpadding="3" width="100%">
		<tr>
			<th align="right" width="130">ID.&nbsp;:&nbsp;</th>
			<td><?php echo $id; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">First Name.&nbsp;:&nbsp;</th>
			<td><?php echo $dfirstname; ?></td>
		</tr>


		<tr>
			<th align="right" width="130">Middle Name&nbsp;:&nbsp;</th>
			<td><?php echo $dmiddlename; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Last Name &nbsp;:&nbsp;</th>
			<td><?php echo $dlastname; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Aged&nbsp;:&nbsp;</th>
			<td><?php echo $daged; ?></td>
		</tr>

		<tr>
			<th align="right">Date&nbsp;:&nbsp;</th>
			<td><?php echo $ddate; ?></td></tr>

		<tr>
			<th align="right">Gender &nbsp;:&nbsp;</th>
			<td><?php echo $dgender; ?></td>
		</tr>

		<tr>
			<th align="right">Whatsapp No&nbsp;:&nbsp;</th>
			<td><?php echo $dwhatsapp; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Organs &nbsp;:&nbsp;</th>
			<td><?php echo $dOrgan; ?></td>
		</tr>

		<tr>
			<th align="right" width="130"> Tissues &nbsp;:&nbsp;</th>
			<td><?php echo $dTissues; ?></td>
		</tr>

		<tr>
			<th align="right"> Blood Group &nbsp;:&nbsp;</th>
			<td><?php echo $dbloodgroup; ?></td></tr>

		<tr>
			<th align="right">Contact No. &nbsp;:&nbsp;</th>
			<td><?php echo $dcontact; ?></td>
		</tr>

		<tr>
			<th align="right">EMail &nbsp;:&nbsp;</th>
			<td><?php echo $demail; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Address :&nbsp;</th>
			<td><?php echo $daddress; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Taluka &nbsp;:&nbsp;</th>
			<td><?php echo $dtaluka; ?></td>
		</tr>

		<tr>
			<th align="right">Dist. &nbsp;:&nbsp;</th>
			<td><?php echo $ddist; ?></td></tr>

		<tr>
			<th align="right">State &nbsp;:&nbsp;</th>
			<td><?php echo $dstate; ?></td>
		</tr>

		<tr>
			<th align="right">First Name (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dfirstNameOfWitness; ?></td>
		</tr>

		<tr>
			<th align="right">Middle Name (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dmiddleNameOfWitness; ?></td>
		</tr>

		<tr>
			<th align="right">Last Name (Witness)  &nbsp;:&nbsp;</th>
			<td><?php echo $dlastNameOfWitness; ?></td>
		</tr>


		<tr>
			<th align="right">Aged (Witness)  &nbsp;:&nbsp;</th>
			<td><?php echo $dwaged; ?></td>
		</tr>

		<tr>
			<th align="right">Contact No. (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwcontact; ?></td>
		</tr>


		<tr>
			<th align="right">Email ID (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwemail; ?></td>
		</tr>

		<tr>
			<th align="right">Gender (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwgender; ?></td>
		</tr>

		<tr>
			<th align="right">Address (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwaddress; ?></td>
		</tr>

		<tr>
			<th align="right">Taluka (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwtaluka; ?></td>
		</tr>

		<tr>
			<th align="right">State (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwdist; ?></td>
		</tr>

		<tr>
			<th align="right">Dist. (Witness) &nbsp;:&nbsp;</th>
			<td><?php echo $dwstate; ?></td>
		</tr>

		<tr>
			<th align="right">Your Relation with applicant &nbsp;:&nbsp;</th>
			<td><?php echo $dwNearRelative; ?></td>
		</tr>
		
		<tr>
			<th align="right">Ref/Ganesha Mandal &nbsp;:&nbsp;</th>
			<td><?php echo $ganesha_mandal; ?></td>
		</tr>
		
		<tr>
			<th align="right">Form Date :&nbsp;</th>
			<td><?php echo $todaydate; ?></td>
		</tr>


		<tr>
			<th align="right">Photo :&nbsp;</th>
			<?php 
			$upload_dir = wp_upload_dir();
    		$pdf_file_path = $upload_dir['baseurl'] . '/donor_card/'; ?>
			<td><a href="<?php echo $pdf_file_path.$photo; ?>" target = "_blank">Click Here to View Donor Card</a></td>
		</tr>

	</table>
	<?php 		
	$html = ob_get_clean();
	echo $html;
	wp_die();
}

add_action('wp_ajax_load_volunteer_data', 'load_volunteer_data_callback');
function load_volunteer_data_callback() {
	global $wpdb;
	$id = $_POST['id'];
	$table_name = $wpdb->prefix . 'volunteer_master'; // Replace with your custom table name
	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	$vid = $row['id'];
    $vfullname = $row['vfullname'];
    $date = date("d-m-Y",strtotime($row['vdate']));
    $todaydate = date("d-m-Y",strtotime($row['todaydate']));
    $vaddress1 = $row['vaddress1'];
    $vbloodgroup = $row['vbloodgroup'];
    $vcity = $row['vcity'];
    $vstate = $row['vstate'];
    $vemail = $row['vemail'];
    $vmobile = stripslashes($row['vmobile']);
    $vcountry = stripslashes($row['vcountry']);
    $vgender = stripslashes($row['vgender']);
    $timeOfContribution = stripslashes($row['timeOfContribution']);
    $areaOfInterest = stripslashes($row['areaOfInterest']);
    $vphone = stripslashes($row['vphone']);
    $photo = stripslashes($row['photo']);


	?>
	

	<table class="table table-bordered" cellspacing="3" cellpadding="3" width="100%">
        <tr>
		<th align="right" width="130">ID.&nbsp;:&nbsp;</th>
		<td><?php echo $vid; ?></td>
		</tr>

        <tr>
            <th align="right" width="130">Name.&nbsp;:&nbsp;</th>
            <td><?php echo $vfullname; ?></td>
        </tr>

        <tr>
            <th align="right" width="130">Date Of Birth&nbsp;:&nbsp;</th>
            <td><?php echo $date; ?></td>
        </tr>

        <tr>
            <th align="right" width="130">E-mail&nbsp;:&nbsp;</th>
            <td><?php echo $vemail; ?></td>
        </tr>

        <tr>
            <th align="right" width="130">Blood Group 2&nbsp;:&nbsp;</th>
            <td><?php echo $vbloodgroup; ?></td>
        </tr>

        <tr>
		<th align="right" width="130">Address&nbsp;:&nbsp;</th>
		<td><?php echo $vaddress1; ?></td>
		</tr>
		
		<tr>
		<th align="right">City&nbsp;:&nbsp;</th>
		<td><?php echo $vcity; ?></td></tr>
		
		<tr>
		<th align="right">State&nbsp;:&nbsp;</th>
		<td><?php echo $vstate; ?></td>
		</tr>
		
		<tr>
		<th align="right">Mobile No. &nbsp;:&nbsp;</th>
		<td><?php echo $vmobile; ?></td>
		</tr>

        <tr>
            <th align="right">Phone No&nbsp;:&nbsp;</th>
            <td><?php echo $vphone; ?></td>
        </tr>

        <tr>
            <th align="right">Gender&nbsp;:&nbsp;</th>
            <td><?php echo $vgender; ?></td>
        </tr>


        <tr>
            <th align="right">Time Of Contribution&nbsp;:&nbsp;</th>
            <td><?php echo $timeOfContribution; ?></td>
        </tr>

        <tr>
            <th align="right">Area Of Interest&nbsp;:&nbsp;</th>
            <td><?php echo $areaOfInterest; ?></td>
        </tr>

        <tr>
            <th align="right">Photo :&nbsp;</th>
			<?php 
			$upload_dir = wp_upload_dir();
    		$volunteer_path = $upload_dir['baseurl'] . '/volunteer/'; ?>
            <td><a href="<?php echo $volunteer_path.$photo; ?>" target = "_blank">Click Here to View Image</a></td>

        </tr>

        <tr>
            <th align="right" width="130">Form Date :&nbsp;</th>
            <td><?php echo $todaydate; ?></td>
        </tr>

	</table>
	<?php 		
	$html = ob_get_clean();
	echo $html;
	wp_die();
}

add_action('wp_ajax_load_online_donation_content', 'load_online_donation_content_callback');
function load_online_donation_content_callback() {
	global $wpdb;
	$id = $_POST['id'];
	$table_name = $wpdb->prefix . 'online_donation_master'; // Replace with your custom table name
	$row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id",ARRAY_A);

	$odid = $row['id'];
	$odname = $row['odname'];
	$odaddress = $row['odaddress'];
	$odcity = $row['odcity'];
	$odstate = $row['odstate'];
	$odpin = $row['odpin'];
	$odcountry = $row['odcountry'];
	$odmobile = $row['odmobile'];
	$odemail = $row['odemail'];
	$oddetails = $row['oddetails'];
	$odamount = $row['odamount'];
	$odstatus = $row['odstatus'];

	?>

	<!--<link rel="stylesheet" href="stylesheet.css" type="text/css" media="screen" />-->
	<table class="table table-bordered" cellspacing="3" cellpadding="3" width="100%">
		<tr>
			<th align="right" width="130">ID.&nbsp;:&nbsp;</th>
			<td><?php echo $odid; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Name :&nbsp;</th>
			<td><?php echo $odname; ?></td>
		</tr>


		<tr>
			<th align="right" width="130">Address&nbsp;:&nbsp;</th>
			<td><?php echo $odaddress; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">City &nbsp;:&nbsp;</th>
			<td><?php echo $odcity; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">State&nbsp;:&nbsp;</th>
			<td><?php echo $odstate; ?></td>
		</tr>

		<tr>
			<th align="right">Pin Code&nbsp;:&nbsp;</th>
			<td><?php echo $odpin; ?></td></tr>

		<tr>
			<th align="right">Country &nbsp;:&nbsp;</th>
			<td><?php echo $odcountry; ?></td>
		</tr>

		<tr>
			<th align="right"> Mobile Number&nbsp;:&nbsp;</th>
			<td><?php echo $odmobile; ?></td>
		</tr>

		<tr>
			<th align="right" width="130">Email Address &nbsp;:&nbsp;</th>
			<td><?php echo $odemail; ?></td>
		</tr>

		<tr>
			<th align="right" width="130"> Donation Amount &nbsp;:&nbsp;</th>
			<td><?php echo $odamount; ?></td>
		</tr>

	</table>
	<?php 		
	$html = ob_get_clean();
	echo $html;
	wp_die();
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