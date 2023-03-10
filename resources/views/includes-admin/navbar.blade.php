<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}"><b>

                    <img src="{{asset('./assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                    <img src="{{asset('./assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span>
                 <img src="{{asset('./assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                 <!-- Light Logo text -->    
                 <img src="{{asset('./assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /></span> </a>
        </div>
        <div class="navbar-collapse">

            <ul class="navbar-nav me-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>

                <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li>
            </ul>

            <ul class="navbar-nav my-lg-0">
                <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
            </ul>
        </div>
    </nav>
</header>