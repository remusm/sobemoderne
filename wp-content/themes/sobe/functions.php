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

/*
 * Display the subcategories of a given category, by name
 */
function woocommerce_subcats_from_parentcat_by_NAME($atts) {

    $parent_cat_NAME = $atts['categorie'];
    
    $IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');

    $product_cat_ID = $IDbyNAME->term_id;

    $args = array(

       'hierarchical' => 1,

       'show_option_none' => '',

       'hide_empty' => 0,

       'parent' => $product_cat_ID,

       'taxonomy' => 'product_cat'

    );

    $subcats = get_categories($args);

    foreach ($subcats as $cat) { ?>
    <div class="col-md-4 text-center">
        <?php
            //echo $link = get_term_link( $cat->slug, $cat->taxonomy ).'<br>';
           
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
                if ( $image ) { ?>
                
                    <a class="orange-link" href="<?php echo $link; ?>">
                    <?php
                        echo '<img src="' . $image . '" alt="" />';
                    } ?>
                    <p><?php echo '<br>'.$cat->name; ?> </p></a>
               
    </div>
    <?php }
}

add_shortcode( 'categorie_shortcode', 'woocommerce_subcats_from_parentcat_by_NAME' );

/*
 * Display the subcategories of a given category, by name
 */
function wc_category_info_by_name($parent_cat_NAME) {

    $IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');

    echo $IDbyNAME->description;
}
