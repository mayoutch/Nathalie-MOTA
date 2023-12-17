
	<footer id="footer">
	<nav id="nav-footer"> 
		<?php 
		// Affichage du menu-footer déclaré dans functions.php
			wp_nav_menu(array('theme_location' => 'menu-footer')); 
		?>		

		 <ul>
            <li>TOUS DROITS RESERVES</li> 
        </ul>
		</nav>
	</footer>

           <!-- Appeler la modale de contact -->
           <?php get_template_part ( 'templates_parts/modale'); ?> 
		   <?php get_template_part('templates_parts/lightbox'); ?>
		  
<?php wp_footer(); ?>
</body>
</html>
