<?php

if (!function_exists('sqhrportfolio_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function sqhrportfolio_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on SqhrPortfolio, use a find and replace
         * to change 'sqhrportfolio' to the name of your theme in all the template files.
         */
        load_theme_textdomain('sqhrportfolio', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
            set_post_thumbnail_size(SQHR_CUSTOM_POST_THUMB_WIDTH, SQHR_CUSTOM_POST_THUMB_HEIGHT);
            //add_image_size('media-large', 1140, 360, array('center', 'center'));
        }

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'header-main' => esc_html__('Header main menu', 'sqhrportfolio'),
            'footer-main' => esc_html__('Footer main menu', 'sqhrportfolio')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('sqhrportfolio_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        //Remove admin bar
        show_admin_bar(false);

        /**
         * Remove logo from wordpress admin bar
         */
        function annointed_admin_bar_remove() {
            global $wp_admin_bar;

            /* Remove their stuff */
            $wp_admin_bar->remove_menu('wp-logo');
        }

        add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
    }

endif;
add_action('after_setup_theme', 'sqhrportfolio_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sqhrportfolio_content_width() {
    $GLOBALS['content_width'] = apply_filters('sqhrportfolio_content_width', 640);
}

add_action('after_setup_theme', 'sqhrportfolio_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sqhrportfolio_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'sqhrportfolio'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'sqhrportfolio'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'sqhrportfolio_widgets_init');

/**
 * Email customizations
 */
function res_fromemail($email) {
    $sitename = strtolower($_SERVER['SERVER_NAME']);
    if (substr($sitename, 0, 4) == 'www.') {
        $sitename = substr($sitename, 4);
    }
    /* end of code lifted from wordpress core */
    $myfront = "admin@";
    $myfrom = $myfront . $sitename;
    return $myfrom;
}

function res_fromname($email) {
    return get_option('blogname');
}

add_filter('wp_mail_from', 'res_fromemail');
add_filter('wp_mail_from_name', 'res_fromname');

/**
 * Filter to show custom post category archives too
 * on category archieves listing page
 */
add_filter('pre_get_posts', 'query_post_type');

function query_post_type($query) {
    $args = array(
        'public' => true,
        '_builtin' => false
    );
    $post_types = get_post_types($args);

    if (is_category() || is_tag()) {
        $post_type = get_query_var('article');

        if ($post_type) {
            $post_type = $post_type;
        } else {
            $post_type = array_values($post_types);
        }

        $query->set('post_type', array('attachment', 'revision', 'nav_menu_item', 'media', 'shops'));

        return $query;
    }
}

/**
 * For Permalinks to work after theme switch
 */
function my_rewrite_flush() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'my_rewrite_flush');
