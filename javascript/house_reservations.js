"use strict";

let reservationsTable = document.getElementById('reservations-table');

let tableHeader = document.createElement("div");
tableHeader.classList.add('table-header');
tableHeader.classList.add('reservations-table-row');
tableHeader.innerHTML = `
    <p>Tenant</p>
    <p>Check in date</p>
    <p>Check out date</p>
    <p>Number of people</p>
`;
let confirmedButton = document.getElementById('confirmed-reservations-tab');
let pendingButton = document.getElementById('pending-reservations-tab');

let houseId = new URL(window.location.href).searchParams.get('id');

function cancelReservationButton(reservationId) {
    let button = document.createElement('button');
    button.addEventListener('click', () => {
        if (!confirm("Are you sure you want to cancel the reservation?")) {
            return;
        }
        makeRequest(
            '../actions/action_setReservationStatus.php',
            'post',
            handleReservationStatusResponse,
            {reservationId: reservationId,
            status: 'canceled'});
    })
    button.innerHTML = 'Cancel';

    let buttonsDiv = document.createElement('div');
    buttonsDiv.classList.add('status-buttons-conatiner');
    buttonsDiv.appendChild(button);

    return buttonsDiv;
}

function pendingReservationButtons(reservationId) {
    let acceptBtn = document.createElement('button');
    acceptBtn.classList.add('status-button');
    acceptBtn.addEventListener('click', () => {
        acceptReservation(reservationId);
    });
    acceptBtn.innerHTML = 'Accept';
    let rejectBtn = document.createElement('button');
    rejectBtn.classList.add('status-button');
    rejectBtn.classList.add('reject-button');
    rejectBtn.addEventListener('click', () => {
        rejectReservation(reservtionId)
    });
    rejectBtn.innerHTML = 'Reject';

    let buttonsDiv = document.createElement('div');
    buttonsDiv.classList.add('status-buttons-conatiner');
    buttonsDiv.appendChild(acceptBtn);
    buttonsDiv.appendChild(rejectBtn);

    return buttonsDiv;
}

function setTableContent(event) {
    console.log(event.currentTarget.responseText);
    
    const data = JSON.parse(event.currentTarget.responseText);

    if (data['result'] === 'error') {
        alert('An error has ocurred.');
        window.location = '../pages/home.php';
        return;
    }

    console.log(data);

    reservationsTable.innerHTML = '';
    reservationsTable.appendChild(tableHeader);

    data['content'].forEach(reservation => {
        console.log(reservation);

        if (reservation['status'] !== data['reservationsStatus']) {
            return;
        }
        
        let tableRow = document.createElement('div');
        tableRow.id = `reservation${reservation['reservationId']}`;
        tableRow.classList.add('reservations-table-row');
        tableRow.classList.add('reservation');

        tableRow.innerHTML = `
            <a href="../pages/profile.php?id=${reservation['tenantId']}">    
                <p class="table-row-name">${reservation['tenantName']}</p>
            </a>
            <p>${reservation['startDate']}</p>
            <p>${reservation['endDate']}</p>
            <p>${reservation['numberOfPeople']}</p>
        `;

        let buttons;
        switch (reservation['status']) {
            case 'accepted':
                buttons = cancelReservationButton(reservation['reservationId']);
                break;
            case 'pending':
                buttons = pendingReservationButtons(reservation['reservationId']);
        }
        tableRow.appendChild(buttons);

        reservationsTable.appendChild(tableRow);
    });
}

confirmedButton.addEventListener('click', (e) => {
    reservationsTable.innerHTML = '';
    pendingButton.classList.remove('selected-tab');
    confirmedButton.classList.add('selected-tab');
    makeRequest('../actions/action_getReservations.php', 'get', setTableContent, {houseId:houseId, status:'accepted'});
});

pendingButton.addEventListener('click', (e) => {
    reservationsTable.innerHTML = '';
    confirmedButton.classList.remove('selected-tab');
    pendingButton.classList.add('selected-tab');
    makeRequest('../actions/action_getReservations.php', 'get', setTableContent, {houseId:houseId, status:'pending'});
});

makeRequest('../actions/action_getReservations.php', 'get', setTableContent, {houseId:houseId, status:'accepted'});

function handleReservationStatusResponse(event) {
    let json = event.currentTarget.responseText;

    let data = JSON.parse(json);

    if (data['result'] === 'error') {
        alert('An error has ocurred.');
        window.location = '../pages/home.php';
        return;
    }

    const row = document.getElementById(`reservation${data['reservationId']}`);
    row.parentElement.removeChild(row);

    alert('Reservation status successfully updated.');
}

function acceptReservation(reservationId) {
    if (!confirm('Are you sure you want to accept this reservation?')) {
        return;
    }
    makeRequest(
        '../actions/action_setReservationStatus.php', 
        'post', 
        handleReservationStatusResponse,
        {reservationId:reservationId, status:'accepted'});
}

function rejectReservation(reservationId) {
    if (!confirm('Are you sure you want to reject this reservation?')) {
        return;
    }
    makeRequest(
        '../actions/action_setReservationStatus.php', 
        'post', 
        handleReservationStatusResponse,
        {reservationId:reservationId, status:'rejected'});
}