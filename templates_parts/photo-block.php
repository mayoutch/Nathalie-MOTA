<?php
// Liste des catégories spécifiques
$categories_list = array('mariage', 'reception', 'television', 'concert');

// Récupérer la catégorie de la photo actuelle
$categories = get_the_terms(get_the_ID(), 'categories_photos');

if ($categories && !is_wp_error($categories)) {
    foreach ($categories as $category) {
        // Vérifier si la catégorie fait partie de la liste spécifique
        if (in_array($category->slug, $categories_list)) {
            // Arguments pour la requête
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 2,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categories_photos',
                        'field' => 'slug',
                        'terms' => $category->slug,
                    ),
                ),
                'post__not_in' => array(get_the_ID()), // Exclure le post actuel
            );
            
            $my_query = new WP_Query($args);

            if ($my_query->have_posts()) :
                while ($my_query->have_posts()) : $my_query->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="overlay-image">
                        <div class="the-content">
                            <?php echo get_the_content(); ?>
                        </div>
                       
                        <img class="oeil" src="<?php echo get_template_directory_uri() . '/assets/images/eye.png'; ?>" alt="oeil">
                    </a>
                    <?php
                endwhile;
            else :
                echo '<p>Aucune photo trouvée pour cette catégorie : ' . $category->name . '</p>';
            endif;

            wp_reset_postdata();
        }
    }
} else {
    echo '<p>Erreur lors de la récupération des catégories</p>';
}
?>
