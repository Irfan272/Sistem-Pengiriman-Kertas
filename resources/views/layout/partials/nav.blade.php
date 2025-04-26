<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div style="float: left; padding: 10px; font-size: 25px; font-weight: bold; ">
            PT. INDAH KIAT APP SERANG
        </div>

        <nav class="nav navbar-nav">
            <ul class="navbar-right">

                <!-- Profil Pengguna -->
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <h6 class="mb-0 text-gray-600">Welcome, {{ Auth::guard('user')->user()->name }}</h6>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log
                                Out</button>
                        </form>
                    </div>
                </li>

                <!-- Ikon Pesan -->
                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" aria-haspopup="true" id="messageDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        {{-- @if ($total > 0)
                            <span class="badge bg-green">{{ $total }}</span>
                        @endif --}}
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu"
                        aria-labelledby="messageDropdown">
                        {{-- @foreach ($antrian as $a)
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span>
                                        <span>Antrian Mobil Masuk: {{ $a->waktu_kedatangan }}</span>
                                        <span>Total Unit: {{ $a->totalMobil ?? 'N/A' }}</span>
                                    </span>
                                    <span class="message">
                                        Belum Dibuat DO
                                    </span>
                                </a>
                            </li>
                        @endforeach
                        @if ($total == 0)
                            <li class="nav-item">
                                <a class="dropdown-item">
                                    <span class="message">Tidak ada antrian mobil masuk.</span>
                                </a>
                            </li>
                        @endif --}}
                    </ul>
                </li>




            </ul>
        </nav>
    </div>
</div>
