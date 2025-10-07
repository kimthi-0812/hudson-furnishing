<header class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img class="app-logo" src="{{ isset($siteSettings['logo']) ? asset('uploads/' . $siteSettings['logo']) : asset('images/logo.png') }}" 
            alt="{{ $siteSettings['site_name'] ?? 'Hudson Furnishing' }}" height="40">
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Trang Chủ
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                        Sản Phẩm
                    </a>
                    <ul class="dropdown-menu shadow">
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">
                            Tất Cả Sản Phẩm
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('products.section', 'phong-ngu') }}">
                            Phòng Ngủ
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('products.section', 'phong-khach') }}">
                            Phòng Khách
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('products.section', 'phong-an') }}">
                            Phòng Ăn
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('products.section', 'van-phong') }}">
                            Văn Phòng
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('products.section', 'ngoai-troi') }}">
                            Ngoài Trời
                        </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">
                        Thư Viện
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('offers.*') ? 'active' : '' }}" href="{{ route('offers.index') }}">
                        Khuyến Mãi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        Giới Thiệu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">
                        Liên Hệ
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav flex-nowrap">
                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link px-2" href="{{ route('admin.dashboard') }}" title="Quản Trị">
                                <i class="fas fa-cog"></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <span class="d-none d-md-inline ms-1">{{ Str::limit(auth()->user()->name, 10) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><h6 class="dropdown-header">{{ auth()->user()->name }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            @if(auth()->user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-cog me-2"></i>Quản Trị
                                </a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Đăng Nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Đăng Ký
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</header>
