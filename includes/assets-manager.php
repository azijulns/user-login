<?php

namespace user_login;

defined('ABSPATH') || die();

class AssetsManager {
    public function __construct() {
        // add_action('login_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }

    public function admin_enqueue_scripts() {
        wp_enqueue_script('jquery');

        wp_enqueue_script(
            'admin',
            USER_PLUGIN_ASSETS . 'js/admin.js',
            ['jquery'],
            USER_PLUGIN_VERSION,
            true
        );

        wp_enqueue_style(
            'public',
            USER_PLUGIN_ASSETS . 'css/style.css',
            null,
            USER_PLUGIN_VERSION,
            "all"
        );

        wp_localize_script(
            'admin',
            'ajax_helper',
            [
                'security'  => wp_create_nonce('vevr_nonce'),
                'ajaxurl'   => admin_url('admin-ajax.php'),
                'rest_root' => esc_url_raw(rest_url()),
            ]
        );
    }
}
