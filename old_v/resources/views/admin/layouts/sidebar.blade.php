<aside class="left-sidebar mt-3">
    <!-- Sidebar scroll-->
    <?php $user = auth()->guard('admins')->user();
    $lang = Session::get('locale');
    ?>
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fa fa-users"></i>

                        <span class="hide-menu">{{ __('roles.tenant_management') }} </span>
                    </a>
                    
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('admin.tenant_management') }}" class="sidebar-link">
                                    <i class="mdi mdi-email"></i>
                                    <span class="hide-menu">{{ __('roles.all_tenants') }}</span>
                                </a>
                            </li>

                        </ul>
                     
                </li>

                {{-- @can('user_management')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fa fa-users"></i>

                            <span class="hide-menu">{{ __('roles.user_management') }} </span>
                        </a>
                        @can('all_users')
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.user_managment') }}" class="sidebar-link">
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
                                    <a href="{{ route('admin.roles') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.all_roles') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('create_admin_roles')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.roles.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu">{{ __('roles.create_role') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.logout') }}"
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
