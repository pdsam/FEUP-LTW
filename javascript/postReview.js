let reviewForm = document.getElementById('review-form');
let errorField = document.getElementById('review-error-label');

let houseID = new URL(window.location.href).searchParams.get('id');

function getFormValue(form, fieldName) {
    return form.elements[fieldName].value;
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

function showError(errorMessage) {
    errorField.style.display = "block";
    errorField.innerHTML = errorMessage;
}

function handleResponse(event) {
    let responseText = event.currentTarget.responseText;
    console.log(event.currentTarget.responseText);

    let json = JSON.parse(responseText);

    if (json['result'] == 'error') {
        if (json['type'] === '1') {
            window.location.href = '..pages/home.php';
            return;
        }
        showError(json['message']);
        return;
    }

    window.location = '../pages/house.php?h=' + houseID;
}

reviewForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    let request = new XMLHttpRequest();
    request.open('post', '../actions/action_postReview.php', true);

    request.addEventListener('load', handleResponse);
    request.send(new FormData(reviewForm));
});