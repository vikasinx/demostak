<?php
/*
* Main function file for firm business theme
*/

/* Register Menu*/
include_once('functions/fbs-theme-options.php');
function fbs_register_my_menu() {
  register_nav_menus(
  	array(
  		'main-menu' => __( 'Main Menu' ),
  		'footer-menu' => __( 'Footer Menu' ),
  		'secondary-menu' => __( 'Secondary Menu' ),
  		'social-menu' => __( 'Social Menu' )
  		)
  );
}
add_action( 'init', 'fbs_register_my_menu' );

/*Custom Theme logo*/

function fbs_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'fbs_custom_logo_setup' );

/*Register style sheet*/

add_action( 'wp_enqueue_scripts', 'fbs_register_styles' );

function fbs_register_styles() {
	wp_enqueue_style( 'style-css', get_template_directory_uri().'/style.css',array(), null, 'all'  );
	wp_enqueue_style( 'unsementic-grid', get_template_directory_uri().'/css/unsementic-grid.css',array(), null, 'all'  );
	wp_enqueue_style( 'owl.carousel.min', get_template_directory_uri().'/css/owl.carousel.min.css',array(), null, 'all'  );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css',array(), null, 'all'  );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ), rand(), true );
	wp_enqueue_script( 'jquery.circliful.min', get_template_directory_uri() . '/js/jquery.circliful.min.js', array( 'jquery' ), rand(), true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), rand(), true );
	
}


/**
 * Register our sidebars and widgetized areas.
 *
 */
function fbs_widgets_init() {

	register_sidebar( array(
			'name'          => 'Right sidebar',
			'id'            => 'right_sidebar',
			'before_widget' => '<div class="primary_sidebar"><div class="widget">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="rounded">',
			'description' => __( 'Sidebar Widgets.', 'text_domain' ),
			'after_title'   => '</h3>',
		));

	register_sidebar(array(
			'name'          => 'Footer sidebar',
			'id'            => 'footer_sidebar',
			'before_widget' => '<div class="grid-33 tablet-grid-33 mobile-grid-100"><div class="widget">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="rounded">',
			'description' => __( 'Footer area widgets.', 'text_domain' ),
			'after_title'   => '</h3>',
		));

}
add_action( 'widgets_init', 'fbs_widgets_init' );

/*Add Thumbnail Support*/

add_theme_support( 'post-thumbnails' );
?>