@extends('layouts.admin')

@section('title')
Tambah Mentor
@endsection

@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card shadow">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h5 class="card-title">Input Data Mentor</h5>
                            <form action="{{ route('pengajar.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label for="exampleFormControlFile1">Masukan Photo</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="profile">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nama</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nama" placeholder="Masukan nama" value="{{ old('nama') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Email</label>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Masukan Email" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="">Profession</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Masukan Profession" name="profession" value="{{ old('nama') }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection