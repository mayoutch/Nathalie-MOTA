<?php get_header() ?>

<div id="heroheader"  >
<?php

$the_query = new WP_Query( array ( 
    'orderby' => 'rand', // précise que c'est aléatoire
     'posts_per_page' => 1 ,
     "post_type" => 'photos' ) );
//Tant qu'il y a des posts à afficher, le contenu de la boucle est exécuté :
while ( $the_query->have_posts() ) : $the_query->the_post();
the_post_thumbnail();
endwhile;
// réinitialiser les données de post après avoir utilisé WP_Query :
wp_reset_postdata();

// Ajout du titre :
?>
<h1 >PHOTOGRAPHE EVENT</h1>
</div>

<?php get_footer() ?>