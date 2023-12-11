console.log("hello");

// ----------------------------------Modale contact-----------------------------------------------------//
document.addEventListener("DOMContentLoaded", (event) => {
  // ajout nécessaire de cette première ligne pour que .btn-contact soit retrouvé dans le DOM => https://bobbyhadz.com/blog/javascript-cannot-read-property-addeventlistener-null

  // Déclaration d'une constante pour pouvoir récupérer le bouton contact du menu :
  var btn = document.querySelector(".btn-contact");
  // Déclaration d'une constante pour aller récupérer dans le DOM l'élément avec l'id `mymodale`:
  var modale = document.getElementById("mymodale");
  var single = document.getElementById("versmodale");

  // Vérifier si l'élément avec l'id "versmodale" existe avant de continuer:
  if (modale) {
    // Ouverture/fermeture de la modale contact
    // http://www.w3bai.com/fr/howto/howto_css_modals.html#gsc.tab=0
    // When the user clicks on the button, open the modal :
    btn.addEventListener("click", () => {
      console.log("Clic sur le bouton contact");
      modale.style.display = "block";
    });

    // When the user clicks anywhere outside of the modal, close it :
    window.onclick = function (event) {
      if (event.target == modale) {
        modale.style.display = "none";
      }
    };

    // ---------- Single-post / Si une réf. photo existe, on la récupère, on ouvre la modale et on fait apparaître la réf dedans ------------------

    // https://gomakethings.com/strategies-for-working-with-data-attributes-in-vanilla-javascript/
    single.addEventListener("click", (event) => {
      const reference = event.target.getAttribute("data-reference"); // "data-reference" renvoie à un ID ajouté dans single-photos et qui récupère en php la réf de la photo

      // Attribution de la valeur de la référence au champ de formulaire `#reference`.
      const referenceField = document.querySelector(
        '[data-name="ref-photo"] input[type="text"]'
      );

      if (referenceField) {
        referenceField.value = reference;
        modale.style.display = "block";
      } else {
        console.error("L'élément avec l'ID 'ref-photo' n'a pas été trouvé."); // "ref-photo" étant l'ID relatif au paramétrage du contact Form7
      }
    });
  }
});
