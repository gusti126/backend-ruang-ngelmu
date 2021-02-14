@extends('layouts.admin')

@section('title')
Course Page
@endsection

@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">
                        <div class="row mb-4">
                            {{-- modal tambah kategori --}}
                            <div class="col">
                                    <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
                                Tambah Kategori
                                </button>
                                <br>
                                @forelse ($kategori as $k)
                                  <button class="btn btn-outline-dark btn-sm mt-3">{{ $k->nama }}</button>
                                @empty
                                    Kategori Kosong
                                @endforelse 
                                <form action="{{ route('kategori.store')}}" method="post" enctype="multipart/form-data">
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                            
                                             @csrf
                                             <label for="exampleFormControlFile1">Icon</label>
                                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                                             <label for="">Nama Kategori</label>
                                             <input type="text" class="form-control" name="nama">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col text-right">
                                <a href="{{ route('course.create') }}" class="btn btn-primary"><i class="fas fa-plus fa-sm text-white"></i> Tambah Course</a>
                            </div>
                        </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                                <h6>Table Course</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            @foreach ($course as $c)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ Storage::url($c->thumbnail) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="teks-title-course">{{ $c->nama }}</h5>
                                            <p class="teks-image">{{ $c->type }} 
                                                    <span>{{ $c->level }}</span>
                                             </p>
                                            <hr>
                                               <p>Rp. {{ $c->price }}</p>  
                                                <hr>
                                                <div class="row no-gutters">
                                                    <div class="col-auto ">
                                                        <img src="{{ Storage::url($c->mentor->profile) }}" class="img-fluid rounded-circle img-mentor-course">
                                                    </div>
                                                    <div class="col pl-2">
                                                        <h6 style="margin-bottom: 0px; color: black">{{ $c->mentor->nama }}</h6>
                                                        <p style="margin-top: 0px;">{{ $c->mentor->profession }}</p>
                                                    </div>
                                                    <div class="col-12 text-right">
                                                        <a href="{{ route('course.show', $c->id) }}" class="btn btn-info btn-sm mx-4">Detail</a>
                                                        <a href="#" class="btn btn-outline-danger btn-sm">Hapus</a>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="card my-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ Storage::url($c->thumbnail) }}" class="img-fluid img-thumbnail-course">
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="teks-title-course">{{ $c->nama }}</h5>
                                                <p class="teks-image">{{ $c->type }} <span>{{ $c->level }}</span></p> 
                                                <hr>
                                                <span class="course-price">Rp. {{ $c->price }}</span> 
                                                <span class="sertifikat" style="{{ $c->sertifkat ? 'yes' : 'text-decoration: line-through ;' }}">{{ $c->sertifikat ? "sertifikat" : "Sertifikat" }}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> --}}
                            @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection
@push('addon-style')
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
@endpush