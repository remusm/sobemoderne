<?php
/**
 * Plugin Name:Display Product Short Descriptions in WooCommerce Archive pages
 * Description: Add product short descriptions to the loop in product archive pages (requires WooCommerce to be activated)
 * Version: 1.0
 * Author: Remus Mesar
 *
 */
function sobe_excerpt_in_product_archives() {
     
    the_excerpt();
     
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sobe_excerpt_in_product_archives', 40 );
