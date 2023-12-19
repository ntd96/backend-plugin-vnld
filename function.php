<?php
/*
Plugin Name: Custom Api backend
Plugin URI: jk.technology
Description: Backend
Version: 1.0.0
Author: ntd
*/


// Important các file services
// require_once plugin_dir_path(__FILE__) . 'services/auth.php';
// require_once plugin_dir_path(__FILE__) . 'services/form-api.php';
include_once('services/auth.php');
include_once('services/form-api.php');
// Tạo shortcode để hiển thị form trên trang/post
function custom_api_form_shortcode()
{
    ob_start();
    // include plugin_dir_path(__FILE__) . 'views/form.php';
    include('views/form.php');
    return ob_get_clean();
}
add_shortcode('custom_api_form', 'custom_api_form_shortcode');

