let sideBarIsOpen = true;

toggleBtn.addEventListener('click', (event) => {
    event.preventDefault();
    sideBarLogo.classList.toggle('hidden');
    dashboardSideBar.classList.toggle('minimized');
    dashboardIcon.classList.toggle('minimized');
    campaignIcon.classList.toggle('minimized');
    dashboardText.classList.toggle('hidden');
    campaignText.classList.toggle('hidden');
    userName.classList.toggle('hidden');
});
