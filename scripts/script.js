// Responsive Menu - Dropdown

const body = document.body;
const hamburger = document.getElementById('hamburger');

hamburger.addEventListener('click', openMenu);

function openMenu() {
    body.classList.toggle('show');
}

