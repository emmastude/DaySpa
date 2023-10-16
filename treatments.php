<?php
/*
Plugin Name: Treatments
Description: Plugin for showing the new treatments
Author: Emma Stude
*/

require_once('includes/treatments-post-type.php');
require_once('includes/treatments-shortcodes.php');

function treatments_setup_menu() {
    add_menu_page('Treatments', 'Treatments', 'manage_options', 'treatments', 'treatments_display_admin_page');
}

function treatments_display_admin_page () {
    echo '<h1>Treatments</h2>';
    echo '<p>Add a shortcode to the page to show all treatments in particular category.</p>';
    echo '<p>Plugin also availble!</p>';
}
add_action('admin_menu', 'treatments_setup_menu');

function treatments_assets() {
    wp_enqueue_style('treatments-css', plugin_dir_url(__FILE__) . 'includes/css/treatments.css');
}
add_action('wp_enqueue_scripts', 'treatments_assets');
?>