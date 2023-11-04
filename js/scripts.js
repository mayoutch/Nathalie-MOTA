console.log("hello");
// ----------------------------------Modale contact-----------------------------------------------------//
document.addEventListener("DOMContentLoaded", (event) => {
  // // ajout nécessaire de cette première ligne pour que .btn-contact soit retrouvé dans le DOM => https://bobbyhadz.com/blog/javascript-cannot-read-property-addeventlistener-null

  // Déclaration d'une constante pour pouvoir récupérer le bouton contact du menu :
  var btn = document.querySelector(".btn-contact");
  // Déclaration d'une constante pour aller récupérer dans le DOM l'élément avec l'id `mymodale`:
  var modale = document.getElementById("mymodale");

  // Ouverture/fermeture de la modale contact
  //http://www.w3bai.com/fr/howto/howto_css_modals.html#gsc.tab=0
  // When the user clicks on the button, open the modal :

  btn.addEventListener("click", () => {
    console.log("clic bouton");
    modale.style.display = "block";
  });

  // When the user clicks anywhere outside of the modal, close it :
  window.onclick = function (event) {
    if (event.target == modale) {
      modale.style.display = "none";
    }
  };
});
