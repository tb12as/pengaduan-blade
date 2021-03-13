@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-light bg-dark">{{ __('Pengaduan Masyarakat') }}</div>

                    <div class="card-body">
                        @if(Session::has('success'))
                        <p class="alert alert-primary ">{{ Session::get('success') }}</p>
                        @endif

                        <p>Semua Pengaduan yang anda buat Akan ditampilkan pada Table dibawah</p>

                        <a href="{{ route('pengaduan.create') }}" class="btn my-3 btn-primary btn-sm float-right">Buat
                            Pengaduan</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                        <td>{{ Str::words($d->isi_laporan, 6, '...') }}</td>
                                        <td>
                                            @if ($d->status == 'terkirim')
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modelDelete-{{ $d->id }}">
                                                    Delete
                                                </button>

                                                <div class="modal fade" id="modelDelete-{{ $d->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="labelModal{{ $d->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="labelModal{{ $d->id }}">Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="alert alert-danger">Hapus pengaduan? Aksi ini tidak dapat dibatalkan</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-danger"
                                                                onclick="event.preventDefault(); document.getElementById('deleteForm{{ $d->id }}').submit()" >Hapus</button>
                                                                <form method="POST" action="{{ route('pengaduan.destroy', $d->slug) }}" id="deleteForm{{ $d->id }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('pengaduan.edit', $d->slug) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            @endif

                                            <a href="{{ route('pengaduan.show', $d->slug) }}"
                                                class="btn btn-success btn-sm">Detail</a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Anda belum membuat pengaduan</td>
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
