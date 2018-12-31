@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="flash-message"></div>
        @if (isset($photo))
            <div class="photo-wrap">
                <div>@getPhoto($photo->img, 'md')</div>
                <div>{{ $photo->name }}</div>
                <div>{{ $photo->description }}</div>
                <div><a href="{{ route('photo.show.original', ['id' => $photo->id]) }}">View Original</a></div>
                @can('author-policy', $photo)
                    <div><a class="btn btn-primary" href="{{ route('photo.edit', ['id'=> $photo->id]) }}">Update</a></div>
                    <button class="btn btn-danger delete-photo" data-id="{{ $photo->id }}">Delete</button>
                @endcan
            </div>
        @endif
    </div>
@endsection