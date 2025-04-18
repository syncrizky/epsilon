<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Core</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <a class="nav-link" href="<?= BASEURL; ?>">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboards
                </a>
                <!-- Sidenav Menu Heading (Management Stock)-->
                <div class="sidenav-menu-heading">Management Stock</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <a class="nav-link" href="<?= BASEURL; ?>">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboards
                </a>
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title"><?= htmlspecialchars(ucwords($_SESSION['user']['name'])); ?></div>
            </div>
        </div>
    </nav>
</div>

<!-- Menu Dropdown -->
<!-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
    <div class="nav-link-icon"><i data-feather="activity"></i></div>
    Dashboards
    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
        <a class="nav-link" href="dashboard-1.html">
            Default
            <span class="badge bg-primary-soft text-primary ms-auto">Updated</span>
        </a>
        <a class="nav-link" href="dashboard-2.html">Multipurpose</a>
        <a class="nav-link" href="dashboard-3.html">Affiliate</a>
    </nav>
</div> -->
