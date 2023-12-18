console.log("Hello LightBox!");

document.addEventListener("DOMContentLoaded", () => {
  const overlayImages = document.querySelectorAll(".overlay-image");
  const myLightbox = document.getElementById("mylightbox");
  const closeLightbox = document.getElementById("croix");
  const flecheGauche = document.getElementById("flecheGauche");
  const flecheDroite = document.getElementById("flecheDroite");
  let currentImageIndex = 0;
  let images = [];
  let categories = [];

  overlayImages.forEach((overlayImage, index) => {
    const fullscreenImage = overlayImage.querySelector(".fullscreen");

    fullscreenImage.addEventListener("click", (event) => {
      event.preventDefault();

      if (myLightbox) {
        const lightboxImage = myLightbox.querySelector(".lightbox__image");
        const lightboxTitle = myLightbox.querySelector(".lightbox-title");
        const lightboxRef = myLightbox.querySelector(".lightbox-ref");
        const lightboxCat = myLightbox.querySelector(".lightbox-cat");

        const imageUrl = fullscreenImage.getAttribute("data-image-url");
        const imageTitle = fullscreenImage.getAttribute("data-title");
        const imageRef = fullscreenImage.getAttribute("data-reference");
        const imageCat = fullscreenImage.getAttribute("data-category");

        const creerImage = `<img src="${imageUrl}" alt="grande image">`;
        lightboxImage.innerHTML = creerImage;

        lightboxTitle.textContent = imageTitle;
        lightboxRef.textContent = `Référence : ${imageRef}`;
        lightboxCat.textContent = `Catégorie : ${imageCat}`;

        myLightbox.style.display = "block";

        if (closeLightbox) {
          closeLightbox.style.display = "flex";
        }

        images = Array.from(overlayImages).map((img) =>
          img.querySelector(".fullscreen").getAttribute("data-image-url")
        );
        categories = Array.from(overlayImages).map((img) =>
          img.querySelector(".fullscreen").getAttribute("data-category")
        );

        if (flecheGauche && flecheDroite) {
          flecheGauche.addEventListener("click", () => {
            currentImageIndex =
              (currentImageIndex - 1 + images.length) % images.length;
            chargerImage(currentImageIndex);
          });

          flecheDroite.addEventListener("click", () => {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            chargerImage(currentImageIndex);
          });
        }
      }
    });
  });

  if (closeLightbox) {
    closeLightbox.addEventListener("click", () => {
      if (myLightbox) {
        myLightbox.style.display = "none";
      }
    });
  }

  function chargerImage(index) {
    const lightboxImage = myLightbox.querySelector(".lightbox__image");
    const lightboxCat = myLightbox.querySelector(".lightbox-cat");

    if (index >= 0 && index < images.length) {
      const imageUrl = images[index];
      const category = categories[index];

      const creerImage = `<img src="${imageUrl}" alt="grande image">`;
      lightboxImage.innerHTML = creerImage;

      lightboxCat.textContent = `Catégorie : ${category}`;
    }
  }
});
