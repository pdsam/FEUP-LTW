let editHouseForm = document.getElementById('edit-house-form');
let errorLabel = document.getElementById('house-form-error-label');

const houseId = new URL(window.location.href).searchParams.get('houseId');

editHouseForm.addEventListener('submit', event => {
    event.preventDefault();

    let data = new FormData(editHouseForm);
    data.append('houseId', houseId);

    makeRequest(
        '../actions/action_editHouse.php',
        'post',
        e => {
            const data = JSON.parse(e.currentTarget.responseText);

            if (data['result'] === 'error') {
                if (data['type'] !== '1') {
                    errorLabel.innerHTML = data['message'];
                } else {
                    window.location.href = 'home.php';
                }
                return;
            }

            window.location.href = `house_overview.php?id=${data['houseId']}`;
        },
        data
    )
});