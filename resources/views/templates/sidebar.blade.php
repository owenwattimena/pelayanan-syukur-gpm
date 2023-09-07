<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        {{-- <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div> --}}
        <div>
            <h4 class="logo-text">Pelayanan Syukur</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('home') }}">
                <div class="parent-icon"><i class="bx bx-home"></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        @if (auth()->guard('admin')->user()->role == 'admin_jemaat')

        <li>
            <a href="{{ route('sektor') }}">
                <div class="parent-icon"><i class="bx bx-grid-horizontal"></i>
                </div>
                <div class="menu-title">Sektor</div>
            </a>
        </li>
        <li>
            <a href="{{ route('unit') }}">
                <div class="parent-icon"><i class="bx bx-grid-horizontal"></i>
                </div>
                <div class="menu-title">Unit</div>
            </a>
        </li>
        <li>
            <a href="{{ route('pengurus-sektor') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Pengurus Sektor</div>
            </a>
        </li>
        <li>
            <a href="{{ route('pengaturan') }}">
                <div class="parent-icon"><i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">Pengaturan</div>
            </a>
        </li>
        @endif
        @if (auth()->guard('admin')->user()->role == 'admin_sektor')

        <li>
            <a href="{{ route("jemaat") }}" >
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Jemaat</div>
            </a>
        </li>
        <li>
            <a href="{{ route("pelayanan-pernikahan") }}" >
                <div class="parent-icon"><i class="bx bx-heart-circle"></i>
                </div>
                <div class="menu-title">Pelayanan Pernikahan</div>
            </a>
        </li>
        <li>
            <a href="{{ route("pelayanan-kelahiran") }}">
                <div class="parent-icon"><i class="bx bx-cake"></i>
                </div>
                <div class="menu-title">Pelayanan Kelahiran</div>
            </a>
        </li>
        <li>
            <a href="{{route("verifikasi")}}">
                <div class="parent-icon"><i class="bx bx-badge-check"></i>
                </div>
                <div class="menu-title">Pengurus Unit</div>
            </a>
        </li>
        @endif

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
