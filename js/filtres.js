console.log("hello les filtres!");

document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM chargé");

  const filters = document.querySelectorAll(".filter");

  filters.forEach((filter) => {
    const select = filter.querySelector("select");
    select.addEventListener("change", function () {
      // Réinitialisation de la pagination à chaque changement de filtre
      page = 1;

      // Récupération des valeurs des filtres
      const categoriesPhotos = document.getElementById("filter-category").value;
      const formats = document.getElementById("filter-format").value;
      const tri = document.getElementById("filter-tri").value;

      // Envoi de la requête AJAX pour filtrer les photos
      sendAjaxRequest(categoriesPhotos, formats, tri, page);
    });
  });

  // Fonction pour envoyer une requête AJAX
  function sendAjaxRequest(categoriesPhotos, formats, tri, page) {
    console.log("Début de sendAjaxRequest");
    // Construction des données à envoyer
    const data = {
      action: "filter_photos",
      nonce: frontendajax.nonce,
      categories_photos: categoriesPhotos,
      formats: formats,
      tri: tri,
      page: page,
    };
    console.log("Fin de sendAjaxRequest");

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
        const galerie = document.querySelector(".photo-container");
        if (page === 1) {
          galerie.innerHTML = response;
        } else {
          galerie.innerHTML += response;
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
});
