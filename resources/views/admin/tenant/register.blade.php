@extends('front_office_layouts.main')
@section('title', translate('register_tenant'))
@section('content')
    <!-- Newsletter Start -->

    <form action="{{ route('admin.tenant_management.register_tenant') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="card shadow-lg" style="width: 450px; max-width: 100%;">
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="schema_id" value="{{ $schema->id }}">

                        <div class="form-group mb-3">
                            <label for="">{{ __('roles.name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tenant_id" class="title-color">{{ translate('company_domain') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" required name="tenant_id">
                        </div>

                        <div class="form-group mb-3">
                            <label class="title-color">{{ __('tenants.user_name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="user_name">
                        </div>

                        <div class="form-group mb-3">
                            <label class="title-color">{{ __('tenants.password') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" name="password" id="signupSrPassword"
                                placeholder="{{ __('8+_characters_required') }}" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ __('dashboard.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </form>

@endsection
