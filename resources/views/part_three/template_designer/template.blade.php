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
                        {{-- @can('change_results_status')
                            <div class="remv_control mr-2">
                                <select name="status" class="mr-3 mt-3 form-control ">
                                    <option value="">{{ __('dashboard.set_status') }}</option>
                                    <option value="1">{{ __('dashboard.active') }}</option>
                                    <option value="2">{{ __('dashboard.disactive') }}</option>
                                </select>
                            </div>
                        @endcan --}}
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
                            <th class="text-center" scope="col">{{ __('results.tamplate_name') }}</th>
                            <th class="text-center" scope="col">@lang('roles.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($temp as $temp_item)
                            <tr>
                                <th scope="row">
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                            value="{{ $temp_item->id }}" />
                                        <span class="text-muted">#{{ $loop->index + 1 }}</span>
                                    </label>
                                </th>

                                <td class="text-center">{{ $temp_item->name }} </td>
                                {{-- <td class="text-center">{{ $result_item->status  }} </td>
                                <td class="text-center">{{ $result_item->priority  }} </td> --}}
                                <td class="text-center">
                                    {{-- @if (array_key_exists('default', $data) && $data['default'] == true)
                                        <label class="switcher mx-auto" onclick="default_language_status_alert()">
                                            <input type="checkbox" class="switcher_input" checked disabled>
                                            <span class="switcher_control"></span>
                                        </label>
                                        @elseif(array_key_exists('default', $data) && $data['default']==false) --}}
                                    <form
                                        action="{{ route('coa_settings.update-default-status' ) }}"
                                        method="GET" id="language_default_id_{{ $temp_item->id }}_form"
                                        class="language_default_id_form">
                                        @csrf
                                        <input type="hidden" name="temp_id" value="{{ $temp_item->id }}">
                                        <label class="form-check form-switch me-2 mx-auto">
                                            <input type="checkbox" value="1" class="form-check-input"
                                                @if ($temp_item->value == 1) checked @endif
                                                id="language_default_id_{{ $temp_item->id }}" name="default"
                                                class="toggle-switch-input"
                                                
                                                onclick="toogleStatusModal(event,'language_default_id_{{ $temp_item->id }}','language-on.png','language-off.png','{{ __('Want_to_Change_Default_Language_Status') }}','{{ __('Want_to_Turn_OFF_Language_Status') }}',`<p>{{ __('if_enabled_this_language_will_be_set_as_default_for_the_entire_system') }}</p>`,`<p>{{ __('if_disabled_this_language_will_be_unset_as_default_for_the_entire_system') }}</p>`)">
                                            <span class="switcher_control"></span>
                                        </label>
                                    </form>
                                    {{-- @endif --}}
                                </td>




                                {{-- <td class="text-center">
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
                                    @can('edit_result')
                                        <a href="{{ route('admin.result.confirm_results', $result_item->id) }}"
                                            class="btn btn-outline-success btn-sm" title="@lang('results.confirm_results')"><i
                                                class="mdi mdi-check"></i> </a>
                                    @endcan

                                </td> --}}
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
@section('js')
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.language_default_id_form').on('click', function(event) {
            event.preventDefault();
            console.log("dfg");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('coa_settings.update-default-status') }}",
                method: 'GET',
                data: $(this).serialize(),
                success: function(data) {
                    toastr.success('{{ __('status_updated_successfully') }}');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });
        });
    </script>
@endsection
