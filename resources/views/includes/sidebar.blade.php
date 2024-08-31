<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link" style="background-color: #212529">
{{--                <img src="{{asset('apple-touch-icon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
{{--                     style="opacity: .8">--}}
        <span class="brand-text font-weight-bolder">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #212529">
        <!-- Sidebar user panel (optional) -->
        <br>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" style="background-color: #212529;">
                <div class="input-group-append" >
                    <button class="btn btn-sidebar" style="background-color: #212529;">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class

                     with font-awesome or any other icon font library -->


                @switch(auth()->user()->role)
                    @case('user')
                        <li class="nav-item">
                            <a href="{{ route('user.house.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    My apartments/houses
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.link.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Links that may be in your qrcode
                                </p>
                            </a>
                        </li>
                        @break
                    @case('advertiser')
                        <li class="nav-item">
                            <a href="{{route('advertiser.tariff.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Tariffs
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('advertiser.tariff.my')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Purchased tariffs
                                </p>
                            </a>
                        </li>
                        @break
                    @case('moderator')
                        <li class="nav-item">
                            <a href="{{ route('moderator.country.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Countries
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.city.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Cities
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.room-type.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Types of rooms
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.tariff.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Tariffs
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.balance.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Users Balance
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.house.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                     Houses
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.room.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Rooms
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.link.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                     Links
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.qrcode.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Qrcodes
                                </p>
                            </a>
                        </li>
                        @break
                @endswitch

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

