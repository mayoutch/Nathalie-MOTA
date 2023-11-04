<!-- Exemple de fichier Single.php sur https://wordpress.bbxdesign.com/single-php-le-template-dedie -->

<?php get_header(); ?>
<div class="main single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="post">
        <h1 class="post-title"><?php the_title(); ?></h1>
        <p class="post-info">
          
        </p>
        <div class="post-content">
          <?php the_content(); ?>
        </div>
        
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>