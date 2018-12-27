@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($photo))
            <div>{{ $photo->img }}</div>
            <div>{{ $photo->name }}</div>
            <div>{{ $photo->description }}</div>
{{--            <div><a href="{{ route('photo.show', ['id'=> $photo->id]) }}">View Original</a></div>--}}
        @endif
    </div>
@endsection