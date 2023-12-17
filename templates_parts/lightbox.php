<div class="mylightbox" id="mylightbox">
    <div class="lightbox-contenu">
        <img class="lightbox__image" src="" alt="Photo en grand format">
        <span class="lightbox-title">Titre de la photo</span>
        <span class="lightbox-ref">Référence de la photo</span>
        <span class="lightbox-cat">Catégorie</span>
    </div>
    <img class="close-lightbox" src="<?php echo get_template_directory_uri() . '/assets/images/croix.png'; ?>" alt="croix refermer lightbox" id="croix"></img>
    <div class="fleches">
        <a href="<?php echo get_permalink($previous_post->ID); ?>" class="lien-fleche">
            <img class="gauche" src="<?php echo get_template_directory_uri() . '/assets/images/left.png'; ?>" alt="flèche gauche">
        </a>
        <a href="<?php echo get_permalink($next_post->ID); ?>" class="lien-fleche">
            <img class="droite" src="<?php echo get_template_directory_uri() . '/assets/images/right.png'; ?>" alt="flèche droite">
        </a>
    </div>
</div>
