<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hug2k16
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>

    <body>

        <div class="blog-masthead">
            <div class="container">
                <?php
                if (has_nav_menu('header-main')) {
                    $nav_opts_primary = array(
                        //'nav' => 'header-main',
                        'theme_location' => 'header-main',
                        'container' => 'nav', // Main container to wrap above ul
                        'container_class' => 'blog-nav', // Main container class
                        'container_id' => '', // Main container id
                        'menu_class' => '', // ul class
                        'menu_id' => '', // ul id
                        'walker' => new WP_Bootstrap_NavWalker() // Customize links
                    );
                    wp_nav_menu($nav_opts_primary);
                }
                ?>
            </div>
        </div>

        <div class="container">

            <div class="blog-header">
                <h1 class="blog-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) :
                    ?>
                    <p class="site-description"></p>
                    <p class="lead blog-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php endif;
                ?>

            </div>