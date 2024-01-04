let page = 1;
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
    console.log("sendAjaxRequest", data);

    // Envoi de la requête
    fetch(frontendajax.ajaxurl, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        "Cache-Control": "no-cache",
      },
      body: new URLSearchParams(data),
    })
      .then((response) => {
        console.log('Réponse reçue',response);
        if (!response.ok) {
            throw new Error('Erreur du réseau');
        }
        return response.text();
      })
      
      .then((data) => {
        console.log("réponse2", data);
        // Mise à jour de la galerie avec les nouvelles photos
        const galerie = document.querySelector(".photo-container");
        galerie.innerHTML = data;
        // if (page === 1) {
        //   galerie.innerHTML = data;
        // } else {
        //   galerie.innerHTML += data;
        // }
      })
      .catch((error) => {
        console.error("Erreur",error);
      });
  }
});
