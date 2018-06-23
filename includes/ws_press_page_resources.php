<?php 
/**
 *
 * @package stoked press page
 * @since stokes press page 1.0
 */



// Register splugin stylesheet and javascript.
add_action( 'wp_enqueue_scripts', 'wps_press_page_register_resources');

function wps_press_page_register_resources() {
	wp_register_style( 'wps_press_page', plugins_url( 'css/wps_press_page_style.css', dirname(__FILE__) ) );
	wp_enqueue_style( 'wps_press_page' );
	wp_enqueue_script( 'wps_press_page_js', plugins_url( 'js/wps_press_page_js.js', dirname(__FILE__) ), array(), '1.0.0', true );
}

?>