@php
    $host = request()->getHost();
    $mainDomain = 'limsstage.com';
    $subdomain = null;
    $isSubdomain = false;

    if ($host !== $mainDomain) {
        $parts = explode('.', $host);
        $lastTwo = implode('.', array_slice($parts, -2));
        if ($lastTwo === $mainDomain) {
            $subdomain = implode('.', array_slice($parts, 0, -2));
            $isSubdomain = true;
        }
    }
@endphp

<header class="ud-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('landing-page') }}">
                        <img src="{{ asset( main_path().$logo->value) }}" alt="Logo" width="50px"
                            height="50px" id="logo_image" />
                    </a>
                    <button class="navbar-toggler">
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                    </button>

                    <div class="navbar-collapse">
                        <ul id="nav" class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#home">{{ translate('Home') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#features">{{ translate('Features') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#about">About</a>
                                </li> --}}
                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#pricing">{{ translate('Pricing') }}</a>
                            </li>
                              <li class="nav-item">
                                <a class="ud-menu-scroll" href="#contact">{{ translate('Contact') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('policy_page') }} ">{{ translate('Policy') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                    <a class="ud-menu-scroll" href="#team">Team</a>
                                </li> --}}
                          
                            @if ($isSubdomain)
                                <li class="nav-item">
                                    <a href="{{ route('login-page') }}"
                                        class="nav-item nav-link">{{ translate('login') }}</a>
                                </li>
                            @endif

                            {{-- <li class="nav-item nav-item-has-children">
                                    <a href="javascript:void(0)"> Pages </a>
                                    <ul class="ud-submenu">
                                        <li class="ud-submenu-item">
                                            <a href="about.html" class="ud-submenu-link">
                                                About Page
                                            </a>
                                        </li>
                                        <li class="ud-submenu-item">
                                            <a href="pricing.html" class="ud-submenu-link">
                                                Pricing Page
                                            </a>
                                        </li>
                                        <li class="ud-submenu-item">
                                            <a href="contact.html" class="ud-submenu-link">
                                                Contact Page
                                            </a>
                                        </li>
                                        <li class="ud-submenu-item">
                                            <a href="blog.html" class="ud-submenu-link">
                                                Blog Grid Page
                                            </a>
                                        </li>
                                        <li class="ud-submenu-item">
                                            <a href="blog-details.html" class="ud-submenu-link">
                                                Blog Details Page
                                            </a>
                                        </li>
                                        <li class="ud-submenu-item">
                                            <a href="login.html" class="ud-submenu-link">
                                                Sign In Page
                                            </a>
                                        </li>
                                        <li class="ud-submenu-item">
                                            <a href="404.html" class="ud-submenu-link">404 Page</a>
                                        </li>
                                    </ul>
                                </li> --}}
                        </ul>
                    </div>

                    {{-- <div class="navbar-btn d-none d-sm-inline-block">
                            <a href="login.html" class="ud-main-btn ud-login-btn">
                                Sign In
                            </a>
                            <a class="ud-main-btn ud-white-btn" href="javascript:void(0)">
                                Sign Up
                            </a>
                        </div> --}}
                </nav>
            </div>
        </div>
    </div>
</header>
