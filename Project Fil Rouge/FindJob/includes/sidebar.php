<?php
if (!isset($base)) $base = '.';
if (!isset($current_page)) $current_page = '';
?>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">Find<span>Job</span></div>
        <div class="role-badge">Admin</div>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="<?php echo $base; ?>/dashboard.php" class="<?php echo $current_page === 'dashboard' ? 'active' : ''; ?>">
                    <span class="icon">&#9632;</span> Dashboard
                </a>
            </li>
            <div class="nav-divider"></div>
            <li>
                <a href="<?php echo $base; ?>/users/index.php" class="<?php echo $current_page === 'users' ? 'active' : ''; ?>">
                    <span class="icon">&#9787;</span> Users
                </a>
            </li>
            <li>
                <a href="<?php echo $base; ?>/offres/index.php" class="<?php echo $current_page === 'offres' ? 'active' : ''; ?>">
                    <span class="icon">&#9998;</span> Offres
                </a>
            </li>
            <div class="nav-divider"></div>
            <li>
                <a href="<?php echo $base; ?>/users/create.php" class="<?php echo $current_page === 'add-user' ? 'active' : ''; ?>">
                    <span class="icon">+</span> Add User
                </a>
            </li>
            <li>
                <a href="<?php echo $base; ?>/offres/create.php" class="<?php echo $current_page === 'add-offre' ? 'active' : ''; ?>">
                    <span class="icon">+</span> Add Offre
                </a>
            </li>
        </ul>
    </nav>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
