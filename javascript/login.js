let loginButton = document.getElementById('login-button');
let loginFormWrapper = document.getElementById('login-form-wrapper');
let loginFormContainer = document.getElementById('login-form-container');
let loginErrorLabel = document.getElementById('login-error-label');

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

loginForm.addEventListener('submit', (event) => {
    event.preventDefault();
    let url = "../actions/action_login.php";

    let request = new XMLHttpRequest();
    request.open("post", url, true);

    request.addEventListener('load', (event) => {
        let text = event.currentTarget.responseText;
        console.log(text);

        let responseJson = JSON.parse(text);

        if (responseJson['result'] == 'error') {
            loginErrorLabel.innerHTML = responseJson['message'];
            return;
        }

        window.location = '../pages/profile.php';
    });

    request.send(new FormData(loginForm));
});