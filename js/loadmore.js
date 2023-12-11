// ----------------- Ajax - load more -----------//
let page = 2; // Commencer à la page 2, car la première page est déjà chargée

function loadMorePhotos() {
  fetch(`/wp-admin/admin-ajax.php?action=load_more_photos&page=${page}`)
    .then((response) => response.json())
    .then((data) => {
      console.log("Données reçues :", data);

      if (data.success) {
        const photoContainer = document.querySelector(".photo-container");

        if (data.data.html.trim()) {
          photoContainer.innerHTML += data.data.html;
          page++;
        } else {
          console.log("Aucune photo trouvée.");
        }
      } else {
        console.error("Erreur lors du chargement des photos :", data.message);
      }
    })
    .catch((error) => {
      console.error("Erreur AJAX", error);
    });
}

window.addEventListener("scroll", () => {
  const scrollHeight = document.documentElement.scrollHeight;
  const scrollTop = window.scrollY;
  const clientHeight = window.innerHeight;

  if (scrollTop + clientHeight >= scrollHeight - 200) {
    loadMorePhotos();
  }
});

document.addEventListener("DOMContentLoaded", () => {
  loadMorePhotos(); // Appel initial pour charger les premières photos
});
