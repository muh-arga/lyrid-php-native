<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <div class="sidebar-brand">
            <a href="../../index.php">Lyrid Test</a>
        </div>

        <ul class="sidebar-menu">
            <?php if(isAdmin()): ?>
                <li class="<?= $currentPage === 'user' ? 'active' : '' ?>">
                    <a class="nav-link" href="../user/index.php">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="<?= $currentPage === 'employee' ? 'active' : '' ?>">
                <a class="nav-link" href="../employee/index.php">
                    <i class="fas fa-user"></i>
                    <span>Employees</span>
                </a>
            </li>
        </ul>

    </aside>
</div>