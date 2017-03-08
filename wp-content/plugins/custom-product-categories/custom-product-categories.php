<?php
/**
 * Plugin Name: Custom Product Categories
 * Description: Display products and catgeories / subcategories as two separate lists in product archive pages
 * Version: 1.0
 * Author: Remus Mesar
 */

function custom_product_categories ( $args = array() ) {
     $parentid = get_queried_object_id();
         
    $args = array(
        'parent' => $parentid
    );

    $terms = get_terms( 'product_cat', $args );

    if ( $terms ) { 
        
            foreach ( $terms as $term ) {

                echo '<div class="category-row">';                 
                    echo '<div class="category-box">';
                        woocommerce_subcategory_thumbnail( $term );

                    echo '<h3 class="category-title">';
                        echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
                            echo $term->name;
                        echo '</a>';
                    echo '</h3>';
                    echo '</div> <!-- end category box -->';
                    
                    echo '<div class="product-list">';
                        $args = array(
                            'post_type'             => 'product',
                            'post_status'           => 'publish',
                            'ignore_sticky_posts'   => 1,
                            'posts_per_page'        => '100',
                            'meta_query'            => array(
                                array(
                                    'key'           => '_visibility',
                                    'value'         => array('catalog', 'visible'),
                                    'compare'       => 'IN'
                                )
                            ),                            
                            'orderby'   => 'meta_value_num',
                            'meta_key'  => '_price',
                            'order' => 'asc',
                            'tax_query'             => array(
                                array(
                                    'taxonomy'      => 'product_cat',
                                    'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                                    'terms'         => $term->term_id,
                                    'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                )
                            )
                        );
                        $loop = new WP_Query($args); ?>
                        <div class="wrap">
                      
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                            <div class="product-box">
                                <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                               <?php woocommerce_show_product_sale_flash( $post, $product ); ?>

                               <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

                               <span class="product-title"><?php the_title(); ?></span>

                               <span class="price"><?php echo $product->get_price_html(); ?> (Fara TVA)</span>                    

                                </a>

                            </div>   
                        <?php endwhile; wp_reset_query();?>
                        
                            
                                               
                        </div><!-- end wrap -->
                        <div class="read-more"></div>
                        <?php
                    echo '</div><!-- end product list -->';
                    
                echo '</div> <!-- end category row -->';
                echo '<hr>'; ?>                
<?php
        } ?>
                <script type="text/javascript">               
                    
                   var slideHeight = 220;
                    jQuery(".product-list").each(function() {
                        var $this = jQuery(this);
                        var $wrap = $this.children(".wrap");
                        var defHeight = $wrap.height();
                        if (defHeight >= slideHeight) {
                            var $readMore = $this.find(".read-more");
                            $wrap.css("height", slideHeight + "px");
                            $readMore.append('<a href="#"><img src="<?php echo get_bloginfo('url'); ?>/wp-content/themes/semineebucuresti/images/arrow-down.png"></a>');
                            $readMore.children("a").bind("click", function(event) {
                                var curHeight = $wrap.height();
                                if (curHeight == slideHeight) {
                                    $wrap.animate({
                                        height: defHeight
                                    }, "normal");
                                    /*jQuery(this).text("Close");*/
                                    jQuery(this).empty().prepend('<img src="<?php echo get_bloginfo('url'); ?>/wp-content/themes/semineebucuresti/images/arrow-up.png" />')
                                    $wrap.children(".gradient").fadeOut();
                                } else {
                                    $wrap.animate({
                                        height: slideHeight
                                    }, "normal");
                                    /*jQuery(this).text("");*/
                                    
                                    jQuery(this).empty().prepend('<img src="<?php echo get_bloginfo('url'); ?>/wp-content/themes/semineebucuresti/images/arrow-down.png" />');
                                    $wrap.children(".gradient").fadeIn();
                                }
                                return false;
                            });
                        }
                    });
                </script>
<?php    }

}

add_action( 'woocommerce_before_shop_loop', 'custom_product_categories', 50 );      