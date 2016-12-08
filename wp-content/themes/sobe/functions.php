<?php
add_theme_support ( 'menus' );
function register_theme_menus () {
	register_nav_menus (
		array(
			'header-menu'   => __( 'Header Menu' )
		)
	);
}    
add_action ( 'init', 'register_theme_menus' ); 

/*
 * Include  necessary scripts and styles
 */

function theme_styles() {
	
	wp_enqueue_style ( 'bootstrap_css', get_template_directory_uri() .'/css/bootstrap.min.css' );
	wp_enqueue_style ( 'fontawesome_css', get_template_directory_uri() .'/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style ( 'main_css', get_template_directory_uri() .'/style.css' );
	
}    
add_action( 'wp_enqueue_scripts', 'theme_styles' );
				
function theme_js () {
	
	global $wp_scripts;
	wp_register_Script ( 'html5_shiv', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', '', '', false );
	wp_register_Script ( 'respond_js', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', '', '', false ); 
	
	$wp_scripts -> add_data ( 'html5_shiv', 'conditional', 'lt IE 9' );
	$wp_scripts -> add_data ( 'respond_js ', 'conditional', 'lt IE 9' );  
	
	wp_enqueue_script ( 'bootstrap_js', get_template_directory_uri() .'/js/bootstrap.min.js', array ('jquery'), '', true ); 
	
}
add_action( 'wp_enqueue_scripts', 'theme_js' );

/*/
 * Hide admin bar when viewing the front-end
 */
add_filter ( 'show_admin_bar', '__return_false' );  

/*
 * Declare Woocommerce support 
 */
add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
