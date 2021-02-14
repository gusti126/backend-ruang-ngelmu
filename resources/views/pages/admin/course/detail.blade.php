@extends('layouts.admin')

@section('title')
Detail mentor
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center"> {{ $data->nama }}</h4>
            @foreach ($data->chapters as $chapter)
                <span style="font-weight: bold">{{ $chapter->nama }} <br> </span> 
                @foreach ($chapter->lessons as $lesson)
                    {{ $lesson->nama }} <a href="" data-toggle="modal" data-target="#tes{{ $lesson->id }}"> Cek Video </a> <br>

                    {{-- Modal Video --}}
                    <div class="modal fade" id="tes{{ $lesson->id }}" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalSayaLabel">{{ $chapter->nama }}
                                        <br>
                                        <span style="font-weight: normal">{{ $lesson->nama }}</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <br/>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $lesson->video }}" allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    {{-- <button type="button" class="btn btn-primary">Oke</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr>
            @endforeach
        </div>
    </div>
</div>
    
@endsection
@push('addon-style')
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
@endpush