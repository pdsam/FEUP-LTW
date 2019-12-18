function getFormValue(form, fieldName) {
    return form.elements[fieldName].value;
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

let reservationForm = document.getElementById('reservation-form');
let reservationErrorLabel = document.getElementById('reservation-error-label');

reservationForm.addEventListener('submit', (e)=>{
    e.preventDefault();

    console.log(getFormValue(reservationForm, 'checkInDate'));

    let request = new XMLHttpRequest();
    request.open("post", '../actions/action_reserve.php', true);

    request.addEventListener('load', (event) => {
        let text =event.currentTarget.responseText;
        console.log(text);

        let responseJson = JSON.parse(text);

        if (responseJson['result'] == 'error') {
            if (responseJson['type'] === '1') {
                window.location.href = '..pages/home.php';
                return;
            }
            reservationErrorLabel.innerHTML = responseJson['message'];
            return;
        }
        
        window.location = '../pages/user_reservations.php';
    });

    request.send(new FormData(reservationForm));
});