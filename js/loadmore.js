// ----------------- Ajax - load more -----------//
document.addEventListener("DOMContentLoaded", function () {
  let page = 2; // Commencer à la page 2, car la première page est déjà chargée

  function loadMoreContent() {
    console.log(`Chargement de la page ${page}`);

    fetch(`/wp-admin/admin-ajax.php?action=load_more_content&page=${page}`)
      .then((response) => response.json())
      .then((data) => {
        console.log("Données reçues :", data);
        if (data.data.html != undefined) {
          let element = document.querySelector("#photo-container");
          element.insertAdjacentHTML("beforeend", data.data.html);
          page++;
        }
      })
      .catch((error) => {
        console.error("Erreur AJAX", error);
      });
  }

  const loadMoreButton = document.getElementById("load-more");

  if (loadMoreButton) {
    loadMoreButton.addEventListener("click", () => {
      loadMoreContent();
    });

    // Retirer complètement le gestionnaire de défilement
    window.removeEventListener("scroll", loadMoreContent);

    document.addEventListener("DOMContentLoaded", () => {
      loadMoreContent(); // Appel initial pour charger les premiers contenus
    });
  }
});
