@extends('layouts.auth')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">404</h1>
    <h3>Oops! Halaman yang Anda cari tidak ditemukan.</h3>
    <p>Silakan periksa kembali URL atau kembali ke halaman utama.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection
