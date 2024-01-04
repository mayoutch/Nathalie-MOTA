
<a href="<?php the_permalink(); ?>" class="overlay-image">
    <div class="the-content">
        <?php echo get_the_content(); ?>
    </div>
    <img class="oeil" src="<?php echo get_template_directory_uri() . '/assets/images/eye.png'; ?>" alt="oeil">
    <img class="fullscreen" data-image-url="<?php echo get_the_post_thumbnail_url(); ?>" src="<?php echo get_template_directory_uri() . '/assets/images/full-screen.png'; ?>" alt="fullscreen" data-category="<?php echo $category->name ?>" data-reference ="<?php echo get_post_meta(get_the_ID(), 'reference', true); ?>">
</a>