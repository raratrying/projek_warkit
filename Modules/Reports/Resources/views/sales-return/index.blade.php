@extends('layouts.app')

@section('title', 'Laporan Pengembalian Penjualan')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Laporan Pengembalian Penjualan</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.sales-return-report :customers="\Modules\People\Entities\Customer::all()"/>
    </div>
@endsection
