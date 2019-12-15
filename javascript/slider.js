let slider = document.getElementById("myRange");
let output = document.getElementById("rangeValue");
output.innerHTML = slider.value;

slider.oninput = function () {
    output.innerHTML = this.value;
}