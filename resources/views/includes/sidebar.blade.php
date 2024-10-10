@if(in_array(auth()->user()->role, ['moderator', 'admin']))
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link" style="background-color: #212529">
            <img src="{{asset('images/logo.png')}}" alt="ADSHOUSE" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-bolder">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="background-color: #212529">
            <!-- Sidebar user panel (optional) -->
            {{--        <br>--}}

            <!-- SidebarSearch Form -->
            {{--        <div class="form-inline">--}}
            {{--            <div class="input-group" data-widget="sidebar-search">--}}
            {{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" style="background-color: #212529;">--}}
            {{--                <div class="input-group-append" >--}}
            {{--                    <button class="btn btn-sidebar" style="background-color: #212529;">--}}
            {{--                        <i class="fas fa-search fa-fw"></i>--}}
            {{--                    </button>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar sidebar-dark flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class

                         with font-awesome or any other icon font library -->



                            <li class="nav-item">
                                <a href="{{ route('moderator.country.index') }}" class="nav-link {{request()->path() == 'moderator/countries' ? 'active' : ''}}">
                                    <p>
                                        Country
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.city.index') }}" class="nav-link {{request()->path() == 'moderator/cities' ? 'active' : ''}}">
                                    <p>
                                        City
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.district.index') }}" class="nav-link {{request()->path() == 'moderator/districts' ? 'active' : ''}}">
                                    <p>
                                        Area
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.room-type.index') }}" class="nav-link {{request()->path() == 'moderator/room-types' ? 'active' : ''}}">
                                    <p>
                                        Type of room
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.tariff.index') }}" class="nav-link {{request()->path() == 'moderator/tariffs' ? 'active' : ''}}">
                                    <p>
                                        Tariff
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.balance.index') }}" class="nav-link {{request()->path() == 'moderator/balance' ? 'active' : ''}}">
                                    <p>
                                        User balance
                                        @if(notification('balance'))
                                            <span class="badge badge-light right">{{notification('balance')}}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.user.index') }}" class="nav-link {{request()->path() == 'moderator/users' ? 'active' : ''}} ">
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.house.index') }}" class="nav-link {{request()->path() == 'moderator/houses' ? 'active' : ''}}">
                                    <p>
                                        Apartment
                                        @if(notification('house'))
                                            <span class="badge badge-light right">{{notification('house')}}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.room.index') }}" class="nav-link {{request()->path() == 'moderator/rooms' ? 'active' : ''}}">
                                    <p>
                                        Room
                                        @if(notification('room'))
                                            <span class="badge badge-light right">{{notification('room')}}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.link.index') }}" class="nav-link {{request()->path() == 'moderator/links' ? 'active' : ''}}">
                                    <p>
                                        Advertised link
                                        @if(notification('link'))
                                            <span class="badge badge-light right">{{notification('link')}}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moderator.qrcode.index') }}" class="nav-link {{request()->path() == 'moderator/qrcodes' ? 'active' : ''}}">
                                    <p>
                                        QR stands
                                    </p>
                                </a>
                            </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endif
