<?php

/**
 * Enqueue scripts and styles.
 */
function hug2k16_scripts() {
    wp_enqueue_style('hug2k16-style', get_stylesheet_uri());
    
    wp_enqueue_style('bootstrap-style', assets_url() . '/css/bootstrap.min.css', array(), '3.3.6', 'all');
    
    wp_enqueue_style('bootstrap-style-theme', assets_url() . '/css/bootstrap-theme.min.css', array(), '3.3.6', 'all');
    
    wp_enqueue_style('bootstrap-blog-theme', assets_url() . '/css/blog.css', array(), '3.3.6', 'all');
    
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap-js', assets_url() . '/js/bootstrap.min.js', array(), '3.3.6', true);
    
    wp_enqueue_script('hug2k16-navigation', assets_url() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('hug2k16-skip-link-focus-fix', assets_url() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'hug2k16_scripts');
