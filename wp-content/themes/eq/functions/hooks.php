<?php
add_action( 'after_setup_theme', 'register_custom_nav_menus' );
function register_custom_nav_menus() {
    register_nav_menus( array(
        'main_menu' => 'Главное меню сайта'
    ) );
}