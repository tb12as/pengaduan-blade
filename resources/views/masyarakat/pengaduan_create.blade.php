@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Buat Pengaduan') }}</div>

                <div class="card-body">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nik" class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>

                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" disabled value="{{ Auth::user()->nik }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ Auth::user()->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isi_laporan" class="col-md-4 col-form-label text-md-right">{{ __('Isi Laporan') }}</label>

                            <div class="col-md-6">
                                <textarea name="isi_laporan" id="isi_laporan" cols="" rows="5" class="form-control @error('isi_laporan') is-invalid @enderror"></textarea>

                                @error('isi_laporan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>

                            <div class="col-md-6">
                               <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto">

                                @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    {{ __('Kirim Pengaduan') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection