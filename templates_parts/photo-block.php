<?php
// Récupérer la catégorie de la photo actuelle
$categories = get_the_terms(get_the_ID(), 'categories_photos');

if ($categories && !is_wp_error($categories)) {
    $category_slugs = wp_list_pluck($categories, 'slug');

    // Stocker la première catégorie dans une variable
    $current_category = reset($category_slugs);
    
    // Arguments pour la requête
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 2,
        'tax_query' => array(
            array(
                'taxonomy' => 'categories_photos',
                'field' => 'slug',
                'terms' => $current_category,
            ),
        ),
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();
        error_log('Post ID: ' . get_the_ID());
            ?>
            <div class="overlay-image">
                <div class="the-content">
                    <?php echo get_the_content(); ?>
                </div>
                <?php the_title(); ?>
                <img class="oeil" src="<?php echo get_template_directory_uri() . '/assets/images/eye.png'; ?>" alt="oeil">
            </div>
            <?php
        endwhile;
    else :
        echo '<p>Aucune photo trouvée pour cette catégorie</p>';
    endif;

    wp_reset_postdata();
}
?>

