
let editForm = document.getElementById('edit-profile-form');
let errorField = document.getElementById('profile-error-field')

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
    console.log("event: "+event);

    let json = JSON.parse(responseText);

    if (json['result'] == 'error') {
        showError(json['message']);
        return;
    }

    window.location = '../pages/profile.php';
}

editForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let newPassword = getFormValue(editForm, 'new-password');
    let cNewPassword = getFormValue(editForm,'new-c-password');

    let form = new FormData(editForm);
    
    if (newPassword != cNewPassword) {
        showError("Passwords do not match");
    } else {
        let request = new XMLHttpRequest();
        request.open('post', '../actions/action_updateProfile.php', true);

        request.addEventListener('load', handleResponse);
        request.send(form);
        console.log(request);
    }
});