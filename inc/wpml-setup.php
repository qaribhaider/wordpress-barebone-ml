<?php

define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_LANGUAGES_JS', true);

function icl_post_languages($hide_active = true, $skip_missing = false) {
    $return = array();
    $skip_missing = ($skip_missing) ? 1 : 0;
    $languages = icl_get_languages('skip_missing=' . $skip_missing);
    if (count($languages) > 1) {
        foreach ($languages as $key => $language) {
            if ($hide_active && $language['active']) {
                continue;
            }
            $return[$key] = $language;
            $a = '<a href="' . $language['url'] . '">' . $language['native_name'] . '</a>';
            $return[$key]['link'] = $a;
        }
    }
    return $return;
}

function get_translation_navigation() {
    $nav = '';
    $lang_nav = icl_post_languages();
    if (count($lang_nav) > 0) {
        foreach ($lang_nav as $key => $item) {
            $nav .= '<li>';
            $nav .= $item['link'];
            $nav .= '</li>';
        }
    }
    return $nav;
}

// Add translation item to navigation
// wp_nav_menu_items -> for all menus
// wp_nav_menu_{$menu->slug}_items -> for specific menu
add_filter('wp_nav_menu_items', 'add_translation_navigation', 10, 2);

function add_translation_navigation($menu, $args) {

    if ('header-secondary' == $args->theme_location) {
        $menu .= get_translation_navigation();
    }

    return $menu;
}
