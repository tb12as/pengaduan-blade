@extends('layouts.app')

@section('userman-link', 'active')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">User Management</div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif

                    <a href="{{ route('petugas.create') }}" class="btn m-2 btn-info btn-sm my-3 float-right">Tambah Petugas</a>
                    <a href="{{ route('masyarakat.create') }}" class="btn m-2 btn-primary btn-sm my-3 float-right">Tambah Masyarakat</a>

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoles()[0] }}</td>
                                <td>
                                    @if (Auth::id() !== $user->id)
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelDelete-{{ $user->id }}">Delete</button>
                                    @else
                                    <p class="badge badge-primary">Active now</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($users as $user)
<div class="modal fade" id="modelDelete-{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="labelModal{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModal{{ $user->id }}">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="alert alert-danger">Hapus User? Aksi ini tidak dapat dibatalkan</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger"
            onclick="event.preventDefault(); document.getElementById('deleteForm{{ $user->id }}').submit()" >Hapus</button>
            <form method="POST" action="{{ route('user.destroy', $user->id) }}" id="deleteForm{{ $user->id }}">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>
</div>
@endforeach

@endsection
