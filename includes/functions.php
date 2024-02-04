<?php

namespace user_login;

defined('ABSPATH') || die();

class Functions {
    public function __construct() {
        add_action('wp_login', [$this, 'limited_login'], 10, 2);
        add_action('wp_logout', [$this, 'logout_time'], 10, 2);
    }

    public function limited_login($user_login, $user) {
        $login_count = get_option('login_count', array()); // Use default value as an empty array

        if (!isset($_COOKIE['login_data']) || "logout" === $_COOKIE['login_data'] ||  !isset($login_count[$_COOKIE['login_data']])) {
            if (count($login_count) == 10) {
                // Logout if the count is 2
                $this->custom_logout();
            } else {
                $user_unique_id  = "user_" . time();
                $login_count[$user_unique_id] = $user_unique_id;

                update_option('login_count', $login_count);
                setcookie('login_data',  $user_unique_id, time() + 604800, '/'); // 7 days
            }
        } else {
            setcookie('login_data',  $_COOKIE['login_data'], time() + 604800, '/'); // 7 days
            $login_count = get_option('login_count');
        }
    }

    public function custom_logout() {
        wp_logout();
        wp_redirect(home_url());
        exit;
    }

    public function logout_time() {
        $login_count = get_option('login_count');
        if (isset($login_count[$_COOKIE['login_data']])) {
            unset($login_count[$_COOKIE['login_data']]);
            setcookie('login_data',  'logout', time() + 604800, '/'); // 7 days
        }

        update_option('login_count', $login_count);
    }
}
