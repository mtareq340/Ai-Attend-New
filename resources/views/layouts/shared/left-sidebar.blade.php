<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('any', 'dashboard') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard</span>
                    </a>
                   
                </li>

                <li class="menu-title mt-2">Apps</li>

                {{-- start of branches --}}
                <li>
                    <a href="{{ route('branches.index' , ['type' => 'table']) }}" >
                        <i class="mdi mdi-office-building"></i>
                        <span> Branches </span>
                    </a>
                </li>
                {{-- end of branches --}}



                {{-- start of Employees --}}
                <li>
                    <a href="#sidebaremp" data-toggle="collapse">
                        <i class="fas fa-user-tie"></i>
                        <span> Employees </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebaremp">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employees.index') }}">Employees</a>
                            </li>
                            <li>
                                <a href="{{ route('employees.create') }}">Add employee</a>
                            </li>
                            <li>
                                <a href="{{ route('employees.excelPage') }}">upload employees from excel</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- end of Employees --}}


                {{-- start of users --}}
                <li>
                    <a href="#sidebarCrm" data-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('users.index') }}">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('users.create') }}">Add User</a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- end of users --}}

                {{-- start of roles --}}
                <li>
                    <a href="#sidebar_roles" data-toggle="collapse">
                        <i data-feather="lock"></i>
                        <span> Roles </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebar_roles">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('roles.index') }}">Roles</a>
                            </li>
                            <li>
                                <a href="{{ route('roles.create') }}">Add role</a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- end of roles --}}
                {{-- start of locations --}}
                <li>
                    <a href="#sidebarlocation" data-toggle="collapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-map icon-dual">
                            <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                            <line x1="8" y1="2" x2="8" y2="18"></line>
                            <line x1="16" y1="6" x2="16" y2="22"></line>
                        </svg>
                        <span> Locations </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarlocation">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('locations.index')}}">Location</a>
                            </li>
                            <li>
                                <a href="{{route('locations.create')}}">Add Location</a>
                            </li>

                        </ul>
                    </div>
                </li>
                    {{-- end of locations --}}

                    {{-- Appointment --}}
                    <li>
                        <a href="#sidebarappointment" data-toggle="collapse">
                            <i class="fe-check-square"></i>. 
                            <span> Appointment </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarappointment">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('appointment.index')}}">Appointments</a>
                                </li>
                                <li>
                                    <a href="{{route('appointment.create')}}">Add Appointments</a>
                                </li>
                            
                            </ul>
                        </div>
                    </li>
                    {{-- end of appointment --}}
                {{-- Here Jobs Sidebar  --}}
                    <li>
                        <a href="#sidebarjob" data-toggle="collapse">
                            <i class="icon-briefcase"></i>. 
                            <span> Jobs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarjob">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route('jobs.index')}}">Jobs</a>
                                </li>
                                <li>
                                    <a href="{{route('jobs.create')}}">Add Jobs</a>
                                </li>
                            
                            </ul>
                        </div>
                    </li>
                {{-- EndSidebar Jobs --}}

                {{-- Here attend_methods  Sidebar --}}
                <li>
                    <a href="#sidebarmethod" data-toggle="collapse">
                        <i class=" icon-clock"></i>.
                        <span> Attend Methods </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarmethod">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('attend_methods.index') }}">Attend Methods</a>
                            </li>
                            <li>
                                <a href="{{ route('attend_methods.create') }}">Add Attend Methods</a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- EndSidebar attend_methods --}}

                {{-- Here devices  Sidebar --}}
                <li>
                    <a href="#sidebardevices" data-toggle="collapse">
                        <i class="icon-mouse"></i>.
                        <span> Devices </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebardevices">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('devices.index') }}">Devices</a>
                            </li>
                            <li>
                                <a href="{{ route('devices.create') }}">Add Devices</a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- EndSidebar devices --}}
                {{-- start of employee - attend methods --}}

                <li>
                    <a href="#sidebarempatt" data-toggle="collapse">
                        <i class="fa fa-users"></i>. 
                        <span>Emp Attendance (M)</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarempatt">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employees-attend-methods.index') }}">Employee Attemdance Methods</a>
                            </li>
                            <li>
                                <a href="{{ route('employees-attend-methods.create') }}">Add Employee Attemdance Methods</a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- end of employee - attend methods --}}

                {{-- start of Assign Appointment --}}
                <li>
                    <a href="#sidebarassign" data-toggle="collapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard icon-dual"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                        <span> Assign Appointments </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarassign">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('assign_appointment.index') }}">Assign Appointments</a>
                            </li>
                            <li>
                                <a href="{{ route('assign_appointment.create') }}">Add Assign Appointments</a>
                            </li>

                        </ul>
                    </div>
                </li>
                {{-- End of Assign Appointment --}}
                
                <li class="menu-title">Some Pages For Design</li>

                <li>
                    <a href="{{ route('second', ['apps', 'calendar']) }}">
                        <i data-feather="calendar"></i>
                        <span> Calendar </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('second', ['apps', 'chat']) }}">
                        <i data-feather="message-square"></i>
                        <span> Chat </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarEcommerce" data-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Ecommerce </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'dashboard']) }}">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'products']) }}">Products</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'product-detail']) }}">Product Detail</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'product-edit']) }}">Add Product</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'customers']) }}">Customers</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'orders']) }}">Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'order-detail']) }}">Order Detail</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'sellers']) }}">Sellers</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'cart']) }}">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ecommerce', 'checkout']) }}">Checkout</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCrm" data-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> CRM </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['crm', 'dashboard']) }}">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['crm', 'contacts']) }}">Contacts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['crm', 'opportunities']) }}">Opportunities</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['crm', 'leads']) }}">Leads</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['crm', 'customers']) }}">Customers</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarEmail" data-toggle="collapse">
                        <i data-feather="mail"></i>
                        <span> Email </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['email', 'inbox']) }}">Inbox</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['email', 'read']) }}">Read Email</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['email', 'compose']) }}">Compose Email</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['email', 'templates']) }}">Email Templates</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('second', ['apps', 'social-feed']) }}">
                        <span class="badge badge-pink float-right">Hot</span>
                        <i data-feather="rss"></i>
                        <span> Social Feed </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('second', ['apps', 'companies']) }}">
                        <i data-feather="activity"></i>
                        <span> Companies </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarProjects" data-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Projects </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProjects">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['project', 'list']) }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['project', 'detail']) }}">Detail</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['project', 'create']) }}">Create Project</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTasks" data-toggle="collapse">
                        <i data-feather="clipboard"></i>
                        <span> Tasks </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTasks">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['task', 'list']) }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['task', 'details']) }}">Details</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['task', 'kanban-board']) }}">Kanban Board</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarContacts" data-toggle="collapse">
                        <i data-feather="book"></i>
                        <span> Contacts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarContacts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['contacts', 'list']) }}">Members List</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['contacts', 'profile']) }}">Profile</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTickets" data-toggle="collapse">
                        <i data-feather="aperture"></i>
                        <span> Tickets </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTickets">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['tickets', 'list']) }}">List</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tickets', 'detail']) }}">Detail</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('second', ['apps', 'file-manager']) }}">
                        <i data-feather="folder-plus"></i>
                        <span> File Manager </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Custom</li>

                <li>
                    <a href="#sidebarAuth" data-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Auth Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['auth', 'login']) }}">Log In</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'login-2']) }}">Log In 2</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'register']) }}">Register</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'register-2']) }}">Register 2</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'signin-signup']) }}">Signin - Signup</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'signin-signup-2']) }}">Signin - Signup 2</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'recoverpw']) }}">Recover Password</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'recoverpw-2']) }}">Recover Password 2</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'lock-screen']) }}">Lock Screen</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'lock-screen-2']) }}">Lock Screen 2</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'logout']) }}">Logout</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'logout-2']) }}">Logout 2</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'confirm-mail']) }}">Confirm Mail</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['auth', 'confirm-mail-2']) }}">Confirm Mail 2</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExpages" data-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['pages', 'starter']) }}">Starter</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'timeline']) }}">Timeline</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'sitemap']) }}">Sitemap</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'invoice']) }}">Invoice</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'faqs']) }}">FAQs</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'search-results']) }}">Search Results</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'pricing']) }}">Pricing</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'maintenance']) }}">Maintenance</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'coming-soon']) }}">Coming Soon</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', 'gallery']) }}">Gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', '404']) }}">Error 404</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', '404-two']) }}">Error 404 Two</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', '404-alt']) }}">Error 404-alt</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', '500']) }}">Error 500</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['pages', '500-two']) }}">Error 500 Two</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarLayouts" data-toggle="collapse">
                        <i data-feather="layout"></i>
                        <span class="badge badge-blue float-right">New</span>
                        <span> Layouts </span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['layoutsDemo', 'horizontal']) }}">Horizontal</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['layoutsDemo', 'detached']) }}">Detached</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['layoutsDemo', 'two-column']) }}">Two Column Menu</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['layoutsDemo', 'two-tone-icons']) }}">Two Tones
                                    Icons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['layoutsDemo', 'preloader']) }}">Preloader</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Components</li>

                <li>
                    <a href="#sidebarBaseui" data-toggle="collapse">
                        <i data-feather="pocket"></i>
                        <span> Base UI </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['ui', 'buttons']) }}">Buttons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'cards']) }}">Cards</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'avatars']) }}">Avatars</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'portlets']) }}">Portlets</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'tabs-accordions']) }}">Tabs & Accordions</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'modals']) }}">Modals</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'progress']) }}">Progress</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'notifications']) }}">Notifications</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'spinners']) }}">Spinners</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'images']) }}">Images</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'carousel']) }}">Carousel</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'list-group']) }}">List Group</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'video']) }}">Embed Video</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'dropdowns']) }}">Dropdowns</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'ribbons']) }}">Ribbons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'tooltips-popovers']) }}">Tooltips & Popovers</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'general']) }}">General UI</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'typography']) }}">Typography</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['ui', 'grid']) }}">Grid</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExtendedui" data-toggle="collapse">
                        <i data-feather="layers"></i>
                        <span class="badge badge-info float-right">Hot</span>
                        <span> Extended UI </span>
                    </a>
                    <div class="collapse" id="sidebarExtendedui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['extended', 'nestable']) }}">Nestable List</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'range-slider']) }}">Range Slider</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'dragula']) }}">Dragula</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'animation']) }}">Animation</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'sweet-alert']) }}">Sweet Alert</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'tour']) }}">Tour Page</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'scrollspy']) }}">Scrollspy</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['extended', 'loading-buttons']) }}">Loading Buttons</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('any', 'widgets') }}">
                        <i data-feather="gift"></i>
                        <span> Widgets </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarIcons" data-toggle="collapse">
                        <i data-feather="cpu"></i>
                        <span> Icons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarIcons">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['icons', 'two-tone']) }}">Two Tone Icons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'feather']) }}">Feather Icons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'mdi']) }}">Material Design Icons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'dripicons']) }}">Dripicons</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'font-awesome']) }}">Font Awesome 5</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'themify']) }}">Themify</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'simple-line']) }}">Simple Line</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['icons', 'weather']) }}">Weather</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarForms" data-toggle="collapse">
                        <i data-feather="bookmark"></i>
                        <span> Forms </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarForms">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['forms', 'elements']) }}">General Elements</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'advanced']) }}">Advanced</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'validation']) }}">Validation</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'pickers']) }}">Pickers</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'wizard']) }}">Wizard</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'masks']) }}">Masks</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'summernote']) }}">Summernote</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'quilljs']) }}">Quilljs Editor</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'file-uploads']) }}">File Uploads</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'x-editable']) }}">X Editable</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['forms', 'image-crop']) }}">Image Crop</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTables" data-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Tables </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['tables', 'basic']) }}">Basic Tables</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'datatables']) }}">Data Tables</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'editable']) }}">Editable Tables</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'responsive']) }}">Responsive Tables</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'footables']) }}">FooTable</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'bootstrap']) }}">Bootstrap Tables</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'tablesaw']) }}">Tablesaw Tables</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['tables', 'jsgrid']) }}">JsGrid Tables</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCharts" data-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> Charts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCharts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['charts', 'apex']) }}">Apex Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'flot']) }}">Flot Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'morris']) }}">Morris Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'chartjs']) }}">Chartjs Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'peity']) }}">Peity Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'chartist']) }}">Chartist Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'c3']) }}">C3 Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'sparklines']) }}">Sparklines Charts</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['charts', 'knob']) }}">Jquery Knob Charts</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMaps" data-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Maps </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('second', ['maps', 'google']) }}">Google Maps</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['maps', 'vector']) }}">Vector Maps</a>
                            </li>
                            <li>
                                <a href="{{ route('second', ['maps', 'mapael']) }}">Mapael Maps</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMultilevel" data-toggle="collapse">
                        <i data-feather="share-2"></i>
                        <span> Multi Level </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMultilevel">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarMultilevel2" data-toggle="collapse">
                                    Second Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);">Item 2</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMultilevel3" data-toggle="collapse">
                                    Third Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel3">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li>
                                            <a href="#sidebarMultilevel4" data-toggle="collapse">
                                                Item 2 <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel4">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="javascript: void(0);">Item 1</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript: void(0);">Item 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
