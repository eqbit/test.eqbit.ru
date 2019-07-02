<?

function portfolio_endpoint($request_data) {
    $posts_per_page = 7;
    
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => $posts_per_page
    );
    
    if(isset($_GET['slug'])) {
        $args['name'] = $_GET["slug"];
        $args['posts_per_page'] = 1;
    }
    
    if(isset($_GET["page"])) {
        $args['offset'] = $posts_per_page * $_GET['page'] - 1;
    }
    
    $posts = get_posts($args);
    foreach ($posts as $key => $post) {
        $posts[$key]->acf = get_fields($post->ID);
    }
    return $posts;
}

add_action('rest_api_init', function () {
    register_rest_route('portfolio/v1', '/post/', array(
        'methods' => 'GET',
        'callback' => 'portfolio_endpoint'
    ));
});