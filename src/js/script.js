const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

const searchForm = document.querySelector("#content nav form");

// Define a function to handle the window resize event
function handleResize() {
  if (window.innerWidth < 768) {
    sidebar.classList.add("hide");
  } else {
    sidebar.classList.remove("hide");
  }
}

// Add the resize event listener to the window object
window.addEventListener("resize", handleResize);

// Call the handleResize function initially to set the initial state of the sidebar
handleResize();

const switchMode = document.getElementById("switch-mode");

switchMode.addEventListener("change", function () {
  if (this.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});
