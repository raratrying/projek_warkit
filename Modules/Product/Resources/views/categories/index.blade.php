@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('third_party_stylesheets')
    <!-- CSS DataTables + Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
        <li class="breadcrumb-item active">Kategori</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('utils.alerts')
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#categoryCreateModal">
                            Tambah Kategori <i class="bi bi-plus"></i>
                        </button>

                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-bordered table-striped dt-responsive nowrap', 'style' => 'width:100%']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    @include('product::includes.category-modal')
@endsection

@push('page_scripts')
    <!-- JS DataTables + Responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    {!! $dataTable->scripts() !!}
@endpush
