<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Stunting</div>
    </a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <?php if (in_groups('admin')) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            User Management
        </div>

        <!-- Nav Item - User list -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin') ?>">
                <i class="fas fa-users"></i>
                <span>User List</span></a>
        </li>
    <?php endif; ?>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User Profile
    </div>


    <!-- Nav Item - My profile -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/profile'); ?>">
            <i class="fas fa-user"></i>
            <span>My Profile</span></a>
    </li>

    <!-- Nav Item - Edit Profile-->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-user-edit"></i>
            <span>Edit Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Stunting
    </div>

    <?php if (in_groups('admin')) : ?>
        <!-- Nav Item - My profile -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('databalita'); ?>">
                <i class="fas fa-server"></i>
                <span>Data Balita</span></a>
        </li>
    <?php endif; ?>

    <!-- Nav Item - Klasifikasi-->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('klasifikasi'); ?>">
            <i class="fas fa-cogs"></i>
            <span>Klasifikasi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout'); ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>