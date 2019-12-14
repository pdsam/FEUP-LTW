
let editForm = document.getElementById('edit-profile-form');
let errorField = document.getElementById('profile-error-field')

function getFormValue(form, fieldName) {
    console.log(fieldName);
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
    console.log(event);

    let json = JSON.parse(responseText);

    if (json['result'] == 'error') {
        showError(json['message']);
        return;
    }

    //window.location = '../pages/profile.php';
}

editForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let firstName = getFormValue(editForm, 'fname');
    let lastName = getFormValue(editForm, 'lname');
    let email = getFormValue(editForm, 'email');
    let oldPassword = getFormValue(editForm, 'old-password');
    let newPassword = getFormValue(editForm, 'new-password');
    let cNewPassword = getFormValue(editForm,'new-c-password');
    let username = document.getElementById("hidden").textContent;

    console.log(username);
    if (newPassword != cNewPassword) {
        showError("Passwords do not match");
    }
    else{
    let request = new XMLHttpRequest();
    request.open('post', '../actions/action_updateProfile.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.addEventListener('load', handleResponse);
    request.send(encodeForAjax({
        firstname: firstName,
        lastname: lastName,
        username: username,
        email: email,
        oldPassword: oldPassword,
        newPassword: newPassword,
    }));
}
});