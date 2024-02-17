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
                <li>
                    <a href="" id="revManIcon"><i class="fa fa-money"> <span id="revManText">REVENUE MANAGEMENT</span></i></a>
                </li>
                <li>
                    <a href="" id="accRecIcon"><i class="fa fa-book"> <span id="accRecText">ACCOUNTS RECEIVABLE</span></i></a>
                </li>
                <li>
                    <a href="" id="configIcon"><i class="fa fa-cogs"> <span id="configText">CONFIGURATION</span></i></a>
                </li>
                <li>
                    <a href="" id="statsIcon"><i class="fa fa-bar-chart"> <span id="statsText">STATISTICS</span></i></a>
                </li>
            </ul>
        </div>