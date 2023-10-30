<?php
/*
 Modale contact

 */
?>

<div id="mymodale" class="modale" > // ajout d'un id pour pouvoir manipuler le DOM
    <div class="modale-content">
        <img src="<?php echo get_theme_file_uri() . '/assets/images/contact.png'; ?> "alt="nous contacter">
        <?php echo do_shortcode('[contact-form-7 id="38eb5ac" title="Contact"]');?>
    </div>
</div>

