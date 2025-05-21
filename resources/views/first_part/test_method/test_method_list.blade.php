@extends('layouts.dashboard')
@section('title')
    <?php $lang = Session::get('locale'); ?>

    {{ __('roles.test_method_management') }}
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('roles.test_method_management') }}</h4>
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


    <form action="" method="get">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="input-group mb-3 d-flex justify-content-end">
                        @can('change_test_methods_status')
                            <div class="remv_control mr-2">
                                <select name="status" class="mr-3 mt-3 form-control ">
                                    <option value="">{{ __('dashboard.set_status') }}</option>
                                    <option value="1">{{ __('test_method.added') }}</option>
                                    <option value="2">{{ __('test_method.not_added') }}</option>
                                </select>
                            </div>
                        @endcan


                        <button type="submit" name="bulk_action_btn" value="update_status"
                            class="btn btn-primary mt-3 mr-2">
                            <i class="la la-refresh"></i> {{ __('dashboard.update') }}
                        </button>
                        @can('delete_test_method')
                            <button type="submit" name="bulk_action_btn" value="delete"
                                class="btn btn-danger delete_confirm mt-3 mr-2"> <i class="la la-trash"></i>
                                {{ __('dashboard.delete') }}</button>
                        @endcan
                        @can('create_test_method')
                            <a href="{{ route('admin.test_method.create') }}" class="btn btn-secondary mt-3 mr-2">
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
                            <th class="text-center" scope="col">{{ __('roles.name') }}</th>
                            <th class="text-center" scope="col">{{ __('test_method.component') }}</th>
                            <th class="text-center" scope="col">@lang('test_method.unit')</th>
                            <th class="text-center" scope="col">@lang('test_method.lower_range')</th>
                            <th class="text-center" scope="col">@lang('test_method.upper_range')</th>
                            <th class="text-center" scope="col">@lang('roles.status')</th>
                            <th class="text-center" scope="col">{{ __('roles.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($test_methods as $test_method)
                            @php
                                $itemCount = $test_method->test_method_items->count();
                            @endphp

                            @forelse ($test_method->test_method_items as $index => $item)
                                <tr>
                                    @if ($index === 0)
                                        <th scope="row" rowspan="{{ $itemCount }}">
                                            <label>
                                                <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                    value="{{ $test_method->id }}" />
                                                <span class="text-muted">#{{ $loop->index + 1 }}</span>
                                            </label>
                                        </th>
                                        <td class="text-center" rowspan="{{ $itemCount }}">{{ $test_method->name }}
                                        </td>
                                    @endif
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->main_unit->name }}</td>
                                    <td class="text-center">{{ $item->lower_range }}</td>
                                    <td class="text-center">{{ $item->upper_range }}</td>
                                    @if ($index === 0)
                                        <td class="text-center" rowspan="{{ $itemCount }}">
                                            <span
                                                class="badge badge-pill {{ $test_method->status == 'added' ? 'badge-success' : 'badge-secondary' }}">
                                                {{ __('test_method.' . $test_method->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center" rowspan="{{ $itemCount }}">
                                            @can('delete_test_method')
                                                <a href="{{ route('admin.test_method.delete', $test_method->id) }}"
                                                    class="btn btn-danger btn-sm" title="@lang('dashboard.delete')"><i
                                                        class="fa fa-trash"></i></a>
                                            @endcan
                                            @can('edit_test_method')
                                                <a href="{{ route('admin.test_method.edit', $test_method->id) }}"
                                                    class="btn btn-outline-info btn-sm" title="@lang('dashboard.edit')"><i
                                                        class="mdi mdi-pencil"></i> </a>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                
                        @endforelse
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">@lang('No data found')</td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </form>



@endsection
