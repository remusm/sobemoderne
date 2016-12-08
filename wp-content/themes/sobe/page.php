<?php get_header(); ?>

    <div class="cat-slider-wrapper">
        
        <div class="container">
            <div class="row">  
                    <?php echo do_shortcode('[gallery ids="43,42" transition="dissolve" autoplay="5000" arrows="false" click="false" swipe="false" nav="false" width="100%" height="auto"]'); ?>                
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
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumb-top">
                <?php woocommerce_breadcrumb(); ?>
                
                <hr class="breadcrumb-underline">
            </div>
        </div>
        <div class="row">              
                <?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// End of the loop.
		endwhile;
		?>
        </div>
    </div>

<?php get_footer(); ?>

