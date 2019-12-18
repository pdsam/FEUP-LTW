function hamburguerDraw() {
  let x = document.getElementById("hamburguer-nav");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

function hiddenMenuDraw() {
  let x = document.getElementById("filter-form");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}