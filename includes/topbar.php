<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="d-none d-lg-block">
                <form class="app-search">
                    <div class="app-search-box dropdown">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search..." id="top-search">
                            <button class="btn input-group-text" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li>

            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fas fa-search"></i>
                </a>
            </li>

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                   href="#">
                    <i class="fas fa-window-maximize"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <?php if($admin_image==''){ ?>
                    <img src="assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                    <?php } else{ ?>
                        <img src="<?php echo $admin_image;?>" alt="user-image" class="rounded-circle">
                    <?php } ?>
                    <span class="pro-user-name ms-1">
                        <?php echo $admin_name;?> <i class="far fa-arrow-alt-circle-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="Profile" class="dropdown-item notify-item">
                        <i class="fas fa-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="Webinfo" class="dropdown-item notify-item">
                        <i class="fas fa-tools"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="Changepassword" class="dropdown-item notify-item">
                        <i class="fas fa-key"></i>
                        <span>Reset Password</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="logout.php" class="dropdown-item notify-item">
                        <i class="fas fa-power-off"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="#" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="<?php echo $logo; ?>" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="<?php echo $logo; ?>" alt="" height="20">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="#" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="<?php echo $logo; ?>" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="<?php echo $logo; ?>" alt="" height="60">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fas fa-align-justify"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>