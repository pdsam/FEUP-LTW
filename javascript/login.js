
let loginButton = document.getElementById('login-button');
let loginFormWrapper = document.getElementById('login-form-wrapper');
let loginFormContainer = document.getElementById('login-form-container');

loginButton.addEventListener('click', () => {
    loginFormWrapper.style.display = "block";
});

loginFormWrapper.addEventListener('click', () => {
    loginFormWrapper.style.display = "none";
});

loginFormContainer.addEventListener('click', (e) => {
    e.stopPropagation();
});

let loginForm = document.getElementById('login-form');

function getFormValue(form, fieldName) {
    return form.elements[fieldName].value;
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

loginForm.addEventListener('submit', (event) => {
    event.preventDefault();
    let url = "actions/login.php";

    let username = getFormValue(loginForm, 'username');
    let pw = getFormValue(loginForm, 'password');

    loginForm.reset();

    let request = new XMLHttpRequest();
    request.open("post", url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    request.addEventListener('load', (event) => {
        console.log(event.currentTarget.responseText);
    });

    request.send(encodeForAjax({
        username: username,
        pw: pw
    }));
});