@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
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
                @foreach($user->photos as $photo)
                    <div class="photo-wrap">
                        <div>@getPhoto($photo->img, 'sm')</div>
                        <div>{{ $photo->name }}</div>
                        <div>{{ $photo->description }}</div>
                        <div><a href="{{ route('photo.show', ['id'=> $photo->id]) }}">View</a></div>
                        @can('author-policy', $photo)
                            <div><a class="btn btn-primary" href="{{ route('photo.edit', ['id'=> $photo->id]) }}">Update</a></div>
                            <button class="btn btn-danger delete-photo" data-id="{{ $photo->id }}">Delete</button>
                        @endcan
                    </div>
                @endforeach
            @endif
        @endif
    </div>
@endsection