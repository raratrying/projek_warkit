@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 2%">
                <div class="card" style="width: 40rem;">
                    <div class="card-body">
                        <h4 class="card-title">Verifikasi alamat email mu</h4>
                        @if (session('resent'))
                            <p class="alert alert-success" role="alert">Tautan verifikasi baru telah Dikirim ke alamat email anda</p>
                        @endif
                        <p class="card-text">Sebelum memproses,harap periksa email anda untuk tautan verifikasi.Jika kamu tidak menerima email,</p>
                        <a href="{{ route('verification.resend') }}">klik disini untuk meminta lagi</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection