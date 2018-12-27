@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($photo))
            <div>{{ $photo->img }}</div>
            <div>{{ $photo->name }}</div>
            <div>{{ $photo->description }}</div>
{{--            <div><a href="{{ route('photo.show', ['id'=> $photo->id]) }}">View Original</a></div>--}}

            @can('author-policy', $photo)
                <div><a class="btn btn-primary" href="{{ route('photo.edit', ['id'=> $photo->id]) }}">Update</a></div>
                <div>
                    <form action="{{ route('photo.destroy', ['id'=> $photo->id]) }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="delete">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            @endcan

        @endif
    </div>
@endsection