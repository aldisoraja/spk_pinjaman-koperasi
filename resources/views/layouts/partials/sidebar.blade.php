<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns   "
    data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    <ul class="navbar-list left">
                        <h5 style="margin-left:250px;">SPK Pemberian Pinjaman Koperasi Non Paket</h5>
                    </ul>
                    <ul class="navbar-list right">
                        <li class="hide-on-med-and-down"><a
                                class="waves-effect waves-block waves-light toggle-fullscreen"
                                href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        <li>
                            <h6 style="margin-top:24px;margin-right:15px">{{ Auth::user()->name ?? '' }}</h6>
                        </li>
                        <li>
                            <a  class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                                data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                    src="{{ asset('assets/images/avatar/1.png') }}"
                                    alt="avatar"><i></i></span>
                            </a>
                        </li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <form id="logout" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li><a href="javascript:void(0);" class="grey-text text-darken-1"
                                    onclick="document.getElementById('logout').submit();"><i
                                        class="material-icons">keyboard_tab</i> Logout</a></li>
                        </form>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
        <div class="brand-sidebar">
            <img src="{{ asset('assets/images/logo/logo4.png') }}" alt="logo" style="width:250px; height:60px" >
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
            data-menu="menu-navigation" data-collapsible="accordion">
            <li class="bold"><a class="waves-effect waves-cyan " href="/dashboard"><i
                        class="material-icons">settings_input_svideo</i><span class="menu-title"
                        data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @if (Auth::user()->role_id == 1)
            <li class="navigation-header"><a class="navigation-header-text">Master Data</a><i
                    class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            @else
            <li class="navigation-header"><a class="navigation-header-text">View Data</a><i
                    class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            @endif

            @if (Auth::user()->role_id == 1)
                <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('hak-akses.index') }}"><i
                            class="material-icons">manage_accounts</i><span class="menu-title" data-i18n="Hak Akses">Hak
                            Akses</span></a>
                </li>
            @endif

            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('criteria.index') }}"><i
                        class="material-icons">cloud</i><span class="menu-title"
                        data-i18n="Kriteria">Kriteria</span></a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('subkriteria.index') }}"><i
                        class="material-icons">format_list_bulleted</i><span class="menu-title"
                        data-i18n="Sub Kriteria">Sub Kriteria</span></a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('bobot-nilai-gap') }}"><i
                        class="material-icons">content_paste</i><span class="menu-title"
                        data-i18n="Bobot Nilai GAP">Bobot Nilai GAP</span></a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('nilai-ideal') }}"><i
                        class="material-icons">star
                        rate</i><span class="menu-title" data-i18n="Nilai Ideal">Nilai Ideal</span></a>
            </li>

            @if (Auth::user()->role_id == 2)
            <li class="navigation-header"><a class="navigation-header-text">Master Data</a><i
                    class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            @else
            <li class="navigation-header"><a class="navigation-header-text">View Data</a><i
                    class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            @endif
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('alternatif.index') }}"><i
                        class="material-icons">people</i><span class="menu-title" data-i18n="Detail Perhitungan">Data
                        Alternatif</span></a>
            </li>
            @if (Auth::user()->role_id == 2)
                <li class="navigation-header"><a class="navigation-header-text">Perhitungan </a><i
                        class="navigation-header-icon material-icons">more_horiz</i>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('perhitungan-index') }}"><i
                            class="material-icons">calculate</i><span class="menu-title"
                            data-i18n="Detail Perhitungan">Perhitungan</span></a>
                </li>
                <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('perhitungan-detail') }}"><i
                            class="material-icons">list_alt</i><span class="menu-title"
                            data-i18n="Detail Perhitungan">Detail Perhitungan</span></a>
                </li>
            @endif

            <li class="navigation-header"><a class="navigation-header-text">Laporan </a><i
                    class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan " href="{{ route('list-hasil') }}"><i
                        class="material-icons">text_snippet</i><span class="menu-title"
                        data-i18n="Hasil Perhitungan">Hasil Perhitungan</span></a>
            </li>

        </ul>
        <div class="navigation-background"></div><a
            class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
            href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->
