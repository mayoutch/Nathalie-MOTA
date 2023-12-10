
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

			  <!-- <div class="mini-carroussel"> -->
        <!-- https://developer.wordpress.org/reference/functions/the_post_thumbnail/ -->
        
        <?php
$next_post = get_next_post();
$previous_post = get_previous_post();

// Définir les URL des images dans des variables PHP / les variables $next_image_url et $previous_image_url sont définies en PHP avant l'inclusion du script JavaScript. Ainsi, lorsque le script JavaScript est exécuté, ces variables seront déjà présentes et correctement définies.
$next_image_url = esc_url(wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'thumbnail')[0]);
$previous_image_url = esc_url(wp_get_attachment_image_src(get_post_thumbnail_id($previous_post->ID), 'thumbnail')[0]);
?>

<div class="interesses">
    <div class="flex-interesses">
        <p>Cette photo vous intéresse ?</p>
        <input type="button" data-reference="<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>" value="Contact" id="versmodale">
    </div>

    <div class="mini-carroussel">
        <div class="image-container">
            <?php
            $current_image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            echo '<img class="current-image" src="' . esc_url($current_image_url) . '" data-next-image-url="' . esc_url($next_image_url) . '" data-previous-image-url="' . esc_url($previous_image_url) . '" />';
            ?>
        </div>
        <div class="fleches">
            <a href="<?php echo get_permalink($previous_post->ID); ?>" class="lien-fleche">
                <img class="fgauche" src="<?php echo get_template_directory_uri() . '/assets/images/gauche.png'; ?>" alt="flèche gauche">
            </a>
            <a href="<?php echo get_permalink($next_post->ID); ?>" class="lien-fleche">
                <img class="fdroite" src="<?php echo get_template_directory_uri() . '/assets/images/droite.png'; ?>" alt="flèche droite">
            </a>
        </div>
    </div>
</div>

<script>
    // création de deux variables JavaScript (next_image_url et previous_image_url) en utilisant les valeurs obtenues côté serveur par wp_get_attachment_image_src. Ces valeurs sont générées du côté serveur (côté PHP) lorsqu'une page est chargée.
    let next_image_url = '<?php echo esc_url($next_image_url); ?>';
    let previous_image_url = '<?php echo esc_url($previous_image_url); ?>';
</script>



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

// Définition des URL des images directement dans le code JavaScript (côté serveur, car créait un bugg quand placé dans scripts.js au dessus du tableau)
<script>
  const images = [
    "<?php echo esc_url($previous_image_url); ?>",
    "<?php echo esc_url($next_image_url); ?>"
  ];
</script>