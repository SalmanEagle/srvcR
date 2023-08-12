<?php
/*
Plugin Name: Homepage Decor
Description: Customizing WordPress Homepage for FE.
Version: 1.0
Declicensed: CC0 by Salman SHUAIB
*/

if ( ! function_exists( 'homepage_decor_enqueue_styles' ) ) {
    // Alternate colors for WordPress Posts
    function homepage_decor_enqueue_styles() {
        wp_enqueue_style( 'homepage-decor', plugins_url( 'homepage-decor.css', __FILE__ ) );
    }
    add_action( 'wp_enqueue_scripts', 'homepage_decor_enqueue_styles' );
}

define( "PATH", $_SERVER['DOCUMENT_ROOT']);
require PATH . "/wp-content/plugins/my-webhooks/my-webhooks.php";

// Calculate $catsNdogs using cooperative function
if ( ! function_exists( 'cooperative' ) ) {
    function cooperative() {
        // $legion_num is already calculated in the above required/included file my-webhooks.php
        $catsNdogs = 'USA' . ' ' . $legion_num . 'Legion'; 
        return $catsNdogs;
    }
}

// Include template-tags.php
require_once(get_template_directory() . '/inc/template-tags.php');

// Pass $catsNdogs to template-tags.php
add_filter('custom_cats_ndogs', function($value) {
    return cooperative();
});
?>
