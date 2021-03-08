@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Pengaduan Masyarakat') }}</div>

                    <div class="card-body">

                        <p>Semua Pengaduan</p>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Pelapor</th>
                                    <th>Status</th>
                                    <th>Isi Laporan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $d)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td>{{ $d->status }}</td>
                                        <td>{{ $d->user->name }}</td>
                                        <td>{{ Str::words($d->isi_laporan, 6, '...') }}</td>
                                        <td>
                                            @if ($d->status == 'terkirim')
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#modalValid-{{ $d->id }}">
                                                    Valid
                                                </button>

                                                <div class="modal fade" id="modalValid-{{ $d->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="labelModal{{ $d->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="labelModal{{ $d->id }}">
                                                                    Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
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
                                                                    onclick="event.preventDefault(); document.getElementById('deleteForm{{ $d->id }}').submit()">Valid</button>
                                                                <form method="POST"
                                                                    action="{{ route('pengaduan.valid', $d->slug) }}"
                                                                    id="deleteForm{{ $d->id }}">
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif

                                            <a href="{{ route('pa.detail', $d->slug) }}"
                                                class="btn btn-success btn-sm">Detail</a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Anda belum membuat pengaduan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection