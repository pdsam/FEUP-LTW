let buttons = document.getElementsByClassName('cancel-reservation-button');

Array.prototype.forEach.call(buttons, element => {
    element.addEventListener('click', event => {
        if (!confirm("Are you sure you want to cancel the reservation?")) {
            return;
        }
        let formData = new FormData();
        
        formData.append('reservationId', element.id);
        formData.append('status', 'canceled');
        makeRequest(
            '../actions/action_setReservationStatus.php',
            'post',
            handleReservationStatusResponse,
            formData);
    });
});

function handleReservationStatusResponse(event) {
    let json = event.currentTarget.responseText;

    let data = JSON.parse(json);

    if (data['result'] === 'error') {
        if (data['type'] === '2') {
            alert(data['message']);
        } else {
            alert('An error has ocurred.');
            window.location = '../pages/home.php';
        }
        return;
    }

    location.reload();

    alert('Reservation status successfully updated.');
}