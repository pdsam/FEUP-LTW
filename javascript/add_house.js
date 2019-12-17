let addHouseForm = document.getElementById('add-house-form');
let errorLabel = document.getElementById('house-form-error-label');

addHouseForm.addEventListener('submit', event => {
    event.preventDefault();

    makeRequest(
        '../actions/action_addHouse.php',
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

            window.location.href = `manage_house_pictures.php?houseId=${data['houseId']}`;
        },
        new FormData(addHouseForm)
    )
});