<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">

        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>

    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">

            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <div class="dropdown" style="">
                <li class="nav-item me-3 " style="" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    id="dropdownMenuButton1">
                    <i class='bx bx-bell'></i>
                </li>
                @if (Auth::user()->role == 'ADMIN')
                    <div class="dropdown-menu dropdown-menu-end" style="width: ;" aria-labelledby="dropdownMenuButton1">
                        <span class="dropdown-item"><b>Notification</b></span>
                        <div class="dropdown-item d-flex">
                            <div class="d-flex flex-column">
                                <span>Pembayaran Tagihan</span>
                                <a href="#">Sandi telah melakukan pembayaran</a>
                                <p class="text-little mt-1 text-secondary" style="font-size:13px;">3 Hari lalu</p>
                            </div>
                            <span type="button" class="">&#10005;</span type="button">
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="d-flex flex-column">
                                <span>Pembayaran Tagihan</span>
                                <a href="#">Sandi telah melakukan pembayaran</a>
                                <p class="text-little mt-1 text-secondary" style="font-size:13px;">3 Hari lalu</p>
                            </div>
                            <span type="button" class="">&#10005;</span type="button">
                        </div>
                    </div>
                @else
                @endif()

            </div>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">

                        <img src="{{ asset('storage/image/' . $user->image) }}" alt
                            class="w-px-40 h-100 rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('storage/image/' . $user->image) }}" alt
                                            class="w-px-40 h-100 rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ $user->name }}</span>
                                    <small class="text-muted">{{ $user->role }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile.edit', Auth::user()->id) }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.instansi.index') }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="bx
                        bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
