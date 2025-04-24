<div class="sidebar">  
    <!-- SidebarSearch Form -->  
    <div class="form-inline mt-2">  
        <div class="input-group" data-widget="sidebar-search">  
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">  
            <div class="input-group-append">  
                <button class="btn btn-sidebar">  
                    <i class="fas fa-search fa-fw"></i>  
                </button>  
            </div>  
        </div>  
    </div>  

    <!-- Sidebar Menu -->  
    <nav class="mt-2">  
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
            <li class="nav-item">  
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">  
                    <i class="nav-icon fas fa-home"></i>  
                    <p>Dashboard</p>  
                </a>  
            </li>  

            <li class="nav-header">Data Peminjam</li>  
            <li class="nav-item">  
                <a href="{{ url('/mahasiswa') }}" class="nav-link {{ ($activeMenu == 'mahasiswa') ? 'active' : '' }}">  
                    <i class="nav-icon fas fa-users"></i>  
                    <p>Data Mahasiswa</p>  
                </a>  
            </li>  
            <li class="nav-header">Data Penyedia</li>  
            <li class="nav-item">  
                <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}">  
                    <i class="nav-icon fas fa-bicycle"></i>  
                    <p>Kategori Sepeda</p>  
                </a>  
            </li>  
            <li class="nav-item">  
                <a href="{{ url('/rental') }}" class="nav-link {{ ($activeMenu == 'rental') ? 'active' : '' }}">  
                    <i class="nav-icon far fa-list-alt"></i>  
                    <p>Data Rental</p>  
                </a>  
            </li>  
        </ul>  
    </nav>  
</div>  