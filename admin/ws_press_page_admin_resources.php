<?php 
/**
 *
 * @package stoked press page
 * @since stokes press page 1.0
 */


//Register Admin panel Resources
function wps_press_page_admin_resources()  
{ 
 wp_enqueue_script( 'wps_press_page_admin_js', plugins_url( 'js/wps_press_page_admin_js.js', dirname(__FILE__)) ,false, '1.0', true);
 wp_enqueue_style( 'wps_press_page_admin_css', plugins_url( 'css/wps_press_page_admin_css.css', dirname(__FILE__)));

}
add_action( 'admin_enqueue_scripts', 'wps_press_page_admin_resources' );