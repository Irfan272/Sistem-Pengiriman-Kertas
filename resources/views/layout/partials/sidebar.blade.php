<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0; margin-top:10px;">
            <a href="/dashboard" class="site_title"><img src="{{ asset('assets/images/INKP.JK.png') }}" style="width: 55px"
                    height="auto"><span class="pl-2">SIPEDAU </span></a>
        </div>

        <div class="clearfix"></div>



        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a>
                    </li>

                    </li>
                    {{-- <li><a><i class="fa fa-tachometer"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if (Auth::guard('user')->user()->role == 'Operator')
                                <li><a href="/akun">Data Akun</a></li>
                                <li><a href="/pengecekan">Pengecekan Mobil</a></li>
                            @elseif(Auth::guard('user')->user()->role ==  'Kordinator Lapangan')
                                <li><a href="/akun">Data Akun</a></li>
                                <li><a href="/department">Data Department</a></li>
                                <li><a href="/supir">Data Supir</a></li>
                                <li><a href="/kertas">Data Kertas</a></li>
                               
                                <li><a href="/pengiriman">Pengiriman</a></li>
                            @endif
                        </ul>
                    </li> --}}

                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan')
                        <li><a><i class="fa fa-tachometer"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                {{-- @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan') --}}
                                <li><a href="/akun">Data Akun</a></li>
                                <li><a href="/supir">Data Supir</a></li>
                                <li><a href="/kertas">Data Kertas</a></li>
                                {{-- <li><a href="/department">Data Department</a></li> --}}

                                {{-- @elseif(Auth::guard('user')->user()->role == 'Kepala Bagian')
                                    
                                    <li><a href="/pengecekan">Pengecekan Mobil</a></li>

                                    <li><a href="/pengiriman">Pengiriman</a></li>
                                @endif --}}
                            </ul>
                        </li>
                    @endif

                    <li><a><i class="fa fa-desktop"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if (Auth::guard('user')->user()->role == 'Operator' || Auth::guard('user')->user()->role == 'Kordinator Lapangan')
                                <li><a href="/pengecekan">Pengecekan Mobil</a></li>
                                <li><a href="/pengiriman">Pengiriman</a></li>
                            @elseif(Auth::guard('user')->user()->role == 'Kepala Bagian')
                                <li><a href="/pengiriman">Pengiriman</a></li>
                            @endif
                        </ul>
                    </li>

                    <li><a><i class="fa fa-file"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/laporan-pengecekan">Laporan Pengecekan</a></li>
                            <li><a href="/laporan-pengiriman">Laporan Pengiriman</a></li>

                        </ul>

                    </li>
                    <li>
                        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>  Log Out
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form> --}}
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->


        <!-- /menu footer buttons -->
    </div>
</div>
