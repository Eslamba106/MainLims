  @extends('web.landing_page')
  @section('content')
      <!-- Newsletter Start -->

      <form action="{{ route('admin.tenant_management.register_tenant') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid py-5">
              <div class="container">
                  <div class="row g-5">
                      <div class="card">
                          <div class="card-body">
                              <div class="row">
                                    <input type="hidden" name="schema_id" value="{{ $schema->id }}">
                                  <div class="col-md-3 col-lg-4 col-xl-3">

                                      <div class="form-group">
                                          <label for="">{{ __('roles.name') }} <span
                                                  class="text-danger">*</span></label>
                                          <input type="text" name="name" class="form-control" required />

                                          @error('name')
                                              <span class="error text-danger">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-6 col-lg-4 col-xl-3">
                                      <div class="form-group">
                                          <label for="tenant_id" class="title-color">{{ translate('company_domain') }}
                                              <span class="text-danger"> *</span></label>
                                          <input type="text" class="form-control" required name="tenant_id">
                                          {{-- <input type="text" class="form-control"  name="tenant_id" value="{{ company_id() }}" > --}}
                                      </div>
                                  </div>
                              
                                  <div class="col-md-6 col-lg-4 col-xl-3">
                                      <div class="form-group">
                                          <label class="title-color">{{ __('tenants.user_name') }}<span class="text-danger">
                                                  *</span></label>
                                          <input type="text" class="form-control" name="user_name">
                                      </div>
                                  </div> 
                                  <div class="col-md-6 col-lg-4 col-xl-3">
                                      <label class="title-color">{{ __('tenants.password') }}<span class="text-danger">
                                              *</span></label>

                                      <div class="form-group input-group input-group-merge">

                                          <input type="password" class="js-toggle-password form-control" name="password"
                                              id="signupSrPassword" placeholder="{{ __('8+_characters_required') }}"
                                              aria-label="8+ characters required" required
                                              data-msg="Your password is invalid. Please try again."
                                              data-hs-toggle-password-options='{
                                                    "target": "#changePassTarget",
                                                    "defaultClass": "tio-hidden-outlined",
                                                    "showClass": "tio-visible-outlined",
                                                    "classChangeTarget": "#changePassIcon"
                                                    }'>
                                        
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group mt-2"
                                  @if (session()->get('locale') == 'ar') style="text-align: left;" @else style="text-align: right;" @endif>
                                  <button type="submit" class="btn btn-primary mt-2">{{ __('dashboard.save') }}</button>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
      </form>
      </div>
      </div>
      </div>
  @endsection
