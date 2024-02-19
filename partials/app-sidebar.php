<div class="dashboardSideBar" id="dashboardSideBar">
       <div class="sideBarLogo">
        <a href=""><img id="sideBarLogo" src="images/E-SCLEPIUS LOGO (2).svg" alt="E-sclepius Logo" /></a>
       </div> 
        <div class="sideBarUser" id="userName">
            <img src="images/user/USER ICON.svg" alt="User Image"/>
            <span> <?= $user['first_name']. ' '. $user['last_name']?></span>
        </div>
        <div class="sideBarMenu">
            <ul>
                <li>
                    <a href="./dashboard.php" id="dashboardIcon"><i class="fa fa-home"> <span id="dashboardText">DASHBOARD</span></i></a>
                </li>
                <li>
                    <a href="./users-add.php" id="campaignIcon"><i class="fa fa-user-plus"> <span id="campaignText">ADD USER</span></i></a>
                </li>
            </ul>
        </div>