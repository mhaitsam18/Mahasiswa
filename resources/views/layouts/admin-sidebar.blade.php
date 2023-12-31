<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            MAHASISWA<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body" id="background-mamhi">
        <ul class="nav">
            <li class="nav-item nav-category">Menu</li>
            @can('admin')
                <li class="nav-item">
                    <a href="/admin/index" class="nav-link @if ($page == 'index') active @endif">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Beranda</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($page == 'index') active @endif>" data-bs-toggle="collapse"
                        href="#datas" role="button" aria-expanded="false" aria-controls="datas">
                        <i class="link-icon" data-feather="database"></i>
                        <span class="link-title">Data</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="datas">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="/admin/user" class="nav-link @if ($page == 'user') active @endif">Data
                                    User</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/mahasiswa"
                                    class="nav-link @if ($page == 'mahasiswa') active @endif">Data mahasiswa</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('mahasiswa')
                <li class="nav-item">
                    <a href="/mahasiswa/index" class="nav-link @if ($page == 'index') active @endif">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</nav>
{{-- <nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                    value="sidebar-light" checked>
                <label class="form-check-label" for="sidebarLight">
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                    value="sidebar-dark">
                <label class="form-check-label" for="sidebarDark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item active" href="../demo1/dashboard.html">
                <img src="/assets-nobleui/images/screenshots/light.jpg" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item" href="../demo2/dashboard.html">
                <img src="/assets-nobleui/images/screenshots/dark.jpg" alt="light theme">
            </a>
        </div>
    </div>
</nav> --}}
<!-- partial -->
