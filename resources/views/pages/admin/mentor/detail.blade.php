@extends('layouts.admin')

@section('title')
Detail mentor
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <img src="{{ Storage::url($item->profile) }}" alt="" class="img-fluid rounded-circle img-profile img-thumbnail">
                </div>
                <div class="col-12 text-center">
                    <h2 class="title-name">{{ $item->nama }}</h2>
                    <p>{{ $item->profession }}</p>
                </div>
                <div class="col-12">
                    
                </div>
                @foreach ($item->course as $course)
                    <div class="col-md-4">
                    <div class="card" >
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->nama }}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
    
@endsection
@push('addon-style')
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
@endpush