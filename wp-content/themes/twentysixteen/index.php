<?php get_header(); ?>

<div class="container">
<div class="row">
    <div class="col-md-9">
        <div class="blog-content-wrapper">
            <?php $post = get_post($id); echo apply_filters(‘the_content’, $post->post_content); ?>
        </div>
    </div>
    
        <?php
            $args = array (
                'post_type' => 'post',
            );
            
            $the_query = new WP_Query( $args );
        ?>
    <div class="col-md-3">   
        <p class="sidebar-blog-title">
            ULTIMELE ARTICOLE
        </p>
        <?php $counter = 0; ?>
        <?php if ( have_posts() ) : while ($the_query->have_posts() AND $counter<3) : $the_query->the_post(); ?>
        <?php                    
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_url = wp_get_attachment_image_src ( $thumbnail_id, 'thumbnail-size', true );
            $thumbnail_meta = get_post_meta ( $thumbnail_id, '_wp_attachment_image_alt', true );
        ?>
        
        <p class="popular-recipes-box">                    
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'thumbnail' );?>    
        </a> 
        <p class="sidebar-post-title"><a href="<?php the_permalink(); ?>"><?php echo the_title (); ?></a></p>
        <?php $counter++; ?></p> 
        <?php endwhile; endif; ?> 
    </div>            
</div><!-- end row -->
</div>

<?php get_footer();?>      