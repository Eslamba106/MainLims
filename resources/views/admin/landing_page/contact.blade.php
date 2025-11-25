@extends('admin.layouts.dashboard')
@section('title')
    {{ translate('contact_section') }}
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
                <h4 class="page-title">{{ translate('contact_section') }}</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ translate('dashboard') }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ translate('contact_section') }}</li>
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
        <form action="{{ route('admin.landing_page_settings.contact.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 col-lg-6 col-xl-6">

                                    <div class="form-group">
                                        <label for="">{{ translate('title') }} <span
                                                class="text-danger">*</span></label>
                                        <textarea name="title" rows="5" class="form-control" required>{{ $title->value ?? '' }}</textarea>
                                        @error('title')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">

                                    <div class="form-group">
                                        <label for="">{{ translate('subtitle') }} <span
                                                class="text-danger">*</span></label>
                                        <textarea name="subtitle" rows="5" class="form-control" required>{{ $subtitle->value ?? '' }}</textarea>
                                        @error('subtitle')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>   
                                <div class="col-md-6 col-lg-6 col-xl-6">

                                    <div class="form-group">
                                        <label for="">{{ translate('email') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="email"  class="form-control" value="{{ $email->value ?? '' }} " required>
                                        @error('email')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
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
        $(document).ready(function() {
            // Initialize Dropify
            $('.dropify').dropify();
        });
    </script>
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
