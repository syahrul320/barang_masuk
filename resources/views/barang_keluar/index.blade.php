@extends('template')
@section('title')
    Stok Barang >> Barang Keluar
@endsection
@section('breadcrumb')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Barang Keluar</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Barang Keluar</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
@section('content')
    <div class="row" id="card-form">
        <div class="col-12">
            <div class="card">
                <div class="card-header  d-flex flex-row align-items-center">
                    <b class="float-left">Form</b>
                </div>
                <form id="form" enctype="multipart/form-data">
                    <input type="hidden" id="id" class="form-control" name="id" value="">
                    <div class="card-body col-sm-12">
                        <div class="form-group has-feedback">
                            <label>Nama Barang</label>
                            <select id='produkku' class='form-control' name="produkku">
                                <option value=''>-- Pilih Produk --</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body col-sm-12">
                        <div class="form-group has-feedback">
                            <label>Nama Customer</label>
                            <select id='cust' class='form-control' name="cust">
                                <option value=''>-- Pilih Produk --</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body col-sm-12">
                        <div class="form-group has-feedback">
                            <b><label>Jumlah Barang Keluar</label></b>
                            <input type="text" id="jumlah_barang_keluar" class="form-control"
                                placeholder="Jumlah Barang Keluar" name="jumlah_barang_keluar">
                            <span class="text-danger" id="jumlah_barang_keluarError"></span>
                        </div>
                    </div>
                    <div class="card-body col-sm-12">
                        <div class="form-group has-feedback">
                            <b><label>Tanggal</label></b>
                            <input type="date" id="tanggal_keluar" class="form-control" name="tanggal_keluar">
                            <span class="text-danger" id="tanggal_keluarError"></span>
                        </div>
                    </div>
                    <div class="card-footer text-center col-sm-12">
                        <button class="btn btn-primary" id="submit">
                            Simpan
                        </button>
                        <a href="javascript:void(0)" class="btn btn-secondary" id="close-form">
                            <ion-icon name="log-in-outline"></ion-icon>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 25px">
                        <div class="col-sm-3">
                            <label>Nama Barang</label>
                            <select id='id_produk' class='form-control' name="id_produk">
                                <option value=''>-- Pilih Produk --</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Nama Customer</label>
                            <select id='custku' class='form-control' name="custku">
                                <option value=''>-- Pilih Customer --</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Range</label>
                            <div id="reportrange"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>

                        </div>
                    </div>
                    <div class="card-header">
                        <button type="button" class="fadeIn animated bx bx-message-square-add btn btn-primary px-5"
                            id="add">
                            Tambah Data
                        </button>
                    </div>
                    <table class="table table-striped table-bordered" id="dt_tbl" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Nama Customer</th>
                                <th>Nama Kategori</th>
                                <th>Rasa</th>
                                <th>Jumlah Barang</th>
                                <th>Tanggal</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/function/barang_keluar.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-select2.js') }}"></script>
@endpush
