@extends('layouts.admin')

@section('title')
Mentor Page
@endsection

@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">
                        <div class="row mb-4">
                            <div class="col text-right">
                                <a href="{{ route('pengajar.create') }}" class="btn btn-primary"><i class="fas fa-plus fa-sm text-white"></i> Tambah Mentor</a>
                            </div>
                        </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Jumlah Data Tables Mentor {{ $jMentor }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nama</th>
                                            <th>Profession</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mentor as $m)
                                            <tr>
                                                <td>{{ $m->nama }}</td>
                                                <td>{{ $m->profession }}</td>
                                                <td>{{ $m->email }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('pengajar.show', $m->id) }}" class="btn btn-primary btn-sm mx-1">
                                                        <i class="fa fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('pengajar.edit', $m->id) }}" class="btn btn-info btn-sm mx-1">
                                                        <i class="fa fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <form action="{{ route('pengajar.destroy', $m->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm mx-1" onclick="return confirm('Hapus Data ?')">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                             <td colspan="7" class="text-center">
                                                Data Kosong
                                            </td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection