<?php
/*
Plugin Name: Sentinel Resurgence
Description: Plugin to handle Sentinel Resurgence functionality.
Version: 1.0.0
Author: Salman Shuaib and ChatGPT
*/

function resolute($phNum) {
  $digits = str_split($phNum);
  while (count($digits) > 1) {
    $digits = str_split(array_sum($digits));
  }
  return intval($digits[0]);
}

function resolute_shortcode($atts) {
  $a = shortcode_atts( array(
    'phNum' => '',
  ), $atts );

  // Validate the input as a number
  $phNum = intval($a['phNum']);
  if (!is_numeric($phNum)) {
    return 'Invalid input. Please enter a valid number.';
  }

  // Retrieve data from the database
  global $wpdb;
  $table_name = $wpdb->prefix . 'league';
  $result = $wpdb->get_row("SELECT * FROM $table_name WHERE `Legion Numer` = $phNum");

  // Check if a matching record is found
  if ($result) {
    // Perform the tally calculation
    $tally = resolute($phNum);

    // Update the score column for the matching Legion Number
    $score = intval($result->Score) + $tally;
    $wpdb->update(
      $table_name,
      array('Score' => $score),
      array('Legion Numer' => $phNum)
    );

    return "Tally performed and score updated for Legion Number: $phNum";
  } else {
    return "No record found for Legion Number: $phNum";
  }
}
add_shortcode('resolute', 'resolute_shortcode');
