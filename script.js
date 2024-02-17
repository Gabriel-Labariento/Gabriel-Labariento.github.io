let sideBarIsOpen = true;

toggleBtn.addEventListener('click', (event) => {
    event.preventDefault();
    sideBarLogo.classList.toggle('hidden');
    dashboardSideBar.classList.toggle('minimized');
    dashboardIcon.classList.toggle('minimized');
    campaignIcon.classList.toggle('minimized');
    revManIcon.classList.toggle('minimized');
    accRecIcon.classList.toggle('minimized');
    configIcon.classList.toggle('minimized');
    statsIcon.classList.toggle('minimized');
    dashboardText.classList.toggle('hidden');
    campaignText.classList.toggle('hidden');
    revManText.classList.toggle('hidden');
    accRecText.classList.toggle('hidden');
    configText.classList.toggle('hidden');
    statsText.classList.toggle('hidden');
    userName.classList.toggle('hidden');
    

});
