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
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar sidebar-dark flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('moderator.currency.index') }}"
                               class="nav-link {{request()->path() == 'moderator/currencies' ? 'active' : ''}}">
                                <p>
                                    {{ __('admin.Currency') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.country.index') }}"
                               class="nav-link {{request()->path() == 'moderator/countries' ? 'active' : ''}}">
                                <p>
                                    {{ __('admin.Country') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('moderator.city.index') }}"
                               class="nav-link {{request()->path() == 'moderator/cities' ? 'active' : ''}}">
                                <p>
                                    {{ __('admin.City') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('moderator.district.index') }}"
                           class="nav-link {{request()->path() == 'moderator/districts' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.Area') }}
                            </p>
                        </a>
                    </li>
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('moderator.room-type.index') }}"
                               class="nav-link {{request()->path() == 'moderator/room-types' ? 'active' : ''}}">
                                <p>
                                    {{ __('admin.Type of room') }}
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('moderator.tariff.index') }}"
                           class="nav-link {{request()->path() == 'moderator/tariffs' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.Plan') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('moderator.balance.index') }}"
                           class="nav-link {{request()->path() == 'moderator/balance' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.User balance') }}
                                @if(notification('balance'))
                                    <span class="badge badge-light right">{{notification('balance')}}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('moderator.user.index') }}"
                           class="nav-link {{request()->path() == 'moderator/users' ? 'active' : ''}} ">
                            <p>
                                {{ __('admin.User') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('moderator.house.index') }}"
                           class="nav-link {{request()->path() == 'moderator/houses' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.Apartment') }}
                                @if(notification('house'))
                                    <span class="badge badge-light right">{{notification('house')}}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('moderator.room.index') }}"
                           class="nav-link {{request()->path() == 'moderator/rooms' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.Room') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('moderator.link.index') }}"
                           class="nav-link {{request()->path() == 'moderator/links' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.Advertised link') }}
                                @if(notification('link'))
                                    <span class="badge badge-light right">{{notification('link')}}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('moderator.qrcode.index') }}"
                           class="nav-link {{request()->path() == 'moderator/qrcodes' ? 'active' : ''}}">
                            <p>
                                {{ __('admin.QR stands') }}
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
