console.log("hello");

// ----------------------------------Modale contact-----------------------------------------------------//
document.addEventListener("DOMContentLoaded", (event) => {
  // ajout nécessaire de cette première ligne pour que .btn-contact soit retrouvé dans le DOM => https://bobbyhadz.com/blog/javascript-cannot-read-property-addeventlistener-null

  // Déclaration d'une constante pour pouvoir récupérer le bouton contact du menu :
  const btn = document.querySelector(".btn-contact");
  // Déclaration d'une constante pour aller récupérer dans le DOM l'élément avec l'id `mymodale`:
  const modale = document.getElementById("mymodale");
  const single = document.getElementById("versmodale");
  // Déclaration d'une constante pour récupérer le bouton "contact" du menu déroulant sur les mobiles :
  const mobile = document.getElementById("Btn-mobile");

  // Vérifier si l'élément avec l'id "mymodale" existe avant de continuer:
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

    // Ouverture de la modale sur les mobiles depuis le menu déroulant
    // Vérifier si l'élément avec l'id "mobile" existe avant de continuer:
    if (modale) {
      mobile.addEventListener("click", () => {
        console.log("Clic sur le bouton contact sur les mobiles");
        modale.style.display = "block";
      });

      // When the user clicks anywhere outside of the modal, close it :
      window.onclick = function (event) {
        if (event.target == modale) {
          modale.style.display = "none";
        }
      };
    }

    // ---------- Single-post / Si une réf. photo existe, on la récupère, on ouvre la modale et on fait apparaître la réf dedans ------------------

    // https://gomakethings.com/strategies-for-working-with-data-attributes-in-vanilla-javascript/
    if (single) {
      single.addEventListener("click", (event) => {
        const reference = event.target.getAttribute("data-reference"); // "data-reference" renvoie à un ID ajouté dans single-photos et qui récupère en PHP la référence de la photo

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
  }
});

// ------------------------------------- Burger Menu -----------------------------------------//
document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".burger");
  const nav = document.querySelector(".menuburger");
  const hero = document.getElementById("heroheader");
  const filters = document.querySelector(".filters-container");
  const content = document.querySelector(".photo-container");
  const charger = document.querySelector(".chargerplus");
  const footer = document.querySelector("footer");
  const post = document.querySelector("article");

  burger.addEventListener("click", () => {
    console.log("Clic sur le burger");
    // Lorsque l'on clique sur le burger :
    burger.classList.toggle("active"); // Le burger se transforme en croix
    nav.classList.toggle("open"); // On ouvre le menuburger qui comprend le menu rouge en plein écran
    console.log("menu responsive rouge ouvert");

    if (hero != null) {
      hero.classList.toggle("remove");
    }

    if (filters != null) {
      filters.classList.toggle("remove");
    }
    // on enlève les filtres
    if (content != null) {
      content.classList.toggle("remove");
    } // on enlève le content
    if (charger != null) {
      charger.classList.toggle("remove");
    } // on enlève "charger plus"
    if (post != null) {
      post.classList.toggle("remove");
    } // on enlève le post sur les pages "single-post"
    footer.classList.toggle("remove"); // ... et le footer
  });
});
