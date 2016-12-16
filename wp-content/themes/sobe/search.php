<?php get_header(); ?>

<?php
    $s=get_search_query();
    $args = array(
                's' =>$s
    );
    // The Query
    $the_query = new WP_Query( $args );
?>

    <div class="cat-slider-wrapper">        
        <div class="container">
            <div class="row">  
                <div class="col-md-12">  
                    <?php echo do_shortcode('[gallery ids="18,19,20" transition="dissolve" autoplay="5000" arrows="false" click="false" swipe="false" nav="false" width="100%" height="auto"]'); ?>                
                </div>
            </div>
        </div>
           
    </div>
    <div class="category-description">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php _e("Rezultate cautare pentru: '".get_query_var('s')."'"); ?></h1>
                </div>
            </div>
        </div> <!-- /container -->
    </div>  
    <div class="container" style="margin-top: 25px; margin-bottom: 25px;">
        <div class="row">
            <div class="col-md-12">

<?php
    if ( $the_query->have_posts() ) {
        
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
        ?>
            <div class="col-md-4 text-center">
                <a class="orange-link" href="<?php the_permalink(); ?>"><?php the_title(); ?>
                <?php echo the_post_thumbnail( 'medium_large' ); ?>
                </a>
            </div>
               
        <?php
        }
    }
    else {
?>
        <div class="alert alert-info">
          <p>Ne pare rau, nu am gasit rezultate.</p>
        </div>
<?php } ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>