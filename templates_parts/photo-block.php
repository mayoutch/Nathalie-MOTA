<?php 
// ------------------ CREATION d'UNE BOUCLE EN WP_QUERY : https://capitainewp.io/formations/developper-theme-wordpress/wp-query/ ------------
// 1. On définit les arguments pour définir ce que l'on souhaite récupérer
$args = array(
    'post_type' => 'photos', // Le 'post-type' est à personnaliser selon le nom du CPT
    'post__not_in' => array(get_the_ID()), // post__not_in pour exclure le post courant de la requête
    'posts_per_page' => 2,
);

// 2. On exécute la WP Query (requête WP_Query basée sur les critères placés dans la variables $args)
$my_query = new WP_Query($args);

// 3. On lance la boucle !
// 3.1 On vérifie si le résultat de la requête contient des articles
if ($my_query->have_posts()) :
    
    // 3.2 On parcourt chacun des articles résultant de la requête
    while ($my_query->have_posts()) : $my_query->the_post();
?>
        <div class="overlay-image">
            
            <div class="the-content">
            <?php the_content ();?>
            </div>
            <?php the_title ();?>
           
                <?php echo the_terms(get_the_ID(), 'categorie', false); ?>

                <img class="oeil" src="<?php echo get_template_directory_uri(). '/assets/images/eye.png'; ?> "alt="oeil">
            
        </div>
<?php
    endwhile;
endif;

// 4. On réinitialise à la requête principale (important)
wp_reset_postdata();
//--------------------------------------------------------------------------------------------------------------------------------------//
?>