// -------------------------- Fleche gauche, Flèche droite, dans le fichier single-post ----------------------------------------------------//
const miniCarroussel = document.querySelector(".mini-carroussel");
const flecheGauche = document.querySelector(".fgauche");
const flecheDroite = document.querySelector(".fdroite");
const imageContainer = document.querySelector(".image-container");

let currentImageIndex = 0;
// Puis Définir les URL des images => elles sont définies côté serveur, dans le fichier single-photo.php
// Avant de les mettre (les URL) dans un tableau
const images = [previous_image_url, next_image_url];

function chargerImage(index) {
  console.log("Tentative de chargement de l'image à l'index", index);

  const imgElement = new Image();
  imgElement.src = images[index];

  imgElement.onload = function () {
    imageContainer.innerHTML = ""; // Efface l'ancienne image
    imageContainer.appendChild(imgElement); // Ajoute la nouvelle image
    console.log("Image chargée avec succès");
  };

  imgElement.onerror = function () {
    console.log("Erreur lors du chargement de l'image à l'index", index);
  };

  currentImageIndex = index;
}

// Initialisation avec la première image au démarrage
chargerImage(currentImageIndex);

// Au survol et au clic pour la flèche gauche
flecheGauche.addEventListener("mouseenter", function () {
  console.log("Survole de la flèche gauche");
  // Ne fait rien au survol
});

flecheGauche.addEventListener("click", function () {
  console.log("Clic sur la flèche gauche");
  currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
  chargerImage(currentImageIndex);
  window.location.href = "<?php echo get_permalink($previous_post_id); ?>"; // Utilise la variable de l'image précédente
});

// Au survol et au clic pour la flèche droite
flecheDroite.addEventListener("mouseenter", function () {
  console.log("Survole de la flèche droite");
  currentImageIndex = (currentImageIndex + 1) % images.length;
  chargerImage(currentImageIndex);
});

flecheDroite.addEventListener("click", function () {
  console.log("Clic sur la flèche droite");
  currentImageIndex = (currentImageIndex + 1) % images.length;
  chargerImage(currentImageIndex);
  window.location.href = next_image_url; // Utilise la variable que tu as définie dans ton script PHP
});
