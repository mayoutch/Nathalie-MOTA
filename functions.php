<?php
function load_custom_scripts() {
    // Charger jQuery
    wp_enqueue_script('jquery');

    // Charger votre fichier "fleches.js" sur les pages de type single-photos
    if (is_single() && get_post_type() === 'photos') {
        wp_enqueue_script('fleches', get_template_directory_uri() . '/js/fleches.js', array('jquery'), '1.0', true);
    }

   

    // Charger votre fichier "scripts.js"
    wp_enqueue_script('modale2', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);

    // Ajouter les styles
    wp_enqueue_style('nathaliemota', get_template_directory_uri() . '/css/main.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'load_custom_scripts');



// ---------------------- LOADMORE - Ajax ----------------------------//
// Functions.php

add_action('wp_ajax_load_more_content', 'load_more_content');
add_action('wp_ajax_nopriv_load_more_content', 'load_more_content');

function load_more_content() {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Ajoutez cette ligne pour voir la valeur de 'page' dans les logs
    error_log('Page: ' . $page);

    $posts_per_page = 12; // Ajustez selon vos besoins
    $offset = ($page - 1) * $posts_per_page;

    $args = array(
        'orderby' => 'rand',
        'posts_per_page' => $posts_per_page,
        'post_type' => 'photos',
        'offset' => $offset,
    );

    $my_query = new WP_Query($args);

    ob_start();

    if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();
            // Votre structure HTML pour chaque photo
            ?>
            <div class="photo-item ajax-load">
                <a href="<?php the_permalink(); ?>" class="overlay-image">
                    <div class="the-content">
                        <?php echo get_the_content(); ?>
                    </div>
                    <img class="oeil" src="<?php echo get_template_directory_uri() . '/assets/images/eye.png'; ?>" alt="oeil">
                </a>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
        wp_send_json_success(array('html' => ob_get_clean()));
    else :
        // Aucune photo trouvée
        wp_send_json_error(array('message' => 'Aucune photo trouvée.'));
    endif;

    wp_die();
}
