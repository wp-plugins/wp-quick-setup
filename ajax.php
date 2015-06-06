<?php

function wes_perform_quick_setup() {

    if (isset($_POST['change_permalink'])) {
        wes_rewrite_permalink();
    }
    if (isset($_POST['upload_path'])) {
        wes_change_upload_path();
    }
    if (isset($_POST['delete_hello_dolly'])) {
        wes_delete_hello_dolly();
    }
    if (isset($_POST['activate_akismet'])) {
        wes_activate_akismet();
    }
    if (isset($_POST['disable_user_registration'])) {
        wes_disable_user_registration();
    }
    if (isset($_POST['delete_sample'])) {
        wes_delete_sample_content();
    }
    if (isset($_POST['empty_trash'])) {
        wes_empty_trash();
    }
    if (isset($_POST['delete_default_theme'])) {
        wes_delete_default_theme();
    }
    if (isset($_POST['crawl_search_engine'])) {
        wes_crawl_search_engine();
    }
    if (isset($_POST['email_on_comment'])) {
        wes_email_on_comment();
    }
    if (isset($_POST['preferred_domain'])) {
        wes_preferred_domain($_POST['preferred_domain']);
    }

    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_perform_quick_setup', 'wes_perform_quick_setup');

function wes_install_plugins() {

    $urls = $_POST['plugin_urls'];
    require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
    require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
    $data = array();
    for ($i = 0; $i < count($urls); $i++) {
        $resp = wes_install_plugin($urls[$i]);
        $data[$resp] = $data[$resp] ++;
    }
    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_install_plugins', 'wes_install_plugins');

function wes_install_themes() {

    $urls = $_POST['theme_urls'];
    require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
    require_once(ABSPATH . 'wp-admin/includes/theme-install.php');
    $data = array();
    for ($i = 0; $i < count($urls); $i++) {
        $resp = wes_install_theme($urls[$i]);
        $data[$resp] = $data[$resp] ++;
    }
    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_install_themes', 'wes_install_themes');


/* * ******* create page ******** */

function wes_create_blank_pages() {
    $page_names = $_POST['page_names'];
    for ($i = 0; $i < count($page_names); $i++) {
        if (!get_page_by_title($page_names[$i])) {
            $post['author'] = get_current_user_id();
            $post['post_type'] = 'page';
            $post['post_title'] = $page_names[$i];
            $post['post_status'] = 'publish';
            $sf[] = wp_insert_post($post);
        }
    }
    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_create_blank_pages', 'wes_create_blank_pages');


/* * ******* create category ******** */

function wes_create_categories() {
    $category_names = $_POST['categories_names'];
    for ($i = 0; $i < count($category_names); $i++) {
        if (0 == get_cat_ID('Uncategorized'))
            wp_create_category($category_names[$i]);
        else {
            $arg = array('cat_ID' => get_cat_ID('Uncategorized'), 'cat_name' => $category_names[$i]);
            wp_insert_category($arg);
        }
    }
    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_create_categories', 'wes_create_categories');

function wes_save_timezone() {

    $utc = $_POST['utc'];
    $timezoneString = $_POST['timezone_string'];

    if (!empty($utc)) {
        update_option('gmt_offset', $utc);
    }
    if (!empty($timezoneString)) {
        update_option('timezone_string', $timezoneString);
    }

    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_save_timezone', 'wes_save_timezone');

function wes_save_front_page() {

    $show_on_front = $_POST['show_on_front'];
    $page_on_front = $_POST['page_on_front'];
    $page_for_posts = $_POST['page_for_posts'];
    $rss_use_excerpt = $_POST['rss_use_excerpt'];
    
    update_option('show_on_front', $show_on_front);
    if ($show_on_front === 'page') {
        update_option('page_on_front', $page_on_front);
        update_option('page_for_posts', $page_for_posts);
    }
    
    //rss_use_excerpt
    update_option('rss_use_excerpt', $rss_use_excerpt);

    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_save_front_page', 'wes_save_front_page');

function wes_save_date_time_format() {

    $date_format = $_POST['date_format'];
    $time_format = $_POST['time_format'];

    update_option('date_format', $date_format);
    update_option('time_format', $time_format);

    status_header(202);
    wp_send_json_success();
}

add_action('wp_ajax_wes_save_date_time_format', 'wes_save_date_time_format');
