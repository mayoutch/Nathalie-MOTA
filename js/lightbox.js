console.log("Hello LightBox!");

document.addEventListener("DOMContentLoaded", () => {
  const overlayImages = document.querySelectorAll(".overlay-image");

  overlayImages.forEach((overlayImage) => {
    const fullscreenImage = overlayImage.querySelector(".fullscreen");

    fullscreenImage.addEventListener("click", (event) => {
      event.preventDefault();

      // Nouvelle méthode pour cibler myLightbox
      const myLightbox = document.getElementById("mylightbox");

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
      } else {
        console.log("myLightbox not found");
      }
    });
  });
});
