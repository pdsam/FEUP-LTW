function hamburguerDraw() {
    let x = document.getElementById("hamburguer-nav");
    console.log(x);
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }