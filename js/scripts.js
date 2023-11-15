console.log("hello");
// ----------------------------------Modale contact-----------------------------------------------------//
document.addEventListener("DOMContentLoaded", (event) => {
  // // ajout nécessaire de cette première ligne pour que .btn-contact soit retrouvé dans le DOM => https://bobbyhadz.com/blog/javascript-cannot-read-property-addeventlistener-null

  // Déclaration d'une constante pour pouvoir récupérer le bouton contact du menu :
  var btn = document.querySelector(".btn-contact");
  // Déclaration d'une constante pour aller récupérer dans le DOM l'élément avec l'id `mymodale`:
  var modale = document.getElementById("mymodale");
  var single = document.getElementById("versmodale");
  console.log(single);
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

  // Single-post / Si une réf. photo existe, on la récupére, on ouvre la modale et on fait apparaître la réf dedans:
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
});

// -------------------------- Fleche gauche, Flèche droite, dans le fichier single-post ----------------------------------------------------//
// comme dans le projet Print It

let numero = 0; // création de la variable "numéro", qui va changer tout au long du programme Et je l'initialise à 0
const slides = wp_get_attachment_image_src(); // img à la une

//Ajout du Eventlistener (ajoute un événement au clique de la souris sur chaque flèche)
const flecheGauche = document.querySelector(".fgauche");
flecheGauche.addEventListener("click", function () {
  console.log(flecheGauche);
  ChangeSlide(-1);
});

const flecheDroite = document.querySelector(".fdroite");
flecheDroite.addEventListener("click", function () {
  console.log(flecheDroite);
  ChangeSlide(1);
});

function ChangeSlide(sens) {
  // création de la fonction ChangeSlide, avec le paramètre "sens"
  numero = numero + sens;
  if (numero < 0) numero = slides.length - 1;
  if (numero > slides.length - 1) numero = 0;
  document.getElementById("").src = slides[numero]; // le "" renvoie à créa d'un id dans le fichier single-photo (image actuelle)
}
// ----------------------------------------------------------------------------------------------------------------------------------------------//
