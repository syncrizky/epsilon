<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <?php
                $db = new Database();
                $db->query("SELECT * FROM menus");
                $menus = $db->resultSet();
                ?>
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Core</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <?php foreach ($menus as $menu): ?>
                    <a class="nav-link  <?php echo ($_SESSION['menu'] == $menu['slug']) ? 'active collapse' : 'collapsed'; ?>" href="<?php echo ($menu['have_sub'] == 0) ? BASEURL . $menu['link'] : ''; ?>" <?php echo ($menu['have_sub'] == 1) ? 'data-bs-toggle="collapse" data-bs-target="#' . htmlspecialchars($menu['slug']) . '"' : ''; ?>>
                        <div class="nav-link-icon "><i data-feather="<?= $menu['feather_ico']; ?>"></i></div>
                        <?= $menu['name']; ?>
                        <?php if ($menu['have_sub'] == 1): ?>
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        <?php endif; ?>
                    </a>
                    <?php
                    $db->query("SELECT * FROM menu_sub WHERE menu_id = :menu_id");
                    $db->bind(':menu_id', $menu['id']);
                    $menu_subs = $db->resultSet();
                    ?>
                    <?php if ($menu['have_sub'] == 1): ?>
                        <div class="<?php echo ($_SESSION['menu'] == $menu['slug']) ? 'collapsed' : 'collapse'; ?>" id="<?= htmlspecialchars($menu['slug']); ?>" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">

                                <?php foreach ($menu_subs as $sub): ?>
                                    <a class="nav-link <?= ($_SESSION['sub'] === $sub['slug']) ? 'active' : ''; ?>" href="<?= BASEURL; ?><?= htmlspecialchars($sub['link']); ?>">
                                        <?= htmlspecialchars($sub['name']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

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
