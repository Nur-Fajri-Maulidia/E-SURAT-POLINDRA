<nav class="offcanvas-collapse sidebar" id="sidebar">
    <ul class="nav">
        @can('Surat Umum Create', 'Surat Khusus Create')
            <li class="nav-item">
                <a href="{{ route('documents.create') }}" class="nav-link btn btn-md btn-primary" aria-expanded="false"
                    aria-controls="letter">
                    <i class="material-icons mr-2 ml-1">send</i>
                    <span class="menu-title text-white hovering"> Kirim Surat</span>
                </a>
            </li>
        @endcan
        @can('Dashboard')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="mr-2 material-icons-two-tone">dashboard</i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        @endcan
        @can('Category Index', 'Category Create', 'Category Update', 'Category Delete')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="mr-2 material-icons-two-tone">category</i>
                    <span class="menu-title">Category</span>
                </a>
            </li>
        @endcan
        @can('Surat Masuk Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('inbox.index') }}">
                    <i class="mr-2 material-icons-two-tone">inbox</i>
                    <span class="menu-title">Surat Masuk</span>
                </a>
            </li>
        @endcan
        @can('Surat Keluar Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('outbox.index') }}">
                    <i class="mr-2 material-icons-two-tone">outbox</i>
                    <span class="menu-title">Surat Keluar</span>
                </a>
            </li>
        @endcan
        @can('Notifikasi Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('notifications.index') }}">
                    <i class="mr-2 material-icons-two-tone">notifications</i>
                    <span class="menu-title">Notifikasi</span>
                </a>
            </li>
        @endcan
        @can('Unit Kerja Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('unit-kerjas.index') }}">
                    <i class="mr-2 material-icons-two-tone">assignment_ind</i>
                    <span class="menu-title">Unit Kerja</span>
                </a>
            </li>
        @endcan
        @can('Jabatan Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jabatans.index') }}">
                    <span class="mr-2 material-icons-two-tone"> admin_panel_settings</span>
                    <span class="menu-title">Jabatan</span>
                </a>
            </li>
        @endcan
        @can('Pangkat Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pangkat.index') }}">
                    <span class="mr-2 material-icons-two-tone">person_pin</span>
                    <span class="menu-title">Pangkat/Golongan</span>
                </a>
            </li>
        @endcan
        @can('Role Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <span class="mr-2 material-icons-two-tone">manage_accounts </span>
                    <span class="menu-title">Role</span>
                </a>
            </li>
        @endcan
        @can('Permission Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('permissions.index') }}">
                    <i class="mr-2 material-icons-two-tone">verified_user</i>
                    <span class="menu-title">Permission</span>
                </a>
            </li>
        @endcan
        @can('User Index')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="mr-2 material-icons-two-tone">people</i>
                    <span class="menu-title">Users</span>
                </a>
            </li>
        @endcan
    </ul>
</nav>
