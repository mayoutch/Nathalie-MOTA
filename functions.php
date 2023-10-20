<?php

function theme_enqueue_styles() {
    
       // Déclaration du fichier styles.css à la racine du thème
       wp_enqueue_style( 
        'nathaliemota', // le handle, c’est le nom unique donné au fichier.
        get_stylesheet_directory_uri() . '/css/style.css',
        array(), 
        '1.0' // C'est la version '1.0' de ce thème.
    );
}


add_action('wp_enqueue_scripts', 'theme_enqueue_styles'); // permet de lier la nouvelle fonction définie à l’action wp_enqueue_scripts.

