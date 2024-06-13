const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  toggle = body.querySelector(".toggle");
// searchBtn = body.querySelector(".search-box"),
// modeSwitch = body.querySelector(".toggle-switch"),
// modeText = body.querySelector(".mode-text");
console.log({ sidebar });
toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

// searchBtn.addEventListener("click", () => {
//   sidebar.classList.remove("close");
// });

// modeSwitch.addEventListener("click", () => {
//   body.classList.toggle("dark");

//   if (body.classList.contains("dark")) {
//     modeText.innerText = "Light mode";
//   } else {
//     modeText.innerText = "Dark mode";
//   }
// });

document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav-link");
  console.log({ navLinks });

  const tabContents = document.querySelectorAll(".tab-content");

  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      const tab = this.getAttribute("data-tab");

      navLinks.forEach((link) => link.classList.remove("active"));
      this.classList.add("active");

      tabContents.forEach((content) => {
        if (content.id === tab) {
          content.classList.add("active");
        } else {
          content.classList.remove("active");
        }
      });
    });
  });
});
