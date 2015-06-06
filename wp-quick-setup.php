<?php

/*
  Plugin Name: WP Quick Setup
  Plugin URI: http://antonhoelstad.dk
  Description: This plugin makes it as easy as possible to start up a new WordPress blog. Fix all the common issues with one click of a button.
  Version: 2.0
  Author: Anton Hoelstad
  Author URI: http://antonhoelstad.dk
 */
  
// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define('WP_QUICK_SETUP_VERSION', '0.1.0');
define('WP_QUICK_SETUP__MINIMUM_WP_VERSION', '3.2');
define('WP_QUICK_SETUP__PLUGIN_URL', plugin_dir_url(__FILE__));
define('WP_QUICK_SETUP__PLUGIN_DIR', plugin_dir_path(__FILE__));


require_once WP_QUICK_SETUP__PLUGIN_DIR . 'functions.php';
require_once WP_QUICK_SETUP__PLUGIN_DIR . 'ajax.php';

/**
 * add config page
 */
function wes_settings_menu() {
    add_options_page(__('Wp Quick Setup'), __('Wp Quick Setup'), 'manage_options', 'wes-settings', 'wes_settings_page');
}
add_action('admin_menu', 'wes_settings_menu');

/**
 * Show settings page
 */
function wes_settings_page(){
    require_once WP_QUICK_SETUP__PLUGIN_DIR . 'views/settings.php';
}

/**
 * Add custom JS
 * @return type
 */
function wes_add_scripts(){
    if(!isset($_GET['page']) || $_GET['page'] !== 'wes-settings')
        return;
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('notify', WP_QUICK_SETUP__PLUGIN_URL . 'js/notify.js', array('jquery'), 1, true);
    wp_enqueue_script('velocity', WP_QUICK_SETUP__PLUGIN_URL . 'js/velocity.js', array('jquery'), 1, true);
    wp_enqueue_script('parsley', WP_QUICK_SETUP__PLUGIN_URL . 'js/parsley.min.js', array('jquery'), 1, true);
    wp_enqueue_script('material', WP_QUICK_SETUP__PLUGIN_URL . 'js/materialize.js', array('velocity'), 1);
    wp_enqueue_script('wes-script', WP_QUICK_SETUP__PLUGIN_URL . 'js/wp-quick-setup.js', array('material'), 1);
}
add_action('admin_enqueue_scripts', 'wes_add_scripts');

/**
 * Add custom CSS
 * @return type
 */
function wes_add_styles(){
    if(!isset($_GET['page']) || $_GET['page'] !== 'wes-settings')
        return;
    wp_enqueue_style('material', WP_QUICK_SETUP__PLUGIN_URL . 'css/materialize.min.css');
    wp_enqueue_style('wes-style', WP_QUICK_SETUP__PLUGIN_URL . 'css/wp-quick-setup.css');
}
add_action('admin_enqueue_scripts', 'wes_add_styles');