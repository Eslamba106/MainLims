@extends('admin.layouts.dashboard')
@section('title')
    {{ translate('header') }}
@endsection
@section('css')
    {{-- <link href="{{ asset('css/tags-input.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #dedede;
            border: 1px solid #dedede;
            border-radius: 2px;
            color: #222;
            display: flex;
            gap: 4px;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ translate('header') }}</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ translate('home') }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ translate('header') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="mb-5"></div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form action="{{ route('admin.tenant_management.store_tenant') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 col-lg-4 col-xl-6">

                                    <div class="form-group">
                                        <label for="">{{ translate('website_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="website_name" class="form-control" required />

                                        @error('website_name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2">
                                                <img src="{{ asset('/assets/back-end/img/footer-logo.png') }}"
                                                    alt="">
                                                {{ translate('loading_Gif') }}
                                            </h5>
                                            <span class="badge badge-soft-info">( {{ translate('ratio') }} 1:1 )</span>
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-around">
                                            <center>
                                                <img height="60" id="viewerLoader"
                                                    onerror="this.src='{{ asset('assets/images/image-place-holder.png') }}'"
                                                    {{-- src="{{ asset('storage/app/company') }}/{{ get_theme_settings('loader_gif') }}" --}}
                                                    >
                                            </center>
                                            <div class="position-relative mt-4">
                                                <input type="file" name="loader_gif" id="customFileUploadLoader"
                                                    class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                                <label class="custom-file-label"
                                                    for="customFileUploadLoader">{{ translate('choose_File') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="tenant_id" class="title-color">{{ translate('company_id') }} <span
                                                class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" required name="tenant_id">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group mt-2"
                                @if (session()->get('locale') == 'ar') style="text-align: left;" @else style="text-align: right;" @endif>
                                <button type="submit" class="btn btn-primary mt-2">{{ translate('save') }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
<script>
    
        $("#customFileUploadLoader").change(function() {
            read_image(this, 'viewerLoader');
        });

        function read_image(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection
