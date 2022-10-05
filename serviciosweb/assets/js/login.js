const passInput = document.querySelector(".input-group input");
const emailInput = document.querySelector(".input-user input");
const toggleIcon = document.querySelector(".input-group .toggle");
const ripple = document.querySelector(".input-group .ripple");
const percentBar = document.querySelector(".strength-percent span");
const passLabel = document.querySelector(".strength-label");

passInput.addEventListener("input", handlePassInput);
emailInput.addEventListener("input", handleEmailInput);
toggleIcon.addEventListener("click", togglePassInput);

const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const validarFormulario = () => {};

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e) => {
  e.preventDefault();
  inputs.forEach((input) => {
    if (input.value === "") {
      alert("Todos los campos son obligatorios");
    }
  });
});

// Estetica para password
function handlePassInput(e) {
  if (passInput.value.length === 0) {
    passLabel.innerHTML = "Nivel de seguridad";
    addClass();
  } else if (passInput.value.length <= 4) {
    passLabel.innerHTML = "Debil";
    addClass("weak");
  } else if (passInput.value.length <= 7) {
    passLabel.innerHTML = "Promedio";
    addClass("average");
  } else {
    passLabel.innerHTML = "Fuerte";
    addClass("strong");
  }
}

function addClass(className) {
  percentBar.classList.remove("Debil");
  percentBar.classList.remove("Promedio");
  percentBar.classList.remove("Fuerte");
  if (className) {
    percentBar.classList.add(className);
  }
}

function togglePassInput(e) {
  const type = passInput.getAttribute("type");
  if (type === "password") {
    passInput.setAttribute("type", "text");
    toggleIcon.innerHTML = "👌";
    ripple.style.cssText = `
    border-radius: 4px;
    width: 100%;
    height: 100%;
    right: 0;
    z-index: -1;
    `;
    passInput.style.color = "#000";
    passInput.style.background = "transparent";
    toggleIcon.style.fontSize = "27px";
  } else {
    passInput.setAttribute("type", "password");
    toggleIcon.innerHTML = "👀";
    toggleIcon.style.fontSize = "25px";
    ripple.style.cssText = `
    border-radius: 50%;
    height: 35px;
    width: 35px;
    right: 10px;
    z-index: 1;
    `;
    passInput.style.color = "#fff";
    passInput.style.background = "#112d37";
  }
}
