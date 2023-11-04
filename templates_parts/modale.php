<?php
/*
 Modale contact

 */
?>

<div id="mymodale" class="modale" > 
    <div class="modale-content">
        <img src="<?php echo get_theme_file_uri() . '/assets/images/contact.png'; ?> "alt="nous contacter">
        <?php echo do_shortcode('[contact-form-7 id="f90da91" title="Contact"]');?>
    </div>
</div>

