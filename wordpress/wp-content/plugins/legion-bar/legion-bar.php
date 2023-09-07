<?php
/*
Plugin Name: Legion Bar
Description: Displays a bar on top of the site showing penalties for each legion.
Version: 1.0.0
Delicensed: CC0 1.0 Universal by Salman SHUAIB, in honor of Taylor Swift
*/
function legion_ticker_enqueue_scripts() {
    wp_enqueue_style('legion-ticker-css', plugins_url('legion-bar.css', __FILE__));
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'legion_ticker_enqueue_scripts');


function display_ticker() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'league';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY Score ASC");
    $colors = ["#FF0000", "#00FF00", "#0000FF", "#000000", "#FF00FF", "#00FFFF", "#C0C0C0", "#808080", "#800000"];

    if ($results) {
        echo '<div class="ticker-wrapper">';
        foreach ($results as $index => $result) {
            $color = $colors[$result->{"Legion Number"} - 1];
            echo '<span class="ticker-item" style="background-color:' . $color . ';">Legion ' . $result->{"Legion Number"} . ': ' . $result->Score . '</span>';
        }
        echo '</div>';
    } else {
        echo "No records found in the league table.";
    }
}
add_action('wp_head', 'display_ticker');


