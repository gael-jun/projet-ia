<nav class="navbar navbar-expand topbar fixed-top border-1 mb-4 d-flex p-3  shadow " style="justify-content: space-between;background-color: rgb(238, 246, 248);">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=dashboard" style="text-decoration: none; font-weight: 900;">
        <div class="sidebar-brand-icon ">
            <img src="../assets/img/logo-medecine-traditionnelle.png" style="width: 60px; height: 60px;border-radius: 10px;">
        </div>
        <div class=" mx-2 font-weight-bold " style=" background-image: linear-gradient(to right, #636363, #09834C);
  -webkit-background-clip: text; /* Pour les navigateurs basés sur WebKit */
  -moz-background-clip: text; /* Pour les navigateurs basés sur Gecko */
  background-clip: text;
  color: transparent;
  font-size: 100px; font-family: 'American Typewriter, serif'; font-weight: 900;"><strong><h3>MedTrad</h3></strong></div>
    </a>

    <!-- Topbar Search -->
    

    <!-- Topbar Navbar -->
    <div>
        <ul class="navbar-nav ml-auto">
 

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell bx-sm" style="color:green"></i>
                    <span class="badge badge-danger badge-counter">3</span>
                </a>

                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">Alerts Center</h6>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-envelope bx-sm" style="color:green"></i>
                    <span class="badge badge-danger badge-counter">7</span>
                </a>

                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - Admin Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline txte" style="color: black;">Bienvenue Mr</span>
                    <img class="img-profile"
                        src="../assets/img/undraw_profile.svg" style="width: 40px; height: 40px;border-radius: 15px;">
                </a>
                <!-- Dropdown - Admin Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-user bx-fw mr-2 text-gray-400""></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-cog bx-fw mr-2 text-gray-400""></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="bx bx-log-out bx-fw mr-2 text-gray-400""></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>
    </div>
</nav>