let tabbedContent = document.getElementById('tabbed-content');

let descriprionTab = document.getElementById('description-tab');
let reviewsTab = document.getElementById('reviews-tab');

let houseId = new URL(window.location.href).searchParams.get('h');

let rightArrow = document.getElementById('right-arrow');
let leftArrow = document.getElementById('left-arrow');

let housePics = document.getElementById('image-wrapper').getElementsByClassName('house-image');
let currentImageDis = 0;

//Hide all house images except the first
for (let i = 1; i < housePics.length; i++) {
    housePics[i].style.display = "none";
}


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

rightArrow.addEventListener('click', (e) => {
    housePics[currentImageDis].style.display = "none";
    currentImageDis = (currentImageDis + 1) % housePics.length;
    housePics[currentImageDis].style.display = "block";
});

