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
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumb-top">
                <?php woocommerce_breadcrumb(); ?>
                
                <hr class="breadcrumb-underline">
            </div>
        </div>
        <div class="row"> 
<?php
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
            $link = get_term_link( $cat->slug, $cat->taxonomy );
           
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
                if ( $image ) { ?>
                
                    <a class="orange-link" href="<?php echo $link; ?>">
                    <?php
                        echo '<img src="' . $image . '" alt="" />';
                    } ?>
                    <p><?php echo '<br>'.$cat->name; ?> </p></a>
               
    </div>
    <?php } ?>
        </div>
    </div>
<?php    
}

add_shortcode( 'categorie_shortcode', 'woocommerce_subcats_from_parentcat_by_NAME' );

/*
 * Display the subcategories of a given category, by name
 */
function wc_category_info_by_name($parent_cat_NAME) {

    $IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');

    echo $IDbyNAME->description;
}

/*
 * Display the category slider
 */
function wc_category_slider($atts) {
?>
    <div class="cat-slider-wrapper">
        
        <div class="container">
            <div class="row">  
                    <?php echo do_shortcode('[gallery ids="'.$atts['id1'].','.$atts['id2'].'" transition="dissolve" autoplay="5000" arrows="false" click="false" swipe="false" nav="false" width="100%" height="auto"]'); ?>                
            </div>
        </div>
           
    </div>
    <div class="category-description">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo get_the_title(); ?></h1>
                    <p class="page-subtitle"> <?php wc_category_info_by_name(get_the_title());?> </p>
                </div>
            </div>
        </div> <!-- /container -->
    </div>  
<?php 
}

add_shortcode( 'fotografii_slider', 'wc_category_slider' );

/**
 * Opening div for our content wrapper
 */
function sobe_open_div () {
?>

    <div class="cat-slider-wrapper">
        
        <div class="container">
            <div class="row">  
                    <?php echo do_shortcode('[gallery ids="42,43" transition="dissolve" autoplay="5000" arrows="false" click="false" swipe="false" nav="false" width="100%" height="auto"]'); ?>                
            </div>
        </div>
           
    </div><!-- end cat-slider-wrapper -->
      

    <?php
}

add_action('woocommerce_before_main_content', 'sobe_open_div', 5);

/**
 * Closing div for the content wrapper
 */
add_action('woocommerce_after_main_content', 'sobe_close_div', 50);
 
function sobe_close_div() { ?>
  
<?php }

//Reposition WooCommerce breadcrumb 
function woocommerce_remove_breadcrumb(){
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action('woocommerce_before_main_content', 'woocommerce_remove_breadcrumb');

function woocommerce_custom_breadcrumb(){
    woocommerce_breadcrumb();
}

add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

/*
 * Hide sub-category product count in product archives
 */
add_filter( 'woocommerce_subcategory_count_html', 'sobe_hide_category_count' );
function sobe_hide_category_count() {
	// No count
}

//Display product category descriptions under category image/title on woocommerce shop page */

add_action( 'woocommerce_after_subcategory', 'my_add_cat_description', 12);
function my_add_cat_description ($category) {

    $cat_id = $category->term_id;
    $prod_term = get_term($cat_id, 'product_cat');
    $description = $prod_term->description;
    //echo '<div class="shop_cat_desc">'.$description.'</div>';
    echo '<div style="clear:both;"></div>';
    echo substr($description, 0, strpos(wordwrap($description, 130), "\n")).'...';
    
    $link = get_term_link( $prod_term->slug, $prod_term->taxonomy );
    
    echo '<a class="buton-detalii" href="'.$link.'">Detalii</a>';
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
