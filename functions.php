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
    // wp_enqueue_script('modale', get_template_directory_uri() . '/js/scripts.js', array(), '1.0');
    wp_enqueue_script('modale2',get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
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
// Ajout de la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// --- CPT -- https://capitainewp.io/formations/developper-theme-wordpress/creer-cpt-theme/
function nathaliemota_register_post_types() {
	// La déclaration de nos Custom Post Types et Taxonomies ira ici :
    //finalement inutile car j'ai utilisé les plugin .. 

}
add_action( 'init', 'nathaliemota_register_post_types' ); // le hook init lance la fonction


// check ACF - https://www.gregoirenoyelle.com/wordpress-utilisation-basique-advanced-custom-fields-acf/
if ( ! function_exists( 'get_field' ) ) {
	add_action( 'template_redirect', 'template_redirect_warning_missing_acf', 0 );
	function template_redirect_warning_missing_acf() {
		wp_die( sprintf( 'Ce site ne fonctionne pas sans l\'extension Advanced Custom Fields. Merci de vous connecter au site pour l\'activer.', wp_login_url() ) );
	}

}