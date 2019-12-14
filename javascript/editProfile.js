let editButton = document.getElementById('edit-profile');
let editFormWrapper = document.getElementById('edit-form-wrapper');
let editFormContainer = document.getElementById('edit-form-container');
let editErrorLabel = document.getElementById('edit-error-label');
let editForm = document.getElementById('edit-profile-form')



editButton.addEventListener('click', () => {
    loginFormWrapper.style.display = "block";
});

editFormWrapper.addEventListener('click', () => {
    loginFormWrapper.style.display = "none";
});

editFormContainer.addEventListener('click', (e) => {
    e.stopPropagation();
});


function getFormValue(form, fieldName) {
    return form.elements[fieldName].value;
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }


editForm.addEventListener('submit', event=>{

    event.preventDefault();
    let url = "../actions/action_updateProfile.php";

    let firstName = getFormValue(editForm,'fName');
    let lastName = getFormValue(editForm,'lName');
    let email = getFormValue(editForm, 'email');
    
    let request = new XMLHttpRequest();
    request.open("post",url,true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    request.addEventListener('load',(event)=>{
        let text=event.currentTarget.responseText;
        console.log(text);

        let responseJson = JSON.parse(text);

        if(responseJson['result'] == error){
            loginErrorLabel.innerHTML = responseJson['message'];
            return;
        }
        window.location = '--/pages/profile.php';

    }
    );
    request.send(encodeForAjax({
        firstName: firstName,
        lastName: lastName,
        email: email,
    }

    ))



})