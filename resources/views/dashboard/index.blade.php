@extends('template')
@section('breadcrumb')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Hai, {{ Auth::user()->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Total Stok</p>
                                        @if ($produk == 0)
                                            <h4 class="mb-0 text-white">0</h4>
                                        @else
                                        <h4 class="mb-0 text-white">{{ $produk }}</h4>
                                        @endif
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="bag-check-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Total Customer</p>
                                        @if ($customer == 0)
                                            <h4 class="mb-0 text-white">0</h4>
                                        @else
                                        <h4 class="mb-0 text-white">{{ $customer }}</h4>
                                        @endif
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="storefront-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Total Restok In</p>
                                        @if ($barang_masuk == 0)
                                            <h4 class="mb-0 text-white">0</h4>
                                        @else
                                            <h4 class="mb-0 text-white">{{ $barang_masuk }}</h4>
                                        @endif
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="log-in-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Total Restok Out</p>
                                        @if ($barang_keluar == 0)
                                            <h4 class="mb-0 text-white">0</h4>
                                        @else
                                            <h4 class="mb-0 text-white">{{ $barang_keluar }}</h4>
                                        @endif
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="log-out-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endpush
