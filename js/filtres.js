console.log("hello les filtres!");

document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM chargé");
  // Initialisation de la variable de pagination
  let page = 1;

  // Gestionnaire d'événement pour les changements de filtres
  document
    .getElementById("filter-category")
    .addEventListener("change", function () {
      console.log(document.getElementById("filter-category"));
      // Réinitialisation de la pagination à chaque changement de filtre
      page = 1;

      // Récupération des valeurs des filtres
      const categoriesPhotos = this.value;
      const formats = document.getElementById("filter-format").value;
      console.log(document.getElementById("filter-format"));

      const tri = document.getElementById("filter-tri").value;
      console.log(document.getElementById("filter-tri"));

      const date = document.getElementById("filter-date").value;
      console.log(document.getElementById("filter-date"));

      // Envoi de la requête AJAX pour filtrer les photos
      sendAjaxRequest(categoriesPhotos, formats, tri, date, page);
    });

  document
    .getElementById("filter-format")
    .addEventListener("change", function () {
      // Réinitialisation de la pagination à chaque changement de filtre
      page = 1;

      // Récupération des valeurs des filtres
      const categoriesPhotos = document.getElementById("filter-category").value;
      const formats = this.value;
      const tri = document.getElementById("filter-tri").value;
      const date = document.getElementById("filter-date").value; // Ajout du sélecteur de date

      // Envoi de la requête AJAX pour filtrer les photos
      sendAjaxRequest(categoriesPhotos, formats, tri, date, page);
    });

  document.getElementById("filter-tri").addEventListener("change", function () {
    // Réinitialisation de la pagination à chaque changement de filtre
    page = 1;

    // Récupération des valeurs des filtres
    const categoriesPhotos = document.getElementById("filter-category").value;
    const formats = document.getElementById("filter-format").value;
    const tri = this.value;
    const date = document.getElementById("filter-date").value; // Ajout du sélecteur de date

    // Envoi de la requête AJAX pour filtrer les photos
    sendAjaxRequest(categoriesPhotos, formats, tri, date, page);
  });

  // Gestionnaire d'événement pour le bouton "Charger plus"
  document.getElementById("load-more").addEventListener("click", function () {
    // Incrémentation de la pagination pour charger les éléments suivants
    page++;

    // Récupération des valeurs des filtres
    const categoriesPhotos = document.getElementById("filter-category").value;
    const formats = document.getElementById("filter-format").value;
    const tri = document.getElementById("filter-tri").value;
    const date = document.getElementById("filter-date").value; // Ajout du sélecteur de date

    // Envoi de la requête AJAX pour charger plus de photos
    sendAjaxRequest(categoriesPhotos, formats, tri, date, page);
  });

  // Fonction pour envoyer une requête AJAX
  function sendAjaxRequest(categoriesPhotos, formats, tri, date, page) {
    // Construction des données à envoyer
    const data = {
      action: "filter_photos",
      nonce: frontendajax.nonce, // Utilisation du nonce ajouté dans le PHP
      categories_photos: categoriesPhotos,
      formats: formats,
      tri: tri,
      date: date,
      page: page,
    };

    // Modification du bouton pour indiquer un état de chargement
    document.getElementById("load-more").textContent = "Chargement...";
    document.getElementById("load-more").disabled = true;

    // Envoi de la requête
    fetch(frontendajax.ajaxurl, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams(data),
    })
      .then((response) => response.text())
      .then((response) => {
        // Mise à jour de la galerie avec les nouvelles photos
        const gallery = document.querySelector(".gallery");
        if (page === 1) {
          gallery.innerHTML = response; // Si c'est la première page, remplace le contenu
        } else {
          gallery.innerHTML += response; // Sinon, ajoute au contenu existant
        }
        // Modification du bouton après le chargement des données
        document.getElementById("load-more").textContent = "Charger plus";
        document.getElementById("load-more").disabled = false;
      })
      .catch((error) => {
        console.error(error);
        // Afficher un message d'erreur ou une action de repli
        document.getElementById("load-more").textContent = "Erreur";
        document.getElementById("load-more").disabled = false;
      });
  }
});
