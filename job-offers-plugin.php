<?php
/**
 * Plugin Name: Job Offers Plugin
 * Description: Wtyczka do zarządzania ofertami pracy z filtrowaniem i asynchroniczną paginacją.
 * Version: 1.0.0
 * Author: Przemysław Zienkiewicz
 */

 if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/custom-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handlers.php';
require_once plugin_dir_path(__FILE__) . 'includes/display-job-offers.php';
require_once plugin_dir_path(__FILE__) . 'includes/regenerate.php';
// foreach (glob(plugin_dir_path(__FILE__) . 'includes/*.php') as $file) {
//      require_once $file;
// }

function enqueue_assets() {
    wp_enqueue_style('style', plugin_dir_url(__FILE__) . 'assets/style.css', array());
    wp_enqueue_script('script', plugin_dir_url(__FILE__) . 'assets/script.js');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_localize_script('script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_assets');

