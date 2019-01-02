@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="flash-message"></div>
        @if (isset($photo))
            <div class="photo-wrap">
                <div class="row">
                    <div class="col-7">
                        @getPhoto($photo->img, 'md')
                    </div>
                    <div class="col-5">
                        <h3 class="mb-3">{{ $photo->name }}</h3>
                        <div class="mb-3">{{ $photo->description }}</div>
                        <div class="buttons">
                        <a href="{{ route('photo.show.original', ['id' => $photo->id]) }}" class="btn btn-primary">View Original</a>
                        @can('author-policy', $photo)
                            <span class="align-middle text-muted">|</span>
                            <a class="btn btn-danger" href="{{ route('photo.edit', ['id'=> $photo->id]) }}">Update</a>
                            <button class="btn btn-danger delete-photo" data-id="{{ $photo->id }}">Delete</button>
                        @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection