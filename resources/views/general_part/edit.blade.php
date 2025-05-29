@extends('layouts.dashboard')
@section('title')
    {{ __('roles.create_test_method') }}
@endsection
@section('css')
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
                <h4 class="page-title">{{ __('roles.create_test_method') }}</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('dashboard.home') }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.dashboard') }}</li>
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
        <form action="{{ route('admin.' . $route . '.update', $main->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex gap-2">
                                <h4 class="mb-0">{{ __('roles.basic_information') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 col-lg-4 col-lg-6">

                                    <div class="form-group">
                                        <label for="">{{ __('roles.name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $main->name }}"
                                            class="form-control" />

                                        @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if ($route = 'frequency')
                                    <div class="col-md-6 col-lg-6 col-xl-6">

                                        <div class="form-group">
                                            <label for="">{{ __('roles.time_by_hours') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="time_by_hours" value="{{ $main->time_by_hours }}" class="form-control" />

                                            @error('time_by_hours')
                                                <span class="error text-danger">{{ $error }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>


                    </div>

                    <div>
                        <div class="form-group mt-2"
                            @if (session()->get('locale') == 'ar') style="text-align: left;" @else style="text-align: right;" @endif>
                            <button type="submit" class="btn btn-primary mt-2">{{ __('general.save') }}</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
@endsection
