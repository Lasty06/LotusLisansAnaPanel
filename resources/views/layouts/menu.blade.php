<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Bayi</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('index') ? 'active' : ''}}" href="{{ route('index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Anasayfa</span>
                </a>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('category') || Route::is('product') ? 'active' : ''}}" href="{{ route('category') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-store-3-line"></i> <span data-key="t-dashboards">Market</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('inventory') ? 'active' : ''}}" href="{{ route('inventory') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-inbox-fill"></i> <span data-key="t-dashboards">Siparişlerim</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('faq') ? 'active' : ''}}" href="{{ route('faq') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="mdi mdi-lifebuoy"></i> <span data-key="t-dashboards">Talimatlar</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('fiyatListesi') ? 'active' : ''}}" href="{{ route('fiyatListesi') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="mdi mdi-file-excel"></i> <span data-key="t-dashboards">Fiyat Listesi</span>
                </a>
            </li>

            @if (Auth::user()->permission == 2 || Auth::user()->permission == 3)
            <li class="menu-title"><span data-key="t-menu">Admin Panel</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('admin.index') ? 'active' : ''}}" href="{{ route('admin.index') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Anasayfa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('admin.generalGettings') ? 'active' : ''}}" href="{{ route('admin.generalGettings') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Genel Ayarlar</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('siparisler') ? 'active' : ''}}" href="{{ route('siparisler') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Tüm Siparişler</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('admin.stockno') ? 'active' : ''}}" href="{{ route('admin.stockno') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Bekleyen Siparişler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarSss" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">SSS</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarSss">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.sssadd') }}" class="nav-link" data-key="t-crm"> Ekle </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sss') }}" class="nav-link" data-key="t-ecommerce"> Düzenle </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarCategory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Kategori</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarCategory">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.categoryadd') }}" class="nav-link" data-key="t-crm"> Ekle </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}" class="nav-link" data-key="t-ecommerce"> Düzenle </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Ürün</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarProduct">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.productadd') }}" class="nav-link" data-key="t-crm"> Ekle </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product') }}" class="nav-link" data-key="t-ecommerce"> Düzenle </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarStock" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Stok</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarStock">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.stockadd') }}" class="nav-link" data-key="t-crm"> Ekle </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stock') }}" class="nav-link" data-key="t-ecommerce"> Düzenle </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Kullanıcı</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarUser">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('admin.useradd') }}" class="nav-link" data-key="t-crm"> Ekle </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user') }}" class="nav-link" data-key="t-ecommerce"> Düzenle </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link menu-link {{ Route::is('listBackups') ? 'active' : ''}}" href="{{ route('listBackups') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Yedekler</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
    <!-- Sidebar -->
</div>