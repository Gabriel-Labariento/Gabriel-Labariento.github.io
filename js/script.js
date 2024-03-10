// Define initial state of sidebar
let sideBarIsOpen = true;

// Toggle button event listener
toggleBtn.addEventListener('click', (event) => {
    event.preventDefault();
    // Toggle visibility of sidebar elements
    sideBarLogo.classList.toggle('hidden');
    dashboardSideBar.classList.toggle('minimized');
    dashboardIcon.classList.toggle('minimized');
    productIcon.classList.toggle('minimized');
    supplierIcon.classList.toggle('minimized');
    userIcon.classList.toggle('minimized');
    dashboardText.classList.toggle('hidden');
    productText.classList.toggle('hidden');
    supplierText.classList.toggle('hidden');
    userText.classList.toggle('hidden');
    userName.classList.toggle('hidden');
    mainMenuIconArrow.classList.toggle('hidden');
});

// Function to show/hide submenu
function showHideSubMenu(subMenu, mainMenuIcon) {
    if (subMenu !== null) {
        // Toggle display of submenu
        if (subMenu.style.display === 'block' || getComputedStyle(subMenu).display === 'block') {
            subMenu.style.display = 'none';
            mainMenuIcon.classList.remove('fa-angle-down');
            mainMenuIcon.classList.add('fa-angle-left');
        } else {
            subMenu.style.display = 'block';
            mainMenuIcon.classList.remove('fa-angle-left');
            mainMenuIcon.classList.add('fa-angle-down');
        }
    }
}

// Document click event listener for submenu
document.addEventListener('click', function(e) {
    let clickedEl = e.target;

    // Check if clicked element is a submenu toggle
    if (clickedEl.classList.contains('showHideSubMenu')) {
        // Find corresponding submenu and its toggle icon
        let subMenu = clickedEl.closest('li').querySelector('.subMenus');
        let mainMenuIcon = clickedEl.closest('li').querySelector('.mainMenuIconArrow');

        // Hide other submenus
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if (subMenu !== sub)
                sub.style.display = 'none';
        });

        // Call function to show/hide submenu
        showHideSubMenu(subMenu, mainMenuIcon);
    }
});

// Highlight active menu item
const pathArray = window.location.pathname.split('/');
let curFile = pathArray[pathArray.length - 1];

let curNav = document.querySelector('a[href="./' + curFile + '"]');
if (curNav) {
    let mainNav = curNav.closest('li.mainMenu');
    mainNav.style.background = '#C8C8C8';

    let subMenu = curNav.closest('.subMenus');
    let mainMenuIcon = mainNav.querySelector('i.mainMenuIconArrow');

    // Show active submenu
    showHideSubMenu(subMenu, mainMenuIcon);
}
