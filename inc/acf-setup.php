<?php

/**
 * Create setting pages using ACF
 */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => TRUE
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'General',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Pages Settings',
        'menu_title' => 'Pages',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Social Settings',
        'menu_title' => 'Social',
        'parent_slug' => 'theme-general-settings',
    ));

    /**
     * Add sub page to contact form plugin
     * 
     * Use the plugin slug in parent to show the page under plugin page
     */
    acf_add_options_sub_page(array(
        'title' => 'Queries Settings',
        'parent' => 'queries_contact_form',
        'capability' => 'edit_posts'
    ));
    
}
