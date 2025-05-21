<!DOCTYPE html>
<html @if (session()->has('locale') && session()->get('locale') == 'ar') dir="rtl" lang="ar" @else dir="ltr" lang="en" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(main_path().'assets/images/main_logo.jpg') }}">
    <title>{{ __('login.login') }}</title>
    <!-- Custom CSS -->
    <link href="{{ asset(main_path().'dist/css/style.min.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset(main_path().'assets/images/big/auth-bg.jpg') }}) no-repeat center center;background-size: cover;    width: 100vw;height: 100vh;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset(main_path().'assets/images/logo-icon.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">{{ __('login.sign_in') }}</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <ul class="nav nav-tabs w-fit-content mb-4">
                            <li class="nav-item">
                                <a class="nav-link type_link active" href="#"
                                    id="company-link">{{ __('general.company') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link type_link " href="#" id="admin-link">{{ __('general.admin') }}</a>
                            </li>
                        </ul>
                        <div class="col-12">
                            <div class="col-md-12 admin_form d-none admin-form" id="admin-form">
                                <form action="{{ route('admin.login') }}" method="post">
                                    @csrf
                                    @include('includes.auth.admin_login')
            
            
                                </form>
                            </div>
                            <div class="col-md-12 admin_form company-form" id="company-form">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    @include('includes.auth.company_login')
                                </form>
                            </div>
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
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
   
    </div>
   
 
    
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset(main_path().'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset(main_path().'assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset(main_path().'assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    
    </script>
     <script>
        $(".type_link").click(function(e) {
            e.preventDefault();
            $(".type_link").removeClass('active');
            $(".login_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            if (form_id === 'company-link') {
                $("#company-form").removeClass('d-none').addClass('active');
                $("#admin-form").removeClass('active').addClass('d-none');
            } else if (form_id === 'admin-link') {
                $("#admin-form").removeClass('d-none').addClass('active');
                $("#company-form").removeClass('active').addClass('d-none');
            }

        });
    </script>
</body>

</html>