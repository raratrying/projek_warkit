@extends('layouts.app')

@section('title', 'Edit Product Category')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product-categories.index') }}">Kategori</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8 col-sm-10 col-12"> {{-- responsive grid --}}
                @include('utils.alerts')
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="mb-4">Edit Kategori Produk</h5>
                        <form action="{{ route('product-categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label class="font-weight-bold" for="category_code">Kode Kategori <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="category_code" id="category_code" required value="{{ $category->category_code }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="category_name">Nama Kategori <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="category_name" id="category_name" required value="{{ $category->category_name }}">
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a href="{{ route('product-categories.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update <i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
