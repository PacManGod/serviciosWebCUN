// Obtén todos los elementos con la clase "form"
var formElements = document.querySelectorAll(".form");

// Itera a través de los elementos con la clase "form"
formElements.forEach(function (formElement) {
  // Obtén todos los elementos "input" y "textarea" dentro del formulario actual
  var inputElements = formElement.querySelectorAll("input, textarea");

  // Agrega eventos "keyup", "blur" y "focus" a cada elemento "input" y "textarea"
  inputElements.forEach(function (inputElement) {
    inputElement.addEventListener("keyup", function (e) {
      var label = inputElement.previousElementSibling;

      if (e.type === "keyup") {
        if (inputElement.value === "") {
          label.classList.remove("active", "highlight");
        } else {
          label.classList.add("active", "highlight");
        }
      }
    });

    inputElement.addEventListener("blur", function () {
      var label = inputElement.previousElementSibling;

      if (inputElement.value === "") {
        label.classList.remove("active", "highlight");
      } else {
        label.classList.remove("highlight");
      }
    });

    inputElement.addEventListener("focus", function () {
      var label = inputElement.previousElementSibling;

      if (inputElement.value === "") {
        label.classList.remove("highlight");
      } else if (inputElement.value !== "") {
        label.classList.add("highlight");
      }
    });
  });
});

// Obtén todos los elementos con la clase "tab" y agrega un evento "click" a cada uno
var tabLinks = document.querySelectorAll(".tab a");

tabLinks.forEach(function (tabLink) {
  tabLink.addEventListener("click", function (e) {
    e.preventDefault();

    // Agrega la clase "active" al elemento padre actual y elimina "active" de los hermanos
    var tabItem = tabLink.parentElement;
    tabItem.classList.add("active");
    var siblings = getSiblings(tabItem);
    siblings.forEach(function (sibling) {
      sibling.classList.remove("active");
    });

    // Obtiene el valor del atributo "href" del enlace
    var target = tabLink.getAttribute("href");

    // Oculta los elementos en ".tab-content > div" que no son el destino y muestra el destino
    var tabContentItems = document.querySelectorAll(".tab-content > div");
    tabContentItems.forEach(function (tabContentItem) {
      if (tabContentItem !== target) {
        tabContentItem.style.display = "none";
      }
    });

    document.querySelector(target).style.display = "block";
  });
});

// Función para obtener todos los hermanos de un elemento
function getSiblings(element) {
  var siblings = [];
  var sibling = element.parentNode.firstChild;

  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== element) {
      siblings.push(sibling);
    }
    sibling = sibling.nextSibling;
  }

  return siblings;
}
