<div class="dashboardSideBar" id="dashboardSideBar">
       <div class="sideBarLogo">
        <a href=""><img id="sideBarLogo" src="images/E-SCLEPIUS LOGO (2).svg" alt="E-sclepius Logo" /></a>
       </div> 
        <div class="sideBarUser" id="userName">
            <img src="images/user/USER ICON.svg" alt="User Image"/>
            <span> <?= $user['first_name']. ' '. $user['last_name']?></span>
        </div>
        <div class="sideBarMenu">
            <ul class="mainMenu">
                <li class="mainMenu">
                    <a href="./dashboard.php" class="sideBarIcon" id="dashboardIcon"><i class="fa fa-home"> <span class="sideBarText" id="dashboardText">DASHBOARD</span></i></a>
                </li>
<!-- Product Management -->
                <li class="mainMenu showHideSubMenu" data-submenu="user">
                    <a href="javascript:void(0)" class="sideBarIcon mainMenu_link showHideSubMenu" data-submenu="user" id="userIcon">
                        <i class="fa fa-archive"></i>
                        <span class="sideBarText  showHideSubMenu" data-submenu="user" id="userText">PRODUCTS</span>
                        <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" data-submenu="user" id="mainMenuIconArrow"></i></a>
                    <ul class="subMenus" id="user">
                        <li class="subMenuItem"><a href="" class="subMenuLink"><i class="fa fa-circle-o"></i> View products</a></li>
                        <li class="subMenuItem"><a href="" class="subMenuLink"><i class="fa fa-circle-o"></i> Add product</a></li>
                    </ul>
                </li>
<!--Supplier Management -->
                <li class="mainMenu showHideSubMenu" data-submenu="user">
                    <a href="javascript:void(0)" class="sideBarIcon mainMenu_link showHideSubMenu" data-submenu="user" id="userIcon">
                        <i class="fa fa-truck"></i>
                        <span class="sideBarText showHideSubMenu" data-submenu="user" id="userText">SUPPLIERS</span>
                        <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" data-submenu="user" id="mainMenuIconArrow"></i></a>
                    <ul class="subMenus" id="user">
                        <li class="subMenuItem"><a href="" class="subMenuLink"><i class="fa fa-circle-o"></i> View suppliers</a></li>
                        <li class="subMenuItem"><a href="" class="subMenuLink"><i class="fa fa-circle-o"></i> Add suppliers</a></li>
                    </ul>
                </li>
<!--USER MANAGEMENT -->
                <li class="mainMenu showHideSubMenu" data-submenu="user">
                    <a href="javascript:void(0)" class="sideBarIcon mainMenu_link showHideSubMenu" data-submenu="user" id="userIcon">
                        <i class="fa fa-user-plus"></i>
                        <span class="sideBarText showHideSubMenu" data-submenu="user" id="userText">USERS</span>
                        <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu" data-submenu="user" id="mainMenuIconArrow"></i></a>
                    <ul class="subMenus" id="user">
                        <li class="subMenuItem"><a href="#" class="subMenuLink"><i class="fa fa-circle-o"></i> View users</a></li>
                        <li class="subMenuItem"><a href="./users-add.php" class="subMenuLink"><i class="fa fa-circle-o"></i> Add users</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>