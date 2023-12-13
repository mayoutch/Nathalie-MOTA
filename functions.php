<?php
function load_custom_scripts() {
    // Charger jQuery
    wp_enqueue_script('jquery');


  
    // Chargement fichier "scripts.js"
    wp_enqueue_script('modale2', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);

   

    // Ajouter les styles
    wp_enqueue_style('nathaliemota', get_template_directory_uri() . '/css/main.css', array(), '1.0');
}

add_action('wp_enqueue_scripts', 'load_custom_scripts');




// ---------------------- LOADMORE - pagination infinie - Ajax ----------------------------//

add_action('wp_ajax_load_more_content', 'load_more_content');
add_action('wp_ajax_nopriv_load_more_content', 'load_more_content');

function load_more_content() {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    //  pour voir la valeur de 'page' dans les logs:
    error_log('Page: ' . $page);

    $posts_per_page = 12; 
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
            // structure HTML pour chaque photo:
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

// -----------------------   Requêtes Ajax pour les filtres ------------------------------------//

function filter_photos()
{
    // Vérifiez le nonce pour la sécurité
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'filter_photos_nonce')) {
        wp_die('La sécurité de la requête n\'a pas pu être vérifiée.');
    }

    // Récupération des valeurs
    $category = isset($_POST['categories_photos']) ? $_POST['categories_photos'] : '';
    $format = isset($_POST['formats']) ? $_POST['formats'] : '';
    $tri = isset($_POST['tri']) ? $_POST['tri'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : ''; // Ajout de la variable date
    $page = isset($_POST['page']) ? $_POST['page'] : 1;

    // Configuration de la requête
    $args = array(
        'post_type' => 'photos',
        'paged' => $page,
        'posts_per_page' => 10,
        'order' => 'DESC',
    );

    // Ajoutez les termes de la taxonomie 'categories-photos' si nécessaire
    if (!empty($category) && $category != 'default-category') {
        $args['tax_query'][] = array(
            'taxonomy' => 'categories-photos',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Ajoutez les termes de la taxonomie 'formats' si nécessaire
    if (!empty($format) && $format != 'default-format') {
        $args['tax_query'][] = array(
            'taxonomy' => 'formats',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    // Ajouter la logique de tri par date si nécessaire
    if (!empty($tri) && $tri != 'default-tri') {
        $args['order'] = ($tri == 'asc') ? 'ASC' : 'DESC';
    }
  

    // La requête WP_Query
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            get_template_part('template-parts/photo-block');
        }
    } else {
        echo 'Aucune photo trouvée.';
    }

    wp_reset_postdata(); // Toujours réinitialiser après une requête personnalisée
    wp_die(); // Cela arrête l'exécution de PHP et retourne la réponse
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
