console.log("Hello LightBox!");

document.addEventListener("DOMContentLoaded", () => {
  const overlayImages = document.querySelectorAll(".overlay-image");
  const myLightbox = document.getElementById("mylightbox");
  const closeLightbox = document.getElementById("croix");

  overlayImages.forEach((overlayImage) => {
    const fullscreenImage = overlayImage.querySelector(".fullscreen");

    fullscreenImage.addEventListener("click", (event) => {
      event.preventDefault();

      if (myLightbox) {
        console.log("myLightbox found:", myLightbox);

        const lightboxImage = myLightbox.querySelector(".lightbox__image");
        console.log("lightboxImage found");

        const imageUrl = fullscreenImage.getAttribute("data-image-url");
        console.log("imageUrl found:", imageUrl);

        // Mettre à jour l'image dans la lightbox avec l'URL
        const creerImage = `<img src="${imageUrl}" alt="grande image">`;
        lightboxImage.innerHTML = creerImage;

        // Afficher la lightbox
        myLightbox.style.display = "block";

        // Afficher la croix
        if (closeLightbox) {
          console.log("#croix found");
          closeLightbox.style.display = "flex";
        } else {
          console.log("#croix not found");
        }
      } else {
        console.log("myLightbox not found");
      }
    });
  });

  if (closeLightbox) {
    closeLightbox.addEventListener("click", () => {
      console.log("Croix clicked");

      // Cacher la lightbox lorsque la croix est cliquée
      if (myLightbox) {
        myLightbox.style.display = "none";
      } else {
        console.log("myLightbox not found");
      }
    });
  } else {
    console.log("#croix not found");
  }
});
