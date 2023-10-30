
	<footer id="footer">
		<?php 
		// Affichage du menu-footer déclaré dans functions.php
			wp_nav_menu(array('theme_location' => 'menu-footer')); 
		?>		
        <!-- Appeler la modale de contact (dans le footer, pour qu'elle soit chargée sur n'importe quelle page-->
            <?php get_template_part('templates-parts/modale'); ?>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
