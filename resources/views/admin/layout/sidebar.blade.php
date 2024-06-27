<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.beranda') }}" class="brand-link">
        <span class="brand-text font-weight-light">SPK-Topsis</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.beranda') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kriteria') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Data Kriteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.sub-kriteria') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Sub Kriteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.alternatif') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Data Alternatif</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.matrix') }}" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>Matrix Score</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.topsis.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-poll"></i>
                        <p>Perhitungan</p>
                    </a>
                </li>
                <li class="nav-header">Menu User</li>
                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>