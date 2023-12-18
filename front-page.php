<?php get_header(); ?>

<!-- Hero et H1 -->
<div id="heroheader">
    <?php
    $the_query = new WP_Query(array(
        'orderby' => 'rand',
        'posts_per_page' => 1,
        'post_type' => 'photos',
    ));

    while ($the_query->have_posts()) : $the_query->the_post();
        the_post_thumbnail();
    endwhile;

    wp_reset_postdata();
    ?>

    <!-- Ajout du titre : -->
    <h1>PHOTOGRAPHE EVENT</h1>
</div>

<!-- Chargement des filtres -->
<?php get_template_part ( 'templates_parts/filtres'); ?> 



<!-- Catalogue photos -->
<div class="photo-container" id="photo-container">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'orderby' => 'rand',
        'posts_per_page' => 12,
        'post_type' => 'photos',
        'paged' => $paged,
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) :
        $count = 0; // Initialiser le compteur pour déterminer la position de chaque photo
        while ($my_query->have_posts()) : $my_query->the_post();
            $count++;

            $allcats="";
            $categories = get_the_terms(get_the_ID(), 'categories_photos');

            if ($categories && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $allcats=$allcats."".$category->name;
            }
        }


            ?>
            <div class="photo-item ajax-load">
                <a href="<?php the_permalink(); ?>" class="overlay-image">
                    <div class="the-content">
                        <?php echo get_the_content(); ?>
                    </div>
                    <img class="oeil" src="<?php echo get_template_directory_uri() . '/assets/images/eye.png'; ?>" alt="oeil">
                    <img class="fullscreen" data-image-url="<?php echo get_the_post_thumbnail_url(); ?>" src="<?php echo get_template_directory_uri() . '/assets/images/full-screen.png'; ?>" alt="fullscreen" data-category="<?php echo $allcats ?>" data-reference ="<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>">
                </a>
            </div>
            <?php
            // Insérer une div de saut de ligne après chaque 2e élément
            if ($count % 2 == 0) {
                echo '<div class="clearfix"></div>';
            }
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucune photo trouvée.</p>';
    endif;
    ?>
</div>

<!-- Charger plus -->
<div class="chargerplus">
<a href="#!" id="load-more" >Charger plus</a>
</div>



<?php get_footer(); ?>

<!-- Inclure loadmore.js uniquement sur la page d'accueil -->
<script src="<?php echo get_template_directory_uri(); ?>/js/loadmore.js"></script>

