
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

			  <div class="mini-carroussel">
        <!-- https://developer.wordpress.org/reference/functions/the_post_thumbnail/ -->
				  <?php the_post_thumbnail(); ?>

				  <div class="fleches">

						<img class="fleche_gauche"src="<?php echo get_template_directory_uri(). '/assets/images/gauche.png'; ?> "alt="flèche gauche">
					  </a>
 
						<img class="fleche_droite" src="<?php echo get_template_directory_uri(). '/assets/images/droite.png'; ?> "alt="flèche droite">
					  </a>

          </div>
			  </div>
      </div>
      

      <!-- Vous aimerez aussi -->

    </article>

    <?php endwhile; ?>
  <?php endif; ?>

<?php get_footer(); ?>