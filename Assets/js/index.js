const section = document.querySelector("#quien-soy");

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("animate__fadeInUp");
    } else {
      entry.target.classList.remove("animate__fadeInUp");
    }
  });
});
