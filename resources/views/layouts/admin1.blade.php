
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Elite Admin Template - The Ultimate Multipurpose admin template</title>
    @include('includes-admin.css')

</head>

<body class="skin-default-dark fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>

    
    
    <div id="main-wrapper">
        @include('includes-admin.navbar')
        @include('includes-admin.sidebar')

        <div class="page-wrapper">
            <div class="container-fluid">
                    <div class="content">

                        @yield('content')
                </div>	

                {{-- @include('includes-admin.warna') --}}
            </div>
        </div>
        

    </div>
    <footer class="footer">
        © 2021 Eliteadmin by themedesigner.in
        <a href="https://www.wrappixel.com/">WrapPixel</a>
    </footer>
    @include('includes-admin.js')
</body>

</html>