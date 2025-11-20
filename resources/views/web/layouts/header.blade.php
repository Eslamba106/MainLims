@php
        $tenant_main = false;
            $host       = $request->getHost(); 
        $mainDomain = 'limsstage.com';
     
        if ($host != $mainDomain) {
            if (!session()->has('tenant_id')) {
                $tenant = \App\Models\Tenant::where('domain', $host)->first();
                $tenant_main = true;
            }
        }
@endphp  
    
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom border-2 border-white">
                <a href="index.html" class="navbar-brand">
                    <h1>Lims Stage</h1>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="project.html" class="nav-item nav-link">Projects</a>
                        @if($tenant_main)
                        <a href="{{ route('login-page') }}" class="nav-item nav-link">{{ translate('login') }}</a>
                        @endif
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>