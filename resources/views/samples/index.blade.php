@extends('layouts.dashboard')
@section('title')
    <?php $lang = Session::get('locale'); ?>

    {{ __('roles.sample_managment') }}
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('roles.sample_managment') }}</h4>
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
    {{-- @if (session()->has('locale'))
    {{ dd(session()->get('locale') ) }}
@endif --}}

    <form action="" method="get">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="input-group mb-3 d-flex justify-content-end">
                        {{-- @can('change_samples_status')
                            <div class="remv_control mr-2">
                                <select name="status" class="mr-3 mt-3 form-control ">
                                    <option value="">{{ __('dashboard.set_status') }}</option>
                                    <option value="1">{{ __('dashboard.active') }}</option>
                                    <option value="2">{{ __('dashboard.disactive') }}</option>
                                </select>
                            </div>
                        @endcan --}}
                        {{-- @can('change_samples_role')
                            <div class="remv_control mr-2">
                                <select name="role" class="mr-3 mt-3 form-control">
                                    <option value="">{{ __('roles.set_role') }}</option>
                                    @foreach ($roles as $item_role) 
                                    <option value="{{ $item_role->id }}">{{ $item_role->name }}</option>
                                    @endforeach
 
                                </select>
                            </div>
                       
                        
                        <button type="submit" name="bulk_action_btn" value="update_status"
                            class="btn btn-primary mt-3 mr-2">
                            <i class="la la-refresh"></i> {{ __('dashboard.update') }}
                        </button>
                         @endcan --}}
                        @can('delete_sample')
                            <button type="submit" name="bulk_action_btn" value="delete"
                                class="btn btn-danger delete_confirm mt-3 mr-2"> <i class="la la-trash"></i>
                                {{ __('dashboard.delete') }}</button>
                        @endcan
                        @can('create_sample')
                            <a href="{{ route('admin.sample.create') }}" class="btn btn-secondary mt-3 mr-2">
                                <i class="la la-refresh"></i> {{ __('dashboard.create') }}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input class="bulk_check_all" type="checkbox" /></th>
                            <th class="text-center" scope="col">{{ __('samples.plant_name') }}</th>
                            <th class="text-center" scope="col">@lang('samples.sample_name')</th>
                            <th class="text-center" scope="col">@lang('test_method.test_methods')</th>
                            <th class="text-center" scope="col">{{ __('roles.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($samples as $sample_item)
                            <tr>
                                <th scope="row">
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                            value="{{ $sample_item->id }}" />
                                        <span class="text-muted">#{{ $sample_item->id }}</span>
                                    </label>
                                </th>
                                <td class="text-center">{{ $sample_item->plant_main->name }} @if ($sample_item->sub_plant)
                                        - {{ $sample_item->sub_plant->name }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $sample_item->sample_plant->name }}</td>
                                <td class="text-center">
                                    <ul class="list-unstyled m-0">
                                        @foreach ($sample_item->test_methods as $test_method_item)
                                            <li>{{ $test_method_item->master_test_method->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>


                                <td class="text-center">
                                    @can('delete_sample')
                                        <a href="{{ route('admin.sample.add_test_method', $sample_item->id) }}"
                                            class="btn btn-success btn-sm">{{ translate('add_Component') }}</a>
                                    @endcan
                                    @can('delete_sample')
                                        <a href="{{ route('admin.sample.add_test_method', $sample_item->id) }}"
                                            class="btn btn-success btn-sm">{{ translate('add_Test_Method') }}</a>
                                    @endcan
                                    @can('delete_sample')
                                        <a href="{{ route('admin.sample.delete', $sample_item->id) }}"
                                            class="btn btn-danger btn-sm" title="@lang('dashboard.delete')"><i
                                                class="fa fa-trash"></i></a>
                                    @endcan

                                    @can('edit_sample')
                                        <a href="{{ route('admin.sample.edit', $sample_item->id) }}"
                                            class="btn btn-outline-info btn-sm" title="@lang('dashboard.edit')"><i
                                                class="mdi mdi-pencil"></i> </a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </form>



@endsection
