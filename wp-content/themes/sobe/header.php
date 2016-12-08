<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <title><?php bloginfo(); ?></title>

        <?php wp_head(); ?>
    </head>

    <body>
        <div style="margin: 40px 0;"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png"></a>
               
                               
                      <?php
                      $args = array (
                          'menu'  => 'header-menu',
                          'menu_class'    => 'nav nav-pills pull-right',
                          'container'     => false
                      );

                      wp_nav_menu( $args );
                      ?>    
                   
                </div>
            </div>   
        </div> <!-- /container -->
        <div style="margin: 40px 0;"></div>
       