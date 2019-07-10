<?php
function create_post_type_portfolio() {
    
    register_post_type('portfolio',
        array(
            'labels' => array(
                'name' => __('Портфолио'),
                'singular_name' => __('Портфолио')
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true
        )
    );
}

add_action('init', 'create_post_type_portfolio');

function create_post_type_forms() {
    
    register_post_type('forms',
        array(
            'labels' => array(
                'name' => __('Формы'),
                'singular_name' => __('Формы')
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true
        )
    );
}

add_action('init', 'create_post_type_forms');