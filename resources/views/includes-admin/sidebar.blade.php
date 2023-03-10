<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu"
                        data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                        <span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="margin-top: -30px">
            <ul id="sidebarnav">
                <li class="nav-small-cap">--- MAIN MENU</li>
                @if (Auth::user()->level == 'admin')
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false">
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('user.index') }}" aria-expanded="false">
                        <span class="hide-menu">Data Petugas</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('masyarakat.index') }}" aria-expanded="false">
                        <span class="hide-menu">Data Masyarakat</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('pengaduanadmin.index') }}" aria-expanded="false">
                        <span class="hide-menu">Pengaduan Masyarakat</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('laporan.index') }}" aria-expanded="false">
                        <span class="hide-menu">Generate Laporan</span>
                    </a>
                </li>
                @else
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false">
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('pengaduanadmin.index') }}" aria-expanded="false">
                        <span class="hide-menu">Pengaduan Masyarakat</span>
                    </a>
                </li>
                @endif
                
            </ul>
        </nav>
    </div>
</aside>
