console.log("hello les filtres!");

document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM chargé");
  // Initialisation de la variable de pagination - Une variable page est initialisée à 1, elle sera utilisée pour paginer les résultats de la requête AJAX.
  let page = 1;

  // Gestionnaire d'événement pour les changements de filtres
  // Lorsqu'un changement est détecté dans l'un de ces filtres, une fonction est appelée pour effectuer une nouvelle requête AJAX avec les filtres mis à jour.
  document
    .getElementById("filter-category")
    .addEventListener("change", function () {
      // Réinitialisation de la pagination à chaque changement de filtre
      page = 1;

      // Récupération des valeurs des filtres
      const categoriesPhotos = this.value; //L'utilisation de this.value est courante dans les événements pour obtenir la valeur de l'élément qui a déclenché l'événement. Dans ce cas, this fait référence à l'élément avec l'ID "filter-category".
      const formats = document.getElementById("filter-format").value;
      const tri = document.getElementById("filter-tri").value;

      // Envoi de la requête AJAX pour filtrer les photos
      sendAjaxRequest(categoriesPhotos, formats, tri, page);
    });

  // Fonction pour envoyer une requête AJAX
  function sendAjaxRequest(categoriesPhotos, formats, tri, page) {
    console.log("Début de sendAjaxRequest");
    // Construction des données à envoyer
    const data = {
      action: "filter_photos",
      nonce: frontendajax.nonce, // Utilisation du nonce ajouté dans le PHP
      categories_photos: categoriesPhotos,
      // formats: formats,
      // tri: tri,
      page: page,
    };
    console.log("Fin de sendAjaxRequest");

    // Envoi de la requête
    //fetch est une fonction JavaScript utilisée pour effectuer des requêtes réseau dans le but de récupérer des ressources à partir d'un serveur. Elle est souvent utilisée pour interagir avec des API ou pour récupérer des données depuis un serveur distant.
    fetch(frontendajax.ajaxurl, {
      // frontendajax déclarée dans functions.php
      // l'url de la ressource que je souhaite récupérer. provient de la variable nommée frontendajax
      method: "POST", //La méthode POST est souvent utilisée lorsqu'on envoie des données au serveur,
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams(data),
    })
      .then((response) => response.text())
      .then((response) => {
        // Mise à jour de la galerie avec les nouvelles photos
        const galerie = document.querySelector(".photo-container");
        if (page === 1) {
          galerie.innerHTML = response; // Si c'est la première page, remplace le contenu
        } else {
          galerie.innerHTML += response; // Sinon, ajoute au contenu existant
        }
      })
      .catch((error) => {
        console.error(error);
        // Gérer les erreurs ici si nécessaire
      });
  }
});
