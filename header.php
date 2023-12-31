<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MotaPhoto</title>
        
    <?php wp_head(); ?>
</head>
<!-- On ouvre le body, qui sera fermé à la fin de footer.php -->
<body> 

    <header id="header">
        <div class="logo">
        <img src="<?php echo get_theme_file_uri() . '/assets/images/logo.png'; ?> "alt="logo de Nathalie Mota">
        </div>

          <!-- menu burger  -->
          <div class="burger">
            <span></span> <!-- span vide pour créa en css du menu burger -->
          </div>


        <!-- Menu Fullscreen -->
        <nav id="nav-header">  
            <!-- Affichage du menu main-menu déclaré dans functions.php  -->
                <?php wp_nav_menu(['theme_location' => 'main-menu',]); ?>  
                <ul>
                    <li><a href="#" id="mybtn" class="btn-contact">CONTACT</a></li> 
                </ul>
           

        </nav>
    </header>