
<!DOCTYPE html>
<html lang="en">

 @include('include-m.header')
<body class="horizontal-nav skin-megna fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <div id="main-wrapper">
        @include('include-m.navbar')
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>


        <footer class="footer">
            © 2021 Eliteadmin by themedesigner.in
            <a href="https://www.wrappixel.com/">WrapPixel</a>
        </footer>
    </div>
    @include('sweetalert::alert')
    @include('include-m.js')
</body>

</html>