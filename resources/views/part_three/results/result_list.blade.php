@extends('layouts.dashboard')
@section('title')
    <?php $lang = Session::get('locale'); ?>

    {{ __('roles.result_managment') }}
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('roles.result_managment') }}</h4>
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
                      
                        @can('change_results_role')
                            <div class="remv_control mr-2">
                                <select name="role" class="mr-3 mt-3 form-control">
                                    <option value="">{{ __('roles.set_role') }}</option>
                                    <option value="pending">{{ $item_role->name }}</option>
                                </select>
                            </div>


                            <button type="submit" name="bulk_action_btn" value="update_status"
                                class="btn btn-primary mt-3 mr-2">
                                <i class="la la-refresh"></i> {{ __('dashboard.update') }}
                            </button>
                        @endcan
                        @can('delete_result')
                            <button type="submit" name="bulk_action_btn" value="delete"
                                class="btn btn-danger delete_confirm mt-3 mr-2"> <i class="la la-trash"></i>
                                {{ __('dashboard.delete') }}</button>
                        @endcan
                        {{-- @can('create_result')
                            <a href="{{ route('admin.result.create') }}" class="btn btn-secondary mt-3 mr-2">
                                <i class="la la-refresh"></i> {{ __('dashboard.create') }}
                            </a>
                        @endcan --}}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input class="bulk_check_all" type="checkbox" /></th>
                            <th class="text-center" scope="col">{{ __('samples.sample_id') }}</th>
                            <th class="text-center" scope="col">@lang('results.collection_date')</th>
                            <th class="text-center" scope="col">@lang('samples.plant')</th>
                            <th class="text-center" scope="col">@lang('results.sample_point')</th>
                            <th class="text-center" scope="col">@lang('roles.status')</th>
                            <th class="text-center" scope="col">@lang('results.priority')</th>
                            <th class="text-center" scope="col">{{ __('roles.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $result_item)
                            <tr>
                                <th scope="row">
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                            value="{{ $result_item->id }}" />
                                        <span class="text-muted">#{{ $loop->index + 1 }}</span>
                                    </label>
                                </th>
                                <td class="text-center">{{ $result_item->submission->submission_number }} </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($result_item->sampling_date_and_time)->format('M d, Y h:i A') }}
                                </td>
                                {{-- {{ dd($result_item->new_sample_main) }} --}}
                                <td class="text-center">{{ $result_item->plant->name }} </td>
                                <td class="text-center">{{ optional(optional($result_item->sample)->sample_plant)->name }}
                                </td>
                                {{-- <td class="text-center">{{ $result_item->status  }} </td>
                                <td class="text-center">{{ $result_item->priority  }} </td> --}}
                                <td class="text-center">
                                    @php
                                        $statusColors = [
                                            'in progress' => 'bg-warning text-dark',
                                            'pending' => 'bg-secondary text-white',
                                            'completed' => 'bg-success text-white',
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusColors[$result_item->status] ?? 'bg-yellow text-dark' }}">
                                        {{ $result_item->status }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @php
                                        $priorityColors = [
                                            'high' => 'bg-danger text-white',
                                            'normal' => 'bg-primary text-white',
                                            'low' => 'bg-info text-dark',
                                        ];
                                    @endphp
                                    <span
                                        class="badge {{ $priorityColors[$result_item->priority] ?? 'bg-light text-dark' }}">
                                        {{ $result_item->priority }}
                                    </span>
                                </td>



                                <td class="text-center">
                                    @can('delete_result')
                                        <a href="{{ route('admin.result.delete', $result_item->id) }}"
                                            class="btn btn-danger btn-sm" title="@lang('dashboard.delete')"><i
                                                class="fa fa-trash"></i></a>
                                    @endcan
                                    @can('edit_result')
                                        <a href="{{ route('admin.result.edit', $result_item->id) }}"
                                            class="btn btn-outline-info btn-sm" title="@lang('dashboard.edit')"><i
                                                class="mdi mdi-pencil"></i> </a>
                                    @endcan
                                    @if ($result_item->status == 'pending')
                                        
                                   
                                    @can('edit_result')
                                        <a href="{{ route('admin.result.confirm_results', $result_item->id) }}"
                                            class="btn btn-outline-success btn-sm" title="@lang('results.confirm_results')"><i
                                                class="mdi mdi-check"></i> </a>
                                    @endcan
                                     @endif
                                    @can('edit_result')
                                        <a href="{{ route('admin.result.review', $result_item->id) }}"
                                            class="btn btn-outline-success btn-sm" title="@lang('results.confirm_results')"><i
                                                class="mdi mdi-file"></i> </a>
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
