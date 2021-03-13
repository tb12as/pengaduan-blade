@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Detail Pengaduan</h5>
                </div>
                <div class="card-body">
                    <p class="lead">Isi Laporan : </p>
                    <p class="">{{ $pengaduan->isi_laporan }}</p>

                    @if($foto = $pengaduan->foto)
                    <p class="lead">Foto : </p>

                    <img src="{{ asset($foto) }}" class="w-75 rounded" alt="">
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tanggapan</h5>
                </div>

                <div class="card-body">
                    @if(!$tanggapan = $pengaduan->tanggapan)
                    <p class="alert alert-warning">Belum ada tanggapan</p>
                    @else
                    <p class="alert alert-primary">Pengaduan telah ditanggapi</p>
                    <textarea disabled cols="" rows="5" class="form-control">{{ $tanggapan->isi_tanggapan }}</textarea>
                    <p class="small my-2">Ditanggapi oleh {{ $tanggapan->user->name }} pada {{ $tanggapan->created_at }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
