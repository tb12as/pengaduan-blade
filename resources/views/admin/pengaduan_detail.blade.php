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

                        @if ($foto = $pengaduan->foto)
                            <p class="lead">Foto : </p>
                            <img src="{{ asset($foto) }}" class="w-50 rounded" alt="">
                        @endif

                        <p class="my-3">Dikirim oleh {{ $pengaduan->user->name }} pada
                            {{ date('d-m-Y', strtotime($pengaduan->created_at)) }}</p>

                        <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm my-3">Back</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tanggapan</h5>
                    </div>

                    <div class="card-body">
                        @if (!$pengaduan->tanggapan)
                            @if ($pengaduan->status == 'proses')
                                <p class="alert alert-warning">Belum ada tanggapan</p>
                                <form action="{{ route('tanggapan.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                                    <div class="form-group">
                                        <label for="isi">Isi Tanggapan</label>
                                        <textarea name="isi_tanggapan" id="isi" cols="" rows="5"
                                            class="form-control @error('isi_tanggapan') is-invalid @enderror">{{ old('isi_tanggapan') }}</textarea>

                                        @error('isi_tanggapan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <button class="btn btn-primary btn-sm" type="submit">Tanggapi</button>
                                </form>
                            @else
                                <p class="alert alert-info">Pengaduan belum melalui proses validasi</p>

                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#modalValid">
                                    Valid
                                </button>

                                <div class="modal fade" id="modalValid" tabindex="-1" role="dialog"
                                    aria-labelledby="labelModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="labelModal">
                                                    Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="alert alert-info">Pengaduan ini valid? </p>
                                                <p>Aksi ini tidak dapat dibatalkan. Pastikan ini benar-benar
                                                    valid sebelum dapat ditanggapi</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-info"
                                                    onclick="event.preventDefault(); document.getElementById('deleteForm').submit()">Valid</button>
                                                <form method="POST" action="{{ route('pengaduan.valid', $pengaduan->slug) }}"
                                                    id="deleteForm">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="form-group">
                                <p class="alert alert-primary">Pengaduan sudah ditanggapi</p>
                                <label for="isi">Isi Tanggapan</label>
                                <textarea name="isi_tanggapan" id="isi" cols="" rows="5" class="form-control"
                                    disabled>{{ $pengaduan->tanggapan->isi_tanggapan }}</textarea>

                            </div>

                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#modelEditTanggapan">
                                Edit Tanggapan
                            </button>

                            <div class="modal fade" id="modelEditTanggapan" tabindex="-1" role="dialog"
                                aria-labelledby="labelModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="labelModal">
                                                Ubah Tanggapan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('tanggapan.store') }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                                                <div class="form-group">
                                                    <label for="isi">Isi Tanggapan</label>
                                                    <textarea name="isi_tanggapan" id="isi" cols="" rows="5"
                                                        class="form-control @error('isi_tanggapan') is-invalid @enderror">{{ old('isi_tanggapan') }}{{ $pengaduan->tanggapan->isi_tanggapan }}</textarea>

                                                    @error('isi_tanggapan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
