let tabbedContent = document.getElementById('tabbed-content');

let descriprionTab = document.getElementById('description-tab');
let reviewsTab = document.getElementById('reviews-tab');

let houseId = new URL(window.location.href).searchParams.get('h');

function setReview(event) {
    tabbedContent.innerHTML = event.currentTarget.responseText;
    descriprionTab.className = "";
    reviewsTab.className = "selected-tab";
}

function setDescription(event) {
    tabbedContent.innerHTML = event.currentTarget.responseText;
    reviewsTab.className = "";
    descriprionTab.className = "selected-tab";
}

reviewsTab.addEventListener('click', (e) => {
    makeRequest('../actions/action_getReviews.php','get',setReview,{houseId : houseId});
});

descriprionTab.addEventListener('click', (e) => {
    makeRequest('../actions/action_getDescription.php','get',setDescription,{houseId : houseId});
});

