
<?php get_header(); ?>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <!-- Mise en place d'un article -->
    <article class="post"> 

    <!-- Mise en place d'un container pour un flex column -->
    <div class="container-img-text">

    <!-- Texte des photos (on récupère les CPT UI & ACF + les dates de WP) -->
    <!-- https://tutoriels.lws.fr/wordpress/get_post_meta -->
    <!-- https://developer.wordpress.org/reference/functions/the_terms/ -->
    
      <div class="post-infos">
        <div class="post-texte">
          <h2 class="title-post">
            <?php the_title(); ?>
          </h2>   
          <p>RÉFÉRENCE : 
            <span id="ref-photo">
            <?php echo get_post_meta(get_the_ID(), 'reference', true); ?> 
            <!-- echo get_post_meta: relatif à "groupe de champs" - type et référence -->
            </span>
          </p>
          <p>CATÉGORIE :
            <?php echo the_terms(get_the_ID(), 'categories_photos', false); ?> 
            <!-- echo the_terms : relatif aux taxonomies -->
          </p>
          <p>FORMAT :
            <?php echo the_terms(get_the_ID(), 'formats', false); ?> 
          </p>
          <p>TYPE :
            <?php echo get_post_meta(get_the_ID(), 'type', true); ?> 
          </p>
          <p>ANNÉE:
            <?php $post_date = get_the_date('Y');
            echo $post_date; ?>
        </div> 
      </div>

          <!-- Image -->
        <div class="post-image">
        <!-- "the_post_thumbnail" permettrait d'afficher l'image mise en avant, mais ici on affiche plutôt le contenu (qui contient ici une image) -->
        <?php the_content(); ?>
        </div>

        </div>


      <!-- Vous êtes intéressés -->
      <div class="interesses">

			  <div class="flex-interesses">
          <p>Cette photo vous intéresse ?</p>
				  <input type="button" data-reference="<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>" value="Contact" id="versmodale">
        </div>

			  <!-- <div class="mini-carroussel"> -->
        <!-- https://developer.wordpress.org/reference/functions/the_post_thumbnail/ -->
        
        <?php
// Récupérez l'objet post associé au champ ACF "type"
$next_post = get_next_post();

// Vérifiez si un post suivant a été sélectionné 
 if ($next_post) {
    // Obtenez l'ID du post suivant
    $next_post_id = $next_post->ID;
    $next_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($next_post_id), 'thumbnail')[0];
    ?>
    
   
    <div class="mini-carroussel">
        <!-- Et afficher ce post suivant: -->
        <?php echo get_the_post_thumbnail($next_post_id, [100, 100]); ?>

        <div class="fleches">
           
                <img class="fgauche" src="<?php echo get_template_directory_uri() . '/assets/images/gauche.png'; ?>" alt="flèche gauche">
            
                <img class="fdroite" src="<?php echo get_template_directory_uri() . '/assets/images/droite.png'; ?>" alt="flèche droite">
            
        </div>
    </div>

<!-- Du javascript et du Php, pour post suivant : -->
    <script>let next_image='<?php echo get_the_post_thumbnail($next_post_id, [100, 100]); ?>'; </script>
    <?php


} else {
    // Aucun post suivant n'a été sélectionné
    echo 'Aucun post suivant n\'a été sélectionné.';
}

// ON FAIT LA MÊME CHOSE POUR LE POST PRECEDENT :
$previous_post = get_previous_post();

// Vérifiez si un post précédent a été sélectionné
if ($previous_post) {
    // Obtenez l'ID du post suivant
    $previous_post_id = $previous_post->ID;

    // Affichez la vignette du post précédent avec un lien vers ce post
    ?>
   
    <script>let previous_image='<?php echo get_the_post_thumbnail($previous_post_id, [100, 100]); ?>'; </script>
    <?php


} else {
    // Aucun post précédent n'a été sélectionné
    echo 'Aucun post précédent n\'a été sélectionné.';
}
?>
			  </div>
      </div>
      

      <!-- Vous aimerez aussi -->
      <div class="aimerez">
        <p>VOUS AIMEREZ AUSSI</p>
            <div class="photo-row">
           <?php get_template_part ( 'templates_parts/photo-block'); ?> 
           </div>
        <input type="button" class="btntouteslesphotos" value="Toutes les photos"> <a href="">  </a></div>    
      </div>

    </article>

    <?php endwhile; ?>
  <?php endif; ?>

<?php get_footer(); ?>