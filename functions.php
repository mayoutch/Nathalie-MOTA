<?php
function styles () {
// Déclarer le fichier style.css 
    wp_enqueue_style( 
        'nathaliemota',
        get_template_directory_uri() . '/css/main.css',
        array(), 
        '1.0'
    );
}
    add_action( 'wp_enqueue_scripts', 'styles' );

// Déclarer le fichier scripts.js:
function script()
{
    wp_enqueue_script('modale', get_template_directory_uri() . '/js/scripts.js', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'script');

   
// ajout d'une fonction permettant d'ajouter/de configurer les menus dans le back office:
function my_menus() {
    register_nav_menu( 'main-menu', "Menu principal");
    register_nav_menu('menu-footer', "Menu pied de page");
    }
    // enregistrer la fonction 'my_menus' après la configuration du thème ('after_setup_theme')
    add_action( 'after_setup_theme', 'my_menus' );

// Ajout du titre du site dans l'en-tête 
add_theme_support( 'title-tag' );