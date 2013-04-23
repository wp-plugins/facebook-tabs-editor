<?php

/*
 * Plugin Name:   Facebook Tabs 
 * Version:       1.0.0
 * Description:   Manage your facebook page directly from your wordpress admin panel!
 * Author:        Codastar Limited
 */
define('CSS_PATH_FAPPLICATION', get_bloginfo('url') . '/plugins/facebook-tabs-editor/css/');
define('JS_PATH_FAPPLICATION', get_bloginfo('url') . '/plugins/facebook-tabs-editor/js/');
define('FAPPLICATION_IMAGE_THUMB_DIR', get_bloginfo('url') . '/images/fapplication/thumb/');
define('FAPPLICATION_IMAGE_DIR', get_bloginfo('url') . '/images/fapplication/');

define('TEMPLATEPATH', get_bloginfo('template_directory') . '/images/image_temp/');

//define('fapplication_TABLE','facebook-tabs-editor');
define('ARTICLES_TABLE', $wpdb->prefix . 'fapplication');

register_deactivation_hook(__FILE__, 'myplugin_deactivate');
register_activation_hook(__FILE__, 'myplugin_activate');

function myplugin_activate() {
    $my_theme = get_bloginfo('template_url');
    $fbsource1 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-page.php';
    $fbsource2 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-blog.php';
    $fbsource3 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-post.php';
    $fbsource4 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-contact.php';


    //open file and get data
    $data1 = file_get_contents($fbsource1);
    $data3 = file_get_contents($fbsource2);
    $data5 = file_get_contents($fbsource3);
    $data7 = file_get_contents($fbsource4);


    //Write correct path for css
    $replacecss = '<link rel="stylesheet" type="text/css" media="all" href="' . get_bloginfo('url') . '/wp-content/plugins/facebook-tabs-editor/style.css">';
    $searchcss = 'pluginstyle';

    //Write correct path for iframe
    $replaceiframe = '<iframe src="' . $my_theme . '/facebook-post.php" style="border: none; height: 205px;"></iframe>';
    $searchiframe = 'esdpluginiframe';


// Do tag replacements
    $data2 = str_replace($searchcss, $replacecss, $data1);
    $data4 = str_replace($searchcss, $replacecss, $data3);
    $data6 = str_replace($searchcss, $replacecss, $data5);
    $data8 = str_replace($searchcss, $replacecss, $data7);




//save it back:
    file_put_contents($fbsource1, $data2);
    file_put_contents($fbsource2, $data4);
    file_put_contents($fbsource3, $data6);
    file_put_contents($fbsource4, $data8);

//Do it again, just for other string
    sleep(1);
    $data3a = file_get_contents($fbsource2);
    $data6a = str_replace($searchiframe, $replaceiframe, $data3a);
    file_put_contents($fbsource2, $data6a);
}

function fapplication() {
    add_menu_page('fapplication', 'Facebook Tabs', 10, 'fapplication/managefapplication.php', 'init_manage_fapplication');
    add_submenu_page('fapplication/managefapplication.php', 'Manage application ', 'Manage pages ', 10, 'fapplication/managefapplication.php', 'init_manage_fapplication');
    add_submenu_page('fapplication/managefapplication.php', 'Add application', '', 10, 'fapplication/addfapplication.php', 'init_add_fapplication');
}

function myplugin_deactivate() {
    $my_theme = get_bloginfo('template_url');

    $fbsource11 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-page.php';
    $fbsource22 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-blog.php';
    $fbsource33 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-contact.php';
    $fbsource44 = WP_CONTENT_DIR . '/plugins/facebook-tabs-editor/files-to-copy/facebook-post.php';

    sleep(1);

    //open file and get data
    $data1a = file_get_contents($fbsource11);
    $data3a = file_get_contents($fbsource22);
    $data5a = file_get_contents($fbsource33);
    $data7a = file_get_contents($fbsource44);

    //Return default path for css
    $searchcssa = '<link rel="stylesheet" type="text/css" media="all" href="' . get_bloginfo('url') . '/wp-content/plugins/facebook-tabs-editor/style.css">';
    $replacecssa = 'pluginstyle';

    //Return default path for iframe
    $searchiframea = '<iframe src="' . $my_theme . '/facebook-post.php" style="border: none; height: 205px;"></iframe>';
    $replaceiframea = 'esdpluginiframe';


// do tag replacements or whatever you want
    $data2a = str_replace($searchcssa, $replacecssa, $data1a);
    $data4a = str_replace($searchcssa, $replacecssa, $data3a);
    $data6a = str_replace($searchcssa, $replacecssa, $data5a);
    $data8a = str_replace($searchcssa, $replacecssa, $data7a);

//save it back:
    file_put_contents($fbsource11, $data2a);
    file_put_contents($fbsource22, $data4a);
    file_put_contents($fbsource33, $data6a);
    file_put_contents($fbsource44, $data8a);

//Do it again, just for other string  
    $data3ab = file_get_contents($fbsource22);
    $data6ab = str_replace($searchiframea, $replaceiframea, $data3ab);
    file_put_contents($fbsource22, $data6ab);
}

add_action('admin_menu', 'fapplication');

function fapplication_show() {
    $fapplication = "";
    $fapplication .= '<div class="slide">
                                        <div><p>' . $row->fapplication_title . '</p>
                                        <a class="author_txt" href="#">Facebook Page</a></div>
                                        <a class="author_txt" href="#">' . $row->fapplication_name . ' , ' . $row->fapplication_content . '</a></div>
                                        <a class="author_txt" href="#">' . $row->fapplication_name . ' , ' . $row->fapplication_content . '</a></div>
                                    </div>';
    return $fapplication;
}

function jal_install($tablename, $sql) {
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . $tablename;
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
// $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'name' => $welcome_name, 'text' => $welcome_text ) );
        add_option("jal_db_version", $jal_db_version);
    }
}

require(dirname(__FILE__) . '/fapplication/managefapplication.php');
require(dirname(__FILE__) . '/fapplication/addfapplication.php');

add_action('activated_plugin', 'save_error');

function save_error() {
    file_put_contents(ABSPATH . 'wp-content/uploads/2012/error_activation.html', ob_get_contents());
}

?>