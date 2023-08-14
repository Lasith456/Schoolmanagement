<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">BMMV</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url()?>dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>student">
        <i class="fas fa-fw fa-table"></i>
        <span>Students</span></a>
</li>
<!-- Nav Item - Teacher -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>teacher">
        <i class="fas fa-fw fa-table"></i>
        <span>Teacher</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url()?>excel">
        <i class="fas fa-fw fa-table"></i>
        <span>Excell</span></a>
</li>
<!-- Nav Item - Settings Collapse Menu -->
<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Settings</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admin:</h6>
                        <a class="collapse-item" href="<?php echo base_url()?>user">Users</a>
                    </div>
                </div>
            </li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
