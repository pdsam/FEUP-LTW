let reservationsTable = document.getElementById('reservations-table');

let confirmedButton = document.getElementById('confirmed-reservations-tab');
let pendingButton = document.getElementById('pending-reservations-tab');

let houseId = new URL(window.location.href).searchParams.get('id');

function setTableContent(event) {
    reservationsTable.innerHTML = event.currentTarget.responseText;
}

confirmedButton.addEventListener('click', (e) => {
    reservationsTable.innerHTML = '';
    makeReqest('../actions/action_getReservations.php', 'get', setTableContent, {houseId:houseId, status:'accepted'});
});

pendingButton.addEventListener('click', (e) => {
    reservationsTable.innerHTML = '';
    makeReqest('../actions/action_getReservations.php', 'get', setTableContent, {houseId:houseId, status:'pending'});
});

makeReqest('../actions/action_getReservations.php', 'get', setTableContent, {houseId:houseId, status:'accepted'});
