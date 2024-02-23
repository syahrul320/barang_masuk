<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo.png') }}" class="logo-icon"
                    alt="logo icon">
            </a>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" style="text-decoration: none">
                <h4 class="logo-text">STOK</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto">
            <ion-icon name="menu-sharp"></ion-icon>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon">
                    <ion-icon name="home-sharp"></ion-icon>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Data Master</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                {{-- <li> <a href="{{ route('user') }}">
                    <ion-icon name="person-sharp"></ion-icon>Data User
                    </a>
                </li> --}}
                <li> <a href="{{ route('produk') }}">
                    <ion-icon name="storefront-sharp"></ion-icon>Data Produk
                    </a>
                </li>
                <li> <a href="{{ route('customer') }}">
                    <ion-icon name="storefront-sharp"></ion-icon>Data Customer
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="{{ route('barang_masuk') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Transaksi Barang Masuk
                    </a>
                </li>
                <li> <a href="{{ route('barang_keluar') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Transaksi Barang Keluar
                    </a>
                </li>
                <li> <a href="{{ route('analisis') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Analisis Seles
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->

