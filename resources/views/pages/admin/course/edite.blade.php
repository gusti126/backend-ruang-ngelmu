@extends('layouts.admin')

@section('title')
Edit Course
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
                            <h5 class="card-title">Edit Data Course</h5>
                            <form action="{{ route('course.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label for="exampleFormControlFile1">Masukan thumbnail</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="thumbnail">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Nama Kelas</label>
                                        <div class="form-group"><input type="text" class="form-control" name="nama" value="{{ $item->nama}}"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Type</label>
                                        <select class="form-control" name="type">
                                            <option value="free">Free</option>
                                            <option value="premium">Premium</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Bersertifikat</label>
                                        <select class="form-control" name="sertifikat">
                                            <option value="0" @if (old('active') == 0) selected @endif>Tidak</option>
                                            <option value="1" @if (old('active') == 1) selected @endif>Iya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Kategori</label>
                                        <select name="kategori_id" class="form-control">
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Price</label>
                                        <div class="form-group"><input type="number" value="0" class="form-control" name="price" value="{{ $item->price }}"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Level</label>
                                        <select class="form-control" name="level">
                                            <option value="all-level">All Level</option>
                                            <option value="beginer">Baginer</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advance">Advance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Mentor</label>
                                        <select class="form-control" name="mentor_id">
                                            @foreach ($mentor as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-10 mb-5">
                                        <label for="">Deskrips</label>
                                        {{ $item->deskripsi }}
                                        <textarea class="form-control" id="" rows="3" name="deskripsi">{{ $deskripsi }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
@endsection