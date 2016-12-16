<?php get_header(); ?>
    <div class="cat-slider-wrapper">        
        <div class="container">
            <div class="row">  
                <div class="col-md-12">  
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4791.24352740945!2d25.981127432572702!3d44.43540942308746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b200e1678b3f6b%3A0x6ace3a1cd06cb3ec!2sBulevardul+Iuliu+Maniu+275%2C+Bucure%C8%99ti!5e0!3m2!1sen!2sro!4v1476119519464" width="100%" height="338" allowfullscreen></iframe>                       
                </div>
            </div>
        </div>
           
    </div>
    <div class="category-description">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo get_the_title(); ?></h1>
                    <p class="page-subtitle">Ne puteti contacta la numerele de telefon: 0749 06 57 82 si 0743 55 00 00, sau puteti sa ne trimiteti un mesaj folosind formularul de mai jos. Vom reveni cu un raspuns in cel mai scurt timp posibil.
Adresa showroom: Bulevardul Iuliu Maniu nr. 275, Bucuresti</p>
                </div>
            </div>
        </div> <!-- /container -->
    </div>  

    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin: 20px 0;">                    
            <?php
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            ?>
            </div>
            <div class="col-md-6" style="margin: 20px 0;">                    
                <img src="<?php bloginfo('template_url'); ?>/images/contact-img.jpg" alt="soba traditionala" >
            </div>
        </div>
    </div><!-- .content-area -->

<?php get_footer(); ?>
