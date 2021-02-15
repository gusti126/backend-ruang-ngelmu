@extends('layouts.admin')

@section('title')
Detail mentor
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="text-center"> {{ $data->nama }}</h4>
            <p class="text-center">Kategori : {{ $data->kategori->nama }}</p>
            @foreach ($data->chapters as $chapter)
                <span style="font-weight: bold">{{ $chapter->nama }} <br> </span> 
                {{-- mengambuk data lesson perchapter --}}
                @foreach ($chapter->lessons as $lesson)
                    {{ $lesson->nama }} <a href="" class="text-primary mx-1" data-toggle="modal" data-target="#tes{{ $lesson->id }}"> Cek Video </a> | 
                    <a href="{{ route('lesson-edit', ['id' => $lesson->id, 'course_id' => $course_id]) }}" class="text-warning mx-1" >Edit</a>
                     | <a href="{{ route('lesson-delete', ['id' => $lesson->id, 'course_id' => $course_id]) }}" class="text-danger mx-1">Delete</a>
                    <br>
                    @include('includes.modalCekVideo')
                    {{-- modal edit video/lesson --}}
                     {{-- @include('includes.editVideo') --}}
                @endforeach

                {{-- button modal tambah video --}}
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahLesson{{ $chapter->id }}">
                    Tambah Materi Video
                </button>
                {{-- Modal tambah video --}}
                @include('includes.tambahVideo')
                <hr>
            @endforeach
            

                {{-- Tambah Chapter --}}
                {{-- button modal tambah Chapter --}}
                <button class="btn btn-info btn-block" data-toggle="modal" data-target="#tambahChapter">
                    Tambah Chapter
                </button>
                {{-- Modal tambah chapter --}}
                @include('includes.tambahChapter')
        </div>
    </div>
</div>
    
@endsection
@push('addon-style')
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
@endpush
