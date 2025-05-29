<aside class="left-sidebar mt-3">
    <!-- Sidebar scroll-->
    <?php
    $lang = Session::get('locale');
    ?>
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">



                @can('test_method_management')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fa fa-flask"></i>

                            <span class="hide-menu">{{ __('roles.test_method_management') }} </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            @can('all_test_methods')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.test_method') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_test_methods') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('all_units')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.unit') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_units') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('all_result_types')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.result_type') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_result_types') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                <!--  Test Method Management End-->


                   <!--  Sample Management Start-->
                @can('sample_management')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fas fa-microscope"></i>

                            <span class="hide-menu">{{ __('roles.sample_management') }} </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            @can('all_samples')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.sample') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_samples') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('all_plants')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.plant') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_plants') }}</span>
                                    </a>
                                </li>
                            @endcan
                           
                            @can('toxic_degree_management')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.toxic_degree') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_toxic_degrees') }}</span>
                                    </a>
                                </li>
                            @endcan
                           
                        </ul>
                    </li>
                @endcan

                   <!--  Sample Management End-->
                   <!--  Submission Management Start-->
                @can('submission_management')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fas fa-microscope"></i>

                            <span class="hide-menu">{{ __('roles.submission_management') }} </span>
                        </a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            @can('all_submissions')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.submission') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_submissions') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('all_sample_routine_scheduler')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.submission.schedule') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_sample_routine_scheduler') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('all_frequencies')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.frequency') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_frequencies') }}</span>
                                    </a>
                                </li>
                            @endcan
                            
                           
                        </ul>
                    </li>
                @endcan

                   <!--  Submission Management End-->

                @can('user_management')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fa fa-users"></i>

                            <span class="hide-menu">{{ __('roles.user_management') }} </span>
                        </a>
                        @can('all_users')
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user_managment') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_users') }}</span>
                                    </a>
                                </li>

                            </ul>
                        @endcan
                    </li>
                @endcan

                @can('admin_roles')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fa fa-id-badge"></i>


                            <span class="hide-menu">{{ __('roles.roles') }} </span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @can('show_admin_roles')
                                <li class="sidebar-item">
                                    <a href="{{ route('roles') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_roles') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('create_admin_roles')
                                <li class="sidebar-item">
                                    <a href="{{ route('roles.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.create_role') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('logout') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">{{ __('login.logout') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
