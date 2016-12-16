<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div class="container">
    <div class="row">
        <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>

                <?php
                        /**
                         * woocommerce_before_single_product_summary hook.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                ?>

                <div class="summary entry-summary">
    <?php

    global $product;
    $attachment_ids = $product->get_gallery_attachment_ids();
    ?>                    
                    <div class="flexslider">
                        <ul class="slides">
                    <?php
                        foreach( $attachment_ids as $attachment_id ) 
                        {
                          echo '<li><img src="'.$image_link = wp_get_attachment_url( $attachment_id ).'" ></li>';
                        }
                    ?>
                        </ul>
                    </div>    
                        <?php
                                /**
                                 * woocommerce_single_product_summary hook.
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 20
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_meta - 40
                                 * @hooked woocommerce_template_single_sharing - 50
                                 */
                                do_action( 'woocommerce_single_product_summary' );
                                
                                the_content();
                        ?>
                            
                </div><!-- .summary -->
                <div class="additional_information">                    
                        <?php woocommerce_product_additional_information_tab();?>
                </div>
                <?php
                        /**
                         * woocommerce_after_single_product_summary hook.
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                ?>

                <meta itemprop="url" content="<?php the_permalink(); ?>" />

        </div><!-- #product-<?php the_ID(); ?> -->
    </div>
</div><!-- end container -->
<div class="related-products-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php do_action( 'woocommerce_after_single_product' ); ?>
            </div>
        </div>
    </div>
</div>