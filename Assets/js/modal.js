observer.observe(section);

document.addEventListener("DOMContentLoaded", function () {
  var btnContacto = document.querySelector(".btnContacto");
  var modal = document.getElementById("modal");
  var modalClose = document.querySelector(".close");

  btnContacto.addEventListener("click", function () {
    modal.style.display = "block";
  });

  modalClose.addEventListener("click", function () {
    modal.style.display = "none";
  });

  window.addEventListener("click", function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
});
