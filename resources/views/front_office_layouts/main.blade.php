<!-- =========

 Template Name: Play
 Author: UIdeck
 Author URI: https://uideck.com/
 Support: https://uideck.com/support/
 Version: 1.1

========== -->
@php
    
            $favicon = App\Models\LandingSettings::where('type', 'header_settings')->where('key' , 'header_favicon')->select('key', 'value' ,'type')->first();
        $logo = App\Models\LandingSettings::where('type', 'header_settings')->where('key' , 'header_logo')->select('key', 'value' ,'type')->first();
        
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
    <meta name="description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://uideck.com/play/">
    <meta property="og:title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
    <meta property="og:description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">
    <meta property="og:image" content="https://uideck.com/wp-content/uploads/2021/09/play-meta-bs.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://uideck.com/play/">
    <meta property="twitter:title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
    <meta property="twitter:description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">
    <meta property="twitter:image" content="https://uideck.com/wp-content/uploads/2021/09/play-meta-bs.jpg">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset( main_path().$favicon->value) }}" type="image/svg" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ asset(main_path() . 'landing/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset(main_path() . 'landing/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset(main_path() . 'landing/assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset(main_path() . 'landing/assets/css/ud-styles.css') }}" />
</head>
.

<body>
    <!-- ====== Header Start ====== -->
    @include('front_office_layouts.header')
    <!-- ====== Header End ====== -->

    @yield('content')

    <!-- ====== Footer Start ====== -->
    @include('front_office_layouts.footer')
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
        <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            swal("Message", "{{ Session::get('error') }}", 'error', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@if ($errors->any())
    <script>
        let errorMessages = @json($errors->all());
        errorMessages.forEach(msg => {
            swal("Error", msg, 'error', {
                button: "Ok",
                timer: 4000
            });
        });
    </script>
@endif
    <!-- ====== All Javascript Files ====== -->
    <script src="{{ asset(main_path() . 'landing/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(main_path() . 'landing/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset(main_path() . 'landing/assets/js/main.js') }}"></script>
    <script>
        // ==== for menu scroll
        const pageLink = document.querySelectorAll(".ud-menu-scroll");

        pageLink.forEach((elem) => {
            elem.addEventListener("click", (e) => {
                e.preventDefault();
                document.querySelector(elem.getAttribute("href")).scrollIntoView({
                    behavior: "smooth",
                    offsetTop: 1 - 60,
                });
            });
        });

        // section menu active
        function onScroll(event) {
            const sections = document.querySelectorAll(".ud-menu-scroll");
            const scrollPos =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop;

            for (let i = 0; i < sections.length; i++) {
                const currLink = sections[i];
                const val = currLink.getAttribute("href");
                const refElement = document.querySelector(val);
                const scrollTopMinus = scrollPos + 73;
                if (
                    refElement.offsetTop <= scrollTopMinus &&
                    refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
                ) {
                    document
                        .querySelector(".ud-menu-scroll")
                        .classList.remove("active");
                    currLink.classList.add("active");
                } else {
                    currLink.classList.remove("active");
                }
            }
        }

        window.document.addEventListener("scroll", onScroll);
    </script>
</body>

</html>
