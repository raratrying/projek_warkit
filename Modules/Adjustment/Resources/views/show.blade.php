@extends('layouts.app')

@section('title', 'Adjustment Details')

@push('page_css')
    @livewireStyles
@endpush

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('adjustments.index') }}">Penyesuaian Stok</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2">
                                        Tanggal
                                    </th>
                                    <th colspan="2">
                                        Referensi
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        {{ $adjustment->date }}
                                    </td>
                                    <td colspan="2">
                                        {{ $adjustment->reference }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Kode</th>
                                    <th>Jumlah</th>
                                    <th>Tipe</th>
                                </tr>

                                @foreach($adjustment->adjustedProducts as $adjustedProduct)
                                    <tr>
                                        <td>{{ $adjustedProduct->product->product_name }}</td>
                                        <td>{{ $adjustedProduct->product->product_code }}</td>
                                        <td>{{ $adjustedProduct->quantity }}</td>
                                        <td>
                                            @if($adjustedProduct->type == 'add')
                                                (+) Menambahkan
                                            @else
                                                (-) Mengurangi
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
