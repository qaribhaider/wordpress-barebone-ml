<?php

/**
 * Few theme setup adons
 */

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

/**
 * Helper functions beign here
 */

function assets_url() {
    return get_template_directory_uri() . '/assets/';
}

/**
 * Check whether the URL is an image or not
 */
function isURLanImage($url) {
    $pos = strrpos($url, ".");
    if ($pos === false)
        return false;
    $ext = strtolower(trim(substr($url, $pos)));
    $imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif"); // this is far from complete but that's always going to be the case...
    if (in_array($ext, $imgExts))
        return true;
    return false;
}

if (!function_exists('_djsn')) {

    function _djsn($str, $status = "error") {
        echo json_encode(array("status" => $status, "message" => $str));
        exit();
    }

}

if (!function_exists('get_client_ip')) {

    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

}

if (!function_exists('getBrowser')) {

    function getBrowser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }

}

if (!function_exists('trim_chars')) {

    function trim_chars($string) {
        return preg_replace('/[^a-zA-Z0-9]/', '', strtolower($string));
    }

}

if (!function_exists('sqhr_trim_chars')) {

    function sqhr_trim_chars($string, $length = 25, $more = '..') {
        if ($string && strlen($string) > $length) {
            return substr($string, 0, $length) . $more;
        }
        return $string;
    }

}

if (!function_exists('sqhr_ml_pid')) {

    /**
     * Wrapper for get_page_by_title
     * 
     * Fixes multilingual linking problem with get_page_by_title module
     * Wrap the output of get_page_by_title around this function to get page 
     * in current language 
     * 
     * @param type $post
     * @return type
     */
    function sqhr_ml_pid($post) {
        if (is_object($post)) {
            $post_id = $post->ID;
        } else {
            $post_id = $post;
        }


        if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE !== 'en') {
            return icl_object_id($post_id, get_post_type($post_id), TRUE, ICL_LANGUAGE_CODE);
        }

        return $post;
    }

}

if (!function_exists('formatSizeUnits')) {

    /**
     * Convert filesize from bytes to human readable format
     * 
     * @param type $bytes
     * @return string
     */
    function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}

if (!function_exists('sqhr_filesize')) {

    /**
     * Get the filesize for absolute wordpress file URLs 
     * 
     * Example: 
     * Get filesize for : http://wp.hug/mrs/wp-content/uploads/2015/08/Parking.jpg
     * 
     * @param type $base_path
     * @return type
     */
    function sqhr_filesize($base_path) {
        $relative_path = str_replace(get_home_url() . '/wp-content/uploads/', '', $base_path);

        $uploads = wp_upload_dir();
        $path = $uploads['basedir'];

        return @filesize($path . '/' . $relative_path);
    }

}

if (!function_exists('sqhr_get_child_pages')) {

    /**
     * Returns all child pages for current page
     * 
     * @global Post Object $post
     * 
     * @return array Array of Post Objects
     */
    function sqhr_get_child_pages() {
        global $post;

        if (is_page()) {
            // Set up the objects needed
            $my_wp_query = new WP_Query();
            $all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

            // Filter through all pages and find children
            $childpages = get_page_children($post->ID, $all_wp_pages);
        }

        return ($childpages) ? $childpages : false;
    }

}

if (!function_exists('is_ajax')) {

    function is_ajax() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

}
