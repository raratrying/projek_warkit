@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
                {!! \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 2, 110) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Kode Produk</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>Simbol Kode Barang</th>
                                    <td>{{ $product->product_barcode_symbology }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $product->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Biaya</th>
                                    <td>{{ format_currency($product->product_cost) }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>{{ format_currency($product->product_price) }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>{{ $product->product_quantity . ' ' . $product->product_unit }}</td>
                                </tr>
                                <tr>
                                    <th>Nilai Saham</th>
                                    <td>
                                        Biaya:: {{ format_currency($product->product_cost * $product->product_quantity) }} /
                                        Harga:: {{ format_currency($product->product_price * $product->product_quantity) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Peringatan</th>
                                    <td>{{ $product->product_stock_alert }}</td>
                                </tr>
                                <tr>
                                    <th>Pajak (%)</th>
                                    <td>{{ $product->product_order_tax ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Pajak</th>
                                    <td>
                                        @if($product->product_tax_type == 1)
                                            Exclusive
                                        @elseif($product->product_tax_type == 2)
                                            Inclusive
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>{{ $product->product_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        @forelse($product->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



