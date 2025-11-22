@extends('admin.layouts.dashboard')
@section('title')
<?php $lang = Session::get('locale'); ?>

    {{ translate('landing_page_settings') }}
@endsection
 
 @push('css_or_js')
     <style>
         body {
             background-color: #f8f9fa;
         }

         .list-container {
             max-width: 800px;
             margin: 10px 10px;
         }

         .list-group-item {
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 12px 20px;
             border: none;
             border-bottom: 1px dashed #ddd;
             font-size: 16px;
             color: #007bff;
             text-decoration: none;
         }

         .list-group-item:hover {
             background-color: #f1f1f1;
         }

         .arrow {
             font-size: 14px;
             color: #bbb;
         }
     </style>
 @endpush

 @section('content')
     {{-- <div class="container list-container  "> --}}
         <div class="row">
             <div class="col-md-6">
                 <div class="accordion" id="accordionExample"> 
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"  href="{{ route('admin.landing_page_settings.header') }}"   >{{ translate('header') }}</a>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"   href="{{ route('admin.landing_page_settings.home') }}"  >{{ translate('home') }}</a>  
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"   href="{{ route('admin.landing_page_settings.feature') }}"  >{{ translate('feature_settings') }}</a>  
                         </h2>  
                     </div>
                    
                    


                 </div>

             </div> 
         </div>
     {{-- </div> --}}

 @endsection

 @push('script')
     <!-- Bootstrap JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @endpush
 