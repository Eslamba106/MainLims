@extends('layouts.dashboard')
@section('title')
    <?php $lang = Session::get('locale');
    
    $currentUrl = url()->current();
    $segments = explode('/', $currentUrl);
    $submission = $segments[count($segments) - 2];
    ?>

    {{ __('roles.submission_managment') }}
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('roles.submission_managment') }}</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">{{ __('dashboard.home') }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('dashboard.dashboard') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div style="  display: flex; justify-content: center ">
        <div class="d-flex flex-wrap gap-10 justify-content-between mb-4">
            <div class="d-flex flex-column  gap-10">

                <div class="d-flex justify-content-between align-items-center" style="gap: 20px;">
                    <p class="text-capitalize mb-0">
                        {{ __('samples.sample_id') }} : {{ $sample->submission_number }}
                    </p>
                    <p class="text-capitalize mb-0">
                        {{ __('results.collection_date') }} :
                        {{ \Carbon\Carbon::parse($sample->sampling_date_and_time)->format('M d, Y h:i A') }}
                    </p>
                </div>

                <div class="">
                    <i class="tio-date-range"></i>
                </div>
            </div>

        </div>
    </div>

    <form action="{{ route('admin.result.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- {{ dd($sample->master_sample) }} --}}
        <input type="hidden" name="sample_id" value="{{ $sample->master_sample }}">
        <input type="hidden" name="submission_id" value="{{ $sample->id }}">
        @foreach ($sample->submission_test_method_items as $item_test_method)
            <div class="row gx-2 gy-3 mt-2" id="printableArea">
                <div class="col-lg-8 col-xl-9">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Body -->
                        <div class="card-header">
                            <div class="d-flex gap-2">
                                <h4 class="mb-0">{{ $item_test_method->sample_test_method->master_test_method->name }}
                                </h4>
                            </div>
                        </div>
                        <input type="hidden" name="sample_test_method_items[]"
                            value="{{ $item_test_method->sample_test_method->master_test_method->id }}">
                        <div class="card-body bg-light">
                            <input type="hidden" name="sample_test_method_id[]"
                                value="{{ $item_test_method->sample_test_method->id }}">
                            <hr>

                            @foreach ($item_test_method->sample_test_method->sample_test_method_items as $sample_test_method_item)
                                {{-- @foreach ($item_test_method->sample_test_method as $sample_test_method_item)  --}}
                                <div class="row">
                                    <div class="col-md-6 col-lg-2 col-xl-3">
                                        <span class="title-color break-all"> {{ __('test_method.component') }} :
                                            <strong> </strong></span>

                                        <div class="form-group">
                                            <input type="text" class="form-control" style="border-radius: 5%" readonly
                                                value="{{ $sample_test_method_item->test_method_item->name }}">
                                            <input type="text" class="form-control" style="border-radius: 5%"
                                                name="test_method_items[]" hidden readonly
                                                value="{{ $sample_test_method_item->test_method_item->id }}">

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <span class="title-color break-all"> {{ __('results.result') }} :
                                            <strong> </strong></span>

                                        <div class="form-group">
                                            <input type="text" class="form-control" style="border-radius: 5%"
                                                name="result-{{ $sample_test_method_item->test_method_item->id }}">
                                        </div>
                                        @error("result-{{ $sample_test_method_item->test_method_item->id }}")
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-3">
                                        <span class="title-color break-all"> {{ __('test_method.unit') }} :
                                            <strong> </strong></span>

                                        <div class="form-group">
                                            <select class="form-control"
                                                name="unit_id-{{ $sample_test_method_item->test_method_item->id }}"
                                                id="">
                                                <option value="" selected disabled>
                                                    {{ __('test_method.select_unit') }}</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">
                                                        {{ $unit->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error("result-{{ $sample_test_method_item->test_method_item->id }}")
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-3">
                                        <span class="title-color break-all"> {{ __('roles.status') }} :
                                            <strong> </strong></span>

                                        <span class="badge bg-success"><i class="fa-solid fa-check-circle me-1"></i>
                                            {{ __('results.in_range') }}</span>
                                        {{-- <span class="badge bg-danger"><i class="fa-solid fa-xmark-circle me-1"></i>
                                        {{ __('results.out_of_range') }}</span> --}}
                                    </div>



                                </div>
                            @endforeach

                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-lg-4 col-xl-3">
                    <!-- Card -->
                    <div class="card">

                        <!-- Body -->
                        @if ($sample)
                            <div class="card-body">
                                {{-- <h4 class="mb-4 d-flex align-items-center gap-2"> 
                                {{ __('companies.info') }}
                            </h4> --}}

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="p-3 rounded" style="background-color: #fff8dc;">
                                            <small class="text-muted d-block">Warning Limit</small>
                                            <span class="text-warning fw-bold"
                                                id="warning_limit_type-${component.id}"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="p-3 rounded" style="background-color: #ffeeee;">
                                            <small class="text-muted d-block">Action Limit</small>
                                            <span class="text-danger fw-bold" id="action_limit_type-${component.id}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <span>{{ __('login.user_not_found') }}</span>
                                </div>
                            </div>
                        @endif
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        @endforeach
        <div>
            <div class="form-group mt-2"
                @if (session()->get('locale') == 'ar') style="text-align: left;" @else style="text-align: right;" @endif>
                <button type="submit" class="btn btn-primary mt-2">{{ __('results.add_result') }}</button>
            </div>
        </div>
    </form>
@endsection
