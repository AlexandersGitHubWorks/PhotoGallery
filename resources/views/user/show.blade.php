@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
            </div>
        @endif

        @if (isset($user))
            @if ($user->photos->isEmpty())
                <div class="alert alert-info" role="alert">
                    No uploaded images.
                </div>
            @else
                <div id="flash-message"></div>
                <div class="row">
                    @foreach($user->photos as $photo)
                        <div class="photo-wrap col-4 mb-5">
                            @getPhoto($photo->img, 'sm')
                            <h3 class="my-3">{{ $photo->name }}</h3>
                            <div class="mb-3">{{ $photo->description }}</div>
                            <div class="buttons">
                                <a href="{{ route('photo.show', ['id'=> $photo->id]) }}" class="btn btn-primary">View</a>
                                @can('author-policy', $photo)
                                    <span class="align-middle text-muted">|</span>
                                    <a class="btn btn-danger" href="{{ route('photo.edit', ['id'=> $photo->id]) }}">Update</a>
                                    <button class="btn btn-danger delete-photo" data-id="{{ $photo->id }}">Delete</button>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection