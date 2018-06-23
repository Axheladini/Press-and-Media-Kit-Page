<?php 
/*
Plugin Name: Press & Media Kit Page
Plugin URL: http://www.agonxheladini.com/
Description:  Press page & Media Kit plugin helps you submit and show press releases, Resources / Media Kits (images, logo's, documents, vectors, videos), Articles, featured blog posts all together in structured, responsive and well formatted one page inside your WordPress page.
Version: 1.0
Author: Agon Xheladini, founder @kolabor.net,
Author URI: http://www.agonxheladini.com/
Licence: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /localization
Text Domain: wps_press_page
*/
/*
 *
 * @package stoked press page
 * @since stokes press page 1.0
 */


/* Initiate plugin text domain for transaltion*/

add_action('init', 'wps_press_page_init');
function wps_press_page_init()
{
  load_plugin_textdomain('wps_press_page', false, plugin_basename(dirname(__FILE__) .'/localization'));
}

/*INCLUDES*/
include( plugin_dir_path( __FILE__ ) . 'settings/wps_press_page_settings.php');
include( plugin_dir_path( __FILE__ ) . 'includes/ws_press_page_resources.php');
include( plugin_dir_path( __FILE__ ) . 'includes/ws_press_page_resources_custom_posts.php');
include( plugin_dir_path( __FILE__ ) . 'includes/ws_press_page_articles_custom_posts.php');
include( plugin_dir_path( __FILE__ ) . 'includes/ws_press_page_press_release_custom_posts.php');
include( plugin_dir_path( __FILE__ ) . 'admin/ws_press_page_admin_resources.php');
/* Include short codes */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/wps_press_page_show_all_shc.php');

/*AJAX*/
include( plugin_dir_path( __FILE__ ) . 'includes/AJAX/wps_press_page_load_more_btn_ajax.php');


/*Plugin Activation hook*/
register_activation_hook( __FILE__, 'wps_press_page_activation' );
function wps_press_page_activation()
{
//Nothing after activation
}


/*plugin Deactivation hook*/
register_deactivation_hook( __FILE__, 'wps_press_page_deactivation' );
function wps_press_page_deactivation()
{
 //Nothing after deactivation
}



/* Allow specific file upload for Wordpress*/
function wps_press_page_myme_types($mime_types){
    $mime_types['ai'] = 'application/postscript'; 
    $mime_types['eps'] = 'application/postscript';
    $mime_types['cdr'] = 'image/x-coreldrawpattern';
    $mime_types['xcf'] = 'application/x-xcf';
    $mime_types['rar'] = 'application/rar';
    $mime_types['gz'] = 'application/tar+gzip';
    $mime_types['tar'] = 'application/tar+gzip';
    $mime_types['tgz'] = 'application/tar+gzip';
    return $mime_types;
}
add_filter('upload_mimes', 'wps_press_page_myme_types', 1, 1);


/*Register uninstall hook*/
register_uninstall_hook(__FILE__, 'wps_press_page_uninstall_fx');

function wps_press_page_uninstall_fx()
{
    if (is_admin()) 
    {  
        /*Delete all plugin Options*/
        $option_name = 'wps_press_page_press_page_section';
        delete_option( $option_name );

        /*Delete all custom post type values*/

        global $wpdb; 
        $postmeta_table = $wpdb->postmeta;
        $posts_table = $wpdb->posts;

        $postmeta_table = str_replace($wpdb->base_prefix, $wpdb->prefix, $postmeta_table); //Get Database table prefixes
        $postmeta_table = str_replace($wpdb->base_prefix, $wpdb->prefix, $postmeta_table); //Get Database table prefixes


        /* Delete Article Custom posts and metaboxes */
        $wpdb->query("DELETE FROM " . $postmeta_table . " WHERE meta_key = '_wps_press_page_article_metas_data'");
        $wpdb->query("DELETE FROM " . $posts_table . " WHERE post_type = 'articles'");

        /* Delete Resources Custom posts and metaboxes */
        $wpdb->query("DELETE FROM " . $postmeta_table . " WHERE meta_key = 'wps_press_page_resource_type_meta'");
        $wpdb->query("DELETE FROM " . $postmeta_table . " WHERE meta_key = 'resource_file_uploaded'");
        $wpdb->query("DELETE FROM " . $posts_table . " WHERE post_type = 'resources'");

        /* Delete Press Releases Custom posts and metaboxes */
        $wpdb->query("DELETE FROM " . $postmeta_table . " WHERE meta_key = 'wps_press_page_releases_type'");
        $wpdb->query("DELETE FROM " . $postmeta_table . " WHERE meta_key = 'wps_press_page_releases_file'");
        $wpdb->query("DELETE FROM " . $postmeta_table . " WHERE meta_key = 'wps_press_page_releases_link_meta'");
        $wpdb->query("DELETE FROM " . $posts_table . " WHERE post_type = 'pressreeleases'");

    }

}