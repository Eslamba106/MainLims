@extends('layouts.dashboard')
@section('title')
    {{ __('roles.create_sample') }}
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
                <h4 class="page-title">{{ __('roles.create_sample') }}</h4>
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
        <form action="{{ route('admin.sample.store') }}" method="post" enctype="multipart/form-data">
            @csrf
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

                                <div class="col-md-6   col-lg-6">
                                    <div class="form-group">
                                        <label for="">{{ __('samples.plant_name') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="main_plant_item" class="form-control">
                                            <option value="">{{ __('samples.select_plant') }}</option>
                                            @foreach ($plants as $plant_item)
                                                <option value="{{ $plant_item->id }}">{{ $plant_item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('main_plant_item')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6   col-lg-6">
                                    <div class="form-group">
                                        <label for="">{{ __('samples.sub_plant_name') }} </label>
                                        <select name="sub_plant_item" class="form-control" disabled>
                                            <option value="">{{ __('samples.select_sub_plant') }}</option>
                                        </select>
                                        @error('sub_plant_item')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-md-6   col-lg-6">
                                    <div class="form-group">
                                        <label for="">{{ __('samples.sample_name') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="sample_name" class="form-control" disabled>
                                            <option value="">{{ __('samples.select_sub_plant') }}</option>
                                        </select>
                                        @error('sample_name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> 

                                <div class="col-md-5 d-flex align-items-center mt-4 ml-2">
                                    <input type="checkbox" name="toxic" id="toxic" class="form-check-input me-2  ">
                                    <label for="toxic" class="form-check-label d-flex align-items-center">
                                        {{ __('samples.toxic') }}
                                        <span class="text-danger ms-1" style="font-size: 18px;">☠</span>
                                    </label>
                                </div>


                            </div>


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex gap-2">
                                <h4 class="mb-0">{{ __('samples.associated_test_method') }}</h4>
                            </div>
                        </div>
                        <div class="card-body  border border-primary">
                            <div class="row componants" id="componants">
                                <div class="col-md-6   col-lg-6">
                                    <div class="form-group">
                                        <label for="">{{ __('test_method.test_method') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="test_method" class="form-control">
                                            <option value="">{{ __('samples.select_test_method') }}</option>
                                            @foreach ($test_methods as $test_method_item)
                                                <option value="{{ $test_method_item->id }}">{{ $test_method_item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('test_method')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6   col-lg-6">
                                    <div class="form-group">
                                        <label for="">{{ __('test_method.component') }} <span
                                                class="text-danger">*</span></label>
                                        <select name="main_components" class="form-control">
                                            <option value="">{{ __('samples.select_component') }}</option>


                                        </select>
                                        @error('test_method')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="main_components  col-lg-12" id="main_components">

                                </div>

                            </div>
                            <div class="form-group mt-2"
                                @if (session()->get('locale') == 'ar') style="text-align: left;" @else style="text-align: right;" @endif>
                                <button type="button" onclick="add_test_method()" class="btn btn-secondary mt-2"><i
                                        class="mdi mdi-plus"></i>
                                    {{ __('samples.add_another_test_method') }}</button>
                            </div>



                        </div>
                        <div id="test_methods_main"></div>
                    </div>

                </div>
            </div>
            <div>
                <div class="form-group mt-2"
                    @if (session()->get('locale') == 'ar') style="text-align: left;" @else style="text-align: right;" @endif>
                    <button type="submit" class="btn btn-primary mt-2">{{ __('samples.create_sample') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script>
        $('select[name=main_plant_item]').on('change', function() {
            var tenant_id = $(this).val();
            if (tenant_id) {
                $.ajax({
                    url: "{{ route('admin.sample.get_sub_from_plant', ':id') }}".replace(':id',
                        tenant_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('select[name="sub_plant_item"]').empty().prop('disabled', true);
                            $('select[name="sample_name"]').empty().prop('disabled', true);
                            if (data && data.plants && data.plants.length > 0) {
                                $('select[name="sub_plant_item"]').empty().prop('disabled', false);
                                var select = $('select[name="sub_plant_item"]');
                                select.empty().prop('disabled', false);
                                select.append(
                                    '<option value="">{{ __('samples.select_sub_plant') }}</option>'
                                );
                                $.each(data.plants, function(index, plant) {
                                    select.append('<option value="' + plant.id + '">' + plant
                                        .name + '</option>');
                                });
                                if (data.samples && data.samples.length > 0) {
                                    var select = $('select[name="sample_name"]');
                                    select.empty().prop('disabled', false);

                                    $.each(data.samples, function(index, sample) {
                                        select.append('<option value="' + sample.id + '">' +
                                            sample
                                            .name + '</option>');
                                    });

                                }
                            } else if (data && data.samples && data.samples.length > 0) {
                                $('select[name="sample_name"]').empty().prop('disabled', false);
                                var select = $('select[name="sample_name"]');
                                select.empty().prop('disabled', false);

                                $.each(data.samples, function(index, sample) {
                                    select.append('<option value="' + sample.id + '">' + sample
                                        .name + '</option>');
                                });

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
        $('select[name=sub_plant_item]').on('change', function() {
            var tenant_id = $(this).val();
            if (tenant_id) {
                $.ajax({
                    url: "{{ route('admin.sample.get_sample_from_plant', ':id') }}".replace(':id',
                        tenant_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('select[name="sample_name"]').empty().prop('disabled', true);
                            if (data && data.samples && data.samples.length > 0) {
                                $('select[name="sample_name"]').empty().prop('disabled', false);
                                var select = $('select[name="sample_name"]');
                                select.empty().prop('disabled', false);

                                $.each(data.samples, function(index, sample) {
                                    select.append('<option value="' + sample.id + '">' + sample
                                        .name + '</option>');
                                });

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
        $('select[name=test_method]').on('change', function() {
            var tenant_id = $(this).val();
            if (tenant_id) {
                $.ajax({
                    url: "{{ route('admin.sample.get_components_by_test_method', ':id') }}".replace(':id',
                        tenant_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data) {
                            //   
                            if (data && data.components && data.components.length > 0) {
                                $('select[name="main_components"]').empty().prop('disabled', false);
                                var select = $('select[name="main_components"]');
                                select.empty().prop('disabled', false);
                                select.append(
                                    '<option value="-1">{{ __('samples.select_component') }}</option>'
                                );
                                select.append(
                                    '<option value="-1">{{ __('samples.select_all_component') }}</option>'
                                );

                                $.each(data.components, function(index, component) {
                                    select.append('<option value="' + component.id + '">' +
                                        component
                                        .name + '</option>');
                                });

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
        $('select[name=main_components]').on('change', function() {
            var component_id = $(this).val();
            var test_method_id = $('select[name=test_method]').val();
            if (component_id == -1) {
                $.ajax({
                    url: "{{ route('admin.sample.get_components_by_test_method', ':id') }}".replace(':id',
                        test_method_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            if (data && data.components && data.components.length > 0) {


                                $('#main_components').empty();

                                $.each(data.components, function(index, component) {

                                    $('#main_components').append(`
                                        <div class="container mt-4">
                                        <label class="form-label">Components & Limits:</label>

                                        <div class="border border-primary rounded p-3 mb-3"
                                            style="background-color: #f8f9fa;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div> 
                                                    <input type="checkbox" id="tds" name="component-${component.id}" checked>
                                                    <label for="tds" class="fw-bold text-primary">${component.name}</label>
                                                </div>
                                                <div class="text-end text-primary fw-bold">Unit:${component.main_unit && component.main_unit.name ? component.main_unit.name : 'N/A'}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit') }}</label>
                                                    <input type="number"  name="warning_limit-${component.id}" class="form-control"     onkeyup="only_one_general_change_warning_limit_type(${component.id})">
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit') }}</label>
                                                    <input type="number"  name="action_limit-${component.id}" class="form-control"     onkeyup="only_one_general_change_action_limit_type(${component.id} )">
                                                    </div>
                                            </div>
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit_type') }}</label>
                                                      <select name="warning_limit_type-${component.id}" class="form-control"   onchange="only_one_general_change_warning_limit_type(${component.id})">
                                                        <option value="">{{ __('samples.select_warning_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit_type') }}</label>
                                                   
                                                    <select name="action_limit_type-${component.id}" class="form-control"   onchange="only_one_general_change_action_limit_type(${component.id})">
                                                            <option value="">{{ __('samples.select_action_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #fff8dc;">
                                                        <small class="text-muted d-block">Warning Limit</small>
                                                        <span class="text-warning fw-bold" id="warning_limit_type-${component.id}"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #ffeeee;">
                                                        <small class="text-muted d-block">Action Limit</small>
                                                        <span class="text-danger fw-bold" id="action_limit_type-${component.id}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                      `);


                                });

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });

            } else {
                $.ajax({
                    url: "{{ route('admin.sample.get_one_component_by_test_method', ':id') }}".replace(
                        ':id',
                        component_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data) {
                            if (data && data.component) {

                                $('#main_components').empty();

                                $('#main_components').append(`
                                        <div class="container mt-4">
                                        <label class="form-label">Components & Limits:</label>

                                        <div class="border border-primary rounded p-3 mb-3"
                                            style="background-color: #f8f9fa;">
                                          
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div> 
                                                    <input type="checkbox" id="tds" name="component-${data.component.id}" checked>
                                                    <label for="tds" class="fw-bold text-primary">${data.component.name}</label>
                                                </div>
                                                <div class="text-end text-primary fw-bold">Unit:${data.component.main_unit && data.component.main_unit.name ? data.component.main_unit.name : 'N/A'}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit') }}</label>
                                                    <input type="number"  name="warning_limit-${data.component.id}" class="form-control"     onkeyup="only_one_change_warning_limit_type(${data.component.id})"> 
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit') }}</label>
                                                    <input type="number"  name="action_limit-${data.component.id}" class="form-control"     onkeyup="only_one_change_action_limit_type(${data.component.id})">
                                                    </div>
                                            </div>
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit_type') }}</label>
                                                      <select name="warning_limit_type-${data.component.id}" class="form-control"   onchange="only_one_change_warning_limit_type(${data.component.id})">
                                                        <option value="">{{ __('samples.select_warning_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit_type') }}</label>
                                                   
                                                    <select name="action_limit_type-${data.component.id}" class="form-control"   onchange="only_one_change_action_limit_type(${data.component.id})">
                                                            <option value="">{{ __('samples.select_action_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #fff8dc;">
                                                        <small class="text-muted d-block">Warning Limit</small>
                                                        <span class="text-warning fw-bold"  id="warning_limit_type-${data.component.id}"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #ffeeee;">
                                                        <small class="text-muted d-block">Action Limit</small>
                                                        <span class="text-danger fw-bold" id="action_limit_type-${data.component.id}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                      `);

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
    </script>
    <script>
        function change_action_limit_type(id) {
            var action_limit_type = document.querySelector('select[name=action_limit_type-'+id +']').value;
            var action_limit = document.querySelector('input[name=action_limit-'+id +']').value;

            if (action_limit_type == '=') {
                document.getElementById('action_limit_type-'+id).innerHTML = '= ' + action_limit;
            } else if (action_limit_type == '>=') {
                document.getElementById('action_limit_type-'+id).innerHTML = '&ge; ' + action_limit;
            } else if (action_limit_type == '<=') {
                document.getElementById('action_limit_type-'+id).innerHTML = '&le; ' + action_limit;
            } else if (action_limit_type == '<') {
                document.getElementById('action_limit_type-'+id).innerHTML = '&lt; ' + action_limit;
            } else if (action_limit_type == '>') {
                document.getElementById('action_limit_type-'+id).innerHTML = '&gt; ' + action_limit;
            }
        }

        function change_warning_limit_type(id) {
            var warning_limit_type = document.querySelector('select[name=warning_limit_type-'+id+']').value;
            var warning_limit = document.querySelector('input[name=warning_limit-'+id+']').value;

            if (warning_limit_type == '=') {
                document.getElementById('warning_limit_type-'+id).innerHTML = '= ' + warning_limit;
            } else if (warning_limit_type == '>=') {
                document.getElementById('warning_limit_type-'+id).innerHTML = '&ge; ' + warning_limit;
            } else if (warning_limit_type == '<=') {
                document.getElementById('warning_limit_type-'+id).innerHTML = '&le; ' + warning_limit;
            } else if (warning_limit_type == '<') {
                document.getElementById('warning_limit_type-'+id).innerHTML = '&lt; ' + warning_limit;
            } else if (warning_limit_type == '>') {
                document.getElementById('warning_limit_type-'+id).innerHTML = '&gt; ' + warning_limit;
            }
        }

        function only_one_change_action_limit_type(id) {
            var action_limit_type = document.querySelector('select[name=action_limit_type-' + id + ']').value;
            var action_limit = document.querySelector('input[name=action_limit-' + id + ']').value;

            if (action_limit_type == '=') {
                document.getElementById('action_limit_type-' + id).innerHTML = '= ' + action_limit;
            } else if (action_limit_type == '>=') {
                document.getElementById('action_limit_type-' + id).innerHTML = '&ge; ' + action_limit;
            } else if (action_limit_type == '<=') {
                document.getElementById('action_limit_type-' + id).innerHTML = '&le; ' + action_limit;
            } else if (action_limit_type == '<') {
                document.getElementById('action_limit_type-' + id).innerHTML = '&lt; ' + action_limit;
            } else if (action_limit_type == '>') {
                document.getElementById('action_limit_type-' + id).innerHTML = '&gt; ' + action_limit;
            }
        }

        function only_one_change_warning_limit_type(id) {
            var warning_limit_type = document.querySelector('select[name=warning_limit_type-' + id + ']').value;
            var warning_limit = document.querySelector('input[name=warning_limit-' + id + ']').value;

            if (warning_limit_type == '=') {
                document.getElementById('warning_limit_type-' + id).innerHTML = '= ' + warning_limit;
            } else if (warning_limit_type == '>=') {
                document.getElementById('warning_limit_type-' + id).innerHTML = '&ge; ' + warning_limit;
            } else if (warning_limit_type == '<=') {
                document.getElementById('warning_limit_type-' + id).innerHTML = '&le; ' + warning_limit;
            } else if (warning_limit_type == '<') {
                document.getElementById('warning_limit_type-' + id).innerHTML = '&lt; ' + warning_limit;
            } else if (warning_limit_type == '>') {
                document.getElementById('warning_limit_type-' + id).innerHTML = '&gt; ' + warning_limit;
            }
        }

        function general_change_action_limit_type(compnent_id, index) {
            var action_limit_type = document.querySelector('select[name="action_limit_type-' + compnent_id + '-' + index +
                '"]').value;
            var action_limit = document.querySelector('input[name=action_limit-' + compnent_id + '-' + index + ']').value;

            if (action_limit_type == '=') {
                document.getElementById('action_limit_type-' + compnent_id + '-' + index).innerHTML = '= ' + action_limit;
            } else if (action_limit_type == '>=') {
                document.getElementById('action_limit_type-' + compnent_id + '-' + index).innerHTML = '&ge; ' +
                action_limit;
            } else if (action_limit_type == '<=') {
                document.getElementById('action_limit_type-' + compnent_id + '-' + index).innerHTML = '&le; ' +
                action_limit;
            } else if (action_limit_type == '<') {
                document.getElementById('action_limit_type-' + compnent_id + '-' + index).innerHTML = '&lt; ' +
                action_limit;
            } else if (action_limit_type == '>') {
                document.getElementById('action_limit_type-' + compnent_id + '-' + index).innerHTML = '&gt; ' +
                action_limit;
            }
        }

        function general_change_warning_limit_type(compnent_id, index) {
            var warning_limit_type = document.querySelector('select[name=warning_limit_type-' + compnent_id + '-' + index +
                ']').value;
            var warning_limit = document.querySelector('input[name=warning_limit-' + compnent_id + '-' + index + ']').value;

            if (warning_limit_type == '=') {
                document.getElementById('warning_limit_type-' + compnent_id + '-' + index).innerHTML = '= ' + warning_limit;
            } else if (warning_limit_type == '>=') {
                document.getElementById('warning_limit_type-' + compnent_id + '-' + index).innerHTML = '&ge; ' +
                    warning_limit;
            } else if (warning_limit_type == '<=') {
                document.getElementById('warning_limit_type-' + compnent_id + '-' + index).innerHTML = '&le; ' +
                    warning_limit;
            } else if (warning_limit_type == '<') {
                document.getElementById('warning_limit_type-' + compnent_id + '-' + index).innerHTML = '&lt; ' +
                    warning_limit;
            } else if (warning_limit_type == '>') {
                document.getElementById('warning_limit_type-' + compnent_id + '-' + index).innerHTML = '&gt; ' +
                    warning_limit;
            } + compnent_id + '-'
        }

        function only_one_general_change_action_limit_type(compnent_id) {
            var action_limit_type = document.querySelector('select[name="action_limit_type-' + compnent_id + '"]').value;
            var action_limit = document.querySelector('input[name=action_limit-' + compnent_id + ']').value;

            if (action_limit_type == '=') {
                document.getElementById('action_limit_type-' + compnent_id).innerHTML = '= ' + action_limit;
            } else if (action_limit_type == '>=') {
                document.getElementById('action_limit_type-' + compnent_id).innerHTML = '&ge; ' + action_limit;
            } else if (action_limit_type == '<=') {
                document.getElementById('action_limit_type-' + compnent_id).innerHTML = '&le; ' + action_limit;
            } else if (action_limit_type == '<') {
                document.getElementById('action_limit_type-' + compnent_id).innerHTML = '&lt; ' + action_limit;
            } else if (action_limit_type == '>') {
                document.getElementById('action_limit_type-' + compnent_id).innerHTML = '&gt; ' + action_limit;
            }
        }

        function only_one_general_change_warning_limit_type(compnent_id) {
            var warning_limit_type = document.querySelector('select[name=warning_limit_type-' + compnent_id + ']').value;
            var warning_limit = document.querySelector('input[name=warning_limit-' + compnent_id + ']').value;

            if (warning_limit_type == '=') {
                document.getElementById('warning_limit_type-' + compnent_id).innerHTML = '= ' + warning_limit;
            } else if (warning_limit_type == '>=') {
                document.getElementById('warning_limit_type-' + compnent_id).innerHTML = '&ge; ' + warning_limit;
            } else if (warning_limit_type == '<=') {
                document.getElementById('warning_limit_type-' + compnent_id).innerHTML = '&le; ' + warning_limit;
            } else if (warning_limit_type == '<') {
                document.getElementById('warning_limit_type-' + compnent_id).innerHTML = '&lt; ' + warning_limit;
            } else if (warning_limit_type == '>') {
                document.getElementById('warning_limit_type-' + compnent_id).innerHTML = '&gt; ' + warning_limit;
            } + compnent_id + '-'
        }
    </script>
    <script>
        let methodIndex = 0;

        function add_test_method() {
            const container = document.getElementById('test_methods_main');
            methodIndex++;

            const bladeContent = `
        <div class="card-body border border-primary" id="test_method-${methodIndex}">
            <div class="row componants" id="componants-${methodIndex}">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>{{ __('test_method.test_method') }} <span class="text-danger">*</span></label>
                        <select name="test_method-${methodIndex}" class="form-control" onchange="get_components(this, ${methodIndex})">
                            <option value="">{{ __('samples.select_test_method') }}</option>
                            @foreach ($test_methods as $test_method_item)
                                <option value="{{ $test_method_item->id }}">{{ $test_method_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>{{ __('test_method.component') }} <span class="text-danger">*</span></label>
                        <select name="components[]" onchange="add_components(this, ${methodIndex})" class="form-control" >
                            <option value="">{{ __('samples.select_component') }}</option>
                        </select>
                    </div>
                </div>
                <div class="main_components col-lg-12" id="main_components-${methodIndex}"> 
                </div>
            </div>

            <div class="form-group mt-2" style="text-align: {{ session()->get('locale') == 'ar' ? 'left' : 'right' }};">
                <button type="button" onclick="add_test_method()" class="btn btn-secondary mt-2">
                    <i class="mdi mdi-plus"></i> {{ __('samples.add_another_test_method') }}
                </button>
            </div>
        </div>
    `;

            container.insertAdjacentHTML('beforeend', bladeContent);
        }

        function get_components(element) {
            var test_method_id = $(element).val();
            if (test_method_id) {
                $.ajax({
                    url: "{{ route('admin.sample.get_components_by_test_method', ':id') }}".replace(':id',
                        test_method_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data && data.components && data.components.length > 0) {
                            var parentRow = $(element).closest('.row');
                            var select = parentRow.find('select[name="components[]"]');

                            select.empty().prop('disabled', false);
                            select.append('<option value="-1">{{ __('samples.select_component') }}</option>');
                            select.append(
                                '<option value="-1">{{ __('samples.select_all_component') }}</option>');

                            $.each(data.components, function(index, component) {
                                select.append('<option value="' + component.id + '">' + component.name +
                                    '</option>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        }
    </script>
    <script>
        function add_components(element, i) {
            var component_id = $(element).val();
            var test_method_id = $('select[name=test_method-' + i + ']').val();
            if (component_id == -1) {
                $.ajax({
                    url: "{{ route('admin.sample.get_components_by_test_method', ':id') }}".replace(':id',
                        test_method_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            if (data && data.components && data.components.length > 0) {


                                $('#main_components-' + i).empty();

                                $.each(data.components, function(index, component) {

                                    $('#main_components-' + i).append(`
                                        <div class="container mt-4">
                                        <label class="form-label">Components & Limits:</label>

                                        <div class="border border-primary rounded p-3 mb-3"
                                            style="background-color: #f8f9fa;">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div> 
                                                     <input type="checkbox" id="tds"  name="component-${component.id}-${index+1}"  checked>
                                                    <label for="tds" class="fw-bold text-primary">${component.name}</label>
                                                </div>
                                                <div class="text-end text-primary fw-bold">Unit:${component.main_unit && component.main_unit.name ? component.main_unit.name : 'N/A'}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit') }}</label>
                                                    <input type="number"  name="warning_limit-${component.id}-${index+1}" class="form-control"     onkeyup="general_change_warning_limit_type(${index+1})">
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit') }}</label>
                                                    <input type="number"  name="action_limit-${component.id}-${index+1}" class="form-control"     onkeyup="general_change_action_limit_type(${index+1})">
                                                    </div>
                                            </div>
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit_type') }}</label>
                                                      <select name="warning_limit_type-${component.id}-${index+1}" class="form-control"   onchange="general_change_warning_limit_type(${component.id} , ${index+1})">
                                                        <option value="">{{ __('samples.select_warning_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit_type') }}</label>
                                                   
                                                    <select name="action_limit_type-${component.id}-${index+1}" class="form-control"   onchange="general_change_action_limit_type(${component.id},${index+1})">
                                                            <option value="">{{ __('samples.select_action_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #fff8dc;">
                                                        <small class="text-muted d-block">Warning Limit</small>
                                                        <span class="text-warning fw-bold" id="warning_limit_type-${component.id}-${index+1}"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #ffeeee;">
                                                        <small class="text-muted d-block">Action Limit</small>
                                                        <span class="text-danger fw-bold" id="action_limit_type-${component.id}-${index+1}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                      `);


                                });

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });

            } else {
                $.ajax({
                    url: "{{ route('admin.sample.get_one_component_by_test_method', ':id') }}".replace(
                        ':id',
                        component_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data) {
                            if (data && data.component) {

                                $('#main_components-' + i).empty();

                                $('#main_components-' + i).append(`
                                        <div class="container mt-4">
                                        <label class="form-label">Components & Limits:</label>

                                        <div class="border border-primary rounded p-3 mb-3"
                                            style="background-color: #f8f9fa;">
                                          
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div> 
                                                     <input type="checkbox" id="tds" name="component-${data.component.id}" checked>
                                                    <label for="tds" class="fw-bold text-primary">${data.component.name}</label>
                                                </div>
                                                <div class="text-end text-primary fw-bold">Unit:${data.component.main_unit && data.component.main_unit.name ? data.component.main_unit.name : 'N/A'}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit') }}</label>
                                                    <input type="number"  name="warning_limit-${data.component.id}" class="form-control"     onkeyup="only_one_change_warning_limit_type(${data.component.id})"> 
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit') }}</label>
                                                    <input type="number"  name="action_limit-${data.component.id}" class="form-control"     onkeyup="only_one_change_action_limit_type(${data.component.id})">
                                                    </div>
                                            </div>
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <label for="tds" class="fw-bold text-primary">{{ __('samples.warning_limit_type') }}</label>
                                                      <select name="warning_limit_type-${data.component.id}" class="form-control"   onchange="only_one_change_warning_limit_type(${data.component.id})">
                                                        <option value="">{{ __('samples.select_warning_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                </div>
                                                <div class="text-end text-primary fw-bold">
                                                     <label for="tds" class="fw-bold text-primary">{{ __('samples.action_limit_type') }}</label>
                                                   
                                                    <select name="action_limit_type-${data.component.id}" class="form-control"   onchange="only_one_change_action_limit_type(${data.component.id})">
                                                            <option value="">{{ __('samples.select_action_limit_type') }}</option> 
                                                            <option value="=">=</option> 
                                                            <option value=">=">&ge;</option> 
                                                            <option value="<=">&le;</option> 
                                                            <option value="<">&lt;</option> 
                                                            <option value=">">&gt;</option> 
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #fff8dc;">
                                                        <small class="text-muted d-block">Warning Limit</small>
                                                        <span class="text-warning fw-bold"  id="warning_limit_type-${data.component.id}"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 rounded" style="background-color: #ffeeee;">
                                                        <small class="text-muted d-block">Action Limit</small>
                                                        <span class="text-danger fw-bold" id="action_limit_type-${data.component.id}"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                      `);

                            }


                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        }
    </script>
@endsection
