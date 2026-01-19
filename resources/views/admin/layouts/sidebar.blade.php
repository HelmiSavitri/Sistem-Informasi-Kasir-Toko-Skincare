<!-- Sidebar Start -->
<aside class="left-sidebar" style="background-color: #FFE4EF">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('template-admin/src/assets/images/logos/logo.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ Request::is('dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Data Master</span>
                </li>
                <li class="sidebar-item {{ Request::is('category*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('category*') ? 'active' : '' }}" href="{{ route('category.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tags"></i>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('product*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('product*') ? 'active' : '' }}" href="{{ route('product.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-box"></i>
                        </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('brand*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('brand*') ? 'active' : '' }}" href="{{ route('brand.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-appgallery"></i>
                        </span>
                        <span class="hide-menu">Brand</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('supplier*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('supplier*') ? 'active' : '' }}" href="{{ route('supplier.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-store"></i>
                        </span>
                        <span class="hide-menu">Supplier</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Transaksi</span>
                </li>
                <li class="sidebar-item {{ Request::is('transaction*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('transaction*') ? 'active' : '' }}" href="{{ route('transaction.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-heart-handshake"></i>
                        </span>
                        <span class="hide-menu">Pembayaran</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
