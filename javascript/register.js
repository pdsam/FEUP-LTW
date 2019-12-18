
let registrationForm = document.getElementById('registration-form');
let errorField = document.getElementById('registration-error-field')

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
    console.log(responseText);

    let json = JSON.parse(responseText);

    if (json['result'] == 'error') {
        if (json['type'] === '1') {
            window.location.href = '../pages/home.php';
            return;
        }
        showError(json['message']);
        return;
    }

    window.location = '../pages/profile.php';
}

registrationForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let password = getFormValue(registrationForm, 'password');
    let confirmPass = getFormValue(registrationForm, 'cpassword');

    if (password != confirmPass) {
        showError("Passwords do not match");
        return;
    }

    let request = new XMLHttpRequest();
    request.open('post', '../actions/action_register.php', true);

    request.addEventListener('load', handleResponse);
    request.send(new FormData(registrationForm));
});