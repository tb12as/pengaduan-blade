@extends('layouts.app')
@section('pengaduan-link', 'active')

@section('content')

    <div class="container">
        <div class="row my-2 justify-content-center">
            <div class="col-md-3 m-1">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5">
                                <h1 class="">{{ count($data->where('status', 'selesai')) }}</h1>
                            </div>
                            <div class="col-md-7">
                                Pengaduan selesai
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 m-1">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5">
                                <h1 class="">{{ count($data->where('status', 'proses')) }}</h1>
                            </div>
                            <div class="col-md-7">
                                Pengaduan dalam proses
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 m-1">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-5">
                                <h1 class="">{{ count($data->where('status', 'terkirim')) }}</h1>
                            </div>
                            <div class="col-md-7">
                                Pengaduan Baru
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-dark text-light">{{ __('Pengaduan Masyarakat') }}</div>

                    <div class="card-body">

                        @if(Session::has('success'))
                        <p class="alert alert-primary ">{{ Session::get('success') }}</p>
                        @endif

                        <p>Semua Pengaduan</p>
                        <table class="table table-bordered table-responsive-lg table-hover" id="table">
                            <thead>
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
                                        <td>{{ $d->user->name }}</td>
                                        <td>{{ $d->status }}</td>
                                        <td>{{ Str::words($d->isi_laporan, 4, '...') }}</td>
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
                                            @elseif($d->status == 'selesai')
                                                @role('admin')
                                                <a href="{{ route('cetak', $d->slug) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-info">Cetak</a>
                                                @endrole
                                            @endif

                                            <a href="{{ route('pa.detail', $d->slug) }}"
                                                class="btn btn-success btn-sm">Detail</a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada pengaduan untuk ditampilkan</td>
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

@section('script')
<script>
    $(document).ready(function() {
        $('#table').DataTable(); 
    });
</script>
@endsection
