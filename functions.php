<?php

function wes_rewrite_permalink() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}

function wes_change_upload_path() {
    update_option('uploads_use_yearmonth_folders', false);
}

function wes_delete_hello_dolly() {
    if (file_exists(WP_PLUGIN_DIR . '/hello.php')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        delete_plugins(array('hello.php'));
    }
}

function wes_activate_akismet() {
    if (file_exists(WP_PLUGIN_DIR . '/akismet/akismet.php')) {
        if (!is_plugin_active(WP_PLUGIN_DIR . '/akismet/akismet.php')) {
            //plugin is activated
            activate_plugin(WP_PLUGIN_DIR . '/akismet/akismet.php');
        }
    }
}

function wes_preferred_domain($url){
    update_option('home', $url);
}

function wes_disable_user_registration() {
    update_option('users_can_register', 0);
}

function wes_delete_sample_content() {
    wp_delete_post(1);
    wp_delete_post(2);
}

function wes_empty_trash() {
    //clear posts
    $posts = get_posts(array('post_status' => 'trash', 'numberposts' => -1));
    foreach ($posts as $post) {
        wp_delete_post($post->ID, true);
    }

    //clear pages
    $pages = get_posts(array(
        'post_status' => 'trash',
        'numberposts' => -1,
        'post_type' => 'page'
    ));
    foreach ($pages as $page) {
        wp_delete_post($page->ID, true);
    }

    // comments
    $comments = get_comments(array('status' => 'trash'));
    foreach ($comments as $comment) {
        wp_delete_comment($comment->comment_ID, true);
    }
}

function wes_delete_default_theme() {
    $current_theme = get_stylesheet();
    $defaultThemes = array('twentyfifteen', 'twentyfourteen', 'twentythirteen');
    foreach ($defaultThemes as $defaultTheme) {
        if ($current_theme !== $defaultTheme)
            delete_theme($defaultTheme);
    }
}

function wes_crawl_search_engine() {
    update_option('blog_public', 0);
}

function wes_email_on_comment() {
    update_option('comments_notify', 0);
    update_option('moderation_notify', 0);
}

function wes_install_plugin($url) {
    if (strstr($url, '.zip') != FALSE) {
        $download_link = $url;
    } else {
        $slug = explode('/', $url);
        $slug = $slug[count($slug) - 2];
        $api = plugins_api('plugin_information', array('slug' => $slug, 'fields' => array('sections' => 'false')));
        $download_link = $api->download_link;
    }

    $upgrader = new Plugin_Upgrader();
    if (!$upgrader->install($download_link))
        return 0;

    //This will also activate the plugin after installation
    $plugin_to_activate = $upgrader->plugin_info();
    $activate = activate_plugin($plugin_to_activate);
    wp_cache_flush();
    return 1;
}

function wes_install_theme($url) {
    if (strstr($url, '.zip') != FALSE) {
        $download_link = $url;
    } else {
        $slug = explode('/', $url);
        $slug = $slug[count($slug) - 2];
        $api = themes_api('theme_information', array('slug' => $slug, 'fields' => array('sections' => 'false')));
        $download_link = $api->download_link;
    }

    $upgrader = new Theme_Upgrader();
    if (!$upgrader->install($download_link))
        return 0;
    
    wp_cache_flush();
    return 1;
}
