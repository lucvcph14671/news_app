<div id="loading">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

        @yield('css')
        <!-- Libraries Stylesheet -->
        <link href="{{ asset('client/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('client/css/style.css') }}" rel="stylesheet">
    </head>

    <body>
        <!-- Topbar Start -->
        @include('client/layout/topbar')
        <!-- Topbar End -->


        <!-- Navbar Start -->
        @include('client/layout/navbar')
        <!-- Navbar End -->
        @yield('slider')
        <!-- News With Sidebar Start -->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @yield('content')
                    </div>

                    <div class="col-lg-4">
                        <!-- Social Follow Start -->
                        @include('client/follow/social_follow')
                        <!-- Social Follow End -->

                        <!-- Ads Start -->
                        @include('client/ads/ads')
                        <!-- Ads End -->

                        <!-- Popular News Start -->
                        @include('client/new/tranding_news')
                        <!-- Popular News End -->

                        <!-- Newsletter Start -->
                        @include('client/new/letter_news')
                        <!-- Newsletter End -->

                        <!-- Categories -->
                        @include('client/category/category')
                        <!-- Categories End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- News With Sidebar End -->


        <!-- Footer Start -->
        @include('client/layout/footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('client/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('client/lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('client/js/main.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
        </script>
        <script>
            var today = new Date();
            var date = 'Hôm nay ' + today.getDate() + ' Tháng ' + (today.getMonth() + 1) + ' Năm ' + today.getFullYear();
            var dateTime = date;

            document.getElementById("date-time").innerHTML = dateTime;
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @yield('js')
    </body>

    </html>

</div>
