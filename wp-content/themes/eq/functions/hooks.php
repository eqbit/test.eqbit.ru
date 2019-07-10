<?php
function register_custom_nav_menus() {
    register_nav_menus( array(
        'main_menu' => 'Главное меню сайта'
    ) );
}
add_action('init','add_cors_http_header');

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');